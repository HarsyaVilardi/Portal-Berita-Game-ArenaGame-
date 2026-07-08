<?php
require_once '../config/database.php';


$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $name = sanitizeInput($_POST['name'] ?? '');
    $username = sanitizeInput($_POST['username'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    
    if (empty($name)) {
        $response['errors'][] = "Nama lengkap harus diisi";
    } elseif (strlen($name) < 3) {
        $response['errors'][] = "Nama lengkap minimal 3 karakter";
    }
    
    if (empty($username)) {
        $response['errors'][] = "Username harus diisi";
    } elseif (strlen($username) < 4) {
        $response['errors'][] = "Username minimal 4 karakter";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $response['errors'][] = "Username hanya boleh mengandung huruf, angka, dan underscore";
    }
    
    if (empty($email)) {
        $response['errors'][] = "Email harus diisi";
    } elseif (!validateEmail($email)) {
        $response['errors'][] = "Format email tidak valid";
    }
    
    if (empty($password)) {
        $response['errors'][] = "Password harus diisi";
    } elseif (strlen($password) < 6) {
        $response['errors'][] = "Password minimal 6 karakter";
    }
    
    if (empty($confirm_password)) {
        $response['errors'][] = "Konfirmasi password harus diisi";
    } elseif ($password !== $confirm_password) {
        $response['errors'][] = "Password dan konfirmasi password tidak cocok";
    }
    
   
    if (empty($response['errors'])) {
        $conn = getDBConnection();
        
       
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $response['errors'][] = "Username sudah digunakan";
        }
        $stmt->close();
        
        
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $response['errors'][] = "Email sudah terdaftar";
        }
        $stmt->close();
        
        
        if (empty($response['errors'])) {
            $hashed_password = hashPassword($password);
            
            $stmt = $conn->prepare("INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $username, $email, $hashed_password);
            
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Selamat! Akun Anda berhasil dibuat. Silakan login untuk melanjutkan.";
                
                
                header("Location: ../login.php?register=success&username=" . urlencode($username));
                exit();
            } else {
                $response['errors'][] = "Gagal membuat akun. Silakan coba lagi.";
            }
            
            $stmt->close();
        }
    }
    
} else {
    $response['errors'][] = "Invalid request method";
}


if (!$response['success']) {
    $error_message = implode(", ", $response['errors']);
    header("Location: ../register.php?error=1&message=" . urlencode($error_message));
    exit();
}
?>
