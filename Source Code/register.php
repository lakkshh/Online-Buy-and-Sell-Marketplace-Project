<!DOCTYPE html>
<html lang="en">
<head>
	<title>Buy and Sell</title>
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta html-equiv = "X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/index.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
	<link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&family=Karla&family=Oswald:wght@400;500&display=swap">
	<!-- favicon -->
	<link rel="icon" href="https://img.icons8.com/cute-clipart/64/000000/shop.png">

	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Philosopher&display=swap');
		header{
      z-index: 2;
      transition: background-color 0.2s;
      min-height: 15vh;
      text-align: center;
      font-family: 'Philosopher';
      font-size: 4rem;
      position: fixed;
      width: 100%;
    }
    @media (max-width: 664px) {
      header{
        font-size: 3rem;
      }
    }
    @media (max-width: 310px) {
      header{
        font-size: 2rem;
      }
    }
    .img-fluid {
      margin: 10%;
        max-width: 70%;
        height: auto;
    }
		.title{
			font-family: "Karla", "Oswald", Sans-serif;
			font-size: 2rem;
		}
		.col-md-6:hover{
			background-color: white;
		}
		.lable{
			font-family: arial;
			font-size: 1rem;
			text-align: left;
		}
		.form-control{
			display: inline-block;
			margin-top: 3px;
			margin-bottom: 4px;
		  background: transparent!important;
		  font-size: 18px!important;
		  border-radius: 10px;
		}
	</style>
</head>
<body>
	<!-- HEADER -->
  <header>
  <div class="text-center" style="font-family: 'Sacramento', 'Anton', 'Oswald', Sans-serif; background-color: white;"> <span style="font-family: 'Karla', Sans-serif;">TIET</span> Marketplace </div>
  </header>
<!-- MAIN CONTAINT -->
  </br></br></br></br>
  <div class="container">
  	<div class=row> 
  		<div class="col-md-6" style="margin: 125px 0 0 0">
        <img src="img/shopping.svg" class="img-fluid">
      </div>
  		<div class="col-md-6 text-center"> <!-- seller -->
  			<br><div class="title"> REGISTER </div><br>
  			<form method="POST" action="#">
          <center>

		<div class="form-group row">
        	<label class="col-sm-2 col-form-label">Name</label>
        	<div class="col-sm-10">
            	<input type="text" id="name" class="form-control" name="name" placeholder="Full Name" required>
        	</div>
    	</div>

		<div class="form-group row">
        	<label class="col-sm-2 col-form-label">Year</label>
        	<div class="col-sm-10">
            	<input type="number" id="year" class="form-control" name="year" placeholder="Year of Study" min="1" max="4" required>
        	</div>
    	</div>

		<div class="form-group row">
        	<label class="col-sm-2 col-form-label">Roll Number</label>
        	<div class="col-sm-10">
            	<input type="number" id="roll" class="form-control" name="roll" placeholder="Roll Number" min="100000000" max="999999999" required>
        	</div>
    	</div>

		<div class="form-group row">
        	<label class="col-sm-2 col-form-label">Email</label>
        	<div class="col-sm-10">
            	<input type="email" id="mail" class="form-control" name="email" placeholder="Email ID" required>
        	</div>
    	</div>

		<div class="form-group row">
        	<label class="col-sm-2 col-form-label">Contact Number</label>
        	<div class="col-sm-10">
            	<input type="NUMBER" id="mob-num" class="form-control" name="mob" placeholder="Mobile Number" min="5000000000" max="9999999999" required>
        	</div>
    	</div>

		<div class="form-group row">
        	<label class="col-sm-2 col-form-label">Password</label>
        	<div class="col-sm-10">
            	<input type="password" id="pass" class="form-control" name="pass" placeholder="Password" required>
        	</div>
    	</div>

            <br>
          <input class="btn btn-dark" type="submit" value="Submit" name="Submit">
          <br><br>
          <div><a href="index.php">Sign-In</a> Instead</div>
            </br></br></br>
          </center>
        </form>
  		</div>
  	</div>
  </div>
</body>
</html>
<!-- PHP starts here -->
<?php

if(isset($_POST['Submit'])){

	$con=mysqli_connect('sql100.epizy.com','epiz_27207236','A7GPMt2vmGVqNpp','epiz_27207236_buysell');
	
	if (!$con) {
	  die("Connection failed");
	}
	else{
		$name = $_POST['name'];
		$year = $_POST['year'];
		$roll = $_POST['roll'];
		$email = $_POST['email'];
		$mob = $_POST['mob'];
		$pass = $_POST['pass'];

        $sql1 = "SELECT * FROM users";
        $res1 = mysqli_query($con,$sql1);
        $num_rows1 = mysqli_num_rows($res1);

        if($num_rows1){
    	    $present = 'false';
            while($row1 = mysqli_fetch_array($res1)){
                if($roll == $row1['roll'])
                    $present = 'true';
            }
        }

        if($present == 'true')
    	    echo "<script>alert('User already registered! Please try signing in.')</script>";
        else{
            $sql = "INSERT INTO `users`(`username`,`year`,`roll`,`email`,`contact`,`password`) VALUES('$name','$year','$roll','$email','$mob','$pass')";
		    $chk = mysqli_query($con , $sql);
		    if($chk){
			    echo "<script>alert('Registered Successfully! You may login now.');</script>";
		    }
		    else
			    echo "<script>alert('Registration Failed! Please try again.');</script>";
        }
	}
}
?>






