<?php
include("connection.php");

if(isset($_POST['customer_name'])){
    $customer=$_POST['customer_name'];
   $sql = "SELECT c_id from customer where c_name='$customer'";
   $resut=mysqli_query($conn,$sql);
   $row = mysqli_fetch_assoc($resut);
   $c_id=$row['c_id'];
   echo $c_id;
}

else{
    echo "opps nothing recieved";
}
?>