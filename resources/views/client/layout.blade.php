<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="{{ asset('storage/css/clientStyles.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/customStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/view_profile.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/chatStyles.css') }}">

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
    align-content: center;
    align-items: center;
    background-color: #343a40;
    padding: 15px 30px;
}

.title {
    display: flex; /* Enable flexbox for the title */
    align-items: center; /* Vertically center the title */
    height: 100%; /* Ensure it takes the full height of the nav */
    justify-content: center; /* Center horizontally */
}


.title h1 {
    color: #ffffff;
    margin: 0; /* Remove default margin to avoid extra space */
    line-height: 1.2; /* Adjust line-height for spacing within the title */
}

.nav-links {
    display: flex;
    list-style: none;
    justify-content: center;
    align-items: center;
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

/* Profile dropdown */
.drp {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.drp img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    padding: 5px;
}

.drp-cnt {
    border-radius: 10px;
    border-top-right-radius: 0;
    display: none;
    position: absolute;
    background-color: #4b4949e0;;
    min-width: 150px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    right: 0; /* Aligns the dropdown to the right of the profile image */
    z-index: 1;
    top:40px;
    overflow: hidden;
}

.drp-cnt a {
    display: block;
    color: #f7f7f7;
    padding: 10px;
    text-decoration: none;
    white-space: nowrap;
}

.drp-cnt a:hover {
    background-color: rgba(255,255,255,0.2);
}
.drp .img-div{
    padding: 5px;
    border-radius: 50%;
}
.drp:hover .img-div{
 background-color: #4b4949e0;;
 border-bottom-left-radius: 0;
 border-bottom-right-radius: 0;
}
.drp:hover .drp-cnt {
    display: block;
}
footer {
    font-size: 12px;
    text-align: center;
    padding: 10px;
    background-color: #bb86fc;
    color: #f7f7f7;
    /* margin-top: 100px; */
    position: fixed;
    bottom: 0;
    width: 100%;
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

.badge-cnt{
    background-color: red;
    color: #fff;
    border-radius:50%;
    padding: 2px 5px;
    margin-left: 3px;
}
</style>
<body>
    <nav>
        <div class="title">
            <h1>Client Dashboard</h1>
        </div>
        <ul class="nav-links">
            <li><a href="{{route('client.dashboard')}}">Home</a></li>
            <li><a href="{{route('client.plansGallery')}}">Plan Gallery</a></li>
            <li><a href="{{route('client.designsGallery')}}">Design Gallery</a></li>
            <li><a href="{{route('client.chat')}}">Chat</a></li>
            <div class="drp">
            <li>
                <div class="img-div">
                   @if($client->profile_image)
                      <img src="{{ asset($client->profile_image) }}" alt=""/>
                   @else
                      <img src="{{asset('images/DpDefault.jpg')}}" alt="defaultDp.jpg">
                   @endif            
                </div>
            </li>
            <div class="drp-cnt">
                <a href="{{ route('client.viewprofile', $client->id) }}">profile Settings</a>
                <a href="{{ route('logout') }}">logout</a>
            </div>
            </div>
        </ul>
    </nav>

    {{-- This is where content from other pages will be inserted --}}
    <div class="content">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>
</body>
</html>
