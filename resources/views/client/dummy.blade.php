@extends('admin.layout')
@section('content')
<div id="chat-container">
    <div class="user-list">
        <div class="tabs">
            <button class="tablink" onclick="openTab(event, 'Client')">Client</button>
            <button class="tablink" onclick="openTab(event, 'Architects')">Architects</button>
            <button class="tablink" onclick="openTab(event, 'Designers')">Designers</button>
        </div>

        <!-- Clients Tab -->
        <div class="tabcontent" id="Client" style="display:none;">
            <ul>
                @foreach ($clients as $client)
                    <li class="user" data-name="{{ $client->user->name }}" data-image="{{ asset($client->profile_image) }}"
                        onclick="openChat('{{ $client->user->id }}', '{{ $client->user->name }}')">{{ $client->user->name }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Architects Tab -->
        <div class="tabcontent" id="Architects" style="display:none;">
            <ul>
                @foreach ($staffs as $staff)
                    @if ($staff->user->role === 'architect')
                        <li class="user" data-name="{{ $staff->user->name }}" data-image="{{ asset($staff->profile_image) }}"
                            onclick="openChat('{{ $staff->user->id }}', '{{ $staff->user->name }}')">{{ $staff->user->name }}</li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Designers Tab -->
        <div class="tabcontent" id="Designers" style="display:none;">
            <ul>
                @foreach ($staffs as $staff)
                    @if ($staff->user->role === 'designer')
                        <li class="user" data-name="{{ $staff->user->name }}" data-image="{{ asset($staff->profile_image) }}"
                            onclick="openChat('{{ $staff->user->id }}', '{{ $staff->user->name }}')">{{ $staff->user->name }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="chat-area" id="chat-area" style="display:none;">
        <div class="chat-box" id="chat-box">
            <div id="chat-head" class="chat-head"></div>
            <div class="messages" id="messages"></div>

            <div class="chat-input">
                <form method="POST" id="messageForm">
                    @csrf
                    <input type="hidden" name="from_id" value="{{ $user->id }}">
                    <div id="reciever"></div>
                    <div class="messageBox">
                        <input placeholder="Message..." type="text" name="message" id="messageInput" />
                        <button type="submit" id="sendButton">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let receiverId = ''; // Global variable for the selected user

    $(document).ready(function () {
        // Restore active tab and chat after page reload
        const activeTab = localStorage.getItem('activeTab') || 'Client';
        openTab(null, activeTab);

        const activeUser = localStorage.getItem('activeUser');
        const activeUserName = localStorage.getItem('activeUserName');
        if (activeUser && activeUserName) {
            openChat(activeUser, activeUserName);
        }

        // Function to fetch messages
        function fetchMessages() {
            const to_id = receiverId;
            if (!to_id) return; // Exit if no chat is opened

            $.ajax({
                url: '/fetch-messages', // Update to the actual route for fetching messages
                type: 'GET',
                data: { to_id },
                success: function (response) {
                    $('#messages').html(''); // Clear previous messages
                    response.messages.forEach(function (message) {
                        const msgClass = message.from_id == response.current_user_id ? 'send-message' : 'reply-message';
                        $('#messages').append(`
                            <div class="${msgClass}">
                                <p>${message.message}</p>
                                <p>${message.created_at}</p>
                            </div>
                        `);
                    });
                },
                error: function (xhr) {
                    console.error('Error fetching messages:', xhr);
                }
            });
        }

        // Handle form submission for sending a message
        $('#messageForm').on('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('to_id', receiverId);

            $.ajax({
                url: '/send-message', // Update to the actual route for sending messages
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        $('#messageInput').val(''); // Clear message input
                        fetchMessages(); // Refresh chat
                    }
                },
                error: function (xhr) {
                    console.error('Error sending message:', xhr);
                }
            });
        });

        // Fetch messages every 5 seconds
        setInterval(fetchMessages, 5000);
    });

    // Function to open a chat
    function openChat(selectedReceiverId, userName) {
        receiverId = selectedReceiverId;
        $('#reciever').html(`<input type="hidden" name="to_id" id="to_id" value="${selectedReceiverId}">`);

        // Update chat header with the user's name
        $('#chat-head').html(`<h4>${userName}</h4>`);
        $('#chat-area').show();

        localStorage.setItem('activeUser', receiverId);
        localStorage.setItem('activeUserName', userName);

        fetchMessages(); // Load messages for the selected chat
    }

    // Function to handle tab switching
    function openTab(evt, tabName) {
        $('.tabcontent').hide();
        $(`#${tabName}`).show();
        $('.tablink').removeClass('active');
        if (evt) evt.currentTarget.classList.add('active');
        localStorage.setItem('activeTab', tabName);
    }
</script>
@endsection
