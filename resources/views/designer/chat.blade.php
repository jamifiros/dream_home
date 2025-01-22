@extends('designer.layout')
@section('content')
<div id="chat-container">
    <div class="user-list">
        <div class="tabs">
            <button class="tablink" onclick="openTab(event, 'Admin')">Admin</button>
            <button class="tablink" onclick="openTab(event, 'Clients')">Clients</button>
            <button class="tablink" onclick="openTab(event, 'Architects')">Architects</button>
        </div>

        <!-- Admin Tab Content -->
        <div class="tabcontent" id="Admin" style="display:none;"></div>

        <!-- Clients Tab Content -->
        <div class="tabcontent" id="Clients" style="display:none;">
            <ul id="list">
            @if($projects->isEmpty())
            <li>No assigned clients</li>
            @else
                @foreach($projects as $project)
                    <li class="user" data-name="{{ $project->client->user->name }}"
                        data-image="{{ asset($project->client->profile_image) }}"
                        onclick="openChat('{{ $project->client->user->id }}', '{{ $project->client->user->name }}')">
                        {{ $project->client->user->name }}
                    </li>
                @endforeach
            @endif    
            </ul>
        </div>


        <!-- Architects Tab Content -->
        <div class="tabcontent" id="Architects" style="display:none;">
            <ul id="architect-list">
                @foreach($architects as $architect)
                <li class="user" data-name="{{ $architect->name }}"
                        data-image="{{ asset( $architect->staff->profile_image) }}"
                        onclick="openChat('{{ $architect->staff->user->id }}', '{{ $architect->name }}')">
                        {{ $architect->name }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>


    <div class="chat-area" id="chat-area" style="display:none;">
        <div class="chat-box" id="chat-box">
            <div id="chat-head" class="chat-head"></div>
            <div class="messages" id="messages">
                <!-- Messages will be loaded dynamically here -->
            </div>
            <div class="chat-input">
                <form id="messageForm">
                    @csrf
                    <input type="hidden"  id="from_id" name="from_id" value="{{$userId}}">
                    <div id="reciever"></div>
                    <div class="messageBox">
                        <div class="fileUploadWrapper">
                            <label for="file">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 337 337">
                                    <circle stroke-width="20" stroke="#6c6c6c" fill="none" r="158.5" cy="168.5"
                                        cx="168.5"></circle>
                                    <path stroke-linecap="round" stroke-width="25" stroke="#6c6c6c" d="M167.759 79V259">
                                    </path>
                                    <path stroke-linecap="round" stroke-width="25" stroke="#6c6c6c" d="M79 167.138H259">
                                    </path>
                                </svg>
                                <span class="tooltip">Add an image</span>
                            </label>
                        </div>
                        <input placeholder="Message..." type="text" name="message" id="messageInput" />
                        <button type="submit" id="sendButton">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 664 663">
                                <path fill="none"
                                    d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888">
                                </path>
                                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="33.67"
                                    stroke="#6c6c6c"
                                    d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
    let fromId = document.getElementById('from_id').value;
    let receiverId = '';
    $(document).ready(function () {
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            document.getElementById(activeTab).style.display = "block";
            $('.tablink').removeClass('active');
            $("button[onclick*='" + activeTab + "']").addClass('active');
        } else {
            document.getElementById("Client").style.display = "block";
        }

        var activeUser = localStorage.getItem('activeUser');
        var activeUserName = localStorage.getItem('activeUserName');
        if (activeUser && activeUserName) {
            openChat(activeUser, activeUserName);
        }

        $('#messageForm').on('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('to_id', receiverId);

            $.ajax({
                url: '/designer/send-message',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response); // Log the response
                    console.log('Receiver ID:', receiverId); // Log receiverId
                    console.log('From ID:', fromId);
                    if (response.success) {
                        $('#messageInput').val('');
                        fetchMessages(receiverId, fromId);
                    }
                },
                error: function (xhr) {
                    console.error('Error sending message:', xhr);
                }
            });
        });

        setInterval(function() {
        if (receiverId) {  // Ensure we only fetch messages if a receiver is selected
            fetchMessages(receiverId, fromId);
        }
    }, 2000); 
    });



    function openTab(evt, tabName) {
        const tabContents = document.querySelectorAll('.tabcontent');
        tabContents.forEach(content => {
            content.style.display = "none";
        });

        const tabLinks = document.querySelectorAll('.tablink');
        tabLinks.forEach(link => {
            link.classList.remove('active');
        });

        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.classList.add('active');
        localStorage.setItem('activeTab', tabName);
         // Open chat with Admin by default (if needed)
         if (tabName === 'Admin') {
            openChat('{{ $admin->id }}', 'admin'); // Replace 'admin-id' with actual admin ID if needed
        }

    }

    function openChat(selectedReceiverId, userName) {
        receiverId = selectedReceiverId;
        document.getElementById('messageInput').value = '';
        const chathead = document.getElementById('chat-head');
        const chatArea = document.getElementById('chat-area');
        chatArea.style.display = "block";
        const reciever = document.getElementById('reciever');
        reciever.innerHTML = `<input type="hidden" name="to_id" id="to_id" value="${selectedReceiverId}">`;
       
        if(userName === 'admin'){
            chathead.innerHTML = `<img src="{{asset('images/DpDefault.jpg')}}" alt="${userName}'s Profile"><h4>${userName}</h4>`;
        }else{
            chathead.innerHTML = `<img src="${document.querySelector(`[data-name='${userName}']`).getAttribute('data-image')}" alt="${userName}'s Profile"><h4>${userName}</h4>`;
        }
     
        // chathead.innerHTML = `<img src="${document.querySelector(`[data-name='${userName}']`).getAttribute('data-image')}" alt="${userName}'s Profile"><h4>${userName}</h4>`;
        localStorage.setItem('activeUser', receiverId);
        localStorage.setItem('activeUserName', userName);
        fetchMessages(receiverId, fromId);
        
    }

    function fetchMessages(receiverId, fromId) {
        if (!receiverId) return;

        $.ajax({
            url: `/designer/fetch-messages/${receiverId}`,
            type: 'GET',
            data: { from_id: fromId },
            success: function (response) {
                const messagesContainer = $('#messages');
                messagesContainer.empty();

                response.messages.forEach(message => {
                    const messageClass = message.from_id === {{$userId}} ? 'send-message' : 'reply-message';
                    messagesContainer.append(`
                        <div class="${messageClass}">
                            <p>${message.message}</p>
                        </div>
                    `);
                });
                messagesContainer.scrollTop(messagesContainer[0].scrollHeight);
            },
            error: function (xhr) {
                console.error('Error fetching messages:', xhr);
                // Display error message to user
                alert('Failed to fetch messages. Please try again.');
            },
            complete: function () {
                // Optionally hide loading indicator
                $('.loading').remove();
            }
        });
    }

    document.getElementById('message-input').addEventListener('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault(); // Prevent form submission
            document.querySelector('.send-message').click(); // Trigger send message button
        }
    });

    // Function to remove duplicate clients from the list
    const ListItems = document.querySelectorAll('#list li');
    const unique = new Set();

    ListItems.forEach(item => {
        const Name = item.getAttribute('data-name');
        if (unique.has(Name)) {
            item.remove();
        } else {
            unique.add(Name);
        }
    });
</script>
@endsection