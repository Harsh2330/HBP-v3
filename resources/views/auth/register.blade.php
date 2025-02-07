<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="/css/styles.css">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- jQuery UI CSS -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <title>Registration Page</title>  
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                font-family: 'Arial', sans-serif;
            }
            .l-form {
                position: relative;
                width: 100%;
                max-width: 400px;
                background: #fff;
                padding: 2rem;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
            }
            .form__title {
                margin-bottom: 1.5rem;
                font-size: 1.5rem;
                color: #333;
            }
            .form__div {
                position: relative;
                margin-bottom: 1.5rem;
            }
            .form__icon {
                position: absolute;
                top: 50%;
                left: 10px;
                transform: translateY(-50%);
                color: #666;
            }
            .form__input {
                width: 100%;
                padding: 0.75rem 1rem 0.75rem 2.5rem;
                border: 1px solid #ddd;
                border-radius: 5px;
                outline: none;
                transition: border-color 0.3s;
            }
            .form__input:focus {
                border-color: #007bff;
            }
            .form__button {
                width: 100%;
                padding: 0.75rem;
                border: none;
                border-radius: 5px;
                background: #007bff;
                color: #fff;
                font-size: 1rem;
                cursor: pointer;
                transition: background 0.3s;
            }
            .form__button:hover {
                background: #0056b3;
            }
            .shape1, .shape2 {
                position: absolute;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
            }
            .shape1 {
                background-color:rgb(229, 196, 6); /* Change to desired color */
                top: -50px;
                left: -50px;
            }
            .shape2 {
                background-color:rgb(228, 209, 4); /* Change to desired color */
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
                <img src="/image/image.jpg" alt="" class="form__img">

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h1 class="form__title">Register</h1>

                    <div class="form__div form__div-one">
                        <div class="form__icon">
                            <i class='bx bx-user-circle'></i>
                        </div>

                        <div class="form__div-input">
                            <label for="name" class="form__label">Name</label>
                            <input id="name" type="text" class="form__input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form__div">
                        <div class="form__icon">
                            <i class='bx bx-calendar'></i>
                        </div>

                        <div class="form__div-input">
                            <label for="date_of_birth" class="form__label">Date of Birth</label>
                            <input id="date_of_birth" type="text" class="form__input @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth">
                          
                        </div>
                    </div>
 @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    <div class="form__div">
                        <div class="form__icon">
                            <i class='bx bx-phone'></i>
                        </div>

                        <div class="form__div-input">
                            <label for="phone_number" class="form__label">Phone Number</label>
                            <input id="phone_number" type="text" class="form__input @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                            
                        </div>
                    </div>
                    @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    <div class="form__div">
                        <div class="form__icon">
                            <i class='bx bx-envelope'></i>
                        </div>

                        <div class="form__div-input">
                            <label for="email" class="form__label">Email</label>
                            <input id="email" type="email" class="form__input @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                        </div>
                    </div>
                    @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    <div class="form__div">
                        <div class="form__icon">
                            <i class='bx bx-lock' ></i>
                        </div>

                        <div class="form__div-input">
                            <label for="password" class="form__label">Password</label>
                            <input id="password" type="password" class="form__input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            
                        </div>
                    </div>
                    @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    <div class="form__div">
                        <div class="form__icon">
                            <i class='bx bx-lock' ></i>
                        </div>

                        <div class="form__div-input">
                            <label for="password_confirmation" class="form__label">Confirm Password</label>
                            <input id="password_confirmation" type="password" class="form__input @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                            
                        </div>
                    </div>
                    @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    <button type="submit" class="form__button">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>
        
        <!-- jQuery and jQuery UI JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#date_of_birth", {
                    dateFormat: "Y-m-d"
                });
            });
        </script>

        <!-- ===== MAIN JS ===== -->
        <script src="/js/main.js"></script>
    </body>
</html>
