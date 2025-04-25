<?php
$conn = new mysqli("localhost", "root", "", "user_auth");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
  echo "Registration successful! <a href='login.html'>Login here</a>";
} else {
  echo "Error: " . $stmt->error;
}

$conn->close();
?>
