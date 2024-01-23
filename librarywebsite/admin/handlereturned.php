<?php
include("../subfiles/database/dbconnect.php");
$requestId = $_GET['r'];
//ger user if from requestid from requested books table
$userIdSql = "select * from bookrequests where requestId=$requestId";
$userIdRes = mysqli_query($conn, $userIdSql);
$userIdItem = mysqli_fetch_assoc($userIdRes);
$userId = $userIdItem['userId'];
$isbn = $userIdItem['bookIsbn'];
// remove from acceptedbooks table
$delSql = "delete from acceptedbooks where requestId=$requestId";
$delRes = mysqli_query($conn, $delSql);
// increase copies of book
$copiesSql = "update books set copies=copies+1 where isbn=$isbn";
$copiesRes = mysqli_query($conn, $copiesSql);
//update book request to returned from accept
$updateReq = "update bookrequests set status='returned' where requestId=$requestId";
$updateRes = mysqli_query($conn, $updateReq);
//add data returned in notifications table
$notiSql = "insert into notifications (requestId,status,userId) values ($requestId,'returned',$userId)";
$notires = mysqli_query($conn, $notiSql);
header("location: ./managebooks.php");
?>