<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="{{ asset('css/login-page.css') }}" /> 
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <h2>Log in</h2>
            <form>
                <div class="input-group">
                    <i></i> {{--icon hide user --}}
                    <input type="email" placeholder="email">
                </div>
                <div class="input-group">
                    <i></i> {{--icon password --}}
                    <input type="password" placeholder="password">
                    <i class="toggle-password"></i>  {{--icon hide password --}}
                </div>
                <div class="remember">
                    <input type="checkbox" id="remember">
                    <label for="remember">Ingat aku yh</label>
                </div>
                <button class="login-btn">Log in</button>
            </form>
        </div>
        <div class="right-box">
            <div class="circle"></div>
        </div>
    </div>

</body>
</html>
