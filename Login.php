<?php
session_start();
include('connection.php');
$error = "";
if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  if (!empty($email) && !empty($pwd)) {

    $sql = "SELECT * FROM `signup` WHERE `Password`='$pwd'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
      $rows = mysqli_fetch_assoc($result);
      $name = $rows['Name'];
      $store = $rows['Store'];
      $db_email = $rows['Email'];
      $db_pwd = $rows['Password'];

      if ($pwd == $rows['Password'] && $email == $db_email) {
        $_SESSION['user_name'] = $name;
        $_SESSION['store_name'] = $store;
        $_SESSION['user_email'] = $email;

        header("location: home.php");
      } else {
        $error = ' <div class="alert alert-danger" role="alert">
                   Incorrect login detais!
                  </div>';
      }
    } else {
      $error = '<div id = "msg">
              
                </div>';
    }
  } else {
    $error = '<div id = "msg" class="alert alert-danger" role="alert">
              All fields required!
              </div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- JavaScript Bundle with Popper -->
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
        <h2 class="text-center">Login</h2>
        <p><?php echo $error ?></p>
        <form class="form-inline form-content" action="Login.php" method="post">
          <label for="email">Email address:</label>
          <input type="email" class="form-control" placeholder="Enter email" name="email"><br>
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" placeholder="Enter password" name="pwd"><br>
          <button type="submit" name="submit" id="bttn" class="btn">Login</button>
          <span style="color:white">Don't hava an account? </span><a href="signup.php">create account</a>
        </form>
      </div>
      <div class="login-text">
        <h2>This is Admin Login </h2>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti aspernatur vero eos ducimus culpa mollitia ipsa quae assumenda, doloribus a aut tenetur cumque optio earum fugit vel reprehenderit reiciendis corporis.
        </p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="resources/jquery.js"></script>
  <script src="resources/jquery-ui.js"></script>

  <script>
    $(function() {
      $(window).onload(function() {
        
        let interval = setInterval(function() {
          $("#msg").append('<div class="alert alert-danger" role="alert">\
                   Incorrect login detais!\
                  </div>');
        }, 2000)
        msg.html();
        clearInterval(interval);
      });
    })
  </script>
</body>

</html>