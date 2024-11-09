<?php
    include 'database/connection.php';
    include 'database/database.php';
    session_start();
?>


<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Unlock the secrets of plant identification with Plant's Notebook. Learn to identify various plant species, understand their characteristics, and explore the tools and techniques used by botanists. Ideal for botanists, hobbyists, and nature enthusiasts." />
        <meta name="keywords" content="Herbarium Specimen Tutorial, Classify Plant, Herbarium Specimen Preserve, Herbarium Specimen Tools, Plant Identifier, Botany, Plant Preservation, Plant Classification, Botanical Tools, Plant Identification, Botanical Education, Nature Enthusiasts, Botanical Hobbyists, Plant Collection, Herbarium Techniques,Plant Common Name, Plant Scientific Name,Herbarium Specimen" />
        <meta name="author" content="Aniq Nazhan bin Mazlan"  />
        <title>Plant's Notebook | Enquiry</title>
        <link rel="stylesheet" href="styles/style.css">
    	<link rel="icon" type="image/x-icon" href="images/logo.png">
        <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>

    </head>

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

        <header id="top_enq">
            <?php include 'include/header.php';
            ?>
        </header>

        <article class="identify-enquiry">

            <?php include 'include/chatbot.php';?>

            <div class="enquiry-form">
                <?php
                    echo "<h1>Hi, " . $_SESSION['username'] . "</h1>";
                ?>
                <div class="profile-picture-content"> 
                        <input type="checkbox" id="change_box">
                        
                        <label for="change_box" class="transform-box1">
                            <span class="box-text">Reveal My Picture <br> (Click Here) </span>
                            <img src="images/aniq.jpeg" alt="Aniq Picture" class="box-img">
                        </label>
                    </div>
                <p>Name: <?php echo isset($user_data['Name']) ? $user_data['Name'] : 'Not set'; ?></p>
                <p>Username: <?php echo isset($user_data['Username']) ? $user_data['Username'] : 'Not set'; ?></p>
                <p>Email: <?php echo isset($user_data['Email']) ? $user_data['Email'] : 'Not set'; ?></p>

                <?php
                    // Query to get plant contributions for current user
                    $plant_sql = "SELECT * FROM contribute WHERE username = '$current_user'";
                    $plant_result = mysqli_query($conn, $plant_sql);

                    if ($plant_result && mysqli_num_rows($plant_result) > 0) {
                        $contribution_count = 1;
                            while ($row = mysqli_fetch_assoc($plant_result)) {
                            echo "<h3>Contribution #" . $contribution_count . "</h3>";
                            echo "<table border='1'>
                            <tr>
                                <th>Contribution</th>   
                                <th>Details</th>
                            </tr>
                            <tr>
                                <td>Plant's Name</td>
                                <td>" . htmlspecialchars($row['Plant_Name']) . "</td>
                            </tr>
                            <tr>
                                <td>Plant's Family</td>
                                <td>" . htmlspecialchars($row['Plant_Family']) . "</td>
                            </tr>
                            <tr>
                                <td>Plant's Genus</td>
                                <td>" . htmlspecialchars($row['Plant_Genus']) . "</td>
                            </tr>
                            <tr>
                                <td>Plant's Species</td>
                                <td>" . htmlspecialchars($row['Plant_Species']) . "</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>" . htmlspecialchars($row['Description_Contribute']) . "</td>
                            </tr>
                    </table><br>";
                            $contribution_count++;
                        }
                    } else {
                        echo "<p>No plant contributions found</p>";
                    }
                ?>
                <br>
                <?php
                    $enquiry_sql = "SELECT * FROM enquiry WHERE username = '$current_user'";
                    $enquiry_result = mysqli_query($conn, $enquiry_sql);

                    if ($enquiry_result && mysqli_num_rows($enquiry_result) > 0) {
                        $enquiry_count = 1;
                        while ($row = mysqli_fetch_assoc($enquiry_result)) {
                            echo "<h3>Enquiry #" . $enquiry_count . "</h3>";
                            echo "<table border='1'>
                            <tr>
                                <th>Enquiry</th>
                                <th>Details</th>
                            </tr>
                            <tr>
                                <td>Enquiry</td>
                                <td>" . htmlspecialchars($row['Enquiry']) . "</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>" . htmlspecialchars($row['Date']) . "</td>
                            </tr>
                            </table><br>";
                            $enquiry_count++;
                        }
                    }
                    echo "<a href='test2.php'><button>Edit Profile</button></a>";
                ?>
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