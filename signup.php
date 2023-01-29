<?php
include('connection.php');
if (isset($_POST['signup'])) {
  $name = $_POST['name'];
  $store = $_POST['store'];
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  $filename = $_FILES["avator"]["name"];
  $tempname = $_FILES["avator"]["tmp_name"];
  $folder = "images/" . $filename;
  if (move_uploaded_file($tempname, $folder)) {
    $message = "<div class='alert alert-success'>
                Data successfully uploaded!
                </div>";
 
    $sql = "INSERT INTO `signup`( `Name`, `Store`, `Email`, `Password`,`image`) VALUES ('$name','$store','$email','$pwd','$filename')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $_SESSION['signup'] = array('email' => $email, 'pwd' => $pwd);
      header("location: Login.php");
    } else {
      echo "something went wrong! Please try again";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <style>
    body {
      margin: 0px;
      padding: 0px;
      background-color: black;
    }

    .container {

      margin: 80px auto;
      border: 2px solid #00f9e8;
      width: fit-content;

    }

    .mainContainer {
      display: flex;
      margin: 15px;
    }

    .form-container {
      color: white;
      background-color: #7e0377;
    }

    .form-content {
      margin-top: 80px;
      line-height: 35px;
      width: 64%;
      margin: 70px auto;
      height: fit-content;
    }

    .login-text {
      background-image: url("images/laptop.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      opacity: 0.6;
      color: white;
      border: 2px solid white;
      background-color: lightgray;
      text-align: center;
      padding-top: 140px;
      width: 1000px;
    }

    #bttn {
      background-color: lightgray;
      color: white;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="mainContainer">
      <div class="container-fluid form-container">
        <h2 class="text-center">SignUp</h2>
        <form class="form-inline form-content" action="signup.php" method="post" enctype="multipart/form-data">
          <label for="name">Name:</label>
          <input type="text" class="form-control" placeholder="Enter full name" name="name"><br>
          <label for="Store">Store Name</label>
          <input type="text" class="form-control" placeholder="Enter Store name" name="store"><br>
          <label for="email">Email address:</label>
          <input type="email" class="form-control" placeholder="Enter email" name="email"><br>
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" placeholder="Enter password" name="pwd"><br>

          <input type="file" class="form-control" name="avator"><br>

          <button type="submit" name="signup" id="bttn" class="btn">SignUp</button>
          <span style="color:white">Already hava an account? </span><a href="Login.php">Login</a>
        </form>
      </div>
      <div class="login-text">
        <h2>Register Your Self </h2>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti aspernatur vero eos ducimus culpa mollitia ipsa quae assumenda, doloribus a aut tenetur cumque optio earum fugit vel reprehenderit reiciendis corporis.
        </p>
      </div>
    </div>
  </div>
</body>

</html>