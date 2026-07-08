<?php
require_once '../config/database.php';


$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $subject = sanitizeInput($_POST['subject'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');
    
    
    if (empty($name)) {
        $response['errors'][] = "Nama harus diisi";
    }
    
    if (empty($email)) {
        $response['errors'][] = "Email harus diisi";
    } elseif (!validateEmail($email)) {
        $response['errors'][] = "Format email tidak valid";
    }
    
    if (empty($subject)) {
        $response['errors'][] = "Subjek harus diisi";
    }
    
    if (empty($message)) {
        $response['errors'][] = "Pesan harus diisi";
    } elseif (strlen($message) < 10) {
        $response['errors'][] = "Pesan minimal 10 karakter";
    }
    

    if (empty($response['errors'])) {
        $conn = getDBConnection();
        
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Terima kasih, $name! Pesan Anda telah berhasil dikirim. Kami akan menghubungi Anda melalui email $email segera.";
        } else {
            $response['errors'][] = "Gagal menyimpan pesan. Silakan coba lagi.";
        }
        
        $stmt->close();
    }
    
} else {
    $response['errors'][] = "Invalid request method";
}


if ($response['success']) {
    header("Location: ../contact.php?success=1&message=" . urlencode($response['message']));
} else {
    $error_message = implode(", ", $response['errors']);
    header("Location: ../contact.php?error=1&message=" . urlencode($error_message));
}
exit();
?>
