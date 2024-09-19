<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Gallery</title>
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

.filter-section {
    padding: 30px;
    text-align: center;
}

.filter-options select {
    padding: 10px;
    margin: 10px;
    border-radius: 5px;
    border: 1px solid #6c757d;
    background-color: #343a40;
    color: #f7f7f7;
}

#plan-gallery {
    padding: 30px;
    text-align: center;
}

.plan-cards {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.plan-card {
    background-color: #282828;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    width: 30%;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.plan-card img {
    width: 100%;
    border-radius: 5px;
    margin-bottom: 15px;
}

.plan-card h3 {
    color: #ffffff;
    margin-bottom: 10px;
}

.plan-card p {
    color: #b5b5b5;
}

.plan-card a {
    display: inline-block;
    padding: 10px 15px;
    background-color: #BB86FC;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

.plan-card a:hover {
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
            <h1>Plan Gallery</h1>
        </div>
        <ul class="nav-links">
            <li><a href="Homepag2.html">Home</a></li>
            <!-- <li><a href="#plans">Plans</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#contact">Contact</a></li> -->
        </ul>
    </nav>

    <section class="filter-section">
        <h2>Filter Plans</h2>
        <div class="filter-options">
            <select id="cost-filter">
                <option value="">Filter by Cost</option>
                <option value="100000-200000">$100,000 - $200,000</option>
                <option value="200000-400000">$200,000 - $400,000</option>
                <option value="400000-600000">$400,000 - $600,000</option>
            </select>

            <select id="size-filter">
                <option value="">Filter by Size</option>
                <option value="1000-2000">1,000 - 2,000 sq ft</option>
                <option value="2000-3000">2,000 - 3,000 sq ft</option>
                <option value="3000-4000">3,000 - 4,000 sq ft</option>
            </select>
        </div>
    </section>

    <section id="plan-gallery">
        <h2>Plans</h2>
        <div class="plan-cards">
            <div class="plan-card">
                <img src="plan2.png" alt="Plan 1">
                <h3>Modern Villa</h3>
                <p>Cost: $500,000</p>
                <p>Size: 3,500 sq ft</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="plan-card">
                <img src="plan2.png" alt="Plan 2">
                <h3>Traditional Bungalow</h3>
                <p>Cost: $300,000</p>
                <p>Size: 2,200 sq ft</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="plan-card">
                <img src="plan2.png" alt="Plan 3">
                <h3>Minimalist Apartment</h3>
                <p>Cost: $200,000</p>
                <p>Size: 1,800 sq ft</p>
                <a href="#" class="view-details">View Details</a>
            </div>
        </div>
        <div class="plan-cards">
            <div class="plan-card">
                <img src="plan2.png" alt="Plan 4">
                <h3>Luxury Mansion</h3>
                <p>Cost: $600,000</p>
                <p>Size: 4,000 sq ft</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="plan-card">
                <img src="plan2.png" alt="Plan 5">
                <h3>Eco-Friendly House</h3>
                <p>Cost: $250,000</p>
                <p>Size: 1,500 sq ft</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="plan-card">
                <img src="plan2.png" alt="Plan 6">
                <h3>Modern Townhouse</h3>
                <p>Cost: $350,000</p>
                <p>Size: 2,500 sq ft</p>
                <a href="#" class="view-details">View Details</a>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>
</body>
</html>
