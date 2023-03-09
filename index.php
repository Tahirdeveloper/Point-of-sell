<?php

include('connection.php');
include('sidebar.php');
if (isset($_SESSION['user_email'])) {
    $sql = " SELECT* FROM `customer`";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count < 1) {
        echo "No customer exist!";
    } else {
        while ($rows = mysqli_fetch_assoc($result)) {
            $c_id = $rows['c_id'];
            $name = $rows['c_name'];
            $phone = $rows['c_phone'];
            $address = $rows['c_address'];
            $payment_date = $rows['city'];
            $payment_date = $rows['zip'];

            $count = mysqli_num_rows($result);
        }
    }
} else {
    // echo "session not seted";
    header("location: Login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {

            background-color: #eceeef;

        }

        .container {
            width: 1032px;
            margin: 0 225px auto;
            background-color: #eceeef;
        }

        .top-bar {
            background: rgb(62, 7, 94);
            display: inline-block;
            display: flex;
            color: white;
            /* padding-left: 48px; */
            /* border-radius: 5px; */
            width: 1064px;
            padding: 4px;
            margin-left: 199px;
            
        }

        .title {
            margin-right: 800px;
            padding-left: 12px;
        }

        .bed-crumb {
            color: white;
        }

        .column {
            float: left;
            width: 32%;
            padding: 0 10px;
            margin-top: 20px;
        }

        /* Remove extra left and right margins, due to padding in columns */
        .row {
            margin: 0 -5px;
            display: flex;
            justify-content: space-around;

        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Style the counter cards */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.8);
            /* this adds the "card" effect */
            padding: 16px;
            text-align: center;
            background-color: #3e075e;
            color: white;
        }

        /* Responsive columns - one column layout (vertical) on small screens */
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }

        .table-container {
            background-color: white;
            padding: 50px;
            padding-top: 0px;
            border: 2px solid gainsboro;
            margin-top: 30px;
        }

        #myInput {
            background-image: url('/css/searchicon.png');
            /* Add a search icon to input */
            background-position: 10px 12px;
            /* Position the search icon */
            background-repeat: no-repeat;
            /* Do not repeat the icon image */
            width: 20%;
            /* Full-width */
            padding: 12px 20px 12px 40px;
            /* Add some padding */
            border: 1px solid #ddd;
            /* Add a grey border */
            margin: 0px 0px 11px 0px;
        }

        #myTable {
            border-collapse: collapse;
            /* Collapse borders */
            width: 100%;
            /* Full-width */
            border: 1px solid #ddd;
            /* Add a grey border */
            font-size: 14px;
            /* Increase font-size */
        }

        #myTable th,
        #myTable td {
            text-align: left;
            /* Left-align text */
            padding: 12px;
            /* Add padding */
        }

        #myTable tr {
            /* Add a bottom border to all table rows */
            border-bottom: 1px solid #ddd;
        }

        #myTable tr.header{
            background-color:rgb(62, 7, 94) ;
            color:white;
        }
        #myTable tr:hover {
            /* Add a grey background color to the table header and on hover */
            background-color: #7379b2;
            color: white;
        }
    </style>
</head>

<body>
    <?php  ?>
    <div class="top-bar">
        <h3 class="title">Home</h3>
        <h4>Dasboard </h4>
    </div>

    <div class="container">

        <div class="row">
            <div class="column">
                <div class="card">
                    <h3>Total Customers</h3>
                    <?php echo $count ?>
                    <hr>
                </div>

                <?php

                $sql = "SELECT order_id from sales_order";
                $result = mysqli_query($conn, $sql);
                $orders = mysqli_num_rows($result);
                ?>
            </div>
            <div class="column">
                <div class="card">

                    <h3>Active Orders</h3>
                    <?php echo $orders ?>
                    <hr>
                </div>
            </div>
            <div class="column">
                <div class="card">
                    <?php 
                    $today = date("Y-m-d");
                    $sql = "SELECT sum(allTotal) as total_sum from account WHERE `date`>= DATE_SUB('$today',INTERVAL 30 DAY)";
                    $result = mysqli_query($conn, $sql);
                    while ($rows = mysqli_fetch_assoc($result)) {
                        $total = $rows['total_sum'];
                    }
                    ?>
                    <h3>Income This Month</h3>
                    Rs <?php echo $total ?>
                    <hr>
                </div>
            </div>
        </div>
        <div class="table-container">
            <h3>Cutomer's Records</h3>
            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
            <table id="myTable">
                <tr class="header">
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Zip code</th>
                    <th>Total Dues</th>

                    <th>Action</th>
                </tr>
                <?php
                $sql = " SELECT* FROM `customer`";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
                while ($rows = mysqli_fetch_assoc($result)) {
                   
                    $c_id = $rows['c_id'];
                    $name = $rows['c_name'];
                    $phone = $rows['c_phone'];
                    $address = $rows['c_address'];
                    $city = $rows['city'];
                    $zip = $rows['zip'];
                    $sql2 = "SELECT sum(due_amount) as total_dues from account where c_id = $c_id";
                    $result2 = mysqli_query($conn,$sql2);
                    while($rows = mysqli_fetch_assoc($result2))
                    {
                        $total_dues = $rows['total_dues'];
                    }

                    echo ' <tr>
                        <td>' . $name . '</td>
                        <td>' . $phone . '</td>
                        <td>' . $address . '</td>
                        <td>' . $city . '</td>
                        <td>' . $zip . '</td>
                        <td>' . $total_dues . '</td>
                        <td>                     
                        <a href="invoiceList.php?id=' . $c_id . '">View</a>
                        </td>
                    </tr>';
                }



                ?>
            </table>
        </div>
    </div>
    <?php include('footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="resources/jquery.js"></script>
    <script src="resources/jquery-ui.js"></script>
    <script src="resources/jQuery.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
    <script src="printThis.js"></script>
    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
            $(".sidebar").find("a").on('click', function(e) {
                e.preventDefault();
                $(this).addClass('active');
            })

        }
    </script>
</body>

</html>
