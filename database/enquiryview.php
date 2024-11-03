<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View Plant's Notebook Enquiries"/>
    <meta name="keywords" content="Plant's Notebook, Enquiries, Admin View"/>
    <title>Plant's Notebook | View Enquiries</title>
    <!-- Fix paths to go up one directory -->
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
</head>

<body>
    <?php 
    // Fix include paths - files are in the same directory
    include ('connection.php');
    include ('database.php');

    // Add connection verification
    if (!isset($conn) || !$conn) {
        die("Database connection not established");
    }
    ?>

    <h1>Plant's Notebook Enquiries</h1>
    
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
            $sql = "SELECT * FROM inquiries";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["phone"]; ?></td>
                    <td><?php echo $row["subject"]; ?></td>
                    <td><?php echo $row["message"]; ?></td>
                    <td><?php echo $row["street"]; ?></td>
                    <td><?php echo $row["city"]; ?></td>
                    <td><?php echo $row["postcode"]; ?></td>
                    <td><?php echo $row["state"]; ?></td>
                    <td><?php echo $row["created_at"]; ?></td>
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