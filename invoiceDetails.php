<!-- <?php 
 include('connection.php');
if(isset($_POST['add'])){
  $c_id=$_POST['c_id'];
  $id=$_POST['invoice_number'];
  $title=$_POST['title'];
  $name=$_POST['name'];
  $date=$_POST['date'];
  $amount=$_POST['amount'];
 


  $sql="INSERT INTO `invoice`(`invoice_number`,`title`, `customer-name`, `date`, `amount_due`,`c_id`) 
  VALUES ($id,'$title','$name','$date','$amount','$c_id')";
  if($sql)
  {
    $result = mysqli_query($conn, $sql);
  }
}

?>
<?php include('sidebar.php') ?>
<!DOCTYPE html>
<html>
  <title>Add Invoice</title>
<head>
<style>
* {
    box-sizing: border-box;
}
body{
    background: #eceeef;
}
.main-container {
            width: 1032px;
            margin: 0 216px auto;
            background-color: #eceeef;
            padding:20px;
            margin-bottom:63px;

        }
        .top-bar{
            background: rgb(62, 7, 94);
             display: inline-block;
            display: flex;
            color: white;
            padding-left: 10px;
            border-radius: 5px;
        }
        .title {
            margin-right: 576px;
        }
        .bred-crumb{
            color:blue;
        }
 .section-1{
     margin-top:50px;
     background:white;
     padding:20px
     
 }       

input[type=text], select, textarea {
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
  background-color:  rgb(62, 7, 94);
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
 
}

input[type=submit]:hover {
  background-color: white;
  border: 2px solid rgb(62, 7, 94);
  color:rgb(62, 7, 94);
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  margin-top:50px;
}

.col-25 {
  float: left;
  width: 15%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

.row{
    text-align:center;
}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>


<div class="main-container">
<div class="top-bar">
<h3 class="title">Add Invoice</h3>
<h6> <a href="home.php" class="bred-crumb">Dasboard </a>/<a href="InvoiceList.php" class="bred-crumb">Invoice List </a> / Edite Invoice</h6>
</div>
<div class="section-1">

<div>
  <form method='post' action="invoiceDetails.php">
  <div class="row">
    <div class="col-25">
      <label for="id">Invoice#</label>
    </div>
    <div class="col-75">
      <input type="text" id="id" name="invoice_number" placeholder="Invoice#">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="title">Invoice Title</label>
    </div>
    <div class="col-75">
      <input type="text" id="title" name="title" placeholder="Invoice Title">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="fname">Customer Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="LastPayment">Date</label>
    </div>
    <div class="col-75">
      <input type="date" id="payment" name="date" style="padding:20px; width:100%">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="amount">Amount</label>
    </div>
    <div class="col-75">
      <input type="text" id="amount" name="amount" placeholder="Amount">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="c_id">Customer Id</label>
    </div>
    <div class="col-75">
      <input type="text" id="c_id" name="c_id" placeholder="Customer di">
    </div>
  </div>
  <div class="row">
    <input type="submit" name="add" value="Add">
  </div>
  </form>
  </div>
  </div>
</div>
<?php include('footer.php') ?>
</body>
</html>

 -->
