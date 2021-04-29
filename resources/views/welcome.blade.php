<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Scripts -->
        <script src="{{ secure_asset('js/app.js') }}" ></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.js"></script>
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">

        <title>Calendario Educativo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
        
        <!-- Styles -->
        <style>
            * {
            	box-sizing: border-box;
            }
            
            footer {
                position: relative;
                height: 100px;
                width: 100%;
            }
            
            .copyright {
                position: absolute;
                width: 100%;
                color: grey;
                line-height: 40px;
                font-size: 0.9em;
                text-align: center;
                bottom:0;
            }
            
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
            
            button {
            	background-color: transparent;
            	padding: 0;
            	border: 0;
            	outline: 0;
            	cursor: pointer;
            }
            
            input {
            	background-color: transparent;
            	padding: 0;
            	border: 0;
            	outline: 0;
            }
            
            input[type="submit"] {
            	cursor: pointer;
            }
            
            input::placeholder {
            	font-size: .85rem;
            	font-family: "Montserrat", sans-serif;
            	font-weight: 300;
            	letter-spacing: .1rem;
            	color: #ccc;
            }
            
            /**
             * Bounce to the left side
             */
            @keyframes bounceLeft {
            	0% {
            		transform: translate3d(100%, -50%, 0);
            	}
            
            	50% {
            		transform: translate3d(-30px, -50%, 0);
            	}
            
            	100% {
            		transform: translate3d(0, -50%, 0);
            	}
            }
            
            /**
             * Bounce to the right side
             */
            @keyframes bounceRight {
            	0% {
            		transform: translate3d(0, -50%, 0);
            	}
            
            	50% {
            		transform: translate3d(calc(100% + 30px), -50%, 0);
            	}
            
            	100% {
            		transform: translate3d(100%, -50%, 0);
            	}
            }
            
            /**
             * Show Sign Up form
             */
            @keyframes showSignUp {
            	100% {
            		opacity: 1;
            		visibility: visible;
            		transform: translate3d(0, 0, 0);
            	}
            }
            
            /**
             * Page background
             */
            .user {
            	display: flex;
            	justify-content: center;
            	align-items: center;
            	width: 100%;
            	height: 60vh;
            }
            
            .user_options-container {
            	position: relative;
            	width: 100%;
            }
            
            .user_options-text {
            	display: flex;
            	justify-content: space-between;
            	width: 100%;
            	background-color: rgba(34, 34, 34, 0.85);
            	border-radius: 3px;
            }
            
            /**
             * Registered and Unregistered user box and text
             */
            .user_options-registered,
            .user_options-unregistered {
            	width: 50%;
            	padding: 75px 45px;
            	color: #fff;
            	font-weight: 300;
            }
            
            .user_registered-title,
            .user_unregistered-title {
            	margin-bottom: 15px;
            	font-size: 1.66rem;
            	line-height: 1em;
            }
            
            .user_unregistered-text,
            .user_registered-text {
            	font-size: .83rem;
            	line-height: 1.4em;
            }
            
            .user_registered-login,
            .user_unregistered-signup {
            	margin-top: 30px;
            	border: 1px solid #ccc;
            	border-radius: 3px;
            	padding: 10px 30px;
            	color: #fff;
            	text-transform: uppercase;
            	line-height: 1em;
            	letter-spacing: .2rem;
            	transition: background-color .2s ease-in-out, color .2s ease-in-out;
            }
            
            .user_registered-login:hover,
              .user_unregistered-signup:hover {
            	color: rgba(34, 34, 34, 0.85);
            	background-color: #ccc;
            }
            
            /**
             * Login and signup forms
             */
            .user_options-forms {
            	position: absolute;
            	top: 50%;
            	left: 30px;
            	width: calc(50% - 30px);
            	min-height: 420px;
            	background-color: #fff;
            	border-radius: 3px;
            	box-shadow: 2px 0 15px rgba(0, 0, 0, 0.25);
            	overflow: hidden;
            	transform: translate3d(100%, -50%, 0);
            	transition: transform .4s ease-in-out;
            }
            
            .user_options-forms .user_forms-login {
            	transition: opacity .4s ease-in-out, visibility .4s ease-in-out;
            }
            
            .user_options-forms .forms_title {
            	margin-bottom: 45px;
            	font-size: 1.5rem;
            	font-weight: 500;
            	line-height: 1em;
            	text-transform: uppercase;
            	color: #e8716d;
            	letter-spacing: .1rem;
            }
            
            .user_options-forms .forms_field:not(:last-of-type) {
            	margin-bottom: 20px;
            }
            
            .user_options-forms .forms_field-input {
            	width: 100%;
            	border-bottom: 1px solid #ccc;
            	padding: 6px 20px 6px 6px;
            	font-family: "Montserrat", sans-serif;
            	font-size: 1rem;
            	font-weight: 300;
            	color: gray;
            	letter-spacing: .1rem;
            	transition: border-color .2s ease-in-out;
            }
            
            .user_options-forms .forms_field-input:focus {
            	border-color: gray;
            }
            
            .user_options-forms .forms_buttons {
            	display: flex;
            	justify-content: space-between;
            	align-items: center;
            	margin-top: 35px;
            }
            
            .user_options-forms .forms_buttons-forgot {
            	font-family: "Montserrat", sans-serif;
            	letter-spacing: .1rem;
            	color: #ccc;
            	text-decoration: underline;
            	transition: color .2s ease-in-out;
            }
            
            .user_options-forms .forms_buttons-forgot:hover {
            	color: #b3b3b3;
            }
            
            .user_options-forms .forms_buttons-action {
            	background-color: #e8716d;
            	border-radius: 3px;
            	padding: 10px 35px;
            	font-size: 1rem;
            	font-family: "Montserrat", sans-serif;
            	font-weight: 300;
            	color: #fff;
            	text-transform: uppercase;
            	letter-spacing: .1rem;
            	transition: background-color .2s ease-in-out;
            }
            
            .user_options-forms .forms_buttons-action:hover {
            	background-color: #e14641;
            }
            
            .user_options-forms .user_forms-signup,
              .user_options-forms .user_forms-login {
            	position: absolute;
            	top: 70px;
            	left: 40px;
            	width: calc(100% - 80px);
            	opacity: 0;
            	visibility: hidden;
            	transition: opacity .4s ease-in-out, visibility .4s ease-in-out, transform .5s ease-in-out;
            }
            
            .user_options-forms .user_forms-signup {
            	transform: translate3d(120px, 0, 0);
            }
            
            .user_options-forms .user_forms-signup .forms_buttons {
            	justify-content: flex-end;
            }
            
            .user_options-forms .user_forms-login {
            	transform: translate3d(0, 0, 0);
            	opacity: 1;
            	visibility: visible;
            }
            
            /**
             * Triggers
             */
            .user_options-forms.bounceLeft {
            	animation: bounceLeft 1s forwards;
            }
            
            .user_options-forms.bounceLeft .user_forms-signup {
            	animation: showSignUp 1s forwards;
            }
            
            .user_options-forms.bounceLeft .user_forms-login {
            	opacity: 0;
            	visibility: hidden;
            	transform: translate3d(-120px, 0, 0);
            }
            
            .user_options-forms.bounceRight {
            	animation: bounceRight 1s forwards;
            }
            
            /**
             * Responsive 990px
             */
            @media screen and (max-width: 990px) {
            	.user_options-forms {
            		min-height: 350px;
            	}
            
            	.user_options-forms .forms_buttons {
            		flex-direction: column;
            	}
            
            	.user_options-forms .user_forms-login .forms_buttons-action {
            		margin-top: 30px;
            	}
            
            	.user_options-forms .user_forms-signup,
                .user_options-forms .user_forms-login {
            		top: 40px;
            	}
            
            	.user_options-registered,
              .user_options-unregistered {
            		padding: 50px 45px;
            	}
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <script type="text/javascript">
                            $.toast({
                                heading: 'Error', // Optional heading to be shown on the toast
                                text: '{{ $error }}', // Text that is to be shown in the toast
                                icon: 'warning', // Type of toast icon
                                showHideTransition: 'fade', // fade, slide or plain
                                allowToastClose: true, // Boolean value true or false
                                hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                                position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                                textAlign: 'left',  // Text alignment i.e. left, right or center
                                loader: true,  // Whether to show loader or not. True by default
                                loaderBg: '#9EC600',  // Background color of the toast loader
                                bgColor: '#31708F'
                            });
                        </script>
                    @endforeach
                @endif
                
                
                <div class="title">
                    Calendario Educativo
                </div>
                
                <section class="user">
                    <div class="user_options-container">
                        <div class="user_options-text">
                          <div class="user_options-unregistered">
                            <h2 class="user_unregistered-title">¿No tienes cuenta?</h2>
                            <p class="user_unregistered-text">Regístrese introduciendo su DNI con letra, un email válido y una contraseña.</p>
                            <button class="user_unregistered-signup" id="signup-button">Registrarse</button>
                          </div>
                        
                          <div class="user_options-registered">
                            <h2 class="user_registered-title">¿Tienes cuenta?</h2>
                            <p class="user_registered-text">Ingrese en su cuenta simplemente introduciendo su DNI con letra y contraseña.</p>
                            <button class="user_registered-login" id="login-button">Login</button>
                          </div>
                        </div>
                        
                        <div class="user_options-forms" id="user_options-forms">
                          <div class="user_forms-login">
                            <h2 class="forms_title">Login</h2>
                            <form method="POST" action="{{ route('login') }}" class="forms_form">
                                @csrf
                              <fieldset class="forms_fieldset">
                                <div class="forms_field">
                                  <input type="text" placeholder="DNI" id="dni_login" class="forms_field-input{{ $errors->has('dni_login') ? ' is-invalid' : '' }}" name="dni_login" value="{{ old('dni_login') }}" required autofocus />
                                </div>
                                <div class="forms_field">
                                  <input id="login_password" type="password" placeholder="Contraseña" class="forms_field-input {{ $errors->has('login_password') ? ' is-invalid' : '' }}" name="login_password" required />
                                </div>
                              </fieldset>
                              <div class="forms_buttons">
                                @if (Route::has('password.request'))
                                    <a class="forms_buttons-forgot" href="{{ route('password.request') }}">
                                        ¿Contraseña olvidada?
                                    </a>
                                @endif
                                <input type="submit" value="Login" class="forms_buttons-action">
                              </div>
                            </form>
                          </div>
                          
                          <div class="user_forms-signup">
                            <h2 class="forms_title">Registrarse</h2>
                            <form class="forms_form" method="POST" action="{{ route('register') }}">
                                @csrf
                              <fieldset class="forms_fieldset">
                                <div class="forms_field">
                                  <input id="dni" type="text" placeholder="DNI" class="forms_field-input{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ old('dni') }}" required />
                                </div>
                                <div class="forms_field">
                                  <input id="email" type="email" placeholder="Email" class="forms_field-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required />
                                </div>
                                <div class="forms_field">
                                  <input id="password" type="password" placeholder="Contraseña" class="forms_field-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />
                                </div>
                              </fieldset>
                              <div class="forms_buttons">
                                <input type="submit" value="Registrarse" class="forms_buttons-action">
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </section>
                <footer>
                    <p class="copyright">Calendario Educativo - © CIFP Zonzamas {{Carbon\Carbon::now()->format("Y")}}</p>
                </footer>
            </div>
        </div>
        
        <script type="text/javascript">
            /**
             * Variables
             */
            const signupButton = document.getElementById('signup-button'),
                loginButton = document.getElementById('login-button'),
                userForms = document.getElementById('user_options-forms')
            
            /**
             * Add event listener to the "Sign Up" button
             */
            signupButton.addEventListener('click', () => {
              userForms.classList.remove('bounceRight')
              userForms.classList.add('bounceLeft')
            }, false)
            
            /**
             * Add event listener to the "Login" button
             */
            loginButton.addEventListener('click', () => {
              userForms.classList.remove('bounceLeft')
              userForms.classList.add('bounceRight')
            }, false)
        </script>
        
    </body>
</html>
