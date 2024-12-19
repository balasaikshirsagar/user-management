<?php

include "./utils/functions.php"; // Assuming the function file is at the same level

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = json_decode(file_get_contents("php://input"), true)['user_id'];

    try {
        $pdo = connect();
        $stmt = $pdo->prepare("UPDATE users SET is_active = 1, is_approved = 1 WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            sendResponse(true, 'User approved successfully.');
        } else {
            sendResponse(false, 'Failed to approve user.');
        }
    } catch (PDOException $e) {
        sendResponse(false, 'Error approving user: ' . $e->getMessage());
    }
} else {
    sendResponse(false, 'Invalid request method.');
}
