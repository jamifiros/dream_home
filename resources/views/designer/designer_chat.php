<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designer Chat</title>
    <link rel="stylesheet" href="designer_chat_style.css">
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    box-sizing: border-box;
}

body {
    background-color: #1c1c1c;
    color: #f7f7f7;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #343a40;
    padding: 15px 30px;
}

.title h1 {
    color: #ffffff;
}

.nav-links {
    display: flex;
    list-style: none;
}

.nav-links li {
    margin-left: 20px;
}

.nav-links li a {
    color: #f7f7f7;
    text-decoration: none;
    transition: color 0.5s ease;
}

.nav-links li a:hover {
    color: #b5b5b5;
}

footer {
    text-align: center;
    padding: 20px;
    background-color: #bb86fc;
    color: #f7f7f7;
    margin-top: 280px;
}

.chat-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: #282828;
    border-radius: 10px;
}

.chat-container h2 {
    font-size: 28px;
    margin-bottom: 20px;
    text-align: center;
}

.tabs {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.tab-button {
    background-color: #1c1c1c;
    color: #f7f7f7;
    border: 1px solid #343a40;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    flex: 1;
    text-align: center;
}

.tab-button.active {
    background-color: #bb86fc;
    color: #ffffff;
    border-bottom: 1px solid #282828;
}

.tab-button:hover {
    background-color: #343a40;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.client-selector {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.client-selector label {
    margin-bottom: 10px;
}

.client-selector select {
    width: 100%;
    padding: 10px;
    border: 1px solid #343a40;
    background-color: #282828;
    color: #f7f7f7;
    border-radius: 5px;
    box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
}

.client-selector select:focus {
    background-color: #1c1c1c;
    outline: none;
}

.chat-box {
    background-color: #1c1c1c;
    border: 1px solid #343a40;
    border-radius: 5px;
    padding: 20px;
    height: 400px;
    display: flex;
    flex-direction: column;
}

.messages {
    flex: 1;
    overflow-y: auto;
    margin-bottom: 20px;
}

.chat-input {
    display: flex;
    align-items: center;
    gap: 10px;
}

.chat-input input[type="text"] {
    flex: 1;
    padding: 10px;
    border: 1px solid #343a40;
    border-radius: 5px;
    background-color: #282828;
    color: #f7f7f7;
}

.attach-file, .send-message {
    background-color: #bb86fc;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.attach-file:hover, .send-message:hover {
    background-color: #8a2c8c;
}

</style>
<body>
    <nav>
        <div class="title">
            <h1>Designer Chat</h1>
        </div>
        <ul class="nav-links">
            <li><a href="Homepag2.html">Home</a></li>
            <li><a href="plan_gallery.html">Plan Gallery</a></li>
            <li><a href="designer_gallery.html">Designer Gallery</a></li>
            <li><a href="designer_dashboard.html">Dashboard</a></li>
        </ul>
    </nav>

    <div class="chat-container">
        <h2>Chat with Admin, Architect, and Clients</h2>
        <div class="tabs">
            <button class="tab-button active" onclick="openTab('admin')">Admin</button>
            <button class="tab-button" onclick="openTab('architect')">Architect</button>
            <button class="tab-button" onclick="openTab('clients')">Clients</button>
        </div>
        <div id="admin" class="tab-content active">
            <div class="chat-box">
                <div class="messages">
                    <!-- Admin messages will appear here -->
                </div>
                <div class="chat-input">
                    <input type="text" placeholder="Type your message...">
                    <button class="attach-file">Attach File</button>
                    <button class="send-message">Send</button>
                </div>
            </div>
        </div>
        <div id="architect" class="tab-content">
            <div class="chat-box">
                <div class="messages">
                    <!-- Architect messages will appear here -->
                </div>
                <div class="chat-input">
                    <input type="text" placeholder="Type your message...">
                    <button class="attach-file">Attach File</button>
                    <button class="send-message">Send</button>
                </div>
            </div>
        </div>
        <div id="clients" class="tab-content">
            <div class="client-selector">
                <label for="client-select">Select Client:</label>
                <select id="client-select">
                    <option value="client1">Client 1</option>
                    <option value="client2">Client 2</option>
                    <option value="client3">Client 3</option>
                    <!-- Add more client options here -->
                </select>
            </div>
            <div class="chat-box">
                <div class="messages">
                    <!-- Client messages will appear here -->
                </div>
                <div class="chat-input">
                    <input type="text" placeholder="Type your message...">
                    <button class="attach-file">Attach File</button>
                    <button class="send-message">Send</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>

    <script>
        function openTab(tabId) {
            var tabs = document.querySelectorAll('.tab-content');
            var buttons = document.querySelectorAll('.tab-button');

            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });

            buttons.forEach(function(button) {
                button.classList.remove('active');
            });

            document.getElementById(tabId).classList.add('active');
            document.querySelector(`.tab-button[onclick="openTab('${tabId}')"]`).classList.add('active');
        }
    </script>
</body>
</html>
