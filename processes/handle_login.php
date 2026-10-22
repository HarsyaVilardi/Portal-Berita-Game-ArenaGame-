<?php
require_once '../config/database.php';


$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    
    if (empty($email)) {
        $response['errors'][] = "Email harus diisi";
    } elseif (!validateEmail($email)) {
        $response['errors'][] = "Format email tidak valid";
    }
    
    if (empty($password)) {
        $response['errors'][] = "Password harus diisi";
    }
    
    if (empty($response['errors'])) {
        $conn = getDBConnection();
        
        $stmt = $conn->prepare("SELECT id, username, name, email, password, created_at FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (verifyPassword($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['created_at'] = $user['created_at'];
                
                $response['success'] = true;
                $response['message'] = "Login berhasil! Selamat datang, " . $user['name'];
                
                header("Location: ../index.php?login=success");
                exit();
            } else {
                $response['errors'][] = "Password salah";
            }
        } else {
            $response['errors'][] = "Email tidak terdaftar";;
        }
        
        $stmt->close();
    }
    
} else {
    $response['errors'][] = "Invalid request method";
}


if (!$response['success']) {
    $error_message = implode(", ", $response['errors']);
    header("Location: ../login.php?error=1&message=" . urlencode($error_message));
    exit();
}
?>
