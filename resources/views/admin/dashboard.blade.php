<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    /* margin-top: 100px; */
    margin-top: 380px;
}

/* Admin Dashboard */
#admin-dashboard {
    padding: 40px;
    background-color: #282828;
    border-radius: 10px;
    margin: 20px;
}

#admin-dashboard h2 {
    font-size: 28px;
    margin-bottom: 20px;
}

.admin-sections {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.admin-section {
    background-color: #1c1c1c;
    border: 1px solid #343a40;
    padding: 20px;
    border-radius: 10px;
    width: calc(50% - 20px);
}

.admin-section h3 {
    font-size: 22px;
    margin-bottom: 10px;
}

.admin-section p {
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
.logout{
    background-color: #BB86FC;
    padding: 10px 20px;
    border-radius: 5px;
}
</style>
<body>
    <nav>
        <div class="title">
            <h1>Admin Dashboard</h1>
        </div>
        <ul class="nav-links">
            <li><a href="Homepag2.html">Home</a></li>
            <li><a href="plan_gallery.html">Plan Gallery</a></li>
            <li><a href="designer_gallery.html">Designer Gallery</a></li>
            <li><a href="admin_chat.html">Chat</a></li>
            <li><a href="{{ route('logout') }}" class="logout">logout</a></li>
        </ul>
    </nav>

    <section id="admin-dashboard">
        <h2>Welcome {{ Auth::user()->name }}</h2>
        <div class="admin-sections">
            <div class="admin-section">
                <h3>User Management</h3>
                <p>Manage user accounts and permissions.</p>
                <a href="manage_users.html" class="view-details">Manage Users</a>
            </div>
            <div class="admin-section">
                <h3>Manage Plans</h3>
                <p>View, edit, and delete plans from the Plan gallery.</p>
                <a href="{{ route('admin.managePlan') }}" class="view-details">Manage Plans</a>
            </div>
            <div class="admin-section">
                <h3>Manage Designs</h3>
                <p>View, edit, and delete designs from the Design gallery.</p>
                <a href="{{ route('admin.manageDesign') }}" class="view-details">Manage Designs</a>
            </div>
            <div class="admin-section">
                <h3>View Feedback / Ratings</h3>
                <p>View Feedback / Ratings from the Clients.</p>
                <a href="{{ route('admin.feedback') }}" class="view-details">Site Settings</a>
            </div>

        </div>
    </section>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>
</body>
</html>
