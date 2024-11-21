<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start(); 
    if(!isset($_SESSION['username'])){
            header("Location: login.php");
            exit();
        }
?>

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

<body>

    <header>
        <?php include 'include/header.php';?>
    </header>

    <div class='edit_user'>

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
                    src="<?php echo !empty($user_data['Profile_Picture']) ? $user_data['Profile_Picture'] : 'images/default.png'; ?>" 
                    alt="Profile Picture">
            </div>

            <form class="edit-user-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                    <label for="First_Name">First Name:</label>
                    <input class="edit-user-input" type="text" id="First_Name" name="FirstName" placeholder="It remains the same if nothing changes">
                </div>
                
                <div class="form-group">
                    <label for="Last_Name">Last Name:</label>
                    <input class="edit-user-input" type="text" id="Last_Name" name="LastName" placeholder="It remains the same if nothing changes">
                </div>
                
                <div class="form-group">
                    <label for="Last_Name">Phone Number:</label>
                    <input class="edit-user-input" type="text" id="Phone" name="Phone" placeholder="It remains the same if nothing changes">
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
                    <label for="Street">Street:</label>
                    <input class="edit-user-input" type="text" name="Street" placeholder="2A,Lorong Bindurong"  id="street">
                </div>

                <div class="form-group">
                    <label for="City">City:</label>
                    <input class="edit-user-input" type="text" name="City" placeholder="Bintulu"  id="city">
                </div>

                <div class="form-group">
                    <label for="Postcode">Postcode:</label>
                    <input class="edit-user-input" type="text" name="Postcode"  id="Postcode">
                </div>

                <div class="form-group">
                    <label for="State">State:</label>
                    <select name="State" id="state" class="profile-enquiry-select" >
                        <option value="">--Select--</option>
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Labuan">Labuan</option>
                        <option value="Malacca">Malacca</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Perak">Perak</option>
                        <option value="Putrajaya">Putrajaya</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                    </select>
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
                
                // Update username in Contribute table
                $update_enquiry = "UPDATE contribute SET Username = ? WHERE Username = ?";
                $stmt = $conn->prepare($update_enquiry);
                $stmt->bind_param("ss", $proposed_username, $current_username);
                $stmt->execute();
                
                // Update username in Contribute table
                $update_enquiry = "UPDATE enquiry SET Username = ? WHERE Username = ?";
                $stmt = $conn->prepare($update_enquiry);
                $stmt->bind_param("ss", $proposed_username, $current_username);
                $stmt->execute();

                // Update username in login table
                $update_enquiry = "UPDATE login SET Username = ? WHERE Username = ?";
                $stmt = $conn->prepare($update_enquiry);
                $stmt->bind_param("ss", $proposed_username, $current_username);
                $stmt->execute();

                // Update username in Pre-Contribute table
                $update_enquiry = "UPDATE pre_contribute SET Username = ? WHERE Username = ?";
                $stmt = $conn->prepare($update_enquiry);
                $stmt->bind_param("ss", $proposed_username, $current_username);
                $stmt->execute();

                // Update username in contribute_comments table
                $update_enquiry = "UPDATE contribute_comments SET Commenter_Username = ? WHERE Commenter_Username = ?";
                $stmt = $conn->prepare($update_enquiry);
                $stmt->bind_param("ss", $proposed_username, $current_username);
                $stmt->execute();

                // Update username in feedback table
                $update_enquiry = "UPDATE feedback SET Username = ? WHERE Username = ?";
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
    
    // Update query including username
     // Retrieve and sanitize form data
     $updates = array();

     // Check and add each field if changed
     if (!empty($_POST['FirstName']) || !empty($_POST['LastName'])) {
         $new_first_name = mysqli_real_escape_string($conn, $_POST['FirstName']);
         $new_last_name = mysqli_real_escape_string($conn, $_POST['LastName']);
         $full_name = trim($new_first_name . ' ' . $new_last_name);
         if ($full_name !== $current_data['Name']) {
             $updates[] = "Name='$full_name'";
         }
     }
     
     if (!empty($_POST['Email']) && $_POST['Email'] !== $current_data['Email']) {
         $new_email = mysqli_real_escape_string($conn, $_POST['Email']);
         $updates[] = "Email='$new_email'";
     }
     
     if (!empty($_POST['Phone']) && $_POST['Phone'] !== $current_data['Phone']) {
         $new_phone_number = mysqli_real_escape_string($conn, $_POST['Phone']);
         $updates[] = "Phone='$new_phone_number'";
     }
     
     // Address fields
     if (!empty($_POST['Street']) && $_POST['Street'] !== $current_data['Street']) {
         $new_street = mysqli_real_escape_string($conn, $_POST['Street']);
         $updates[] = "Street='$new_street'";
     }
     
     if (!empty($_POST['City']) && $_POST['City'] !== $current_data['City']) {
         $new_city = mysqli_real_escape_string($conn, $_POST['City']);
         $updates[] = "City='$new_city'";
     }
     
     if (!empty($_POST['Postcode']) && $_POST['Postcode'] !== $current_data['Postcode']) {
         $new_postcode = mysqli_real_escape_string($conn, $_POST['Postcode']);
         $updates[] = "Postcode='$new_postcode'";
     }
     
     if (!empty($_POST['State']) && $_POST['State'] !== $current_data['State']) {
         $new_state = mysqli_real_escape_string($conn, $_POST['State']);
         $updates[] = "State='$new_state'";
     }
     
     if (!empty($_POST['Profile_Picture']) && $_POST['Profile_Picture'] !== $current_data['Profile_Picture']) {
         $new_profile_photo = mysqli_real_escape_string($conn, $_POST['Profile_Picture']);
         $updates[] = "Profile_Picture='$new_profile_photo'";
     }
     
     // Execute update only if there are changes
     if (!empty($updates)) {
         $sql = "UPDATE register SET " . implode(', ', $updates) . " WHERE Username='$current_username'";
         
         if(mysqli_query($conn, $sql)) {
             echo "<div class='success-message'>Profile updated successfully!</div>";
             echo "<meta http-equiv='refresh' content='1;url=user_profile.php'>";
         } else {
             echo "<div class='error-message'>Error updating profile: " . mysqli_error($conn) . "</div>";
         }
     } else {
         echo "<div class='info-message'>No changes were made to the profile.</div>";
         echo "<meta http-equiv='refresh' content='1;url=user_profile.php'>";
     }
    
    if(mysqli_query($conn, $sql)) {
        // Update the session with new username
        $_SESSION['username'] = $new_username;
        echo "<div class='edit-success-message'>
                <p>Profile updated successfully!</p>
                <p>You will be redirected to your profile page soon!</p>
              </div>
              <meta http-equiv='refresh' content='1 ;url=user_profile.php'>
              ";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}
?>


<footer>
    <?php include 'include/footer.php';?>
</footer>
</body>
</html>