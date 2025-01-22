// Sending a message via AJAX
function sendMessage() {
    const messageInput = document.querySelector('.chat-input input');
    const message = messageInput.value;
    const receiverId = document.querySelector('.chat-area').getAttribute('data-receiver-id'); // Assume you're storing the receiver's ID here

    if (message.trim() === '') {
        return;
    }

    // Send the message via AJAX
    $.ajax({
        url: '{{ route('send.message') }}',
        method: 'POST',
        data: {
            message: message,
            receiver_id: receiverId,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            // Clear the input field after message is sent
            messageInput.value = '';

            // Append the message to the chat box
            const messagesDiv = document.querySelector('.messages');
            messagesDiv.innerHTML += `<p>You: ${response.message}</p>`;
        },
        error: function(error) {
            console.error('Error sending message:', error);
        }
    });
}

// Fetch new messages periodically via AJAX
function fetchMessages() {
    const receiverId = document.querySelector('.chat-area').getAttribute('data-receiver-id');

    $.ajax({
        url: '{{ route('fetch.messages') }}',
        method: 'GET',
        data: {
            receiver_id: receiverId
        },
        success: function(response) {
            const messagesDiv = document.querySelector('.messages');
            messagesDiv.innerHTML = ''; // Clear previous messages

            // Loop through the received messages and append them to the chat box
            response.messages.forEach(function(message) {
                const sender = message.sender_id === {{ auth()->id() }} ? 'You' : message.sender_name;
                messagesDiv.innerHTML += `<p>${sender}: ${message.message}</p>`;
            });
        },
        error: function(error) {
            console.error('Error fetching messages:', error);
        }
    });
}

// Call fetchMessages every 5 seconds to get new messages
setInterval(fetchMessages, 5000);

// Handle message send button click
document.querySelector('.send-message').addEventListener('click', sendMessage);

// Optionally handle enter key for sending messages
document.querySelector('.chat-input input').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
});




































@extends('client.layout')
@section('content')
<div id="chat-container">
    <div class="user-list">
        <div class="tabs">
            <button class="tablink" onclick="openTab(event, 'Admin')">Admin</button>
            <button class="tablink" onclick="openTab(event, 'Architects')">Architects</button>
            <button class="tablink" onclick="openTab(event, 'Designers')">Designers</button>
        </div>

        <!-- Admin Tab Content -->
        <div class="tabcontent" id="Admin" style="display:none;">

        </div>

        <!-- Architects Tab Content -->
        <div class="tabcontent" id="Architects" style="display:none;">
    <ul id="architect-list">
        @foreach ($projects as $project)
            @if ($project->staff->user->role === 'architect')
                <li class="user" data-name="{{ $project->staff->user->name }}" onclick="openChat('{{ $project->staff->user->name }}')">
                    {{ $project->staff->user->name }}
                </li>
            @endif
        @endforeach
    </ul>
</div>

        <!-- Designers Tab Content -->
        <div class="tabcontent" id="Designers" style="display:none;">
    <ul id="designer-list">
        @foreach ($projects as $project)
            @if ($project->staff->user->role === 'designer')
                <li class="user" data-name="{{ $project->staff->user->name }}" onclick="openChat('{{ $project->staff->user->name }}')">
                    {{ $project->staff->user->name }}
                </li>
            @endif
        @endforeach
    </ul>
</div>

    </div>

    <div class="chat-area">
        <div class="chat-box" id="chat-box">
            <div class="messages">
                <!-- Messages will appear here -->
            </div>
            <div class="chat-input">
                <input type="text" placeholder="Type your message...">
                <button class="attach-file">Attach File</button>
                <button class="send-message">Send</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openTab(evt, tabName) {
        // Hide all tab content
        const tabContents = document.querySelectorAll('.tabcontent');
        tabContents.forEach(content => {
            content.style.display = "none";
        });

        // Remove active class from all tab links
        const tabLinks = document.querySelectorAll('.tablink');
        tabLinks.forEach(link => {
            link.classList.remove('active');
        });

        // Show the selected tab content
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.classList.add('active');

        if (tabName === 'Admin') {
        openChat('Admin');
    }
    }

    function openChat(userType) {
        const messages = document.querySelector('.messages');
        messages.innerHTML = `<p>Chatting with ${userType}</p>`; // Simulated messages
    }

        // Get all the architect list items
        const architectListItems = document.querySelectorAll('#architect-list li');
    
    // Create a Set to store unique architect names
    const uniqueArchitects = new Set();

    architectListItems.forEach(item => {
        const architectName = item.getAttribute('data-name');

        // If the architect name already exists in the Set, remove the duplicate item
        if (uniqueArchitects.has(architectName)) {
            item.remove();
        } else {
            uniqueArchitects.add(architectName);
        }
    });

     // Get all the designer list items
     const designerListItems = document.querySelectorAll('#designer-list li');
    
    // Create a Set to store unique designer names
    const uniqueDesigners = new Set();

    designerListItems.forEach(item => {
        const designerName = item.getAttribute('data-name');

        // If the designer name already exists in the Set, remove the duplicate item
        if (uniqueDesigners.has(designerName)) {
            item.remove();
        } else {
            uniqueDesigners.add(designerName);
        }
    });



</script>
@endsection