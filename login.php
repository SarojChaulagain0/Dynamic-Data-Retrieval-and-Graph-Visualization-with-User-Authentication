<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = new mysqli("localhost", "root", "", "week9");
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row["password"])) {
        session_start();
        $_SESSION["username"] = $username;

        // Redirect to the landing page after successful login
        header("Location: landing_page.html");
        exit();
    } else {
        echo "Invalid username or password.";
    }
} else {
    // Handle the case where the script is accessed directly
    echo "Invalid access.";
}
?>
