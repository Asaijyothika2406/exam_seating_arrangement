<!-- New index.php with Bootstrap 5 UI and Stanley College Header -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exam Hall Seating | Stanley College</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  body {
  background-color: white;
 /* Change this color code as needed */
  }
  .header {
    background-color: #003366;
    color: white;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .login-options {
    margin-top: 3rem;
  }
  .card {
    border-radius: 1rem;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .admin{
    height:50px;
    width:50px;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
  .student{
    height:60px;
    width:60px;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
  .footer{
    margin-top:130px;
  }

</style>
</head>
<body>

  <!-- Stanley College Banner -->
  <div class="text-center mb-4">
    <img src="images/header.png" alt="Stanley College Banner" class="img-fluid mb-4 shadow-lg"/>
  </div>

  <div class="container login-options">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card p-5 text-center">
          <h4 class="p-3 text-center">Admin Login</h4>
          <img src="images/admin.png" class="admin"/>
          <a href="login_admin.php" class="btn btn-primary mt-4">Login as Admin</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-5 text-center">
          <h4 class="p-3 text-center">Student Login</h4>
          <img src="images/students.png" class="student"/>
          <a href="login_student.php" class="btn btn-primary mt-3">Login as Student</a>
        </div>
      </div>
    </div>
  </div>

  <footer class="text-center text-muted footer py-3">
    &copy; <?php echo date("Y"); ?> Stanley College of Engineering & Technology for Women. All Rights Reserved.
  </footer>

</body>
</html>
