<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback and Ratings</title>
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
    margin-bottom: 20px;
}

.title {
    display: flex;
    align-items: center;
}

.title h1 {
    color: #ffffff;
    margin: 0;
    font-size: 24px;
}

.nav-links {
    display: flex;
    list-style: none;
    align-items: center; /* Align items vertically */
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
    margin-top: 445px;
}

main {
    padding: 40px;
    background-color: #282828;
    border-radius: 10px;
    margin: 0 auto;
    max-width: 1200px;
}

h1 {
    font-size: 28px;
    margin-bottom: 30px;
    text-align: center;
}

.feedback-container {
    background-color: #1c1c1c;
    padding: 20px;
    border: 1px solid #343a40;
    border-radius: 10px;
    margin-bottom: 30px;
}

.feedback-container h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #ffffff;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #282828;
}

table th, table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #343a40;
}

table th {
    background-color: #343a40;
    color: #f7f7f7;
}

table td {
    color: #f7f7f7;
}

table tr:hover {
    background-color: #343a40;
}

</style>
<body>
    <nav>
        <div class="title">
            <h1>Feedback</h1>
            <!-- <a href="admin.html"><h1>Admin Dashboard</h1></a> -->
        </div>
        <ul class="nav-links">
            <li><a href="home.html">Home</a></li>
            <li><a href="plan_gallery.html">Plan Gallery</a></li>
            <li><a href="designer_gallery.html">Designer Gallery</a></li>
            <li><a href="feedback.html">Feedback</a></li>
            <li><a href="admin.html">Admin</a></li>
        </ul>
    </nav>

    <main>
        <h1>Client Feedback and Ratings</h1>
        
        <section class="feedback-container">
            <h2>Feedback List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Feedback</th>
                        <th>Rating</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>201</td>
                        <td>Great design and service!</td>
                        <td>5</td>
                        <td>Very satisfied with the outcome.</td>
                    </tr>
                    <tr>
                        <td>202</td>
                        <td>Good work but delayed delivery.</td>
                        <td>3</td>
                        <td>Needs improvement in meeting deadlines.</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>
</body>
</html>
