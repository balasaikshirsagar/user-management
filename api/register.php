<?php

include "./utils/functions.php"; // Ensure you include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $role = $_POST['role'];

    // Handling file uploads
    $profile_picture = '';
    if ($_FILES['profile_picture']['name']) {
        $profile_picture = uploadFile($_FILES['profile_picture']);
    }

    $signature = '';
    if ($_FILES['signature']['name']) {
        $signature = uploadFile($_FILES['signature']);
    }

    try {
        $pdo = connect(); // Assuming you have a function to connect to the database
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, mobile, address, gender, dob, profile_picture, signature, role) VALUES (:name, :email, :password, :mobile, :address, :gender, :dob, :profile_picture, :signature, :role)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':profile_picture', $profile_picture);
        $stmt->bindParam(':signature', $signature);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        sendResponse(true, 'User registered successfully.');
    } catch (PDOException $e) {
        sendResponse(false, 'Registration failed: ' . $e->getMessage());
    }
}

function uploadFile($file)
{
    $targetDir = "../uploads/"; // Adjust the upload directory
    $targetFile = $targetDir . basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $targetFile;
    } else {
        throw new Exception('File upload failed.');
    }
}

