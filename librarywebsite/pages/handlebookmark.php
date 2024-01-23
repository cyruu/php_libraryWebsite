<?php
if (!session_id())
    session_start();

?>

<?php

//connect to database
include("../subfiles/database/dbconnect.php");
$isbn = $_GET["i"];
$userId = $_SESSION["userid"];
$checkSql = "SELECT * from bookmarks where isbn=$isbn and userId=$userId";
$checkResult = mysqli_query($conn, $checkSql);
//not book marked
if (mysqli_num_rows($checkResult) == 0) {
    $sql = "INSERT INTO bookmarks(isbn,userId) values ($isbn,$userId)";


    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: viewbook.php?i=$isbn&a=y&aa=n");
    }
} else {
    header("location: viewbook.php?i=$isbn&a=n&aa=y");
}
?>