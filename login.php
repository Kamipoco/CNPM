</html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>TrangChu</title>
   <link rel="icon" href="e7f764b8-d1ff-4fbf-b8b8-6938f597d786.png" type="image/png" sizes="16x16">
</head>
<body>	
</body>
</html>  

<?php
 $link = mysqli_init();
 $servername = "localhost";
 $username = "root"; 
 $passdb = "";
 $namedb = "demo";

 $success = mysqli_real_connect(
    $link,
    $servername,
    $username,
    $passdb,
    $namedb
 );
    if(isset($_POST['submit'])){
       if(empty($_POST['email']) || empty($_POST['password'])){

          echo ("<p style='color:red;'>Please enter your Email or Password! </p>");
          echo "<a href=index.html>=>>Go Back</a>";
       }
       else{
          $email = $_POST['email'];
          $pass = $_POST['password'];
       }
       if(isset($email) && isset($pass)){
          //ket noi db
         $conn = mysqli_connect($servername,$username,$passdb,$namedb) or die ('Khong the ket noi toi database');
         //truy van
          $sql = mysqli_query($conn,"SELECT * FROM users WHERE email= '".$email."' AND password = '".md5($pass)."'");
          $row = mysqli_num_rows($sql);
          if($row == 0){
              $check = true;
              header("Location: http://localhost/CNPM/index.php?check=$check");
              die();

          }
          else{
            session_start();
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
             echo ("Login Successful!");
          }
          //dong db
          mysqli_close($conn);  
        }
      }
?> 
