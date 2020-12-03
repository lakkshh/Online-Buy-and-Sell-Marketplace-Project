<?php session_start();
if(!isset($_SESSION['roll'])){
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Buy and Sell</title>
	<!-- Meta Tags -->
  <meta charset="utf-8">
  <meta html-equiv = "X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
  <!-- Symbol -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- STYLE -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&family=Karla&family=Oswald:wght@400;500&display=swap">
  <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
  <!-- favicon -->
  <link rel="icon" href="https://img.icons8.com/cute-clipart/64/000000/shop.png">
  <style type="text/css">
  	@import url('https://fonts.googleapis.com/css2?family=Philosopher&display=swap');
  	header{
      /*background-color: white;*/
      z-index: 2;
      transition: background-color 0.2s;
      min-height: 10vh;
      text-align: center;
      font-family: 'Philosopher';
      font-size: 4rem;
      position: fixed;
      width: 100%;
    }
    @media (max-width: 556px) {
      header{
        font-size: 3rem;
      }
    }

    .card{
      /*margin: 1rem;*/
      border-radius: 25px;
    }
    .col-md-5{
      margin: 2.5rem;
    }
    .user{
      font-family: arial;
      font-size: 40%;
      display: inline-block;
      float: right;
      margin-top: 2%;
    }
    .hide{
      display: inline-block;
    }
    @media (max-width: 432px) {
      header{
        font-size: 2rem;
      }
      .user{
        font-size: 70%
      }
    }
    @media (max-width: 318px){
      .hide{
        display: none;
      }
    }
  </style>
</head>
<body>
	<!-- HEADER -->
  <header>
    <div class="text-center" style="font-family: 'Sacramento', 'Anton', 'Oswald', Sans-serif; background-color: white;"> Products
      <div class="sym user"> <div class="hide" style="font-family: 'Karla', 'Oswald', Sans-serif; font-size: 80%;"><?php echo $_SESSION['username']; ?></div>
        <a href="logout.php">
          <i class="fa text-secondary">
          &#xf08b;
          </i>
        </a>
      </div>
    </div>
  </header>
<!-- MAIN CONTAINT -->
<br><br><br><br>
<?php
    $con=mysqli_connect('sql100.epizy.com','epiz_27207236','A7GPMt2vmGVqNpp','epiz_27207236_buysell');
    // $con=mysqli_connect('sql211.epizy.com','epiz_27178478','5Dkmn56NmlLvE','epiz_27178478_buysell');
  
  if (!$con) {
    die("DB Connection failed");
  }
  else{
    $sql = "SELECT * FROM products";

    $res = mysqli_query($con,$sql);
    $num_rows = mysqli_num_rows($res);

    if($num_rows>0){
      echo '
      <div class="container">
        <div class="row">';
      while($row=mysqli_fetch_array($res)){
        
        echo '<div class="col-md-5 card">';
              $imgname = $row['img'];
              if($row['img']){
                echo "<img class='card-img-top' src='up/$imgname' width='100' height='300' alt='Image Unavailable'>";
              }else{
                echo '<img class="card-img-top" src="up/default.png" width="100" height="300">';
              }

            echo '
            <div class="card-body">
            <b><center><span style="font-size: 130%;">
            '.$row['name'].'
            </b></center></span>
            ';
            $sql1 = "SELECT * FROM users";
            $res1 = mysqli_query($con,$sql1);
            $num_rows1 = mysqli_num_rows($res1);
            if($num_rows1){
              while($row1=mysqli_fetch_array($res1) ){
                if($row['ownerroll'] == $row1['roll'])
                  echo '<b><center>Contact Number </b>'.$row1['contact'].'</center>';
              }
            }
            echo '<hr>
            '.$row['details'].'
            </div>
          </div>
          ';
      }
      echo '
      </div>';
    }
  }
?>
</body>
</html>