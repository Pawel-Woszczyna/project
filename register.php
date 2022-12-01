<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <?php
        if(isset($_POST['Add'])){
            $Conn = mysqli_connect("localhost", "root", "", "strona");
            $Name = $_POST['Name'];
            $Password = $_POST['Password'];
            $Username = $_POST['username'];
            $Surname = $_POST['surname'];
            $age = $_POST['age'];

            $sol = $Name[0].$Password[0];
            $EPassword = sha1($Password."tegonieodczytasz".$sol);
            
            $Sql = "insert into Person (Name,Password, username, surname, age) values ('$Name','$EPassword', '$Username', '$Surname', '$age')";

            $Run = mysqli_query($Conn, $Sql) or die(mysqli_error($Conn));

            if($Run){
                header('Location: login.php');
            }

            else{
                echo " Dodanie do bazy nie powiodło się";
            }
        }
    ?>
</head>
<body>
    <div id="main">
            <ul>
                <li><a href="login.php">logowanie</a></li>
                <li><a href="index.php">strona</a></li>
            </ul>
            <form action="<?php $_PHP_SELF ?>" method="post">
                <input type="text" name="Name" placeholder="Podaj Imię" id="for">
                <input type="password" name="Password" placeholder="Podaj Hasło" id="for">
                <input type="text" name="username" placeholder="Dodaj Imię Usera" id="for">
                <input type="text" name="surname" placeholder="Dodaj Nazwisko Usera" id="for">
                <input type="text" name="age" placeholder="Dodaj Wiek Usera" id="for">
                <input type="submit" name="Add" value="Zarejestruj">
            </form>
    </div>
</body>
</html>