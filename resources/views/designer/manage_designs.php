<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Designs</title>
    <link rel="stylesheet" href="design_manage.css">
</head>
<style>
    /* General Styles */
body {
    background-color: #1c1c1c;
    color: #f7f7f7;
    font-family: Arial, sans-serif;
    margin: 0;  
    padding: 0;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #343a40;
    padding: 15px 30px;
}

nav .title h1 {
    color: #ffffff;
    margin: 0;
    font-size: 24px;
    text-decoration: none;
}

nav .nav-links {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

nav .nav-links li {
    margin-left: 20px;
}

nav .nav-links li a {
    color: #f7f7f7;
    text-decoration: none;
    transition: color 0.5s ease;
}

nav .nav-links li a:hover {
    color: #b5b5b5;
}

footer {
    text-align: center;
    padding: 10px;
    background-color: #bb86fc;
    color: #f7f7f7;
    /* margin-top: 100px; */
    /* margin-top: 390px; */
}

/* Manage Designs and Gallery Section */
#manage-designs, #manage-design-gallery {
    margin: 40px auto;
    padding: 20px;
    background-color: #282828;
    border-radius: 10px;
    width: 90%;
    max-width: 1200px;
}

#manage-designs h2, #manage-design-gallery h2 {
    font-size: 28px;
    margin-bottom: 20px;
}

.spacer {
    height: 40px;
}

.gallery-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.gallery-actions .btn-add {
    padding: 10px 20px;
    background-color: #BB86FC;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.gallery-actions .btn-add:hover {
    background-color: #8A2C8C;
}

/* Table Styles */
table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

table th, table td {
    border: 1px solid #343a40;
    padding: 15px;
    text-align: center;
}

table th {
    background-color: #282828;
    color: #ffffff;
}

table td {
    background-color: #1c1c1c;
    color: #b5b5b5;
}

/* Action Buttons */
.edit-btn, .delete-btn {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
    color: #ffffff;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.edit-btn {
    background-color: #BB86FC;
}

.delete-btn {
    background-color: #E74C3C;
}

.edit-btn:hover {
    background-color: #8A2C8C;
}

.delete-btn:hover {
    background-color: #C0392B;
}

</style>
<body>
    <nav>
        <div class="title">
            <a href="admin.html"><h1>Admin Dashboard</h1></a>
        </div>
        <ul class="nav-links">
            <li><a href="Homepag2.html">Home</a></li>
            <li><a href="plan_gallery.html">Plan Gallery</a></li>
            <li><a href="designer_gallery.html">Designer Gallery</a></li>
            <li><a href="admin.html">Admin</a></li>
        </ul>
    </nav>

    <section id="manage-designs">
        <h2>Manage Custom Designs</h2>
        <table>
            <thead>
                <tr>
                    <th>Custom Design ID</th>
                    <th>Client ID</th>
                    <th>Requirements</th>
                    <th>Additional Notes</th>
                    <th>Payment</th>
                    <th>Design Attachments</th>
                    <th>Design ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2</td>
                    <td>201</td>
                    <td>Modern design with glass facades</td>
                    <td>Requires approval for balcony extension</td>
                    <td>Paid</td>
                    <td><a href="design.jpg" target="_blank">View</a></td>
                    <td>7</td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>202</td>
                    <td>Classy design with Wooden accents</td>
                    <td>Requires approval for floor extension</td>
                    <td>Not Paid</td>
                    <td><a href="design.jpg" target="_blank">View</a></td>
                    <td>7</td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <div class="spacer"></div>

    <section id="manage-design-gallery">
        <h2>Manage Design Gallery</h2>
        <div class="gallery-actions">
            <p>View and manage designs displayed in the gallery below:</p>
            <a href="add_design.html" class="btn-add">Add New Design</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Design ID</th>
                    <th>Design Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>desc</td>
                    <td><img src="design.jpg" alt="Design Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>desc</td>
                    <td><img src="design.jpg" alt="Design Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>desc</td>
                    <td><img src="design.jpg" alt="Design Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>desc</td>
                    <td><img src="design.jpg" alt="Design Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>desc</td>
                    <td><img src="design.jpg" alt="Design Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>desc</td>
                    <td><img src="design.jpg" alt="Design Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>
</body>
</html>
