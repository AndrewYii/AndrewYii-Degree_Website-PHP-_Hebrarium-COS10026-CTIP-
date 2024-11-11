<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start(); 
?>

<h1>Update Profile</h1>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
    
    <div>
        <label for="First_Name">First Name:</label>
        <input type="text" id="First_Name" name="First_Name" placeholder="First Name">
    </div>
    
    <div>
        <label for="Last_Name">Last Name:</label>
        <input type="text" id="Last_Name" name="Last_Name" placeholder="Last Name">
    </div>
    
    <div>
        <label for="StudentID">Student ID:</label>
        <input type="number" id="StudentID" name="StudentID" placeholder="Student ID">
    </div>
    
    <div>
        <label for="Username">Username:</label>
        <input type="text" id="Username" name="Username" placeholder="Username">
    </div>
    
    <div>
        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" placeholder="Email">
    </div>

    <div>
        <label for="upload_photo">Profile Photo:</label>
        <div class="photo-upload-group">
            <input type="file" id="upload_photo" name="upload_photo" accept="image/*">
            <button type="button" onclick="document.getElementById('upload_photo').value = ''">Clear</button>
        </div>
    </div>
    
    <input type="submit" name="submit" value="Submit">
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
        echo "<a href='user_profile.php'>Profile updated successfully</a>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>