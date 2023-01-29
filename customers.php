<?php
include 'connection.php';
if (isset($_POST['add'])) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $zip = $_POST['zip'];

  $query = "INSERT INTO `customer`(`c_name`, `c_phone`, `c_address`, `city`, `zip`)
   VALUES ('$name','$phone','$address','$city','$zip')";

  if ($query) {
    $result = mysqli_query($conn, $query);
    // if($result){
    //   echo "data inserted!";
    // }
    // else{
    //   echo "data not inserted !";
    // }
  }
}
?>

<?php include('sidebar.php') ?>
<!DOCTYPE html>
<html>

<head>
  <title>Add new customer</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background: #eceeef;
    }

    .main-container {
      width: 1032px;
      margin: 0 216px auto;
      background-color: #eceeef;
      padding: 20px;
      margin-bottom: 63px;
    }

    .top-bar {
      background: rgb(62, 7, 94);
      display: inline-block;
      display: flex;
      color: white;
      padding-left: 10px;
      width: 1067px;
      margin-left: 196px;
      padding:5px;
    }

    .title {
      margin-right: 576px;
    }

    .bed-crumb {
      color: white;
    }

    .section-1 {
      margin-top: 50px;
      background: white;
      padding: 20px
    }

    input[type=text],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
    }

    label {
      padding: 12px 12px 12px 0;
      display: inline-block;
    }

    input[type=submit] {
      background-color: rgb(62, 7, 94);
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;

    }

    input[type=submit]:hover {
      background-color: white;
      border: 2px solid rgb(62, 7, 94);
      color: rgb(62, 7, 94);
    }

    .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
      margin-top: 50px;
    }

    .col-25 {
      float: left;
      width: 10%;
      margin-top: 6px;
    }

    .col-75 {
      float: left;
      width: 75%;
      margin-top: 6px;
    }

    .row {
      text-align: center;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {

      .col-25,
      .col-75,
      input[type=submit] {
        width: 100%;
        margin-top: 0;
      }
    }
  </style>
</head>

<body>
  <div class="top-bar">
    <h3 class="title">Add New Customer</h3>
    <h6> <a href="home.php" class="bed-crumb">Dasboard </a>/ Add customer</h6>
  </div>

  <div class="main-container">

    <div class="section-1">

      <div>
        <form method="post" action="customers.php">
          <div class="row">
            <div class="col-25">
              <label for="fname">Name</label>
            </div>
            <div class="col-75">
              <input type="text" id="name" name="name" placeholder="Your name..">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="phone">Phone</label>
            </div>
            <div class="col-75">
              <input type="text" id="phone" name="phone" placeholder="phone number">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="subject">Address</label>
            </div>
            <div class="col-75">
              <textarea id="subject" name="address" placeholder="Write something.." style="height:80px"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="city">City</label>
            </div>
            <div class="col-75">
              <input type="text" id="" name="city" style="padding:20px; width:100%">
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="zip">Zip</label>
            </div>
            <div class="col-75">
              <input type="text" id="" name="zip" placeholder="zip code">
            </div>
          </div>
          <br>
          
            <input type="submit" name="add"  value="Add">
          
        </form>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>

</html>