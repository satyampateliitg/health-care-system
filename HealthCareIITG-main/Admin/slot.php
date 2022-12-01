<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Slot</title>
</head>

<style>
    h1 {
        font-size: 50px;
        text-align: center;
        padding-top: 30px;
        color: #000066;
    }

    img {
        float: left;
        width: 77px;
    }

    li {
        font-size: 24px;
    }

    h3 {
        font-size: 24px;
    }

    p {
        text-align: center;
        font-size: 26px;
    }

    body {
        margin: 0;
        padding: 0;
        font: 400 15px/1.8 Lato, sans-serif;
        color: #777;
        width: 100%;
        height: 100vh;
        background-image: url(../pic/1.jpg);
        background-attachment: fixed;
        background-size: cover;
    }
</style>

<body class="container display-4">
    <h1 class=" text-center font-weight-bold text-white ">Doctor's Information</h1><br />


    <?php
    if (isset($_GET['uid'])) {
        session_start();

        include("connection.php");
        $d_email = $_GET['did'];
        $d_id = mysqli_query($db, $_GET['id']);
        $show_doctor_profile_query = "select * from doctor WHERE email='$d_email'";
        $show_run_doctor_profile_query = mysqli_query($db, $show_doctor_profile_query);
        $row = mysqli_fetch_array($show_run_doctor_profile_query);

    ?>
        <!-- Grid -->
        <div class="w3-row">
            <a href="../Users">
                <img alt="Qries" src="../home.png" width="50"" height=" 50">
            </a>
            <!-- Blog entries -->
            <div class="w3-col 18 s12">
                <!-- Blog entry -->
                <div class="w3-card-4 w3-margin w3-black">
                    <div class="w3-container">
                        <h1 class=" text-center font-weight-bold text-warning">Personal Information</h1>
                        <hr color="#333333" />
                        <h3 class="text-white ">ID : <?php echo  $row['id'] . "<br />"; ?></br></h3>
                        <h3 class="text-white"> Name : <?php echo   $row['f_name'] . " ";
                                                        echo  $row['l_name'] . "<br />"; ?></br></h3>
                        <h3 class="text-white">Email Address : <?php echo $row['email'] . "<br />"; ?></br></h3>
                        <h3 class="text-white"> Contact Number : <?php echo   $row['contact'] . "<br />"; ?></br></h3>
                        <h3 class="text-white"> Qualification : <?php echo  $row['qualification'] . "<br />"; ?></br></h3>
                        <h3 class="text-white"> Specialism : <?php echo  $row['specialist'] . "<br />" . "<br />" . "<br />"; ?></h3>

                    <?php



                }

                $uemail = $_GET['uid'];
                $d_email = $_GET['did'];
                $day = $_GET['day'];

                $query = "SELECT * FROM slot where did='$d_email' and day= '$day';";
                $run = mysqli_query($db, $query);
                echo "<table border='1'><tr><td>From</td><td>Till</td><td>Status</td></tr>";
                while ($row = mysqli_fetch_array($run)) {

                    $day = $row['day'];
                    $from = $row['tfrom'];
                    $to = $row['tto'];
                    $status = $row['status'];

                    $hrf = $from / 100;
                    $hrf = (int)$hrf;
                    $hrt = $to / 100;
                    $hrt = (int)$hrt;

                    $mnf = $from % 100;
                    $mnf = (int)$mnf;

                    $mnt = $to % 100;
                    $mnt = (int)$mnt;


                    echo "<tr><td>";
                    echo $hrf;

                    echo ":" . $mnf;
                    echo "</td><td>" . $hrt;
                    echo ":" . $mnt;


                    echo
                    "</td><td>";

                    if ($row['status'] != 'Booked') {
                        echo "<a href='";
                        $uemail = $_SESSION['uid'];
                        echo "slotbook.php?uid=";
                        echo $uemail;
                        echo "&did=";
                        echo $d_email;
                        echo "&day=";
                        echo $day;
                        echo "&tfrom=";
                        echo $from;
                        echo "'>Book Now</a>";
                    } else {
                        echo $status;
                    }

                    echo "</td></tr>";
                }

                    ?>

                    </div>
                </div>
            </div>
        </div>

</body>

</html>