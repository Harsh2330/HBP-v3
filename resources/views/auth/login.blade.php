<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="/css/styles.css">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <title>Login form responsive</title>  
        <style>
            .shape1, .shape2 {
                position: absolute;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
                z-index: 2; /* Bring shapes to the front */
                background-color:rgba(122, 169, 250, 0.92); /* Change to desired color */
            }
            .shape1 {
                top: -50px;
                left: -50px;
            }
            .shape2 {
                bottom: -50px;
                right: -50px;
                animation-delay: 3s;
            }
            @keyframes float {
                0%, 100% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-20px);
                }
            }
            .form {
                position: relative;
                z-index: 1;
            }
        </style>
    </head>
    <body>
        <div class="l-form">
            <div class="shape1"></div>
            <div class="shape2"></div>

            <div class="form">
                <img src="/image/72490574_9775039.jpg" alt="" class="form__img" style="width: 700px; height: auto; margin-top: -1rem;">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1 class="form__title">Login</h1>

                    <div class="form__div form__div-one">
                        <div class="form__icon">
                            <i class='bx bx-user-circle'></i>
                        </div>

                        <div class="form__div-input">
                            <label for="login" class="form__label">Email or Unique ID</label>
                            <input class="form__input" type="text" name="login" :value="old('login')" required autofocus>
                            @error('login')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form__div">
                        <div class="form__icon">
                            <i class='bx bx-lock' ></i>
                        </div>

                        <div class="form__div-input">
                            <label for="password" class="form__label">Password</label>
                            <input type="password" class="form__input" id="password" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <a href="{{ route('password.request') }}" class="form__forgot">Forgot Password?</a>

                    <button type="submit" class="form__button">
                        Log in
                    </button>
                    <p class="form__text">Don't have an account?
                        <a href="{{ route('register') }}" class="form__button form__button--signup">
                            Sign up
                        </a>
                    </p>
                    
                </form>
            </div>

        </div>
        
        <!-- ===== MAIN JS ===== -->
        <script src="/js/main.js"></script>
    </body>
</html>