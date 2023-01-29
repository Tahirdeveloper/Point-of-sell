<?php
include('connection.php');
if (isset($_GET['report'])) {
    $report = $_GET['report'];
    $report_type = $report;
    $today = date('Y-m-d');
    if ($report === 'Daily') {
        $query = "SELECT  `date`, allTotal, due_amount,grant_amount,discount,change_amount, SUM(allTotal) AS total_sales, SUM(due_amount) AS allDues,
    SUM(grant_amount) AS paid_amount, SUM(discount) AS allDiscount, SUM(change_amount) AS totalChange 
    FROM account
    WHERE `date` = '$today'";
    $sql2 = "SELECT * FROM `account` WHERE `date` = '$today' ORDER BY `date` ASC";
    
    } elseif ($report === 'Weekly') {
        $query = "SELECT `date`, allTotal, due_amount,grant_amount,discount,change_amount, SUM(allTotal) AS total_sales, SUM(due_amount) AS allDues,
        SUM(grant_amount) AS paid_amount, SUM(discount) AS allDiscount, SUM(change_amount) AS totalChange 
        FROM account
        WHERE `date` >= DATE_SUB('$today', INTERVAL 7 DAY )";
    $sql2 = "SELECT * FROM `account` WHERE `date` >= DATE_SUB('$today', INTERVAL 7 DAY ) ORDER BY `date` ASC";

    }
     elseif ($report === 'Monthly') {
        $query = "SELECT 'date', allTotal, due_amount,grant_amount,discount,change_amount, SUM(allTotal) AS total_sales, SUM(due_amount) AS allDues,
        SUM(grant_amount) AS paid_amount, SUM(discount) AS allDiscount, SUM(change_amount) AS totalChange 
        FROM account
        WHERE `date`>= DATE_SUB('$today', INTERVAL 30 DAY )";
    $sql2 = "SELECT * FROM `account` WHERE `date` >= DATE_SUB('$today', INTERVAL 30 DAY ) ORDER BY `date` ASC";       
    }
    $result2 = mysqli_query($conn, $sql2);
    

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reports</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .top-bar {
                background: rgb(62, 7, 94);
                display: inline-block;
                display: flex;
                color: white;
                padding-left: 10px;
                padding-top: 5px;
            }

            .title {
                margin-right: 721px;
                padding-left: 10px;
            }

            .bed-crumb {
                color: white;
            }

            .container1 {
                width: 1063px;
                margin: 0 200px auto;
                background-color: #eceeef;
            }
        </style>
    </head>

    <body>
        <?php include('sidebar.php'); ?>
        <div class="container1">
            <div class="top-bar">
                <h3 class="title">Sale Report</h3>
                <a href="home.php">
                    <h6 class="py-2">Dasboard >
                </a> <?php echo $report_type ?></h6>
            </div>
            <div class="container">
                <h3 class="text-center my-3 bg-white"><?php echo $report_type ?> Report</h3>
                <table class="table bg-white text-center">
                    <thead>
                        <tr style='background: #3e075e;color: white;'>
                            <th scope="col">Date</th>
                            <th scope="col">Total sales</th>
                            <th scope="col">Paid Amount</th>
                            <th scope="col">Total Discount</th>
                            <th scope="col">Total Dues</th>
                            <th scope="col">Change Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $total = $row['allTotal'];
                        $due_amount = $row['due_amount'];
                        $grant_amount = $row['grant_amount'];
                        $discount = $row['discount'];
                        $change_amount = $row['change_amount'];
                        $date = $row['date'];

                        echo '
                        <tr>
                        <th scope="row">' . $date . '</th>
                        <td>' . $total . '</td>
                        <td>' . $grant_amount . '</td>
                        <td>' . $discount . '</td>
                        <td>' . $due_amount . '</td>
                        <td>' . $change_amount . '</td>
                    </tr>';
                }
                    // while loop ended!
                    $result = mysqli_query($conn, $query);
                    if($result)
                    {
                        $rows = mysqli_fetch_assoc($result);
                        $total_sales = $rows['total_sales'];
                        $allDues = $rows['allDues'];
                        $paid_amount = $rows['paid_amount'];
                        $allDiscount = $rows['allDiscount'];
                        $totalChange = $rows['totalChange'];
                        echo '<tr style="background: #20841e;color: white;">
                       <th scope="row">Total:</th>
                       <th>' . $total_sales . '</td>
                       <th>' . $paid_amount . '</td>
                       <th>' . $allDiscount . '</td>
                       <th>' . $allDues . '</td>
                       <th>' . $totalChange . '</td>
                        </tr>';
                    }
                   
                   
                } 
                else {
                    echo 'no data';
                }
                    ?>
                    </tbody>
                </table>
                <button type="submit" id="print" class="btn" style="background-color: #3e075e; color:white;">Print</button>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="resources/jquery.js"></script>
        <script src="resources/jquery-ui.js"></script>
        <script src="resources/jQuery.print.min.js"></script>
        <script>
            $(function() {
                $("#print").on('click', function() {
                    $(".container").print({
                        noPrintSelector: '#print'
                    });
                })
            })
        </script>
    </body>

    </html>