<!DOCTYPE html>

<html lang="en">
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="View User Info" />
<meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques,Plant Common Name, Plant Scientific Name,Herbarium Specimen" />
<meta name="author" content="Aniq Nazhan bin Mazlan"  />
<title>Plant's Notebook | Profile Page</title>
<link rel="stylesheet" href="styles/style.css">
<link rel="icon" type="image/x-icon" href="images/logo.png">
<link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

</head>

<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start();
?>

    <body>
        <?php
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            
            // Check if user is logged in
            if (isset($_SESSION['username'])) {
                $current_user = $_SESSION['username'];
                $sql = "SELECT * FROM Register WHERE username = '$current_user'";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);
                }
            } else {
                // Redirect to login page if not logged in
                header("Location: login.php");
                exit();
            }
        ?>
        <?php 

        if (isset($_SESSION['message'])) {
            $messageClass = strpos($_SESSION['message'], 'Error') !== false ? 'error-message' : 'success-message';
            echo "<div class='admin-message {$messageClass}'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']); // Clear the message after displaying
        }
        ?>

        <header id="top_enq">
            <?php include 'include/header.php';
            ?>
        </header>

        <article class="identify-enquiry">

            <?php include 'include/chatbot.php';?>
            
            <div class="enquiry-form">
                <br>
                <h1>User Profile</h1>
                <br>
                <?php
                    echo "<h1>Hi, " . $_SESSION['username'] . "</h1>";
                ?>
                <?php
                // Check if the 'Profile_Picture' key exists and is not empty
                $profilePic = isset($user_data['Profile_Picture']) && !empty($user_data['Profile_Picture']) 
                    ? htmlspecialchars($user_data['Profile_Picture']) 
                    : 'images/default.png';

                // Output the image tag
                echo "<img src='" . $profilePic . "' alt='Profile Picture' class='user-profile'>";
                ?>
                <table class="profile-table-user">
                    <tr class="odd-row5">
                        <th>Name</th>
                        <td><?php echo isset($user_data['Name']) ? $user_data['Name'] : 'Not set'; ?></td>                       
                    </tr>
                    <tr class="even-row5">
                        <th>Phone Number</th>
                        <td><?php echo isset($user_data['Phone']) ? $user_data['Phone'] : 'Not set'; ?></td>
                    </tr>
                    <tr class="odd-row5">
                        <th>Email</th>
                        <td><?php echo isset($user_data['Email']) ? $user_data['Email'] : 'Not set'; ?></td>
                    </tr>
                    <tr>
                        <?php
                            if (isset($user_data['Street']) && isset($user_data['City']) && isset($user_data['Postcode']) && isset($user_data['State'])) {
                                $address = $user_data['Street'] . ', ' . $user_data['City'] . ', ' . $user_data['Postcode'] . ', ' . $user_data['State'];
                            } else {
                                $address = 'Not set';
                            }
                            echo "<th>Address</th>";
                            echo "<td>" . $address . "</td>";
                        ?>
                    </tr>
                </table>
                <?php
                    echo "<div class='right-align-button'><a href='edit_user_profile.php'><button class='edit-user-button'>Edit Profile</button></a></div>";
                ?>
                <input type="radio" id="contribution" name="profile" checked="checked">
                <input type="radio" id="enquiry" name="profile">
                <ul class="profile-nav">
                    <li id="contribution-section"><label for="contribution">Contribution</label></li>
                    <li>|</li>
                    <li id="enquiry-section"><label for="enquiry">Enquiry</label></li>   
                </ul>
                <?php
                    // Query to get plant contributions for current user
                    $plant_sql = "SELECT * FROM contribute WHERE username = '$current_user'";
                    $plant_result = mysqli_query($conn, $plant_sql);
                    echo "<div class='profile-contribution'>";
                    if ($plant_result && mysqli_num_rows($plant_result) > 0) {
                        $contribution_count = 1;
                            while ($row = mysqli_fetch_assoc($plant_result)) {
                                $contribution_id = $row['Contribute_ID'];
                                $comment_sql = "SELECT * FROM Contribute_Comments WHERE Contribute_ID = '$contribution_id' ORDER BY Comment_Created_At DESC";
                                $comment_result = mysqli_query($conn, $comment_sql);
                                echo "<h3>Contribution #" . $contribution_count . "</h3>";
                                echo "<form method='POST' onsubmit='return confirm(\"Are you sure you want to delete this contribution?\");'>";
                                echo "<input type='hidden' name='contribution_id' value='" . $row['Contribute_ID'] . "'>";
                                echo "<div class='right-align-button2'><button type='submit' name='delete_contribution' class='edit-user-button'>Delete Contribution</button></div>";
                                echo "</form>";
                                echo "<table class='profile-table-enquiry'>
                                <tr class='odd-row5'>
                                    <th>Contribution</th>   
                                    <th>Details</th>
                                </tr>
                                <tr>
                                    <td>Plant's Leaf</td>
                                    <td><img src='" . htmlspecialchars($row['Plant_Leaf_Photo']) . "' alt='Plant Leaf Photo' class='enquiry-img'></td>
                                </tr>
                                <tr class='odd-row5'>
                                    <td>Herbarium Species</td>
                                    <td><img src='" . htmlspecialchars($row['Plant_Herbarium_Photo']) . "' alt='Plant Herbarium Photo' class='enquiry-img'></td>
                                </tr>
                                <tr>
                                    <td>Plant's Name</td>
                                    <td>" . htmlspecialchars($row['Plant_Name']) . "</td>
                                </tr>
                                <tr class='odd-row5'>
                                    <td>Plant's Family</td>
                                    <td>" . htmlspecialchars($row['Plant_Family']) . "</td>
                                </tr>
                                <tr>
                                    <td>Plant's Genus</td>
                                    <td>" . htmlspecialchars($row['Plant_Genus']) . "</td>
                                </tr>
                                <tr class='odd-row5'>
                                    <td>Plant's Species</td>
                                    <td>" . htmlspecialchars($row['Plant_Species']) . "</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>" . htmlspecialchars($row['Description_Contribute']) . "</td>
                                </tr>";
                                if ($comment_result && mysqli_num_rows($comment_result) > 0) {
                                    $comment_count = 1;
                                    while ($comment = mysqli_fetch_assoc($comment_result)) {
                                        if($comment_count%2 != 0){
                                            echo"<tr class='odd-row5'>
                                                <td>Comments " . $comment_count . "</td>";
                                                echo"<td>"  . htmlspecialchars($comment['Comment_Text']) . "</td>
                                                </tr>";
                                            echo"<tr>
                                                    <td>Commenter Username</td>
                                                    <td>"  . htmlspecialchars($comment['Commenter_Username']) . "</td>
                                                </tr>";
                                            echo"<tr class='odd-row5'>
                                                    <td>Comments Created</td>
                                                    <td>"  . htmlspecialchars($comment['Comment_Created_At']) . "</td>
                                                </tr>";

                                        }
                                        else{
                                            echo"<tr>
                                            <td>Comments" . $comment_count . "</td>";
                                            echo"<td>"  . htmlspecialchars($comment['Comment_Text']) . "</td>
                                            </tr>";
                                        echo"<tr class='odd-row5'>
                                                <td>Commenter Username</td>
                                                <td>"  . htmlspecialchars($comment['Commenter_Username']) . "</td>
                                            </tr>";
                                        echo"<tr>
                                                <td>Comments Created</td>
                                                <td>"  . htmlspecialchars($comment['Comment_Created_At']) . "</td>
                                            </tr>";
                                        }
                                        $comment_count++;
                                    }
                                }
                                else{
                                    echo"<tr class='odd-row5'>
                                            <td>Comment</td>
                                            <td>No Comments Found</td>
                                        </tr>";
                                }
                           echo"</table>
                                <br>";
                                $contribution_count++;
                            }
                            } else {
                            echo "<p>No plant contributions found</p>";
                            }
                            if (isset($_POST['delete_contribution'])) {
                                $contribution_id = $_POST['contribution_id'];
                                $delete_sql = "DELETE FROM contribute WHERE Contribute_ID = '$contribution_id' AND username = '$current_user'";
                                if (mysqli_query($conn, $delete_sql)) {
                                    $_SESSION['message'] = 'Contribution Deleted';
                                    echo "<meta http-equiv='refresh' content='0;url=user_profile.php'>";
                                } else {
                                    echo "";
                        }
                    }
                    echo "</div>";

                    $enquiry_sql = "SELECT * FROM Enquiry WHERE Username = '$current_user'";
                    $enquiry_result = mysqli_query($conn, $enquiry_sql);
                    
                    echo "<div class='profile-enquiry'>";
                    if ($enquiry_result && mysqli_num_rows($enquiry_result) > 0) {
                        $enquiry_count = 1;
                        while ($row = mysqli_fetch_assoc($enquiry_result)) {
                            echo "<h3>Enquiry #" . $enquiry_count . "</h3>";
                            echo "<form method='POST'>";
                            echo "<input type='hidden' name='enquiry_id' value='" . $row['Enquiry_ID'] . "'>";
                            echo "<div class='right-align-button2'><a href='user_profile.php'><button type='submit' name='delete_enquiry' class='edit-user-button'><label for='delete_enquiry'>Delete Enquiry</label></button></a></div>";
                            echo "</form>";
                            echo "<table class='profile-table-enquiry'>
                            <tr class='odd-row5'>
                                <th>Enquiry</th>   
                                <th>Details</th> 
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>" . htmlspecialchars($row['Name']) . "</td>
                            </tr>
                            <tr class='odd-row5'>
                                <td>Email</td>
                                <td>" . htmlspecialchars($row['Email']) . "</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>" . htmlspecialchars($row['Enquiry_Created_At']) . "</td>
                            </tr>
                            <tr class='odd-row5'>
                                <td>Subject</td>
                                <td>" . htmlspecialchars($row['Subject']) . "</td>
                            </tr>
                            <tr>
                                <td>Message</td>
                                <td>" . htmlspecialchars($row['Message']) . "</td>
                            </tr>
                            <tr class='odd-row5'>
                                <td>Response</td>
                                <td>" . htmlspecialchars($row['Response']) . "</td>
                            </tr>
                        </table>";
                            $enquiry_count++;   
                        }
                    } else {
                        echo "<p>No enquiries found</p>";
                    }
                    echo "</div>";
                    if (isset($_POST['delete_enquiry'])) {
                        $enquiry_id = $_POST['enquiry_id'];
                        $delete_enquiry_sql = "DELETE FROM Enquiry WHERE Enquiry_ID = '$enquiry_id' AND Username = '$current_user'";
                        if (mysqli_query($conn, $delete_enquiry_sql)) {
                            $_SESSION['message'] = 'Enquiry Deleted';
                            echo "<meta http-equiv='refresh' content='0;url=user_profile.php'>";
                        } else {
                            echo "";
                        }
                    }

                    
                ?>
                <br>
            </div>

            <?php   
                mysqli_close($conn);
            ?>

            <figure class='going-up-container'>
                <a href='#top_enq'>
                    <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
                </a>
            </figure>
            
        </article>

        <footer>
            <?php include 'include/footer.php';?>
        </footer>

        <figure class='going-up-container'>
            <a href='#top_enq'>
                <img src='images/going_up.png' alt='going-up' class='going-up'  title="going to the top">
            </a>
        </figure> 

    </body>

</html>