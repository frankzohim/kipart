<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/style.min.css') }}">
    <title>Document</title>
</head>
<body class="theme-blush">
    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form class="card auth_form" method="POST" action="{{ route('user.login') }}">
                        @csrf
                        <div class="header">
                            <img class="logo" src="{{ asset('admin/assets/images/logo.svg') }}" alt="">
                            <h5>Log in</h5>
                        </div>
                        <div class="body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Email" name="email">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                                </div>
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Password" name="password">
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="forgot-password.html" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                                </div>

                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="checkbox">
                                <input id="remember_me" type="checkbox">
                                <label for="remember_me">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Login</button>
                            <div class="signin_with mt-3">
                                <p class="mb-0">or Sign Up using</p>
                                <button class="btn btn-primary btn-icon btn-icon-mini btn-round facebook"><i class="zmdi zmdi-facebook"></i></button>
                                <button class="btn btn-primary btn-icon btn-icon-mini btn-round twitter"><i class="zmdi zmdi-twitter"></i></button>
                                <button class="btn btn-primary btn-icon btn-icon-mini btn-round google"><i class="zmdi zmdi-google-plus"></i></button>
                            </div>
                        </div>
                    </form>
                    <div class="copyright text-center">
                        &copy;
                        <script>document.write(new Date().getFullYear())</script>,
                        <span>Copyright<a href="https://thememakker.com/" target="_blank">Kipart</a></span>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="{{ asset('assets/images/customer.png') }}" alt="Sign In"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
