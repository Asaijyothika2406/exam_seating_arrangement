<?php
include '../db.php';
session_start();

if (isset($_POST['addallotment'])) {
    // Sanitize and fetch input values
    $room = mysqli_real_escape_string($conn, htmlentities($_POST['room']));
    $class = mysqli_real_escape_string($conn, htmlentities($_POST['class']));
    $start = mysqli_real_escape_string($conn, htmlentities($_POST['start']));
    $end = mysqli_real_escape_string($conn, htmlentities($_POST['end']));

    // Validate roll numbers
    if (!is_numeric($start) || !is_numeric($end) || $start > $end) {
        $_SESSION['batchnot'] = "Invalid roll number range.";
        header("Location: dashboard.php");
        exit();
    }

    $total = $end - $start + 1;

    // Check if total fits in available capacity of room
    $roomQuery = mysqli_query($conn, "SELECT capacity, 
        IFNULL(SUM(batch.total), 0) AS used 
        FROM room 
        LEFT JOIN batch ON batch.room_id = room.rid 
        WHERE rid = '$room' 
        GROUP BY room.rid");

    $roomData = mysqli_fetch_assoc($roomQuery);

    if ($roomData && ($roomData['capacity'] - $roomData['used'] < $total)) {
        $_SESSION['batchnot'] = "Not enough capacity in the selected room.";
        header("Location: dashboard.php");
        exit();
    }

    // Insert into batch table
    $insert = "INSERT INTO batch (class_id, room_id, startno, endno, total) 
               VALUES ('$class', '$room', '$start', '$end', '$total')";
    $insert_query = mysqli_query($conn, $insert);

    if ($insert_query) {
        $_SESSION['batch'] = "New allotment placed successfully.";
    } else {
        $_SESSION['batchnot'] = "Error!! Allotment not added.";
    }

    header("Location: dashboard.php");
}
?>