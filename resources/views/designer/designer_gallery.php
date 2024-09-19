<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designer Gallery</title>
    <link rel="stylesheet" href="design_gallery_style.css">
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
    transition: 0.5s ease;
}

.nav-links li a:hover {
    color: #b5b5b5;
}

#designer-gallery {
    padding: 30px;
    text-align: center;
}

#designer-gallery h2 {
    font-size: 36px;
    margin-bottom: 20px;
}

.design-cards {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.design-card {
    background-color: #282828;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    width: 30%;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.design-card img {
    width: 100%;
    border-radius: 5px;
    margin-bottom: 15px;
}

.design-card h3 {
    color: #ffffff;
    margin-bottom: 10px;
}

.design-card p {
    color: #b5b5b5;
    margin-bottom: 10px;
}

.design-card a {
    display: inline-block;
    padding: 10px 15px;
    background-color: #BB86FC;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

.design-card a:hover {
    background-color: #8A2C8C;
}

footer {
    text-align: center;
    padding: 20px;
    background-color: #bb86fc;
    color: #f7f7f7;
}

</style>
<body>
    <nav>
        <div class="title">
            <h1>Designer Gallery</h1>
        </div>
        <ul class="nav-links">
            <li><a href="Homepag2.html">Home</a></li>
            <!-- <li><a href="#plans">Plans</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#contact">Contact</a></li> -->
        </ul>
    </nav>

    <section id="designer-gallery">
        <h2>Designs</h2>
        <div class="design-cards">
            <div class="design-card">
                <img src="design2.jpg" alt="Design 1">
                <h3>Design 1</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="design-card">
                <img src="design2.jpg" alt="Design 2">
                <h3>Design 2</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="design-card">
                <img src="design2.jpg" alt="Design 3">
                <h3>Design 3</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="design-card">
                <img src="design2.jpg" alt="Design 4">
                <h3>Design 4</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="design-card">
                <img src="design2.jpg" alt="Design 5">
                <h3>Design 5</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="design-card">
                <img src="design2.jpg" alt="Design 6">
                <h3>Design 6</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>
</body>
</html>
