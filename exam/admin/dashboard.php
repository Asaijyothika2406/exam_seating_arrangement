<?php
include '../db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Allotment Dashboard</title>
    <link rel="stylesheet" href="common.css">
    <?php include '../link.php'; ?>
</head>
<body>
<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4>DASHBOARD</h4>   
        </div>
        <ul class="list-unstyled components">
            <li><a href="add_class.php"><img src="https://img.icons8.com/ios-filled/26/ffffff/google-classroom.png"/> Classes</a></li>
            <li><a href="add_student.php"><img src="https://img.icons8.com/ios-filled/25/ffffff/student-registration.png"/> Students</a></li>
            <li><a href="add_room.php"><img src="https://img.icons8.com/metro/26/ffffff/building.png"/> Rooms</a></li>
            <li><a href="dashboard.php" class="active_link"><img src="https://img.icons8.com/nolan/30/ffffff/summary-list.png"/> Allotment</a></li>
        </ul>
    </nav>

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <img src="https://img.icons8.com/ios-filled/19/ffffff/menu--v3.png"/>
                </button><span class="page-name"> Manage Allotments</span>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main-content">
            <?php
            if (isset($_SESSION['batch'])) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['batch']."<button class='close' data-dismiss='alert'>&times;</button></div>";
                unset($_SESSION['batch']);
            }
            if (isset($_SESSION['batchnot'])) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['batchnot']."<button class='close' data-dismiss='alert'>&times;</button></div>";
                unset($_SESSION['batchnot']);
            }
            ?>
            <!-- Add this heading below alerts -->
             <h4 class="mb-3">Manage Allotment</h4>

            <div class="table-responsive border">
                <table class="table table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Class</th>
                            <th>Room</th>
                            <th>Start Roll</th>
                            <th>End Roll</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="addallot.php" method="post">
                            <tr>
                                <td class="bg-light">
                                    <select name="class" class="form-control" required>
                                        <option value="" disabled selected>Select Class</option>
                                        <?php
                                        $class_query = mysqli_query($conn, "SELECT * FROM class");
                                        while ($class = mysqli_fetch_assoc($class_query)) {
                                            $classname = $class['year'] . ' ' . $class['semester'] . ' ' . $class['dept'] . ' ' . $class['division'];
                                            echo "<option value='".$class['class_id']."'>".$classname."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="bg-light">
                                    <select name="room" class="form-control" required>
                                        <option value="" disabled selected>Select Room</option>
                                        <?php
                                        $room_query = mysqli_query($conn, "SELECT * FROM room");
                                        while ($room = mysqli_fetch_assoc($room_query)) {
                                            echo "<option value='".$room['rid']."'>".$room['room_no']." (Block ".$room['block_name'].")</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="bg-light">
                                    <input type="number" class="form-control" name="start" min="1" required>
                                </td>
                                <td class="bg-light">
                                    <input type="number" class="form-control" name="end" min="1" required>
                                </td>
                                <td class="bg-light">
                                    <button class="btn btn-primary" name="addallotment">Add</button>
                                </td>
                                <td class="bg-light"></td> <!-- empty cell for Add row -->
                            </tr>
                        </form>

                        <?php
                        $batch_query = mysqli_query($conn, "
                            SELECT batch.*, 
                                   CONCAT(class.year, ' ', class.semester, ' ', class.dept, ' ', class.division) AS class_name, 
                                   room.room_no, 
                                   room.block_name 
                            FROM batch 
                            JOIN class ON batch.class_id = class.class_id 
                            JOIN room ON batch.room_id = room.rid 
                            ORDER BY batch.batch_id DESC
                        ");

                        if ($batch_query && mysqli_num_rows($batch_query) > 0) {
                            while ($row = mysqli_fetch_assoc($batch_query)) {
                                echo "<tr>
                                    <td>".$row['class_name']."</td>
                                    <td>".$row['room_no']." (Block ".$row['block_name'].")</td>
                                    <td>".$row['startno']."</td>
                                    <td>".$row['endno']."</td>
                                    <td>".$row['total']."</td>
                                    <td>
                                        <form action='delete_allotment.php' method='post' onsubmit='return confirm(\"Are you sure you want to delete this allotment?\");'>
                                            <input type='hidden' name='batch_id' value='".$row['batch_id']."'>
                                                <button type='submit' class='btn btn-sm btn-light p-1'>
                                                    <img src='https://img.icons8.com/color/25/000000/delete-forever.png'/>
                                                </button>

                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No allotments found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
