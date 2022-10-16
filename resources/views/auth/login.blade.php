<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('source/dist/images/logo.svg') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="GYPEM">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login - GYPEM</title>
        <link rel="stylesheet" href="{{ asset('source/dist/css/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
    <body class="login">
        <div id="loader-screen">
            <div class="loader"></div>
        </div>
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Logo" class="w-6" src="{{ asset('source/dist/images/logo.svg') }}">
                        <span class="text-white text-lg ml-3"> Back<span class="font-medium">Office</span> </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Logo" class="-intro-x w-1/2 -mt-16" src="{{ asset('source/dist/images/illustration.svg') }}">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            Back Office 
                            <br>
                            Global Youth Peace Education
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white"><a href="https://gypem.com" target="_blank">gypem.com</a></div>
                    </div>
                </div>

                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Sign In
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">For back office user Gypem</div>
                        <form id="form-login">
                            <div class="intro-x mt-8">
                                <input type="text" class="intro-x login__input input input--lg border border-gray-300 block" name="username" placeholder="Username">
                                <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" name="password" placeholder="Password">
                            </div>
                            <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                                <!-- <div class="flex items-center mr-auto">
                                    <input type="checkbox" class="input border mr-2" id="remember-me">
                                    <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                                </div>
                                <a href="">Forgot Password?</a>  -->
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="button" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 btn-submit-login" id="btn-submit-login">Login</button>
                            </div>
                        </form>
                        <!-- <div class="intro-x mt-10 xl:mt-24 text-gray-700 text-center xl:text-left">
                            By signin up, you agree to our 
                            <br>
                            <a class="text-theme-1" href="">Terms and Conditions</a> & <a class="text-theme-1" href="">Privacy Policy</a> 
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('source/dist/js/app.js') }}"></script>
        <script src="{{ asset('source/src/js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/login.js') }}"></script>

    </body>
</html>