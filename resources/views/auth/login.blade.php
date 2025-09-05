<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Tour Guide - Sign In</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/src/assets/img/logo.svg') }}" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Global Styling */
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Nunito', sans-serif;
        }

        .login-container {
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }

        /* Left Section Styles */
        .login-left {
            flex: 1.7;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            /* Add right-side border */
        }


        .overlay {
            text-align: center;
            color: #000;
            padding: 2rem;
        }

        .overlay img {
            max-width: 80%;
            height: auto;
            margin: 1rem 0;
        }

        .overlay h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .overlay p {
            font-size: 1rem;
            color: #666;
        }

        /* Right Section Styles */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            background-color: #1e353d;
        }

        .card {
            width: 100%;
            max-width: 400px;
            background-color: transparent;
            border: none;
            box-shadow: none;
        }

        .card-body h2,
        .card-body p {
            color: #fff;
            /* Set text color to white */
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .floating-label {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            font-size: 16px;
            color: #fff;
            /* Label text color white */
            transition: 0.2s ease all;
            pointer-events: none;
        }

        .floating-input {
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: transparent;
            color: #fff;
            /* White text */
            transition: 0.3s ease all;
            /* Smooth hover effect */
        }

        /* Transparent input box by default */
        .floating-input:hover {
            background-color: white;
            /* Background turns white on hover */
            color: #1e353d;
            /* Text turns dark */
        }


        /* When input has a value or is focused */
        .floating-input:focus,
        .floating-input:not(:placeholder-shown) {
            background-color: white;
            /* Background turns white */
            color: #1e353d;
            /* Text turns dark */
        }

        .floating-input:focus~.floating-label,
        .floating-input:not(:placeholder-shown)~.floating-label {
            top: -8px;
            left: 10px;
            font-size: 15px;
            color: white;
        }

        .floating-input::placeholder {
            color: transparent;
            /* Hides placeholder for floating effect */
        }


        /* Change label color only while input box is hovered */
        .floating-input:hover~.floating-label {
            color: #1e353d;
            /* Label color changes to black on hover */
        }

        /* Reset label color for all other states */
        .floating-input:focus~.floating-label,
        .floating-input:not(:placeholder-shown)~.floating-label {
            color: white;
            /* Keep label color white when focused or filled */
        }

        .floating-input:focus {
            outline: none;
            border-color: #80bdff;
            /* Focus border */
            box-shadow: 0 0 5px rgba(128, 189, 255, 0.8);
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
        }

        .btn-login {
            background-color: white;
            color: #1e353d;
            font-weight: bold;
            border: none;
            width: 100%;
            padding: 0.75rem;
            border-radius: 5px;
        }

        .btn-login:hover {
            background-color: skyblue;
            color: #fff;
        }

        .form-check-label {
            color: #fff;
            /* Remember me text color */
        }
    </style>

</head>

<body>

    <div class="login-container">
        <!-- Left Section: Image with overlay -->
        <div class="login-left">
            <div class="overlay">
                <div>
                    <img src="{{ asset('src/assets/img/new-login-image.jpg') }}" alt="Tour Image" class="rounded">
                </div>
            </div>

        </div>
        <!-- Right Section: Sign-in Form -->
        <div class="login-right">
            <div class="card">
                <div class="card-body">

                    <div class="text-center mb-4">
                        <img src="{{ asset('/src/assets/img/new-log2-img.png') }}" alt="Logo" class=""
                            width="200" height="150" style="border-radius: 5%;">
                    </div>

                    <h2 class="mb-2 text-center">Sign In</h2>
                    <p class="text-center mb-4">Enter your email and password to continue</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-4">
                            <input id="email" placeholder=" " class="form-control form-control-sm floating-input"
                                type="email" name="email" required autofocus>
                            <label for="email" class="floating-label">Email</label>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group password-container">
                            <input id="password" placeholder=" " class="form-control form-control-sm floating-input"
                                type="password" name="password" required>
                            <label for="password" class="floating-label">Password</label>
                            <i class="toggle-password fas fa-eye" onclick="togglePassword()"></i>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        <button type="submit" class="btn btn-login">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }
    </script>

</body>

</html>
