<?php
if (!session_id())
    session_start();

?>

<?php

//connect to database
include("../subfiles/database/dbconnect.php");
$isbn = $_GET["i"];
$userId = $_SESSION["userid"];
$checkSql = "DELETE from bookmarks where isbn=$isbn and userId=$userId";
$checkResult = mysqli_query($conn, $checkSql);
//not book marked
if ($checkResult) {

    header("location: bookmark.php");
} else {
    header("location: bookmark.php?e=error");
}
?>