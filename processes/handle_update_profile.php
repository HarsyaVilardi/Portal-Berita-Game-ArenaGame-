<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = sanitizeInput($_POST['name'] ?? '');
    $username = sanitizeInput($_POST['username'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $new_password = $_POST['new_password'] ?? '';
    
    if (empty($name)) {
        $response['errors'][] = "Nama harus diisi";
    } elseif (strlen($name) < 3) {
        $response['errors'][] = "Nama minimal 3 karakter";
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
    
    if (!empty($new_password) && strlen($new_password) < 6) {
        $response['errors'][] = "Password minimal 6 karakter";
    }
    
    if (empty($response['errors'])) {
        $conn = getDBConnection();
        
        if ($username !== $_SESSION['username']) {
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
            $stmt->bind_param("si", $username, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $response['errors'][] = "Username sudah digunakan";
            }
            $stmt->close();
        }
        
        if ($email !== $_SESSION['email']) {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
            $stmt->bind_param("si", $email, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $response['errors'][] = "Email sudah terdaftar";
            }
            $stmt->close();
        }
        
        if (empty($response['errors'])) {
            if (!empty($new_password)) {
                $hashed_password = hashPassword($new_password);
                $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ?, password = ? WHERE id = ?");
                $stmt->bind_param("ssssi", $name, $username, $email, $hashed_password, $user_id);
            } else {
                $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ? WHERE id = ?");
                $stmt->bind_param("sssi", $name, $username, $email, $user_id);
            }
            
            if ($stmt->execute()) {
                $_SESSION['name'] = $name;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                
                $response['success'] = true;
                $response['message'] = "Profile berhasil diupdate!";
                
                header("Location: ../profile.php?updated=1");
                exit();
            } else {
                $response['errors'][] = "Gagal mengupdate profile. Silakan coba lagi.";
            }
            
            $stmt->close();
        }
    }
}

if (!$response['success']) {
    $error_message = implode(", ", $response['errors']);
    header("Location: ../profile.php?error=1&message=" . urlencode($error_message));
    exit();
}
?>
