<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand ms-4 text-white" href="#">User Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <h1>Welcome to Your Dashboard</h1>
        <div class="row">
            <div class="col-md-6">
                <h3 class="my-4">Update Profile</h3>
                <form id="update-profile-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-muted">Leave blank to keep your current password.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Load the user's current data
            fetch('./api/get-user-details.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        document.getElementById('name').value = data.user.name;
                        document.getElementById('email').value = data.user.email;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error fetching user details:', error));

            // Handle profile update
            document.getElementById('update-profile-form').addEventListener('submit', function (event) {
                event.preventDefault();
                const formData = new FormData(this);

                fetch('./api/update-user-profile.php', {
                    method: 'POST',
                    body: JSON.stringify(Object.fromEntries(formData)),
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Profile updated successfully.');
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error updating profile:', error));
            });
        });
    </script>
</body>
</html>
