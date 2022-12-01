<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>doctor Dr Registration</title>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Dr. Register</title>
</head>
<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
<style>
	<style>.jumbotron {
		background-color: #f4511e;
		color: #666666;
		padding: 100px 25px;
	}

	.container-fluid {
		padding: 60px 50px;
	}

	.bg-success {
		background-color: #ccccc;
		color: black;
		padding: 100px 25px;

	}

	.col-50 {
		-ms-flex: 50%;
		/* IE10 */
		flex: 50%;
		padding: 0 16px;
	}

	.bg-grey {
		background-color: #EEEEEE;

	}

	.icon-container {
		margin-bottom: 20px;
		padding: 7px 0;
		font-size: 24px;
	}
</style>

<?php
include("connection.php");


if (isset($_POST["submit"])) {
	$d_id = $_POST['id'];
	$d_f_name = $_POST['f_name'];
	$d_l_name = $_POST['l_name'];
	$d_email = $_POST['email'];
	$d_contact = ($_POST['contact']);
	$d_specialist = ($_POST['specialist']);
	if ($_POST['spac'] != NULL) {

		$d_specialist = $_POST['spac'];
	}


	$d_qualification = ($_POST['qualification']);
	$d_gender = $_POST['gender'];
	$d_pswd = $_POST['pswd'];
$d_pswd = md5($d_pswd);
	$d_date = date("y/m/d");

	//$_POST[".$d_date."];
	$d_query = "INSERT INTO doctor(f_name,l_name,email,contact,specialist,qualification,gender,pswd,permission)     
	                            VALUES('$d_f_name','$d_l_name','$d_email','$d_contact','$d_specialist','$d_qualification','$d_gender','$d_pswd','Pending')";
	if (mysqli_query($db, $d_query)) {
		echo "<h1 style='color:green'>Added successfully : Wait For Admin's Approval</h1>";

		
		$arr =array("1.Sunday", "2.Monday", "3.Tuesday", "4.Wednesday", "5.Thrusday","6.friday","7.saturday");
		foreach ($arr as $value) {
		
			$qq = "INSERT INTO drtime(did,dday,tfrom,tto) 
		values
		('$d_email','$value','12:00','12:00')";
		mysqli_query($db, $qq);
		  }
		
	} else {
		echo "<h1 style='color:red'>Error Inserting Record : Try Again : " . mysqli_error($conn) . "</h1>";
	}
}

?>
<a href="../">
	<img alt="Qries" src="../home.png" width="50"" height=" 50">
</a>
<div class="text-center panel-body bg-success">
	<h1>
		<stron>Registration As A Doctor</strong>
	</h1>
	<p><strong>Fill and Submit</strong></p>
	<form action="doctor_registration.php" method="POST" class="form-inline">

		<div class="container-fluid text-center bg-grey col-50">
			<?php

			?>
			<script type="text/javascript">
				function CheckColors(val) {
					var element = document.getElementById('color');
					if (val == 'pick a color' || val == 'others')
						element.style.display = 'block';
					else
						element.style.display = 'none';
				}
			</script>



			<input type="text" class="form-control" size="50" placeholder="Enter First Name" name="f_name" required> <br>
			<input type="text" class="form-control" size="50" placeholder="Enter Last Name" name="l_name" required> <br>
			<input type="email" placeholder="Enter Email Address" class="form-control" size="50" name="email" required> <br>

			<input type="number" class="form-control" size="10" placeholder="Enter Contact Number" name="contact" required> <br>
			<label for="specialist"><b>Specialist:</b></label><select name="specialist" onchange='CheckColors(this.value);' required>

				<?php

				$query = "SELECT DISTINCT specialist FROM doctor;";


				$run = mysqli_query($db, $query);
				while ($row = mysqli_fetch_array($run)) {

					echo  "<option value='" . $row['specialist'] . "' required>" . $row['specialist'] . "</option>";
				}

				?>
				<option value="others" required>Other</option>

			</select>
			<br><input type="text" name="spac" id="spac" placeholder="Enter Spacification Feild" style='display:none;' />

			<script type="text/javascript">
				function CheckColors(val) {
					var element = document.getElementById('spac');
					if (val == 'others')
						element.style.display = 'block';
					else
						element.style.display = 'none';
				}
			</script>

			<br>


			<label for="qualification"></label><input type="text" placeholder="Enter Your Qualification" class="form-control" size="50" name="qualification" required> <br>
			
             <br>
			<label for="gender"><b>Gender:</b></label>
			<input type="radio" name="gender" value="male" required>Male
			<input type="radio" name="gender" value="female" required>Female 
			<br>
			
			<label for="pswd"></i> </label> <br><input type="password" class="form-control" size="50" placeholder="Create Password" name="pswd" required>
			<br> <input type="submit" class="btn btn-danger text-uppercase focus" name="submit" value="register">
		</div>
		<p> <strong> Already A Member? <a href="login.php">Login</a></strong></p>
		<h2><a href="../index.php">Back</a></h2>
		</p>
</div>

<?php
if (isset($error_msg)) {
	echo $error_msg;
}
if (isset($success_msg)) {
	echo $success_msg;
}

?>

</form>
</div>


</body>

</html>