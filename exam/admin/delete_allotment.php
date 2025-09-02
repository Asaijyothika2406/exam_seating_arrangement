<?php
include '../db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['batch_id'])) {
    $batch_id = intval($_POST['batch_id']);

    $delete = mysqli_query($conn, "DELETE FROM batch WHERE batch_id = $batch_id");

    if ($delete) {
        $_SESSION['batch'] = "Allotment deleted successfully.";
    } else {
        $_SESSION['batchnot'] = "Failed to delete allotment.";
    }
}

header("Location: dashboard.php");
exit();
?> 