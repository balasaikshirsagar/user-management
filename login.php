<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="YOUR_GOOGLE_CLIENT_ID">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gsign {
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand ms-4" href="#">Reference Globe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">REGISTER</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row align-items-center justify-content-center">
        <div class="col-12 col-md-6 col-lg-3">
            <h1 class="text-center mt-3">LOGIN</h1>
            <div class="form-floating my-3">
                <input type="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password_hash" placeholder="Password">
                <label for="password_hash">Password</label>
            </div>
            <div class="text-center">
                <button class="btn btn-primary mt-3" onclick="login()">Sign In</button>
            </div>
            <br>
            <div class="g-signin2 text-center gsign" data-onsuccess="onSignIn"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/js/login.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</body>
</html>
