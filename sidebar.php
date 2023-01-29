<?php
session_start();
if (isset($_SESSION['user_email'])) {
    $usernam = $_SESSION['user_name'];
    $sql ="SELECT id, `image` FROM signup where `Name` = '$usernam'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $u_id = $row['id'];
    $image = $row['image'];
} else {
    header("location: login.php?Please enter email and password");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: "Lato", sans-serif;
        }

        .sidebar {

            padding: 0;
            width: 200px;
            background-color: rgb(62, 7, 94);
            color: white;

            position: fixed;
            height: 100%;
            overflow: auto;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 28px;
            margin-top: -20px;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color: #07b6f3;
            color: white;
        }

        div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px;
        }

        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar a {
                float: left;
                padding-left: 44px;
            }

            div.content {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 400px) {
            .sidebar a {
                text-align: center;
                float: none;
            }
        }

        /* Drop down button setting */
        .dropbtn {
            background: #3e075e;
            font-size: 16px;
            color: white;
            margin-bottom: 40px;
            font-weight: 400;
            border: none;
            cursor: pointer;
        }

        .dropbtn:after {
            content: "v";
            padding-left: 10px;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: sticky;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: relative;
            width: 115px;
            color: white;
            margin-left: 40px;
            box-shadow: 0px 6px 7px 3px rgb(251 251 251 / 20%);
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            color: gray;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;

        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
            cursor: pointer;
        }

        hr {

            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 1;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        i {
            padding-left: 10px;
            position: relative;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div>
            <a href="profile.php?u_id=<?php echo $u_id ?>"> <img src="images/<?php echo $image ?>" 
            width="90px" class="mx-4 mb-3 rounded-circle zoom transform-scale-5" alt="profile image">
                <h3 class=""><?php echo $_SESSION['user_name'] ?></h3>
            </a>
            <hr>
        </div>
        
            <i class='fas fa-house-user' style='font-size:20px; padding-right:10px; float:left'></i> <a href="home.php">Dashboard</a>
            <i class='fas fa-weight-hanging' style='font-size:20px; padding-right:10px; float:left'></i><a class="px-3" href="store1.php">Store</a>

            <i class='fas fa-restroom' style='font-size:20px; padding-right:10px; float:left'></i><a href="customers.php">Add Customer</a>
            <i class='fas fa-money-check' style='font-size:15px; padding-right:2px; float:left'></i>
            <div class="dropdown">
                <button class="dropbtn">Invoices</button>
                <div class="dropdown-content">
                    <a href="invoiceList.php">Invoice List</a>
                    <a href="invoiceDetails.php">Add Details</a>
                </div>
            </div><br>
            <i style='font-size:20px; float:left' class="fas fa-file-alt"></i>
            <div class="dropdown">
                <button class="dropbtn">Reports</button>
                <div class="dropdown-content">
                    <a href="report.php?report=Daily">Daily</a>
                    <a href="report.php?report=Weekly">Weekly</a>
                    <a href="report.php?report=Monthly">Monthly</a>

                </div>
            </div><br>
            <i class='far fa-sun' style='font-size:20px; float:left'></i>
            <div class="dropdown">
                <button class="dropbtn">Settings</button>
                <div class="dropdown-content">
                    <a href="invoice_header/edit_header.php">Edit Invoice</a>
                </div>
            </div>
        </div>
 
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="resources/jquery.js"></script>
    <script src="resources/jquery-ui.js"></script>
    <script>
        $(".sidebar").find("a").on('click', function(e) {

            $(this).addClass('active');
        })
    </script>