<?php

use Illuminate\Console\View\Components\Alert;

$message = "";
include('connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['inv_no'];
    $c_id = $_POST['c_id'];
    $name =  $_POST['product_name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];

    $customer_name = $_POST['customer_name'];
    foreach ($name as $index => $data) {
        $s_name = $data;
        $order_no = $order_id;
        $s_price = $price[$index];
        $s_qty = $qty[$index];
        $s_total = intval($s_price) * intval($s_qty);
        $sql = "INSERT INTO `sales_order`( `order_no`,`product_name`, `price`, `qty`,`total`,`c_name`,`c_id`)
         VALUES ('$order_no','$s_name','$s_price','$s_qty','$s_total','$customer_name','$c_id')";
        $result1 = mysqli_query($conn, $sql);
        $inv_id = mysqli_insert_id($conn);
        echo $inv_id;
        if ($result1) {
            // header("location:store1.php");
        }
    }
    $date = $_POST['date'];
    $subTotal = $_POST['allTotal'];
    $discount = $_POST['discount'];
    $grant = $_POST['grant'];
    $dues  = $_POST['dues'];
    $change  = $_POST['change'];

    $sql2 = "INSERT INTO `account`( `order_id`,`allTotal`,`date`, `discount`, `grant_amount`,`due_amount`,`change_amount`,`c_name`,`c_id`)
    VALUES ('$order_id','$subTotal','$date','$discount','$grant','$dues','$change','$customer_name','$c_id')";
    $result1 = mysqli_query($conn, $sql2);
    if ($result1) {

        header("location:store1.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>

    <link rel="stylesheet" href="resources/store.css">
    <script src="resources/jquery.js"></script>
    <script src="resources/jquery-ui.js"></script>
</head>
<style>
    .form-controle {
        border: 0px solid;
    }

    label,
    input {
        display: block;
    }

    input.text {
        margin-bottom: 12px;
        width: 95%;
        padding: .4em;
    }

    fieldset {
        padding: 0;
        border: 0;
        margin-top: 25px;
    }

    h1 {
        font-size: 1.2em;
        margin: .6em 0;
    }

    div#users-contain {
        width: 350px;
        margin: 20px 0;
    }

    div#users-contain table {
        margin: 1em 0;
        border-collapse: collapse;
        width: 100%;
    }

    div#users-contain table td,
    div#users-contain table th {
        border: 1px solid #eee;
        padding: .6em 10px;
        text-align: left;
    }

    .ui-dialog .ui-state-error {
        padding: .3em;
    }

    .validateTips {
        border: 1px solid transparent;
        padding: 0.3em;
    }
</style>

<body>
    <?php include('sidebar.php'); ?>
    <div class="container1">
        <div class="top-bar">
            <h3 class="title">Store</h3>
            <a href="home.php">
                <h6 class="py-2">Dasboard >
            </a> Store</h6>
        </div>
        <div id="msg" class="container px-3 my-5 clearfix">
            <!-- Shopping cart table -->
            <div class="card">
                <div class="card-header">
                    <h2>Point Of Sell</h2>
                </div>
                <div class="printable">
                    <div class="card-body">

                        <?php
                        $sql = "SELECT * FROM `company`";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $rows = mysqli_fetch_assoc($result);
                            $image = $rows['logo'];
                        }
                        ?>
                        <div class="inv_head top">
                            <div class='head'>
                                <img src="images/<?php echo $image ?>" />
                               
                            </div>

                            <div class='info'>
                                <div>
                                    <h5>CPP#:<span id="inv_label"></span> </h5>

                                    <h5>Date:<span id="inv_date"></span></h5>
                                    <h5>Customer Name: <span id="inv_name"></span> </h5>
                                </div>
                            </div>
                            <hr>

                        </div>

                        <!-- customer modal -->
                        <?php include('customer_modal.php') ?>
                        <!-- ===================== -->
                        <div class="d-flex justify-content-between plus">
                            <Button id="create-user" class="mx-5" style='background:rgb(62, 7, 94);color:white' name="add_customer"><span class=" rounded-circle">+Add Customer</Button>
                            <Button id="row" class="mx-5" style='background:rgb(62, 7, 94);color:white' name="add"><span class=" rounded-circle">+ Add Row</span></Button>
                        </div>
                        <form method="post" action="store1.php" id="myform">
                            <!-- this is a hidden field which pass invoice id to the database as well as to the invoice -->
                            <input type="hidden" name="inv_no" id="inv_id" value="<?php echo substr(strval(mt_rand()), 0, 4) ?>">
                            <div class="d-flex justify-content-between mx-5">
                                <?php
                                include("connection.php");
                                $query = "SELECT c_name  FROM customer ";
                                $result = mysqli_query($conn, $query);
                                echo "<select class=' mx-auto mb-3  text-center serial' name='customer_name' id='c_name'  style ='width: 120px;'>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $customer_name = $row['c_name'];
                                    echo "<option value='$customer_name'>$customer_name </option>";
                                }
                                echo "</select>";
                                ?>
                                <input type="hidden" id="c_id" name="c_id">
                                <input type="date" class=" mx-auto mb-3  text-center serial" id="date" name="date" placeholder="enter date" required>
                            </div>
                            <table class="table table-bordered m-0">

                                <thead>
                                    <tr>
                                        <!-- Set columns width -->
                                        <th class="text-right py-3 px-1" style="width: 100px;">S.No</th>
                                        <th class="text-center py-3 px-1" style="min-width: 400px;">Product Name &amp; Details</th>
                                        <th class="text-right py-3 px-1" style="width: 120px;">Price</th>
                                        <th class="text-center py-3 px-1" style="width: 120px;">Quantity</th>
                                        <th class="text-right py-3 px-1" style="width: 140px;">Total</th>
                                        <th class="text-center align-middle py-3 px-0" style="width: 40px;">Action<i class="ino ion-md-trash"></i></th>
                                    </tr>
                                </thead>

                                <tbody id="tbody">
                                    <tr id="master">
                                        <td class="text-right py-3 px-1 " style="width: 100px;">
                                            <input type="text" style="border:0px" class=" form-control text-center serial bg-white" id="sNo" value="1" disabled>
                                        </td>
                                        <td class="p-4">
                                            <input type="text" id="p_name" name="product_name[]" style="border:0px" class="form-control text-center" required placeholder="Title here...">
                                        </td>
                                        <td class="text-right font-weight-semibold align-middle p-4">
                                            <input type="text" id="price" name="price[]" style="border:0px" class=" price form-control text-center" required placeholder="click">
                                        </td>
                                        <td class="align-middle p-4">
                                            <input type="text" name="qty[]" id="qty" style="border:0px" class=" qty form-control text-center" required placeholder="click">
                                        </td>
                                        <td class="text-right font-weight-semibold align-middle p-4">
                                            <input type="text" name="total[]" id="total" style="border:0px" class=" total form-control text-center" value="00">
                                        </td>
                                        <td class="text-center align-middle px-0">
                                            <a href="#" class="shop-tooltip close float-none text-danger del" data-original-title="Remove"></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="non-print" style="margin-top: 116px; position: absolute;">
                                <tr>
                                    <td>
                                        <div style="height: 58px">
                                            <div class="  disc-area hidden mx-4">
                                                <input style="width: 100px; float:left;margin-top: 15px;" id="disc-amount" type="text" name="discount" placeholder="Amount">
                                                <button type="submit" id="ok" class="my-3">OK</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="height: 58px;">
                                            <div class=" multiPay-area hidden mx-4">
                                                <input style="width: 100px;float:left;margin-top: 15px;" id="multi_amount" type="text" name="multi_pay" placeholder="Pay amount">
                                                <button type="submit" id="yes" class="my-3">OK</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <div class="action-buttons  my-5">
                                        <td>
                                            <Button class="mx-5 discount-btn" style='background:rgb(62, 7, 94);color:white' id="discountClick">Discount</Button>
                                        </td>
                                        <td>
                                            <Button class="mx-5" style='background:rgb(62, 7, 94);color:white' id="multipay-button" name="multi-pay">Multiple Pay</Button>
                                        </td>
                                        <td>
                                            <button type="submit" class="mx-5" id="payment" style='background:rgb(62, 7, 94);color:white' name="payment">PayNow</button>
                                        </td>
                                    </div>
                                </tr>
                            </table>

                            <!-- / Shopping cart table -->
                            <div style="margin-left: 74%;margin-top: 20px; position:static">
                                <table id="calculation">
                                    <tr>
                                        <th> Sub Total :</th>
                                        <th class="text-right" style="width: 105px;">
                                            <input type="text" style="border:0px" class="form-control text-center" id="allTotal" name="allTotal" value="00">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Discount :</th>
                                        <th class="text-right" style="width: 72px;">
                                            <input type="text" style="border:0px" class="form-control text-center" id="discount-col" name="discount" value="00">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Grant Amount :</th>
                                        <th class="text-right" style="width: 72px;">
                                            <input type="text" style="border:0px" class="form-control text-center" id="grant" name="grant" value="00">
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
                                            <input type="text" style="border:0px" class="form-control text-center" id="dues" name="dues" value="00">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Change Amount :</th>
                                        <th class="text-right" style="width: 72px;">
                                            <input type="text" style="border:0px" class="form-control text-center" id="change" name="change" value="00">
                                        </th>
                                    </tr>
                            </div>
                            </table>
                        </form>
                    </div>
                    <div class="inv_head top">
                        <div class="invoice-foot">
                            <p>Developed by <strong>Codes Solution</strong></p><span href="tel:+923349234375">+923349234375</span>
                            <a style=" color:rgb(14, 122, 194);" href="https://codessol.com">https://codessol.com</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
   
    <script src="resources/jQuery.print.min.js"></script>
    <script>
        $(function() {
            // Execute when the #add button is clicked.
            let count = 2;
            $("#row").on('click', function(e) {
                e.preventDefault();
                var numrows = $("#tbody tr").length;
                $("#tbody").append(` <tr id="master">\
                                        <td class="text-right py-3 px-1 " style="width: 100px;">\
                                            <input type="text" style="border:0px" class=" form-control text-center serial" id="sNo"  value="${count}">\
                                        </td>\
                                        <td class="p-4">\
                                            <input type="text" id="p_name" name="product_name[]"style="border:0px"  class="form-control text-center" placeholder="Title here...">\
                                        </td>\
                                        <td class="text-right font-weight-semibold align-middle p-4">\
                                            <input type="text" id="price" name="price[]" style="border:0px"  class=" price form-control text-center" placeholder="click">\
                                        </td>\
                                        <td class="align-middle p-4">\
                                            <input type="text" id="qty" name="qty[]" style="border:0px"  class=" qty form-control text-center" placeholder="click">\
                                        </td>\
                                        <td class="text-right font-weight-semibold align-middle p-4">\
                                            <input type="text" id="total" name="total[]" style="border:0px" class=" total form-control text-center" value="00" disabled>\
                                        </td>\
                                        <td class="text-center align-middle px-0">\
                                            <a href="#" class="shop-tooltip close float-none text-danger del" data-original-title="Remove">×</a>\
                                        </td>\
                                    </tr>`);
                count++;
            });

            $("table").on("click", ".del", function() {
                // Remove the parent TR tag completely from DOM.
                $(this).closest("tr").remove();
            });
            $("table").on("input", "input", function() {

                $("tbody tr").each(function() {

                    $this = $(this);
                    if (this.id != "#master") {

                        $this.find(".total").val(+$this.find(".qty").val() * +$(this).find(".price").val());
                        var allTotal = parseInt($("#allTotal").val());
                        var grantAmount = $("#multi_amount").val();
                        if (grantAmount == '' || grantAmount == '0') {
                            $("#grant").val($("#allTotal").val());
                        }

                        var discount = $("#discount-col").val();
                        if ((parseInt(grantAmount) + parseInt(discount)) <= allTotal) {
                            $('#dues').val(parseInt(allTotal) - (parseInt(grantAmount) + parseInt(discount)));
                        }

                        if ((parseInt(grantAmount) + parseInt(discount)) > allTotal) {
                            $('#change').val((parseInt(grantAmount) + parseInt(discount)) - parseInt(allTotal));
                        }
                    }
                    $("#allTotal").val(0);

                    $(".total").each(function() {
                        if (this.value != "")
                            $("#allTotal").val(parseInt($("#allTotal").val()) + parseInt($(this).val()));



                    });

                });

            });
            // discount button function

            $('#discountClick').on('click', function(e) {
                e.preventDefault();
                $('div').find('.disc-area').removeClass('hidden');
                $('#ok').on('click', function(e) {
                    e.preventDefault();
                    if ($("#disc-amount").val() != "" && $("#disc-amount").val() !== "NaN") {
                        $("#discount-col").val($("#disc-amount").val());
                        var grantAmount = $("#multi_amount").val();
                        var allTotal = parseInt($("#allTotal").val());
                        var discount = $("#discount-col").val();
                        if ((parseInt(grantAmount) + parseInt(discount)) <= allTotal) {
                            $('#dues').val(parseInt(allTotal) - (parseInt(grantAmount) + parseInt(discount)));
                        }
                        if ((parseInt(grantAmount) + parseInt(discount)) >= allTotal) {
                            console.log(grantAmount + discount);
                            $('#change').val((parseInt(grantAmount) + parseInt(discount)) - parseInt(allTotal));
                        }
                        $('div').find('.disc-area').addClass('hidden');

                    }

                });

            });

            //   multiple pay button function

            $('#multipay-button').on('click', function(e) {
                e.preventDefault();
                $('div').find('.multiPay-area').removeClass('hidden');
                $('#yes').on('click', function(e) {
                    e.preventDefault();
                    if ($("#multi_pay").val != "" || $("#multipay").val !== "0") {
                        // calculate amount
                        var grantAmount = $("#multi_amount").val();
                        $("#grant").val(grantAmount);
                        var allTotal = parseInt($("#allTotal").val());
                        var discount = $("#discount-col").val();
                        if ((parseInt(grantAmount) + parseInt(discount)) <= allTotal) {
                            $('#dues').val(parseInt(allTotal) - (parseInt(grantAmount) + parseInt(discount)));
                        }

                        if ((parseInt(grantAmount) + parseInt(discount)) >= allTotal) {
                            console.log(grantAmount + discount);
                            $('#change').val((parseInt(grantAmount) + parseInt(discount)) - parseInt(allTotal));
                        }
                        $('div').find('.multiPay-area').addClass('hidden');

                    }
                });
            });
// when click paynow button this code will be execute!
            $("#myform").submit(function(e) {
                e.preventDefault();
                var price = $("#price").val();
                var qty = $("#qty").val();
                var p_name = $("#p_name").val();
                var c_name = $("#c_name").val();
                var c_id = $("#c_id").val();
                var date = $("#date").val();
                var inv_id = $("#inv_id").val();
                var grant = $("#grant").val();

                if (grant != "" && c_name != "" && price != "" && qty != "" && p_name != "") {
                    $.ajax({
                        url: 'store1.php',
                        type: 'POST',
                        data: $(this).serialize(),

                        success: function(response) {
                            $("#inv_name").text(c_name);
                            $("#inv_date").text(date);
                            $("#inv_label").text(inv_id);
                            $('.inv_head').removeClass('top');
                            $('div .printable').print({
                                noPrintSelector: ".non-print , .plus , #c_id , #date",
                            });
                            $("#date").val("")
                            $("#price").val("");
                            $("#qty").val("");
                            $("#p_name").val("");
                            $("#c_name").val("");
                            $("#grant").val("00");
                            $("#multi_amount").val("0");
                            $("#discount-col").val("00");
                            $('#dues').val("00");
                            $('#change').val("00");
                            $("#allTotal").val("00")
                            $(".total").val("00")
                            $('.inv_head').addClass('top');

                        }
                    });

                } else {

                    alert("Plese fill all fields");
                    $('.inv_head').addClass('top');

                }
                $('.inv_head').addClass('top');

            });
            // select tag code
            $('#c_name').on('change', function() {
                var customer_name = $(this).val();
                $.ajax({
                    url: 'storefunction.php',
                    type: 'post',
                    data: {
                        customer_name: customer_name,
                    },
                    success: function(data) {
                        $('#c_id').val(data);
                        $("#c_id").prop("disabled", false);
                    }
                });
            });
        })
    </script>
</body>

</html>