<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: rgb(22, 22, 22);
    font-family: Arial, sans-serif;
}

.register {
    background-color: #FFFFFF;
    padding: 30px;
    width: 600px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
}

.register-form h2 {
    text-align: center;
    margin-bottom: 20px;
    color: rgb(0, 0, 0);
}

.form-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.form-label {
    width: 48%;
}

.form-label.full-width {
    width: 100%;
    margin-top: 10px;
    text-align: center;
}

.form-label input, .form-label select {
    display: block;
    width: 100%;
    padding: 10px;
    border: 1px solid rgb(200, 200, 200);
    border-radius: 5px;
    background-color: rgb(240, 240, 240);
    color: black;
}

.form-label input:focus, .form-label select:focus {
    outline: none;
    border: 1px solid rgb(150, 150, 150);
}

.form-label button {
    color: white;
    width: 100%;
    padding: 10px;
    background-color: rgb(187, 134, 252); /* Violet color for button */
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.form-label button:hover {
    background-color: rgb(138, 44, 140); /* Darker violet on hover */
}

a {
    color: #BB86FC;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

.error-list{
    color: red;
}

</style>
<body>
<div class="register">
    <form class="register-form" method="POST" action="{{ route('create') }}" enctype="multipart/form-data">
        @csrf
        <h2>Register</h2>
        <div class="form-row">
            <div class="form-label"> 
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-label"> 
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label">
                <label for="password">Create Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-label">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="password_confirmation" id="confirm-password" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-label"> 
                <label for="post">POST</label>
                <input type="text" name="post" id="post">
            </div>
            <div class="form-label"> 
                <label for="pincode">Pincode</label>
                <input type="text" name="pincode" id="pincode">
            </div>
        </div>
        <div class="form-row">
            <div class="form-label"> 
                <label for="place">Place</label>
                <input type="text" name="place" id="place">
            </div>
            <div class="form-label"> 
                <label for="landmark">Landmark</label>
                <input type="text" name="landmark" id="landmark">
            </div>
        </div>
        <div class="form-row">
            <div class="form-label"> 
                <label for="contact">Contact No.</label>
                <input type="text" name="contact" id="contact">
            </div>
            <div class="form-label"> 
                <label for="id-proof-type">ID Proof Type</label>
                <select name="id_proof_type" id="id-proof-type" required>
                    <option value="NULL">Please select ID proof</option>
                    <option value="aadhaar">Aadhaar Card</option>
                    <option value="license">Driver's License</option>
                    <option value="pan">PAN Card</option>
                </select>
            </div>
        </div>
        <div class="form-label full-width"> 
            <label for="id-proof">Upload ID Proof</label>
            <input type="file" name="id_proof" id="id-proof" required>
        </div>
        <div class="form-label full-width">
            <button type="submit">Register</button>
        </div>
        <div class="form-label full-width">
            <label>Already have an account?</label>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </form>

    @if ($errors->any())
    <div class="alert alert-danger" style="margin-top: 10px;">
        <ul class=" error-list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</div>

</body>
</html>
