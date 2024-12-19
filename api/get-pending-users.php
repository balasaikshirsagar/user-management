<?php

include "./utils/functions.php"; // Assuming the function file is at the same level

try {
    $pdo = connect();
    $stmt = $pdo->prepare("SELECT id, email, created_at FROM users WHERE is_active = 0");
    $stmt->execute();
    
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($users) {
        sendResponse(true, 'Pending users fetched successfully.', $users);
    } else {
        sendResponse(false, 'No pending users found.');
    }
} catch (PDOException $e) {
    sendResponse(false, 'Error fetching pending users: ' . $e->getMessage());
}
