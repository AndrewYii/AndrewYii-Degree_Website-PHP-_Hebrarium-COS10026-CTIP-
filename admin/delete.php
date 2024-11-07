<?php
include '../database/connection.php';
include '../database/database.php';

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];
    $delete_query = "DELETE FROM Register WHERE Register_ID = '$id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run)
    {
        $_SESSION['status'] = "DATA DELETED SUCCESSFULLY";
        $_SESSION['status_code'] = "success";
        header("Location: admin_control_panel.php");
    }
    else
    {
        $_SESSION['status'] = "DATA NOT DELETED";
        $_SESSION['status_code'] = "error";
        header("Location: admin_control_panel.php");
    }
}





