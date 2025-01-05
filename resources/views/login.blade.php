<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #000000;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #121212;
        }

        /* Embed iframe to fill the background */
        .background-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            z-index: -1;
            pointer-events: all; 
            /* Makes sure the iframe doesn't block interactions */
        }

        /* Centering and styling the login card */
        .login-container {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: left;
            padding-left: 10%;
            align-items: center;
            width: 100%;
        }

        .login {
            background-color: #FFFFFF;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.1);
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #000000;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #000000;
        }

        .form-group input {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #CED4DA;
            border-radius: 5px;
            font-size: 16px;
            background-color: #F8F9FA;
            color: #000000;
        }

        .form-group input:focus {
            outline: none;
            border: 1px solid #AAB8C2;
        }

        .form-group button {
            color: #FFFFFF;
            width: 100%;
            padding: 10px;
            background-color: #BB86FC;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: #8A2C8C;
        }

        .register-link p {
            color: #8A8A8A;
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #BB86FC;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Background Three.js scene embedded via iframe -->
    <iframe class="background-iframe" src="https://landing-threejs-particle.netlify.app/"></iframe>

    <!-- Login form content -->
    <div class="login-container">
        <div class="login">
            <form class="login-form" method="POST" action="{{ route('login.submit') }}">
                @csrf
                <h2>Login</h2>
                <div class="form-group"> 
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
                <div class="register-link">
                    <p>Don't have an account? <a href="{{ route('showRegform') }}">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Handle errors and success messages
        @if ($errors->any())
            let errorMessages = "";
            @foreach ($errors->all() as $error)
                errorMessages += "{{ $error }}\n";
            @endforeach
            alert(errorMessages);
        @endif
        @if (session('success'))
            alert("{{ session('success') }}");
        @endif
    </script>
</body>
</html>
