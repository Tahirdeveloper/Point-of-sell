<?php
include("connection.php");
if (isset($_GET['inv_id'])) {
    $inv_id = $_GET['inv_id'];
    $sql = "SELECT* FROM `account` where id = '$inv_id'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    $allTotal = $rows['allTotal'];
    $date = $rows['date'];
    $discount = $rows['discount'];
    $grant_amount = $rows['grant_amount'];
    $due_amount = $rows['due_amount'];
    $change_amount = $rows['change_amount'];
    $customer = $rows['c_name'];
    $c_id = $rows['c_id'];
    $order_id = $rows['order_id'];


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>invoice</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="resources/store.css">
        <style>
            .container {
                background: white;
                width: 984px;
               
            }

            .invoice-footer {
                border: 2px solid black;
                display: flex;
                margin-top: 25px;
                justify-content: space-around;
                background: rgb(62, 7, 94);
                color: rgb(0, 153, 255);
                width: 103%;
                margin-left: -13px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="inv_head">
                <?php
                $sql = "SELECT * FROM `company`";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $rows = mysqli_fetch_assoc($result);
                    $image = $rows['logo'];
                }
                ?>
                <div class='head'>
                    <img src="images/<?php echo $image ?>" />
                   
                </div>
                <?php
                ?>
                <div class='info'>
                    <div>
                        <h5>CPP#: <?php echo $order_id ?></h5>
                        <h5>Date:<span id="inv_date"><?php echo $date ?></span></h5>
                        <h5>Customer Name: <span id="inv_name"><?php echo $customer ?></span> </h5>
                    </div>
                    <?php
                        $sql = "SELECT c_address FROM `customer` where c_name = '$customer'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $rows = mysqli_fetch_assoc($result);
                            $address = $rows['c_address'];
                        }
                        ?>
                    <div style="width:200px; line-height:15px">
                        <h5><?php echo $address ?></h5>
                    </div>
                </div>
                <hr>
            </div>
            <table class="table table-bordered m-0" style="background-color: white;">

                <thead>
                    <tr>
                        <!-- Set columns width -->
                        <th class="text-right py-3 px-1" style="width: 100px;">S.No</th>
                        <th class="text-center py-3 px-1" style="min-width: 400px;">Product Name &amp; Details</th>
                        <th class="text-right py-3 px-1" style="width: 120px;">Price</th>
                        <th class="text-center py-3 px-1" style="width: 120px;">Quantity</th>
                        <th class="text-right py-3 px-1" style="width: 140px;">Total</th>
                    </tr>
                </thead>

                <tbody id="tbody">
                    <?php
                    $sql2 = "SELECT* FROM `sales_order` where  order_no = '$order_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $i=1;
                    while ($rows = mysqli_fetch_assoc($result2)) {
                        $product = $rows['product_name'];
                        $price = $rows['price'];
                        $qty = $rows['qty'];
                        $total = $rows['total'];

                        echo '<tr id="master">
                    <td class="text-right py-3 px-1 " style="width: 100px;">
                        <input type="text" style="border:0px background:white;" class=" form-control text-center serial bg-white" id="sNo" name="item#" value="' . $i . '" disabled>
                    </td>
                    <td class="p-4">
                        <input type="text" id="p_name" name="product_name[]" style="border:0px; background:white;" class="form-control text-center" value="' . $product . '" disabled>
                    </td>
                    <td class="text-right font-weight-semibold align-middle p-4">
                        <input type="text" id="price" name="price[]" style="border:0px; background:white;" class=" price form-control text-center" value="' . $price . '"disabled>
                    </td>
                    <td class="align-middle p-4">
                        <input type="text" name="qty[]" id="qty" style="border:0px; background:white;" class=" qty form-control text-center" value="' . $qty . '"disabled>
                    </td>
                    <td class="text-right font-weight-semibold align-middle p-4">
                        <input type="text" name="total[]" id="total" style="border:0px; background:white;" class=" total form-control text-center" value="' . $total . '"disabled>
                    </td>
                   
                </tr>';
                $i++;
                    }
                    ?>
                </tbody>
            </table>
            <div style="margin-left: 74%;margin-top: 4px; padding:10px; background:#e9ecef; margin-bottom:-21px;">
                <table id="calculation">
                    <tr>
                        <th> Sub Total :</th>
                        <th class="text-right" style="width: 105px;">
                            <input type="text" style="border:0px; background:white;" class="form-control text-center" id="allTotal" name="allTotal" value="<?php echo $allTotal ?>">
                        </th>
                    </tr>
                    <tr>
                        <th>Discount :</th>
                        <th class="text-right" style="width: 72px;">
                            <input type="text" style="border:0px; background:white;" class="form-control text-center" id="discount-col" name="discount" value="<?php echo $discount ?>">
                        </th>
                    </tr>
                    <tr>
                        <th>Grant Amount :</th>
                        <th class="text-right" style="width: 72px;">
                            <input type="text" style="border:0px; background:white;" class="form-control text-center" id="grant" name="grant" value="<?php echo $grant_amount ?>">
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <hr class="hr2">
                        </th>
                    </tr>
                    <tr>
                        <th>Due Amount :</th>
                        <th class="text-right" style="width: 72px;">
                            <input type="text" style="border:0px; background:white;" class="form-control text-center" id="dues" name="dues" value="<?php echo $due_amount ?>">
                        </th>
                    </tr>
                    <tr>
                        <th>Change Amount :</th>
                        <th class="text-right" style="width: 72px;">
                            <input type="text" style="border:0px; background:white;" class="form-control text-center" id="change" name="change" value="<?php echo $change_amount ?>">
                        </th>
                    </tr>
                </table>

            </div>
           <a href="invoiceList.php"><button  class="mx-5" id="print" style='background:rgb(62, 7, 94);color:white' name="payment">Back</button></a> 
           <button type="submit" class="mx-5" id="print" style='background:rgb(62, 7, 94);color:white' name="payment">Print</button>


        <?php
    }

        ?>
        

        <div class="inv_head">
            <div class="invoice-foot text-white">
                <p>Developed by <strong>Codes Solution</strong></p><a href="tel:+923349234375">+923349234375</a>
                <a style=" color:rgb(14, 122, 194);" href="https://codessol.com">https://codessol.com</a>
            </div>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
        <script src="resources/jquery.js"></script>
        <script src="resources/jquery-ui.js"></script>
        <script src="resources/jQuery.print.min.js"></script>
        <script>
            $("#print").on('click', function() {
                $('div .printable').print();
            })
        </script>
    </body>

    </html>