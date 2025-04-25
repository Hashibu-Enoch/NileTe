<?php
$conn = new mysqli("localhost", "root", "", "user_auth");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
  echo "Login successful! Welcome, " . htmlspecialchars($user['username']);
} else {
  echo "Invalid username or password.";
}

$conn->close();
?>
