<?php
session_start();
include '../db.php';
?>
<html>
<head>
    <title>Manage Classes</title>
    <link rel="stylesheet" href="common.css">
    <?php include '../link.php'; ?>
</head>
<body>
<?php
if (isset($_POST['deleteclass'])) {
    $class = $_POST['deleteclass'];
    $delete = "DELETE FROM class WHERE class_id = '$class'";
    $delete_query = mysqli_query($conn, $delete);
    $_SESSION[$delete_query ? 'delete' : 'deletenot'] = $delete_query ? "Class deleted successfully" : "Error!! Class not deleted.";
}
?>
<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4>DASHBOARD</h4>
        </div>
        <ul class="list-unstyled components">
            <li><a href="add_class.php" class="active_link"><img src="https://img.icons8.com/ios-filled/26/ffffff/google-classroom.png"/> Classes</a></li>
            <li><a href="add_student.php"><img src="https://img.icons8.com/ios-filled/25/ffffff/student-registration.png"/> Students</a></li>
            <li><a href="add_room.php"><img src="https://img.icons8.com/metro/25/ffffff/building.png"/> Rooms</a></li>
            <li><a href="dashboard.php"><img src="https://img.icons8.com/nolan/30/ffffff/summary-list.png"/> Allotment</a></li>
        </ul>
    </nav>
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <img src="https://img.icons8.com/ios-filled/19/ffffff/menu--v3.png"/>
                </button>
                <span class="page-name"> Manage Classes</span>
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
            foreach (["class", "classnot", "delete", "deletenot"] as $msg) {
                if (isset($_SESSION[$msg])) {
                    $type = ($msg == "class" || $msg == "delete") ? "warning" : "danger";
                    echo "<div class='alert alert-$type alert-dismissible fade show' role='alert'>" . $_SESSION[$msg] . "<button class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                    unset($_SESSION[$msg]);
                }
            }
            ?>
            <div class="table-responsive border">
                <table class="table table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Department</th>
                            <th>Division</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="addclass.php" method="post">
                            <tr>
                                <td>
                                    <select name="year" class="form-control">
                                        <option value="">--select--</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="semester" class="form-control">
                                        <option value="">--select--</option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="dept" class="form-control">
                                        <option value="">--select--</option>
                                        <option value="CSE">CSE</option>
                                        <option value="IT">IT</option>
                                        <option value="ECE">ECE</option>
                                        <option value="AI&DS">AI&DS</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="div" class="form-control">
                                        <option value="">--select--</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </td>
                                <td><button class="btn btn-primary" name="addclass">Add</button></td>
                            </tr>
                        </form>
                        <?php
                        $selectclass = "SELECT * FROM class ORDER BY year, semester, dept, division";
                        $selectclassquery = mysqli_query($conn, $selectclass);
                        if ($selectclassquery && mysqli_num_rows($selectclassquery) > 0) {
                            while ($row = mysqli_fetch_assoc($selectclassquery)) {
                                echo "<tr>
                                    <td>{$row['year']}</td>
                                    <td>{$row['semester']}</td>
                                    <td>{$row['dept']}</td>
                                    <td>{$row['division']}</td>
                                    <form method='post'>
                                    <td><button class='btn btn-light px-1 py-0' type='submit' name='deleteclass' value='{$row['class_id']}'><img src='https://img.icons8.com/color/25/000000/delete-forever.png'/></button></td>
                                    </form>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No classes available.</td></tr>";
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