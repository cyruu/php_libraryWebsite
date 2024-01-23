<?php
include("../subfiles/database/dbconnect.php");
$requestId = $_GET['ri'];
//update bookrequests to reject
$updateReq = "update bookrequests set status='reject' where requestId=$requestId";
$updateRes = mysqli_query($conn, $updateReq);
$bookreqsql = "select * from bookrequests where requestId=$requestId";
$bookreqres = mysqli_query($conn, $bookreqsql);
$userIdItem = mysqli_fetch_assoc($bookreqres);
$userId = $userIdItem['userId'];
if ($updateRes) {
    //send notifi to requester , rejected request
    //add data rejected in notifications table
    $notiSql = "insert into notifications (requestId,status,userId) values ($requestId,'reject',$userId)";
    $notires = mysqli_query($conn, $notiSql);

    header("location: ./request.php");
}


?>