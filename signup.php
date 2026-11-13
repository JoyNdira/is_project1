<!DOCTYPE html>
<html>
<head><title>Signup</title></head>
<body>
<h2>Create an Account</h2>
<form action="/is_project1/signup.php" method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" value="Sign Up">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "ubuntu", "CAT2");
    if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
    
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $pass);
    
    if ($stmt->execute()) {
        echo "<h3 style='color:green;'>Success! User $user registered.</h3>";
    } else {
        echo "<h3 style='color:red;'>Error: " . $stmt->error . "</h3>";
    }
    $conn->close();
}
?>
</body>
</html>
