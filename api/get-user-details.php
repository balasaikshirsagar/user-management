<?php
session_start(); // Start the session

include "./utils/functions.php"; 

if (!isset($_SESSION['user_id'])) { // Check for user_id
    echo json_encode(['status' => false, 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['user_id']; // Use the correct session key

// Ensure the database connection is established
$pdo = connect();
$query = "SELECT name, email FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->bindParam(1, $user_id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode(['status' => true, 'user' => $user]);
} else {
    echo json_encode(['status' => false, 'message' => 'User not found.']);
}
?>
