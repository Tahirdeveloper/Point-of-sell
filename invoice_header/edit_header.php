<?php
include('../connection.php');
$message = "";
if (isset($_POST['upload'])) {
    $filename = $_FILES["logo"]["name"];
    $tempname = $_FILES["logo"]["tmp_name"];
    $folder = "../images/" . $filename;
    // image size
    $image = getimagesize($_FILES['logo']['tmp_name']);
    $width = $image[0];
    $height = $image[1];
    if ($width > 999 || $height > 150) {
        
        $message = "<div class='alert alert-danger'>
        Error: Image dimensions must be 980 x 100 or less.
     </div>";
    } else {
        $sql = "UPDATE `company` SET `logo`='$filename' WHERE id=11";
        $resul = mysqli_query($conn, $sql);
        if (move_uploaded_file($tempname, $folder)) {
            $message = "<div class='alert alert-success'>
                        image successfully uploaded!
                        </div>";
                        header("location:../home.php");
        } else {
            $message = "<div class='alert alert-danger'>
                            image not uploaded successfully!
                         </div>";;
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title></title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 font-poppins" style="padding-top:60px;">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <?php echo $message ?>
                    <h2 class="title">Customize Invoice Header</h2>
                    <form method="post" action="edit_header.php" enctype="multipart/form-data">
                        <div class="row row-space">
                           
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Company Logo</label>
                                    <input class="input--style-4" type="file" name="logo">
                                </div>
                            </div>

                        </div>
                        <div class="p-t-15">                            
                        <button class="btn btn--radius-2" style="background:#6c4079;" name="upload" type="submit">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>


</html>
<!-- end document-->