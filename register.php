<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand ms-4" href="#">Reference Globe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Register</h1>
                <form id="registrationForm" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" placeholder="Full Name" required>
                        <label for="name">Full Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="mobile" placeholder="Mobile Number">
                        <label for="mobile">Mobile Number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="address" placeholder="Address"></textarea>
                        <label for="address">Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="gender" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <label for="gender">Gender</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="dob" placeholder="Date of Birth">
                        <label for="dob">Date of Birth</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" id="profile_picture" placeholder="Profile Picture">
                        <label for="profile_picture">Profile Picture</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" id="signature" placeholder="Signature">
                        <label for="signature">Signature</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="role" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                            <option value="superadmin">Super Admin</option>
                        </select>
                        <label for="role">Role</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/js/register.js"></script>
</body>

</html>
