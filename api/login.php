<?php
session_start(); // Start the session

include "./utils/functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $pdo = connect(); // Establish a PDO connection
        $stmt = $pdo->prepare("SELECT id, password, role, is_active, is_approved FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            sendResponse(false, 'No user found with this email.');
        } elseif (password_verify($password, $user['password'])) {
            // Check if the user account is active and approved
            if ($user['is_active'] == 1 && $user['is_approved'] == 1) {
                // Set session data
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                // Handle role-specific behavior
                switch ($user['role']) {
                    case 'superadmin':
                        sendResponse(true, 'Login successful.', [
                            'user_id' => $user['id'],
                            'role' => 'superadmin',
                            'redirect_url' => '../superadmin-dashboard.php'
                        ]);
                        break;

                    case 'admin':
                        sendResponse(true, 'Login successful.', [
                            'user_id' => $user['id'],
                            'role' => 'admin',
                            'redirect_url' => '../admin-dashboard.php'
                        ]);
                        break;

                    case 'user':
                        sendResponse(true, 'Login successful.', [
                            'user_id' => $user['id'],
                            'role' => 'user',
                            'redirect_url' => 'http://task-1.test/dashboard.php'
                        ]);
                        break;

                    default:
                        sendResponse(false, 'Invalid role specified.');
                }
            } else {
                sendResponse(false, 'Your account is pending admin approval.');
            }
        } else {
            sendResponse(false, 'Invalid email or password.');
        }
    } catch (PDOException $e) {
        sendResponse(false, 'Login failed: ' . $e->getMessage());
    }
}
?>
