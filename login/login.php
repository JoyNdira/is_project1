<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<form action="/is_project1/login.php" method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "ubuntu", "CAT2");
    if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
    
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($pass, $row['password'])) {
            echo "<h3 style='color:green;'>Login Successful! Welcome, $user.</h3>";
        } else {
            echo "<h3 style='color:red;'>Invalid password.</h3>";
        }
    } else {
        echo "<h3 style='color:red;'>User not found.</h3>";
    }
    $conn->close();
}
?>
</body>
</html>
