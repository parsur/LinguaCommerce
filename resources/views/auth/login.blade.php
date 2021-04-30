<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- Authentication --}}
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        {{-- App Css --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <div class="wrapper">
            {{-- Form --}}
            <form action="{{ url('admin/login')}} " method="POST" class="login">
                @csrf
                <!-- Title -->
                <p class="title">ورود ادمین</p>
                {{-- Email --}}
                <div class="form-group">
                    <input type="email" name="email" placeholder="آدرس ایمیل">
                    <i class="fa fa-user"></i>
                </div>
                {{-- Password --}}
                <div class="form-group">
                    <input type="password" name="password" placeholder="رمز عبور" />
                    <i class="fa fa-key"></i>
                </div>
                <!-- Remember token  -->
                <label class="form-remember">
                    <input type="checkbox" name="remember_me"/>
                    <span>
                        مرا به خاطر بسپارید     
                    </span>
                </label>
                {{-- Role --}}
                <input type="hidden" name="role" value="admin" />
                {{-- Submit button --}}
                <button>
                    <span class="state">ورود</span>
                </button>
            </form>
            {{-- Errors --}}
            <div class="mt-2">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </body>
</html>