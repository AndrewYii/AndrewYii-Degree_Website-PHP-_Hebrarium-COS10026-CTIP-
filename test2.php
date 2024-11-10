<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start(); 
?>

<form action="" method="post" enctype="multipart/form-data">
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
    
    $upload_dir = "profilepic/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $current_username = $_SESSION['username'];
    $query = "SELECT * FROM register WHERE Username='$current_username'";
    $result = mysqli_query($conn, $query);
    $current_data = mysqli_fetch_assoc($result);

    // Handle file upload
    $new_profile_photo = $current_data['Profile_Picture']; // Default to current photo
    if(isset($_FILES['upload_photo']) && $_FILES['upload_photo']['error'] === 0) {
        $file_tmp = $_FILES['upload_photo']['tmp_name'];
        $file_name = time() . '_' . $_FILES['upload_photo']['name']; // Add timestamp to prevent duplicate names
        $file_destination = $upload_dir . $file_name;
        
        // Move uploaded file to destination
        if(move_uploaded_file($file_tmp, $file_destination)) {
            $new_profile_photo = mysqli_real_escape_string($conn, $file_destination);
        }
    }    

    $new_name = !empty($_POST['Name']) ? mysqli_real_escape_string($conn, $_POST['Name']) : $current_data['Name'];
    $new_email = !empty($_POST['Email']) ? mysqli_real_escape_string($conn, $_POST['Email']) : $current_data['Email'];
    $new_username = !empty($_POST['Username']) ? mysqli_real_escape_string($conn, $_POST['Username']) : $current_data['Username'];
    $current_username = $_SESSION['username'];
    
    // Update query including username
    $sql = "UPDATE register SET 
            Name='$new_name', 
            Email='$new_email', 
            Username='$new_username', 
            Profile_Picture='$new_profile_photo' 
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