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
  <!-- FONTS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Anton&family=Karla&family=Oswald:wght@400;500&display=swap">
  <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
  <!-- Symbol -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- favicon -->
  <link rel="icon" href="https://img.icons8.com/cute-clipart/64/000000/shop.png">
  <!-- STYLE -->
  <style type="text/css">
  	@import url('https://fonts.googleapis.com/css2?family=Philosopher&display=swap');
    .img-fluid {
      margin: 10%;
      max-width: 70%;
      height: auto;
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
    .user{
      font-family: arial;
      font-size: 40%;
      display: inline-block;
      float: right;
      margin-top: 2%;
    }
  </style>
  <style type="text/css">/*login.css*/
    .form-control{
      display: inline-block;
      margin-top: 3px;
      margin-bottom: 4px;
      background: transparent!important;
      font-size: 18px!important;
      border-radius: 10px;
    }

    .title{
      font-family: "Karla", "Oswald", Sans-serif;
			font-size: 2rem;
    }

    .lable{
      text-align: left;
    }

    h4 {
      font-family: "Allerta Stencil", Sans-serif;
      border: 0 solid #fff; 
      border-bottom-width:1px;
      padding-bottom:10px;
      text-align: center;
    }
    .hide{
      display: inline-block;
    }
    @media (max-width: 554px) {
      header{
        font-size: 2rem;
      }
      .user{
        font-size: 70%
      }
    }
    @media (max-width: 344px){
      .hide{
        display: none;
      }
    }
    @media (max-width: 250px){

    }
  </style>
</head>
<body>
	<!-- HEADER -->
  <header>
    <div class="text-center" style="font-family: 'Sacramento', 'Anton', 'Oswald', Sans-serif; background-color: white;"> List your Product
      <div class="sym user"> <div class="hide" style="font-family: 'Karla', 'Oswald', Sans-serif; font-size: 80%;"> <?php echo $_SESSION['username']; ?></div>
        <a href="logout.php">
          <i class="fa text-secondary">
          &#xf08b;
          </i>
        </a>
      </div>
    </div>
  </header>
<!-- MAIN CONTAINT -->
  </br></br></br></br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <img src="img/shopping.svg" class="img-fluid">
      </div>
      <div class="col-md-6">
        </br>
        <br><div class="title text-center"> ADD PRODUCT </div><br>
          </br>
        <form method="POST" action="sell.php" enctype="multipart/form-data">

        <div class="form-group">
          <label>Product Name</label>
          <input type="text" id="productName" class="form-control" placeholder="Product Name" name="pname" required >
        </div>

        <div class="form-group">
          <label>Image</label>
          <img id="blah" src="img/cam.png" width="100" height="100"/>
          <input type="file" name="pimg" accept="image/*" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
        </div>

        <div class="form-group">
          <label>Item Description</label>
          <textarea  name="paragraph_text" rows="5" id="details" class="form-control" placeholder="Give brief description of the product (Max 100 char.)" name="detail" required></textarea>
          </br></br>
        </div>

          <center>
          <input class="btn btn-dark" type="submit" value="Submit" name="Submit">
          </center>
            </br></br></br>
        </form>
      </div>
    </div>
  </div>
  </br></br></br>
</body>
</html>
<?php
if(isset($_POST['Submit'])){

  $con=mysqli_connect('sql100.epizy.com','epiz_27207236','A7GPMt2vmGVqNpp','epiz_27207236_buysell');

  if (!$con) {
    die("Database connection failed!");
  }
  else{
    $pname = $_POST['pname'];
    $details = $_POST['paragraph_text'];
    $img_name = $_FILES['pimg']['name'];
    $ownername = $_SESSION['roll'];

    $sql = "INSERT INTO `products`(`name`,`img`,`details`,`ownerroll`) VALUES('$pname','$img_name','$details','$ownername')";

    $chk = mysqli_query($con,$sql);
    if($chk){
      echo "<script>alert('Product listed successfully!');</script>";
    }
    else
      echo "<script>alert('Product listing falied. Please try again later.');</script>";

    $move = move_uploaded_file($_FILES['pimg']['tmp_name'], 'up/'.$img_name);
    
  }
}
?>
