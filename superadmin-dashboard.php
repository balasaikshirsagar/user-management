<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark">
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
        <h1>Super Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text">1200</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pending Approvals</h5>
                        <p class="card-text">20</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Settings</h5>
                        <p class="card-text">Manage your system settings</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="my-4">Pending User Approvals</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="pending-users-list">
                    <!-- Pending users will be loaded here via AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="editUserId">
                        <div class="mb-3">
                            <label for="editUserEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editUserEmail" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetchPendingUsers();

            function fetchPendingUsers() {
                fetch('./api/get-pending-users.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            let usersHtml = '';
                            data.data.forEach(user => {
                                usersHtml += `
                                    <tr>
                                        <td>${user.id}</td>
                                        <td>${user.email}</td>
                                        <td>${new Date(user.created_at).toLocaleString()}</td>
                                        <td>
                                            <button class="btn btn-success" onclick="approveUser(${user.id})">Approve</button>
                                            <button class="btn btn-warning" onclick="openEditModal(${user.id}, '${user.email}')">Edit</button>
                                            <button class="btn btn-danger" onclick="deleteUser(${user.id})">Delete</button>
                                        </td>
                                    </tr>
                                `;
                            });
                            document.getElementById('pending-users-list').innerHTML = usersHtml;
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error fetching pending users:', error));
            }

            window.approveUser = function (userId) {
                fetch('./api/approve-user.php', {
                    method: 'POST',
                    body: JSON.stringify({ user_id: userId }),
                    headers: { 'Content-Type': 'application/json' }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User approved successfully.');
                            fetchPendingUsers();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error approving user:', error));
            };

            window.openEditModal = function (userId, email) {
                document.getElementById('editUserId').value = userId;
                document.getElementById('editUserEmail').value = email;
                const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
                modal.show();
            };

            document.getElementById('editUserForm').addEventListener('submit', function (event) {
                event.preventDefault();
                const userId = document.getElementById('editUserId').value;
                const email = document.getElementById('editUserEmail').value;

                fetch('./api/edit-user.php', {
                    method: 'POST',
                    body: JSON.stringify({ id: userId, email }),
                    headers: { 'Content-Type': 'application/json' }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User updated successfully.');
                            const modal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
                            modal.hide();
                            fetchPendingUsers();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error updating user:', error));
            });

            window.deleteUser = function (userId) {
                if (!confirm('Are you sure you want to delete this user?')) return;

                fetch('./api/delete-user.php', {
                    method: 'POST',
                    body: JSON.stringify({ user_id: userId }),
                    headers: { 'Content-Type': 'application/json' }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User deleted successfully.');
                            fetchPendingUsers();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error deleting user:', error));
            };
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
