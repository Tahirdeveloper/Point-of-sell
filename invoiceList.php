<?php
include('connection.php');
// php code for invoice payment....

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $inv_id = $_GET['inv_id'];
  $amount = floatval($_POST['amount']);
  if (!empty($amount)) {
    $select = "SELECT due_amount, grant_amount from account where id = '$inv_id'";
    $query = mysqli_query($conn, $select);
    $rows = mysqli_fetch_assoc($query);
    $dues = $rows['due_amount'];
    $grant = $rows['grant_amount'];

    $total_grant = $grant + $amount;
    $cal_dues = $dues - $amount;

    if (isset($_GET['inv_id'])) {

      $sql = "UPDATE account SET grant_amount = '$total_grant' ,due_amount ='$cal_dues' WHERE id='$inv_id'";
      $result = mysqli_query($conn, $sql);
      header("location:invoiceList.php");
    } else {
      echo "undefine invoice id";
    }
  } else {
    echo "empty amount";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>invoice List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="invoiceList/fonts/icomoon/style.css">

  <link rel="stylesheet" href="invoiceList/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="invoiceList/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="invoiceList/css/style.css">

  <style>
    body {

      background-color: #eceeef;

    }

    .container1 {
      width: 1063px;
      margin: 0px 200px auto;
      background-color: #eceeef;
    }

    .top-bar {
      background: rgb(62, 7, 94);
      display: inline-block;
      display: flex;
      color: white;
      padding-left: 32px;
      padding: 5px;
      width: 100%;
    }

    .title {
      margin-right: 667px;
    }

    .bred-crumb {
      color: blue;
    }
     td {
      text-align: center;
      vertical-align: middle !important;
    }
    th{
      text-align: center !important;
    }
  </style>
</head>

<body>
  <?php include('sidebar.php') ?>
  <div class="container1">
    <div class="top-bar">
      <h3 class="title">Invoice List</h3>
      <h6><a href="home.php" class="bred-crumb">Dashboard </a> / Invoice List </h6>
    </div>
    <div>
      <!-- paydues.php -->
      <?php include('paydues.php') ?>
      <!-- the popup modal  -->
      <div class="container">
        <h2 class="my-2">Invoice List</h2>
        <div class=" custom-table-responsive">
        <input type="text" id="myInput" onkeyup="myFunction()" class=" mb-4" placeholder="Search for names..">
          <table class="table custom-table" id="myTable">
            <thead>
              
              <tr style='background: #3e075e;color: white;'>
              <th scope="col">invoice#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Total</th>
                <th scope="col">Date</th>
                <th scope="col">Discount</th>
                <th scope="col">Grant Amount</th>
                <th scope="col">Dues</th>
                <th scope="col">Change</th>
                <th scope="col">Status</th>
                <th scope="col">Print</th>

              </tr>
            </thead>
            <tbody>
              <?php
              // php code to fetch customer and his account details
              if (isset($_GET['id'])) {
                // This code for single customer based on customer id
                $customer_id = $_GET['id'];
                $sql = "SELECT*  FROM `customer` JOIN `account` ON customer.c_id = account.c_id where customer.c_id = '$customer_id'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
              } else {
                // This code for all customer's invoice list
                $sql = "SELECT*  FROM `customer` JOIN `account` ON customer.c_id = account.c_id";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
              }
              $i = 1;
              while ($rows = mysqli_fetch_assoc($result)) {
                $name = $rows['c_name'];
                $phone = $rows['c_phone'];
                $address = $rows['c_address'];
                $zip = $rows['zip'];
                // account table data
                $inv_id = $rows['id'];
                $total = $rows['allTotal'];
                $date = $rows['date'];
                $discount = $rows['discount'];
                $grant = $rows['grant_amount'];
                $dues = $rows['due_amount'];
                $change = $rows['change_amount'];

                $result2 = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result2);
                if ($count > 0) {
                  echo '  
      
      <tr scope="row" style="">
      <td style="width: 100px;"> ' . $inv_id . ' </td>
      <td> ' . $name . ' </td>
      <td><a href="tel:+4733378901"> ' . $phone . ' </a></td>
      <td> ' . substr($address, 0, 14) . ' <small class="d-block">' . substr($address, 14) . ' </small>
      </td>

      <td id="total' . $i . '">' . $total . '</td>
      <td id="date' . $i . '"    style="width: 104px;text-align: center";>' . $date . '</td>
      <td id="discount' . $i . '">' . $discount . '</td>
      <td id="grant' . $i . '">' . $grant . '</td>
      <td>' . $dues . '</td>
      <td>' . $change . '</td>
      <th> 
      <button  class= "status' . $i . '" id="' . $inv_id . '" data-bs-toggle ="modal" data-bs-target="#exampleModal"></button>  </th>
      <th> <a href="invoice.php?inv_id='.$inv_id.'" <button  class= "view'. $i . ' btn btn-primary" id="'.$inv_id.'">View </button> </a> </th>

      </tr>';

                  $i++;
                } else {
                  echo '<div class="alert alert-warning" role="alert">
                         No record found!
                  </div>';
                }
              }
              ?>
            </tbody>

          </table>

        </div>
      </div>
      <footer>
        <?php include('footer.php') ?>
      </footer>
    </div>
    <script src="invoiceList/js/jquery-3.3.1.min.js"></script>
    <script src="invoiceList/js/popper.min.js"></script>
    <script src="invoiceList/js/bootstrap.min.js"></script>
    <script src="invoiceList/js/main.js"></script>
    <script>
      $(function() {
        var rowCount = $('table tr').length;

        for (let i = 1; i <= rowCount; i++) {
          var payble = parseFloat($('#total' + i).text() - parseFloat($('#discount' + i).text()));
          var pay = parseFloat($("#grant" + i).text());
          if (payble <= pay) {
            $('.status' + i).addClass('btn-success').text('Paid');
            $('.status' + i).removeAttr("data-bs-toggle");
          } else {
            $('.status' + i).addClass('btn-warning').text('Unpaid');
          }
          // this code for invoice payment button
          $('body').on('click', '.status' + i, function(e) {
            e.preventDefault();
            var inv_id = $(".status" + i).attr("id");
            $.ajax({
              type: "GET",
              url: window.location.href + '?invoice_id=' + inv_id,
              data: {
                inv_id: inv_id,
              },
              success: function(response) {
                inv_id = '';
              }
            });
            window.history.pushState("", "", "?inv_id=" + inv_id);
            return false;
          });
        
        }
        $("#close").on('click', function() {
          $("#amount").val(0);
        });
      });
      function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        $(".sidebar").find("a").on('click', function(e) {
                // e.preventDefault();
                $(this).addClass('active');
            })
    </script>
</body>

</html>