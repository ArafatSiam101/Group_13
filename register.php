<?php
// Database configuration
$host = 'localhost:3000';
$dbname = 'user_management';
$db_username = 'root'; // XAMPP default username
$db_password = '';     // XAMPP default password is empty

// Database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    // Validate input
    if (empty($email) || empty($password) || empty($role)) {
        echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.history.back();</script>";
        exit;
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into database
    try {
        $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password, :role)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

        echo "<script>alert('Registration successful! Please log in.'); window.location.href = 'login.html';</script>";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate email
            echo "<script>alert('Email already exists.'); window.history.back();</script>";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid request.";
}
?>
