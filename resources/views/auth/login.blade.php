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
            .shape1 {
                background-color:rgb(229, 196, 6); /* Change to desired color */
            }
            .shape2 {
                background-color:rgb(228, 209, 4); /* Change to desired color */
            }
        </style>
    </head>
    <body>
        <div class="l-form">
            <div class="shape1"></div>
            <div class="shape2"></div>

            <div class="form">
                <img src="/image/patients.jpg" alt="" class="form__img" style="width: 650px; height: auto; margin-top: -1rem;">

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
                    <p class="form__text">Don't have an account?</p>
                    <a href="{{ route('register') }}" class="form__button form__button--signup">
                        Sign up
                    </a>
                </form>
            </div>

        </div>
        
        <!-- ===== MAIN JS ===== -->
        <script src="/js/main.js"></script>
    </body>
</html>