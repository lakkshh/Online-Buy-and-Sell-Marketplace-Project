<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Buy and Sell</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta html-equiv = "X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
  <!-- fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&family=Karla&family=Oswald:wght@400;500&display=swap">
  <!-- favicon -->
  <link rel="icon" href="https://img.icons8.com/cute-clipart/64/000000/shop.png">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Philosopher&display=swap');
  </style>
  <style type="text/css">/*index.css*/
    .img-fluid {
      margin: 10%;
        max-width: 70%;
        height: auto;
    }

    .site-footer {
    padding-bottom: 0.5em;
    padding-top: 2.5em;
    }

    header{
      background-color: white;
      z-index: 2;
      transition: background-color 0.2s;
      min-height: 10vh;
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
    footer{
      background-color: #454B69;
      transition: background-color 0.2s; 
      min-height: 10vh;
      text-align: center;
      font-family: Syne, sans-serif;
      color: white;
      bottom: 0;
      position: fixed;
      width: 100%;
    }
  </style>
  <style type="text/css">/*login.css*/
    .form-control{
      background: transparent!important;
      font-size: 18px!important;
      width: 80%;
      border-radius: 10px;
    }

    h4 {
      font-family: "Karla", "Oswald", Sans-serif;
      border: 0 solid #fff; 
      border-bottom-width:1px;
      padding-bottom:10px;
      text-align: center;
      font-size: 2rem;
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
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <img src="img/shopping.svg" class="img-fluid">
      </div>
      <div class="col-md-6 text-center">
        </br>
        <h4>LOGIN</h4>
          </br>
        <form method="POST" action="index.php">
          <center>
          <input type="text" id="roll" class="form-control" placeholder="Roll Number" name="roll" autofocus required />
            </br></br>
          <input type="password" id="userPassword" class="form-control" placeholder="Password" name="pass"required/>
            </br>
          <input type="radio" id="buy" name="buy-sel" value="b" required>
          <label for="buy"> Buyer </label>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" id="sell" name="buy-sel" value="s" required>
          <label for="sell"> Seller </label><br>
            </br>
          <input class="btn btn-dark" type="submit" value="Submit" name="Submit">
            </br></br></br>
          <div>Don't have an account?
          <a href="register.php">Register Now</a></div>
          </center>
        </form>
      </div>
    </div>
  </div>
  </br></br></br>
  
<!-- FOOTER -->
  <footer class="site-footer" style="min-height: 1vh; font-family: Karla, sans-serif; padding: 1em 0 1em 0;">2020 &copy; Made with <font color="red">&hearts;</font> by Lakshya, Devansh and Vidit  </footer>
</body>
</html>
<!-- PHP starts here -->
<?php

if(!empty($_GET['status'])){
  echo '<script>alert("You have been logged out!")</script></div>';
}

if(isset($_POST['Submit'])){
  
  $con=mysqli_connect('sql100.epizy.com','epiz_27207236','A7GPMt2vmGVqNpp','epiz_27207236_buysell');

  if (!$con) {
    die("Dsatabase connection failed. Please try again later.");
  }
  else{
    $roll = $_POST['roll'];
    $pass = $_POST['pass'];//do md5 at last

    $sql = "SELECT * FROM users";
    $result = mysqli_query($con,$sql);
    $num_row = mysqli_num_rows($result);

    if($num_row > 0){
      while($row = mysqli_fetch_array($result)){

        //this is to check if either of the fields are vacaent
        if (empty($roll) || empty($pass) ) {
          echo '<script>alert("Please fill all the fields.")</script>';
        } 
        
        //this part is to check if the pass and username are correct
        else if($roll == $row["roll"] && $pass == $row["password"]){

          $_SESSION['roll'] = $roll;
          $_SESSION['username'] = $row['username'];


          if ($_POST['buy-sel'] == 'b')
            header('location:buy.php');
          if ($_POST['buy-sel'] == 's') 
            header('location:sell.php');
        }
        
        else{
          /*echo '<div class="alert alert-success fixed-top text-center w-25 container justify-content-center alert-dismissible" role="alert">
          <span type="button" class="close" data-dismiss="alert">&times;</span></span>
          Wrong Username or Password. Please try again.
          </div>';*/

          echo '<script>alert("Wrong Username or Password. Please try again.")</script>';
        } 
          
      }
    }
  }
}
?>