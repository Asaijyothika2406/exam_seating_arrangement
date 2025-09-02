<?php 
session_start();
include "../db.php";

if (isset($_POST['addroom'])) {
    $roomno = mysqli_real_escape_string($conn, $_POST['roomno']);
    $block = strtoupper(mysqli_real_escape_string($conn, $_POST['block_name']));
    $cap = mysqli_real_escape_string($conn, $_POST['cap']);

    $insert = "INSERT INTO room (room_no, block_name, capacity) 
               VALUES ('$roomno', '$block', '$cap')";
    
    $insert_query = mysqli_query($conn, $insert);
    if ($insert_query) {
        $_SESSION['room'] = "Room added successfully!";
    } else {
        $_SESSION['roomnot'] = "Error! Room not added.";
    }

    header("Location: add_room.php");
    exit();
}

if (isset($_POST['deleteroom'])) {
    $room = $_POST['deleteroom'];
    $delete = "DELETE FROM room WHERE rid = '$room'";
    $delete_query = mysqli_query($conn, $delete);
    if ($delete_query) {
        $_SESSION['delroom'] = "Room deleted successfully.";
    } else {
        $_SESSION['delnotroom'] = "Error! Room not deleted.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Rooms</title>
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
            <li><a href="add_room.php" class="active_link"><img src="https://img.icons8.com/metro/26/ffffff/building.png"/> Rooms</a></li>
            <li><a href="dashboard.php"><img src="https://img.icons8.com/nolan/30/ffffff/summary-list.png"/> Allotment</a></li>
        </ul>
    </nav>
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <img src="https://img.icons8.com/ios-filled/19/ffffff/menu--v3.png"/>
                </button><span class="page-name"> Manage Rooms</span>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <img src="https://img.icons8.com/ios-filled/19/ffffff/menu--v3.png"/>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main-content">
            <?php
            if (isset($_SESSION['room'])) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['room']."<button class='close' data-dismiss='alert'>&times;</button></div>";
                unset($_SESSION['room']);
            }
            if (isset($_SESSION['roomnot'])) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['roomnot']."<button class='close' data-dismiss='alert'>&times;</button></div>";
                unset($_SESSION['roomnot']);
            }
            if (isset($_SESSION['delroom'])) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>".$_SESSION['delroom']."<button class='close' data-dismiss='alert'>&times;</button></div>";
                unset($_SESSION['delroom']);
            }
            if (isset($_SESSION['delnotroom'])) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".$_SESSION['delnotroom']."<button class='close' data-dismiss='alert'>&times;</button></div>";
                unset($_SESSION['delnotroom']);
            }
            ?>

            <div class="table-responsive border">
                <table class="table table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Room No.</th>
                            <th>Block</th>
                            <th>Capacity</th>
                            <th>Vacancy</th>
                            <th>Actions</th>
                        </tr>   
                    </thead>
                    <tbody>
                        <form action="add_room.php" method="post">
                            <tr>
                                <td class="py-3 bg-light">
                                    <input class="form-control" type="number" min="0" max="815" name="roomno" required>
                                </td>
                                <td class="py-3 bg-light">
                                    <select class="form-control" name="block_name" required>
                                    <option value="" disabled selected>Select Block</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    </select>
                                </td>
                                <td class="py-3 bg-light">
                                    <input class="form-control" type="number" min="0" max="80" name="cap" required>
                                </td>
                                <td class="py-3 bg-light"></td>
                                <td class="py-3 bg-light">
                                    <button class="btn btn-primary" name="addroom">Add</button>
                                </td>
                            </tr>  
                        </form>

                        <?php
                        $selectclass = "SELECT rid, room_no, block_name, capacity, SUM(total) AS filled 
                                        FROM batch 
                                        RIGHT JOIN room ON batch.room_id = room.rid 
                                        GROUP BY rid";
                        $selectclassquery = mysqli_query($conn, $selectclass);
                        if ($selectclassquery) {
                            while ($row = mysqli_fetch_assoc($selectclassquery)) {
                                $vacancy = $row['capacity'] - $row['filled'];
                                echo "<tr>
                                    <td>".$row['room_no']."</td>
                                    <td>".$row['block_name']."</td>
                                    <td>".$row['capacity']."</td>
                                    <td>".$vacancy."</td>
                                    <td>
                                        <form method='post'>
                                            <button class='btn btn-light px-1 py-0' type='submit' value='".$row['rid']."' name='deleteroom'>
                                                <img src='https://img.icons8.com/color/25/000000/delete-forever.png'/>
                                            </button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No rooms available.</td></tr>";
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
