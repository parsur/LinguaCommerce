<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <title>Sign in</title>
</head>

<body>
    {{-- Particles.js --}}
    <div id="particles-js"></div>

    {{-- the yellow background --}}
    <div class="background">
        <div class="signin-container">
            {{-- this div is a filler and acts as a maintainer of positioning --}}
            <div class="top-container container-col">
                <div class="filler"></div>
            </div>
            {{-- this div is the middle things in signin-container --}}
            <div class="middle-container container-col">
                {{-- Login text --}}
                <div class="login-text">
                    <h1>ورود</h1>
                </div>
                {{-- an hr, for separating --}}
                <hr />
                {{-- place for inputs --}}
                <div class="inputs">
                    <div class="input-one"><input class="input" placeholder="ایمیل را وارد کنید" type="text" id="pass"
                            name="pass" /></div>
                    <div class="input-two"><input class="input" placeholder="رمز خودرا بزنید" type="password" id="pass"
                            name="pass" /></div>
                </div>
                {{-- this is where, 'Remember me, have no account' texts will apear --}}
                <div class="functions">
                    <div class="remember-me">
                        {{-- input for remember me, add attributes you want! --}}
                        <label for="rememberme-check">مرا بخاطر بسپار</label>
                        <input type="checkbox" />
                    </div>
                    <div class="no-account">
                        {{-- link for no account --}}
                        <p>اکانت ندارید؟ <a href="../Signup/index.html">اینجا ثبت کنید!</a></p>
                    </div>
                </div>
            </div>
            {{-- this div is the bottom things in signin-container --}}
            <div class="bottom-container container-col">
                {{-- sign in container --}}
                <div class="main-signin-container">
                    {{-- sign in input, add attributes you want! --}}
                    <input type="submit" value="وارد شوید!" />
                </div>
            </div>
        </div>
    </div>
    {{-- gradient at end, is here --}}
    <div class="gradient"></div>
</body>

{{-- Scripts --}}
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
{{-- Particles --}}
<script>
    /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
    particlesJS.load('particles-js', 'js/particles.json', function() {
    console.log('callback - particles.js config loaded');
    });
</script>

</html>