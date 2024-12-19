<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand ms-4" href="#">Reference Globe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <h1>Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text" id="total-users">Loading...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Active Users</h5>
                        <p class="card-text" id="active-users">Loading...</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="my-4">Manage Users</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="user-list">
                    <!-- User data will be loaded here via AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Editing User -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="edit-user-id">
                        <div class="mb-3">
                            <label for="edit-user-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-user-email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchUsers();

            function fetchUsers() {
                fetch('./api/get-user-details.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            let usersHtml = '';
                            data.data.forEach(user => {
                                usersHtml += `
                                    <tr>
                                        <td>${user.id}</td>
                                        <td>${user.email}</td>
                                        <td>
                                            <button class="btn btn-warning me-2" onclick="openEditModal(${user.id}, '${user.email}')">Edit</button>
                                            <button class="btn btn-danger" onclick="deleteUser(${user.id})">Delete</button>
                                        </td>
                                    </tr>
                                `;
                            });
                            document.getElementById('user-list').innerHTML = usersHtml;
                            document.getElementById('total-users').innerText = data.total_users;
                            document.getElementById('active-users').innerText = data.active_users;
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error fetching users:', error));
            }

            window.openEditModal = function(userId, userEmail) {
                document.getElementById('edit-user-id').value = userId;
                document.getElementById('edit-user-email').value = userEmail;
                const editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
                editModal.show();
            };

            document.getElementById('editUserForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const userId = document.getElementById('edit-user-id').value;
                const userEmail = document.getElementById('edit-user-email').value;

                fetch('./api/edit-user.php', {
                    method: 'POST',
                    body: JSON.stringify({ id: userId, email: userEmail }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('User updated successfully.');
                        fetchUsers(); // Reload the user list
                        const editModal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
                        editModal.hide();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error editing user:', error));
            });

            window.deleteUser = function(userId) {
                if (confirm('Are you sure you want to delete this user?')) {
                    fetch('./api/delete-user.php', {
                        method: 'POST',
                        body: JSON.stringify({ user_id: userId }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User deleted successfully.');
                            fetchUsers();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error deleting user:', error));
                }
            };
        });
    </script>
</body>
</html>
