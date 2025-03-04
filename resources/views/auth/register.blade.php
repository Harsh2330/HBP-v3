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
            .shape1, .shape2 {
                position: absolute;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
            }
            .shape1 {
                background-color:rgba(88, 117, 210, 0.82); /* Change to desired color */
                top: -50px;
                left: -50px;
            }
            .shape2 {
                background-color:rgba(88, 117, 210, 0.82); /* Change to desired color */
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
        @php
        use Illuminate\Support\Facades\Mail;
        use App\Mail\RegistrationSuccess;
        @endphp
    </head>
    <body>
        <div class="l-form">
            <div class="shape1"></div>
            <div class="shape2"></div>

            <div class="form">
                <img src="/image/image.jpg" alt="" class="form__img">

                <form method="POST" action="{{ route('register') }}" onsubmit="sendRegistrationEmail(event)">
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

            function sendRegistrationEmail(event) {
                event.preventDefault();
                const form = event.target;
                const formData = new FormData(form);
                const data = {
                    name: formData.get('name'),
                    email: formData.get('email'),
                    password: formData.get('password')
                };

                fetch('{{ route('register') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Mail::to(data.email)->send(new RegistrationSuccess(data));
                        alert('Registration successful! An email has been sent to you.');
                        form.submit();
                    } else {
                        alert('Registration failed. Please try again.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        </script>

        <!-- ===== MAIN JS ===== -->
        <script src="/js/main.js"></script>
    </body>
</html>
