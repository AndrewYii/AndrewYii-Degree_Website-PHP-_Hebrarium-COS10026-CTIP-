<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Enquiries"/>
    <meta name="keywords" content="Plant's Notebook, Enquiries, Admin View"/>
    <title>Plant's Notebook | View Enquiries</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
</head>

<body>
    <?php 
    include ('../database/connection.php');
    include ('../database/database.php');
    ?>

    <h1>Plant's Notebook Enquiry Form</h1>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Street</th>
            <th>City</th>
            <th>Postcode</th>
            <th>State</th>
            <th>Date Submitted</th>
        </tr>

        <?php
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            $sql = "SELECT * FROM Enquiry";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row["Enquiry_ID"]; ?></td>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo $row["Email"]; ?></td>
                    <td><?php echo $row["Phone"]; ?></td>
                    <td><?php echo $row["Subject"]; ?></td>
                    <td><?php echo $row["Message"]; ?></td>
                    <td><?php echo $row["Street"]; ?></td>
                    <td><?php echo $row["City"]; ?></td>
                    <td><?php echo $row["Postcode"]; ?></td>
                    <td><?php echo $row["State"]; ?></td>
                    <td><?php echo $row["Enquiry_Created_At"]; ?></td>
                </tr>
        <?php
                }
            } else {
                echo "<tr><td colspan='11'>No enquiries found</td></tr>";
            }
            mysqli_close($conn);
        ?>
    </table>



    <h1>Plant's Notebook Contribution Form</h1>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Picture Option</th>
            <th>Tag</th>
            <th>Plant's Name</th>
            <th>Plant's Family</th>
            <th>Plant's Genus</th>
            <th>Plant's Species</th>
            <th>Plant's Leaf Photo</th>
            <th>Plant's Herbarium Photo</th>
            <th>Comment</th>
            <th>Date Submitted</th>
        </tr>

        <?php
            $conn = mysqli_connect($servername,$username,$password,$dbname);
            $sql = "SELECT * FROM Contribute";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row["Contribute_ID"]; ?></td>
                    <td><?php echo $row["Picture_Option"]; ?></td>
                    <td><?php echo $row["Tag"]; ?></td>
                    <td><?php echo $row["Plant_Name"]; ?></td>
                    <td><?php echo $row["Plant_Family"]; ?></td>
                    <td><?php echo $row["Plant_Genus"]; ?></td>
                    <td><?php echo $row["Plant_Species"]; ?></td>
                    <td><?php echo $row["Plant_Leaf_Photo"]; ?></td>
                    <td><?php echo $row["Plant_Herbarium_Photo"]; ?></td>
                    <td><?php echo $row["Comment_Contribute"]; ?></td>
                    <td><?php echo $row["Contribute_Created_At"]; ?></td>
                </tr>
        <?php
                }
            } else {
                echo "<tr><td colspan='11'>No enquiries found</td></tr>";
            }
            mysqli_close($conn);
        ?>
    </table>
</body>
</html>