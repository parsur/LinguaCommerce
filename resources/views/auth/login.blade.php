<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    </head>
    <body>
        <div class="wrapper">
            {{-- Form --}}
            <form action="{{ url('login')}} " method="POST" class="login">
                @csrf
                <!-- Title -->
                <p class="title">ورود</p>
                <!-- Form -->
                <div class="form-group">
                    <input class="text-right" type="email" name="email" placeholder="آدرس ایمیل">
                    <i class="fa fa-user"></i>
                </div>
                <div class="fomr-group">
                    <input class="text-right" type="password" name="password" placeholder="رمز عبور" />
                    <i class="fa fa-key"></i>
                </div>
                <!-- remember token  -->
                <label class="form-remember">
                    <input type="checkbox" name="remember_me"/>
                    <span>
                        مرا به خاطر بسپارید     
                    </span>
                </label>
                <button>
                    <span class="state">ورود</span>
                </button>
            </form>
            <br>
            @if($message = Session::get('faliure'))
                <div class="alert alert-danger right-direction">
                    <footer><a target="blank">{{ $message }}</a></footer>
                </div>
            @endif
        </div>
    </body>
</html>