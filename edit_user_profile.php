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
<meta name="description" content="Plant's Notebook Edit User Info" />
<meta name="keywords" content="User Edit Profile, Plant's Notebook" />
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

            <form class="edit-user-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off" novalidate="novalidate">
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
    
    $error = '';
    $message = '';
    
    // Get form data and sanitize
    $first_name = !empty($_POST['FirstName']) ? mysqli_real_escape_string($conn, $_POST['FirstName']) : '';
    $last_name = !empty($_POST['LastName']) ? mysqli_real_escape_string($conn, $_POST['LastName']) : '';
    $new_username = !empty($_POST['Username']) ? mysqli_real_escape_string($conn, $_POST['Username']) : '';
    $email = !empty($_POST['Email']) ? mysqli_real_escape_string($conn, $_POST['Email']) : '';
    $phone = !empty($_POST['Phone']) ? mysqli_real_escape_string($conn, $_POST['Phone']) : '';
    $postcode = !empty($_POST['Postcode']) ? mysqli_real_escape_string($conn, $_POST['Postcode']) : '';
    $city = !empty($_POST['City']) ? mysqli_real_escape_string($conn, $_POST['City']) : '';
    
    // Validate First Name
    if (!empty($first_name)) {
        if (!preg_match('/^[a-zA-Z\s]+$/', $first_name)) {
            $error .= "Only alphabetic characters and space are allowed in the first name.<br>";
        } else if (strlen($first_name) > 25) {
            $error .= "First name too long. It cannot exceed 25 characters.<br>";
        }
    }

    // Validate Last Name
    if (!empty($last_name)) {
        if (!preg_match('/^[a-zA-Z\s]+$/', $last_name)) {
            $error .= "Only alphabetic characters and space are allowed in the last name.<br>";
        } else if (strlen($last_name) > 25) {
            $error .= "Last name too long. It cannot exceed 25 characters.<br>";
        }
    }

    // Validate Username
    if (!empty($new_username)) {
        if (str_word_count($new_username) > 25) {
            $error .= "Username cannot exceed 25 words.<br>";
        }
        // Check if username already exists (excluding current user)
        $current_username = $_SESSION['username'];
        $query = "SELECT * FROM Register WHERE Username='$new_username' AND Username != '$current_username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $error .= "Username already exists. Please choose a different username.<br>";
        }
    }

    // Validate email
    if (!empty($email)) {
        if (!preg_match('/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $error .= "Please enter a valid email address.<br>";
        }
        // Check if email already exists (excluding current user)
        $query = "SELECT * FROM Register WHERE Email='$email' AND Username != '$current_username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $error .= "Email already exists. Please choose a different email.<br>";
        }
    }

    // Validate Phone if provided
    if (!empty($phone)) {
        if (!preg_match('/^[0-9]{10,11}$/', $phone)) {
            $error .= "Please enter a valid phone number (10-11 digits).<br>";
        }
    }

    // Add postcode validation
    if (!empty($postcode)) {
        if (!preg_match('/^[0-9]{5}$/', $postcode)) {
            $error .= "Postcode must be exactly 5 digits.<br>";
        }
    }

    // Add city validation
    if (!empty($city)) {
        if (!preg_match('/^[a-zA-Z\s]+$/', $city)) {
            $error .= "City name can only contain letters and spaces.<br>";
        }
    }

    // If there are no errors, proceed with the update
    if ($error == '') {
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
                 $message = "Profile updated successfully! You will be redirected to your profile page soon!";
                 echo "<div class='snackbar show success'>" . $message . "</div>";
                 echo "<meta http-equiv='refresh' content='2;url=user_profile.php'>";
             } else {
                 echo "<div class='snackbar show error'>Error updating profile: " . mysqli_error($conn) . "</div>";
             }
         } else {
             echo "<div class='info-message'>No changes were made to the profile.</div>";
             echo "<meta http-equiv='refresh' content='1;url=user_profile.php'>";
         }
    } else {
        echo "<div class='snackbar show error'>" . $error . "Please try again.</div>";
    }
    
    mysqli_close($conn);
}
?>


<footer>
    <?php include 'include/footer.php';?>
</footer>
</body>
</html>