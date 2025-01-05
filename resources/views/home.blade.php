<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('storage/css/Home_style.css') }}">
</head>
<body>
    <nav>
        <div class="title">
           <h1>Home Plans</h1>
        </div>
        <ul class="nav-links">
            <!-- <li><a href="#plans">Plans</a></li> -->
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="{{route('login')}}" class="button">login</a></li>
        </ul>
    </nav>
    
    <header class="header-section" id="home">
        <div class="overlay">
            <h1>Custom Home Builder</h1>
            <h2>Explore a variety of home plans</h2>
            <a href="{{route('showRegform')}}" class="button">Explore</a>
        </div>
    </header>
    
    <!-- <section id="plans">
        <h2>Plans</h2>
        <div class="plan-pdiv">
            <div class="plan-cdiv">
                <img src="plan.png" alt="">
                <h2>Plan 1</h2>
            </div>
            <div class="plan-cdiv">
                <img src="plan.png" alt="">
                <h2>Plan 2</h2>
            </div>
            <div class="plan-cdiv">
                <img src="plan.png" alt="">
                <h2>Plan 3</h2>
            </div>
        </div>
    </section> -->

    <section id="gallery">
        <h2>Gallery</h2>
        <div class="architect">
            <h1>Architect Gallery</h1>
            <div class="arc-gallery">
                @foreach ($plans as $plan)
                <img src="{{asset($plan->plan_image)}}" alt="">
                @endforeach
            </div>
        </div>
        <div class="architect">
            <h1>Designer Gallery</h1>
            <div class="arc-gallery">
            @foreach ($designs as $design)
                <img src="{{asset($design->design_image)}}" alt="">
                
            @endforeach
            </div>
        </div>
    </section>
    
    <section id="about">
        <div class="about">
            <h1>About Us</h1>
            <p>We are a team of architects and designers passionate about providing industry-leading designs for your home.</p>
        </div>
    </section>
    
    <section id="contact">
        <div class="contact">
            <h1>Contact</h1>
            <p>Reach us at our email: customhomebuilder@gmail.com</p>
        </div>
    </section>
    
    <footer>
        <p>&copy; 2024 @ Custom Home Builder</p>
    </footer>
</body>
</html>
