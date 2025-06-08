<?php
session_start();
require_once '../config/db.php'; // tvoj konekcioni fajl

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validacija
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // SQL Injection zaštita
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Provjera passworda
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            echo json_encode(["success" => true, "message" => "Login successful"]);
        } else {
            echo json_encode(["success" => false, "message" => "Wrong password"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "User not found"]);
    }
}
?>
