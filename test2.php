<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start(); 
?>

<form action="" method="post">
    <input type="file" name="upload_photo" placeholder="Upload Photo">
    <input type="text" name="Name" placeholder="Name">
    <input type="text" name="Username" placeholder="Username">
    <input type="text" name="Email" placeholder="Email">
    <a href="test.php"><input type="submit" name="submit" value="Submit"></a>
</form>

<?php
if(isset($_POST['submit'])) {
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $new_name = mysqli_real_escape_string($conn, $_POST['Name']);
    $new_email = mysqli_real_escape_string($conn, $_POST['Email']);
    $new_username = mysqli_real_escape_string($conn, $_POST['Username']); // New username from form
    $current_username = $_SESSION['username'];
    
    // Update query including username
    $sql = "UPDATE register SET 
            Name='$new_name', 
            Email='$new_email', 
            Username='$new_username' 
            WHERE Username='$current_username'";
    
    if(mysqli_query($conn, $sql)) {
        // Update the session with new username
        $_SESSION['username'] = $new_username;
        echo "<a href='test.php'>Profile updated successfully</a>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>