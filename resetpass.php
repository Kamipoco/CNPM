<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset</title>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/structure.css"> -->
    <link rel="stylesheet" href="css/1.css">

</head>
<body>
<?php
$check = true;
if (isset($_GET['check'])){
    $check=false;
}

$alibaba = false;
if (isset($_POST['submit'])){
    $sql = mysqli_connect('localhost', 'root', '', 'demo');
    $query = "SELECT * FROM users WHERE email= '".$_POST['email']."' AND phone = '".md5($_POST['phone'])."'";
    $user = mysqli_fetch_array(mysqli_query($sql, $query));
    if ($user == NULL)
        $alibaba = true;
    else{
        $check = false;
        $id = md5('123123132').$user['id'];
        header("Location: http://localhost/CNPM/resetpass.php?user=$id&check=false");
        die();
    }
}
if (isset($_POST['reset'])){
    $id = $_GET['user'][strlen($_GET['user']) - 1];
    $sql = mysqli_connect('localhost', 'root', '', 'demo');
    $query = "UPDATE users SET password= '". md5($_POST['password']) ."' WHERE id='".$id."'";
    if (mysqli_query($sql, $query))
        echo '
        <script>
        var x = "Reset Successful!";
        alert(x);
        </script>
        <a href="index.php">=>> Goto Login page</a><br>
        ';
        die();
}
?>


<form method="post" action="">
    <?php
    if ($check){
        // echo '
        // <div class="title">Your email:</div>
        //         <input type="text" name="email">
        //         <div class="title">Your Phone:</div>
        //         <input type="password" name="phone"><br>
        //         <input type="submit" name="submit" value="Submit">
        //         ';
        echo'
        <div class="container">
           <div class="row">
               <div class="col text-center">
               <h3 style="text-align:center">Reset Password</h3>
               <div class="title">Your email:</div>
                        <input type="text" name="email">
                        <div class="title">Your Phone:</div>
                        <input type="password" name="phone"><br>
                        <input type="submit" name="submit" value="Submit">
               </div>
           </div>
        </div>
        ';
        if ($alibaba)
            echo '<div class="container">
                     <div class="row">
                        <div class="col text-center">
                            <div style="color: red">Invalid Email or phone number!</div>
                        </div>
                     </div>
                  </div>
            
            ';
    }
    else{
        // echo '<div class="title">New Password:</div>
        //         <input type="password" id="pass1" name="password">
        //         <div class="title">Again:</div>
        //         <input type="password" id="pass2" name="new_password"><br>
        //         <input type="submit" id="reset" name="reset" value="Submit" disabled>
        echo'
        <div class="container">
        <div class="row">
            <div class="col text-center">
            <h3 style="text-align:center">Reset Password</h3>
            <div class="title">New Password:</div>
                     <input type="password" id="pass1" name="password">
                     <div class="title">Again:</div>
                     <input type="password" id="pass2" name="new_password"><br>
                     <input type="submit" id="reset" name="reset" value="Submit" disabled>
            </div>
        </div>
     </div>
                <script>
                    let pass1 = document.getElementById("pass1");
                    let pass2 = document.getElementById("pass2");
                    pass2.onkeyup = function () {
                        if (pass1.value === pass2.value)
                            document.getElementById("reset").removeAttribute("disabled");

                    }
                </script>';


    }
    ?>
</form>
</body>
</html>