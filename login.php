<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <?php
        session_start();

        $Conn = mysqli_connect("localhost", "root", "", "strona");
        

        if (isset($_POST['Name']) and isset($_POST['Password'])){

            $Name = $_POST['Name'];
            $Password = $_POST['Password'];
            $sol = $Name[0].$Password[0];
            $EPassword = sha1($Password."tegonieodczytasz".$sol);

            $Query = "select * from `Person` where Name='$Name' and Password='$EPassword'";

            $Result = mysqli_query($Conn, $Query) or die(mysqli_error($Conn));

            $Count = mysqli_num_rows($Result);
            if($Count == 1){
                $_SESSION['Name'] = $Name;
                header("Location: index.php");
            }

            else{
                $POST['message'] = 'złe hasło';
                header("Location: register.php");
            }
        }

    ?>
</head>
<body>
    <div id="main">
            <ul>
                <li><a href="index.php">strona</a></li>
                <li><a href="register.php">rejestracja</a></li>
            </ul>
            <form action="<?php $_PHP_SELF ?>" method="post">
                <input type="text" name="Name" placeholder="Podaj Imię" id="for">
                <input type="password" name="Password" placeholder="Podaj Hasło" id="for">
                <input type="submit" value="Zaloguj">
            </form>
    </div>
</body>
</html>