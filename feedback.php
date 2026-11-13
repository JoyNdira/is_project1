<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<body>

<h2>Submit Feedback</h2>
<form method="POST" action="/is_project1/feedback.php">
    Name: <input type="text" name="name" required><br><br>
    Message: <input type="text" name="message" required><br><br>
    <input type="submit" value="Submit">
</form>

<hr>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "ubuntu", "CAT2");
    
    if ($conn->connect_error) { 
        die("<h3 style='color:red;'>Connection failed: " . $conn->connect_error . "</h3>"); 
    }
    
    $name = $_POST['name'];
    $msg = $_POST['message'];
    
    $sql = "INSERT INTO feedback (name, message) VALUES ('$name', '$msg')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<h3 style='color:green;'>Success! Data saved.</h3>";
    } else {
        echo "<h3 style='color:red;'>Error: " . $conn->error . "</h3>";
    }
}

echo "<h3>Saved Feedback:</h3>";
$conn = new mysqli("localhost", "root", "ubuntu", "CAT2");
$result = $conn->query("SELECT name, message FROM feedback");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<b>" . $row["name"] . "</b>: " . $row["message"] . "<br>";
    }
} else {
    echo "No feedback found.";
}
$conn->close();
?>

</body>
</html>
