<?php
session_start(); // Start the session

include "./utils/functions.php";

if (!isset($_SESSION['user_id'])) { // Check for user_id
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$user_id = $_SESSION['user_id'];
$name = $data['name'];
$email = $data['email'];
$password = $data['password'];

// Establish database connection
$pdo = connect();

// Update query
if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name, $email, $hashed_password, $user_id]);
} else {
    $query = "UPDATE users SET name = ?, email = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name, $email, $user_id]);
}

if ($stmt->rowCount() > 0) {
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating profile.']);
}
?>
