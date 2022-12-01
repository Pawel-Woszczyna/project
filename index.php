<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php
        session_start();
        $conn = mysqli_connect("localhost", "root", "", "strona");
        
        if(isset($_SESSION['Name'])){
            $Name = $_SESSION['Name'];
            echo "<p id='text'>Witaj <b>$Name</b></p>";
            echo "<br>";
        }

        else{
            header('Location: login.php');
        }
        

        if(isset($_POST['username'])){
            $result = mysqli_query($conn,"SELECT * FROM person");

            if(count($_POST)>0) {
                while($row = mysqli_fetch_array($result)) {
                    $Username = $row['username'];
                    $Surname = $row['surname'];
                    $Age = $row['age'];
                }
                mysqli_query($conn,"UPDATE person set username ='" . $_POST['username'] . "', surname='" . $_POST['surname'] . "', age='" . $_POST['age'] . "'");
                $message = "Record Modified Successfully";
                }
                $result = mysqli_query($conn,"SELECT * FROM person WHERE username='" . $_POST['username'] . "'");
                $row= mysqli_fetch_array($result);                
        }

        if(isset($_POST['klasa'])){
            $klasa = $_POST['klasa'];

            $sql1 = "INSERT INTO klasa (name) VALUES ('$klasa')";
            if(mysqli_query($conn, $sql1)){
                echo "";
            }
            else{
                echo "błąd ". sql1 . mysqli_error($conn);
            }
        }

        if(isset($_POST['student_surname'])){
            $klasa_name = $_POST['klasa_name'];
            $student_name = $_POST['student_name'];
            $student_surname = $_POST['student_surname'];
            $student_klasaid = mysqli_fetch_array(mysqli_query($conn,"SELECT id FROM `klasa` WHERE `name` = '$klasa_name'"));
            $student_klasaid=(int)$student_klasaid[0];
            
            $sql2 = "INSERT INTO student (name, surname, klasa_name, class_id) VALUES ('$student_name', '$student_surname', '$klasa_name', '$student_klasaid')";
            if(mysqli_query($conn, $sql2)){
                echo "";
            }
            else{
                echo "błąd ". sql2 . mysqli_error($conn);
            }
        }

        if(isset($_POST['subject_name'])){
            $klasa_name = $_POST['klasa_name'];
            $subject_name = $_POST['subject_name'];
            $subject_klasaid = mysqli_fetch_array(mysqli_query($conn,"SELECT id FROM `klasa` WHERE `name` = '$klasa_name'"));
            $subject_klasaid=(int)$subject_klasaid[0];

            $sql3 = "INSERT INTO subject (name, klasa_name,  class_id) VALUES ('$subject_name','$klasa_name', '$subject_klasaid')";
            if(mysqli_query($conn, $sql3)){
                echo "";
            }
            else{
                echo "błąd ". sql3 . mysqli_error($conn);
            }
        }

        if(isset($_POST['teacher_name'])){
            $teacher_name = $_POST['teacher_name'];
            $teacher_surname = $_POST['teacher_surname'];
            $teacher_age = $_POST['teacher_age'];
            $sql4 = "INSERT INTO teacher (id, name, surname, age) VALUES (NULL, '$teacher_name','$teacher_surname', '$teacher_age')";
            if(mysqli_query($conn, $sql4)){
                echo "";
            }
            else{
                echo "błąd ". sql4 . mysqli_error($conn);
            }
        }
    ?>
</head>
<body>
    <div id="main2">
        <a href="logout.php" id="link">Wyloguj</a>
        <form action="<?php $_PHP_SELF ?>" method="post">
            <input type="text" name="username" placeholder="Zmień Imię" id="for">
            <input type="text" name="surname" placeholder="Zmień Nazwisko" id="for">
            <input type="text" name="age" placeholder="Zmień Wiek" id="for">
            <input type="submit" value="Zmień dane">
        </form>
        <form action="<?php $_PHP_SELF ?>" method="post">
                <input type="text" name="klasa" placeholder="Podaj Klase" id="for">
                <input type="submit" value="Dodaj Klase do bazy">
        </form>
        <form action="<?php $_PHP_SELF ?>" method="post">
                <input type="text" name="klasa_name" placeholder="Podaj Klase" id="for">
                <input type="text" name="student_name" placeholder="Podaj Imie ucznia" id="for">
                <input type="text" name="student_surname" placeholder="Podaj nazwisko ucznia" id="for">
                <input type="submit" value="Dodaj studenta do bazy">
        </form>
        <form action="<?php $_PHP_SELF ?>" method="post">
                <input type="text" name="klasa_name" placeholder="Podaj Klase" id="for">
                <input type="text" name="subject_name" placeholder="Podaj Przedmiot" id="for">
                <input type="submit" value="Dodaj subject'a do bazy">
        </form>
        <form action="<?php $_PHP_SELF ?>" method="post">
            <input type="text" name="klasa_name" placeholder="Podaj Klase" id="for">
            <input type="text" name="teacher_name" placeholder="Podaj Imie Nauczyciela" id="for">
            <input type="text" name="teacher_surname" placeholder="Podaj nazwisko Nauczyciela" id="for">
            <input type="text" name="teacher_age" placeholder="Podaj wiek Nauczyciela" id="for">
            <input type="submit" value="Dodaj teacher'a do bazy">
        </form>
    </div>
        <div class="card text-center mt-5 mb-5" style="margin: 0 auto; width: 50%;">
            <div class="card-body">
                <table class="table table-bordered mt-1">
                    <thead>
                        <tr>
                            <th>person_id</th>
                            <th>person_name</th>
                            <th>person_username</th>
                            <th>person_surname</th>
                            <th>person_age</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql9 = "SELECT * FROM person";
                            $result = $conn->query($sql9);
                            while ($row = $result->fetch_assoc()) {
                                $field1name = $row["ID"];
                                $field2name = $row["Name"];
                                $field3name = $row["username"];
                                $field4name = $row["surname"];
                                $field5name = $row["age"];
                                echo "<tr> 
                                          <td class ='xd'>" . $field1name . "</td> 
                                          <td class ='xd'>" . $field2name . "</td> 
                                          <td class ='xd'>" . $field3name . "</td> 
                                          <td class ='xd'>" . $field4name . "</td> 
                                          <td class ='xd'>" . $field5name . "</td> 
                                      </tr>";
                            }
                        ?>
                    </tbody>
                </table>
                        
                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>klasa_id</th>
                            <th>klasa_name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql5 = "SELECT * FROM klasa";
                            $result = $conn->query($sql5);
                            while ($row = $result->fetch_assoc()) {
                                $field1name = $row["id"];
                                $field2name = $row["name"];
                                echo "<tr> 
                                          <td class ='xd'>" . $field1name . "</td> 
                                          <td class ='xd'>" . $field2name . "</td> 
                                      </tr>";
                            }
                        ?>
                    </tbody>
                </table>
                        
                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>student_id</th>
                            <th>student_name</th>
                            <th>student_surname</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql6 = "SELECT * FROM student";
                            $result = $conn->query($sql6);
                            while ($row = $result->fetch_assoc()) {
                                $field1name = $row["id"];
                                $field2name = $row["name"];
                                $field3name = $row["surname"];
                                echo "<tr> 
                                          <td class ='xd'>" . $field1name . "</td> 
                                          <td class ='xd'>" . $field2name . "</td> 
                                          <td class ='xd'>" . $field3name . "</td> 
                                      </tr>";
                            }
                        ?>
                    </tbody>
                </table>  
                        
                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>subject_id</th>
                            <th>subject_name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql7 = "SELECT * FROM subject";
                            $result = $conn->query($sql7);
                            while ($row = $result->fetch_assoc()) {
                                $field1name = $row["id"];
                                $field2name = $row["name"];
                                echo "<tr> 
                                          <td class ='xd'>" . $field1name . "</td> 
                                          <td class ='xd'>" . $field2name . "</td> 
                                      </tr>";
                            }
                        ?>
                    </tbody>
                </table>
                        
                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>teacher_id</th>
                            <th>teacher_name</th>
                            <th>teacher_surname</th>
                            <th>teacher_age</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql8 = "SELECT * FROM teacher";
                            $result = $conn->query($sql8);
                            while ($row = $result->fetch_assoc()) {
                                $field1name = $row["id"];
                                $field2name = $row["name"];
                                $field3name = $row["Surname"];
                                $field4name = $row["age"];
                                echo "<tr> 
                                          <td class ='xd'>" . $field1name . "</td> 
                                          <td class ='xd'>" . $field2name . "</td> 
                                          <td class ='xd'>" . $field3name . "</td> 
                                          <td class ='xd'>" . $field4name . "</td> 
                                      </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>