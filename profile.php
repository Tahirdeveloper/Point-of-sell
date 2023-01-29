<?php
include("connection.php");
if (isset($_GET['u_id'])) {
    $u_id = $_GET['u_id'];
    $sql = "SELECT * FROM `signup` where id = '$u_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['Name'];
    $store = $row['Store'];
    $email = $row['Email'];
    $image = $row['image'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .gradient-custom {
            background: #f6d365;
            background: linear-gradient(to right bottom, rgb(87 87 87), rgb(25 18 88));
        }
    </style>
</head>

<body>

    <section class="vh-100" style="background-color: #dcdbdc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="images/<?php echo $image ?>" alt="Avatar" class="img-fluid my-5 rounded-circle zoom transform-scale-5" style="width: 80px;" />
                                <h5><?php echo $name ?></h5>
                                <p>Admin</p>
                                <i class="far fa-edit mb-5"></i>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Personal Info</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Name:</h6>
                                            <p class="text-muted"><?php echo $name ?></p>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <h6>Store Name:</h6>
                                            <p class="text-muted"><?php echo $store ?></p>
                                        </div>
                                    </div>
                                    <h6>Account Info</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email:</h6>
                                            <p class="text-muted"><?php echo $email ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Password:</h6>
                                            <p class="text-muted">*****</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="resources/jquery.js"></script>
    <script src="resources/jquery-ui.js"></script>
    <script src="resources/jQuery.print.min.js"></script>
</body>

</html>