<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Architect Dashboard</title>
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
    margin-top: 380px;
}

/* Architect Dashboard */
#architect-dashboard {
    padding: 40px;
    background-color: #282828;
    border-radius: 10px;
    margin: 20px;
}

#architect-dashboard h2 {
    font-size: 28px;
    margin-bottom: 20px;
}

.architect-sections {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.architect-section {
    background-color: #1c1c1c;
    border: 1px solid #343a40;
    padding: 20px;
    border-radius: 10px;
    width: calc(50% - 20px);
}

.architect-section h3 {
    font-size: 22px;
    margin-bottom: 10px;
}

.architect-section p {
    font-size: 16px;
    margin-bottom: 20px;
}

.view-details {
    display: inline-block;
    padding: 10px 20px;
    background-color: #BB86FC;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.view-details:hover {
    background-color: #8A2C8C;
}

/* Buttons */
.btn-add {
    display: inline-block;
    padding: 10px 20px;
    background-color: #BB86FC;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn-add:hover {
    background-color: #8A2C8C;
}

/* Input Fields */
input[type="text"], input[type="number"], input[type="password"], input[type="email"], textarea, select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #343a40;
    background-color: #1c1c1c;
    color: #f7f7f7;
    border-radius: 5px;
    box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
}

input[type="text"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="email"]:focus, textarea:focus, select:focus {
    background-color: #282828;
    outline: none;
}

textarea {
    height: 100px;
}

button, input[type="submit"] {
    background-color: #BB86FC;
    color: #ffffff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button:hover, input[type="submit"]:hover {
    background-color: #8A2C8C;
}

</style>
<body>
    <nav>
        <div class="title">
            <h1>Architect Dashboard</h1>
        </div>
        <ul class="nav-links">
            <li><a href="Homepag2.html">Home</a></li>
            <li><a href="manage_plans.html">Manage Plans</a></li>
            <li><a href="architect_profile.html">Profile</a></li>
            <li><a href="architect_chat.html">Chat</a></li>
        </ul>
    </nav>

    <section id="architect-dashboard">
        <h2>Welcome, Architect</h2>
        <div class="architect-sections">
            <div class="architect-section">
                <h3>Profile Management</h3>
                <p>View and update your profile details.</p>
                <a href="architect_profile.html" class="view-details">View Profile</a>
            </div>
            <div class="architect-section">
                <h3>Manage Plans</h3>
                <p>View, edit, and manage project plans.</p>
                <a href="manage_plans.html" class="view-details">Manage Plans</a>
            </div>
            <div class="architect-section">
                <h3>Chat with Staff/Clients</h3>
                <p>Engage in conversations with Admin, Designer, and Clients.</p>
                <a href="architect_chat.html" class="view-details">Go to Chat</a>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>
</body>
</html>
