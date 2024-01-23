<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //connect to database
    include("../subfiles/database/dbconnect.php");

    $username = $_POST["username"];
    $password = $_POST["password"];
    $vbIsbn = $_GET['vb'];
    //check if email in database
    $sql = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    $item = mysqli_fetch_assoc($result);

    if ($row == 1) {
        //email exits in databse


        //check password
        if ($password == $item["password"]) {


            //session start
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['username'] = $item['username'];
            $_SESSION['userid'] = $item['id'];
            //send to viewbook with isbn vb
            if ($vbIsbn != 0) {

                header("location: viewbook.php?i=$vbIsbn&a=n&aa=n");
            } else {
                header("location: ../index.php");

            }

        } else {

            header("location: login.php?c=none&e=notexist&p=nomatch&vb=$vbIsbn");
        }
    } else {
        //email doesnt exist
        header("location: login.php?c=none&e=notexist&p=none&vb=$vbIsbn");

    }
}
?>