<!DOCTYPE html>

<html lang="en">
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Unlock the secrets of plant identification with Plant's Notebook. Learn to identify various plant species, understand their characteristics, and explore the tools and techniques used by botanists. Ideal for botanists, hobbyists, and nature enthusiasts." />
<meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques,Plant Common Name, Plant Scientific Name,Herbarium Specimen" />
<meta name="author" content="Aniq Nazhan bin Mazlan"  />
<title>Plant's Notebook | Profile Page</title>
<link rel="stylesheet" href="styles/style.css">
<link rel="icon" type="image/x-icon" href="images/logo.png">
<link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

</head>

<body class="edit_user">
<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start(); 
?>

<div class="profile-update-container">
    <h1 class="edit-user-title">Update Profile</h1>

<?php
    // Add this after your database connection includes
    $current_username = $_SESSION['username'];
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $query = "SELECT Profile_Picture FROM register WHERE Username='$current_username'";
    $result = mysqli_query($conn, $query);
    $user_data = mysqli_fetch_assoc($result);
    mysqli_close($conn);
?>

    <div class="profile-container">
        <img class="Profile-Picture" 
             src="<?php echo !empty($user_data['Profile_Picture']) ? $user_data['Profile_Picture'] : 'default-avatar.png'; ?>" 
             alt="Profile Picture">
    </div>

    <form class="edit-user-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="form-group">
            <label for="First_Name">First Name:</label>
            <input class="edit-user-input" type="text" id="First_Name" name="First_Name" placeholder="It remains the same if nothing changes">
        </div>
        
        <div class="form-group">
            <label for="Last_Name">Last Name:</label>
            <input class="edit-user-input" type="text" id="Last_Name" name="Last_Name" placeholder="It remains the same if nothing changes">
        </div>
        
        <div class="form-group">
            <label for="Username">Username:</label>
            <input class="edit-user-input" type="text" id="Username" name="Username" placeholder="It remains the same if nothing changes">
        </div>
        
        <div class="form-group">
            <label for="Email">Email:</label>
            <input class="edit-user-input" type="email" id="Email" name="Email" placeholder="It remains the same if nothing changes">
        </div>

        <div class="form-group">
            <label for="upload_photo">Profile Photo:</label>
            <div class="photo-upload-group">
                <input class="edit-user-input" type="file" id="upload_photo" name="upload_photo" accept="image/*">
                <button class="edit-user-button" type="button" onclick="document.getElementById('upload_photo').value = ''">Clear</button>
            </div>
        </div>
        
        <input type="submit" name="submit" value="Update" class="update-button">
    </form>
</div>

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



    $new_username = $current_data['Username']; // Default to current username
    if (!empty($_POST['Username'])) {
        $proposed_username = mysqli_real_escape_string($conn, $_POST['Username']);
        
        // Check if the new username already exists (excluding current user)
        $check_username = "SELECT * FROM register WHERE Username = ? AND Username != ?";
        $stmt = $conn->prepare($check_username);
        $stmt->bind_param("ss", $proposed_username, $current_username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo "<script>alert('Username already taken. Please choose another.');
            window.location.href='edit_user_profile.php';</script>";
            exit();
        } else {
            // Begin transaction to ensure all updates complete successfully
            mysqli_begin_transaction($conn);
            
            try {
                // Update username in Register table
                $update_register = "UPDATE register SET Username = ? WHERE Username = ?";
                $stmt = $conn->prepare($update_register);
                $stmt->bind_param("ss", $proposed_username, $current_username);
                $stmt->execute();
                
                // Update username in Enquiry table
                $update_enquiry = "UPDATE contribute SET Username = ? WHERE Username = ?";
                $stmt = $conn->prepare($update_enquiry);
                $stmt->bind_param("ss", $proposed_username, $current_username);
                $stmt->execute();
                
                // If all queries successful, commit transaction
                mysqli_commit($conn);
                
                // Update session with new username
                $_SESSION['username'] = $proposed_username;
                $new_username = $proposed_username;
                
            } catch (Exception $e) {
                // If any query fails, rollback all changes
                mysqli_rollback($conn);
                echo "<script>alert('Error updating username. Please try again.');
                window.location.href='edit_user_profile.php';</script>";
                exit();
            }
        }
        $stmt->close();
    }


    $new_name = !empty($_POST['Name']) ? mysqli_real_escape_string($conn, $_POST['Name']) : $current_data['Name'];
    $new_email = !empty($_POST['Email']) ? mysqli_real_escape_string($conn, $_POST['Email']) : $current_data['Email'];
    
    // Update query including username
    $sql = "UPDATE register SET 
            Name='$new_name',
            Email='$new_email',
            Profile_Picture='$new_profile_photo'
            WHERE Username='$current_username'";
    
    if(mysqli_query($conn, $sql)) {
        // Update the session with new username
        $_SESSION['username'] = $new_username;
        echo "<div class='success-message'>
                <p>Profile updated successfully!</p>
                <a href='user_profile.php' class='view-profile-btn'>View Profile</a>
              </div>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>
</body>
</html>