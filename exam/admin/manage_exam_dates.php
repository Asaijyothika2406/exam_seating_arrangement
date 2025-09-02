<?php
session_start();
include "../db.php";


// Optional: Restrict access only to admins
if (!isset($_SESSION['login']) || $_SESSION['login'] != 'admin') {
    header("Location: login_admin.php");
    exit();
}

if (isset($_POST['update'])) {
    $batch_id = $_POST['batch_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $update = "UPDATE batch SET date='$start_date', end_date='$end_date' WHERE batch_id=$batch_id";
    if (mysqli_query($conn, $update)) {
        // Redirect to dashboard after successful update
        header("Location: dashboard.php");
        exit();
    } else {
        $msg = "Failed to update dates: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Exam Dates</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f0ff;
            padding: 30px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            margin: auto;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: #2b5cb8;
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background: linear-gradient(to right, #003366, #6699ff);
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
        .msg {
            text-align: center;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Set Exam Dates</h2>
        <?php if (isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
        <form method="post">
            <label>Select Batch:</label>
            <select name="batch_id" required>
                <option value="">-- Select Batch --</option>
                <?php
                $result = mysqli_query($conn, "SELECT batch_id FROM batch");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['batch_id']}'>Batch ID: {$row['batch_id']}</option>";
                }
                ?>
            </select>

            <label>Start Date:</label>
            <input type="date" name="start_date" required>

            <label>End Date:</label>
            <input type="date" name="end_date" required>

            <button type="submit" name="update">Update Dates</button>
        </form>
    </div>
</body>
</html>
