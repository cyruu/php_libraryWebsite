<?php
include("../subfiles/database/dbconnect.php");
$requestId = $_GET['ri'];
//ger user if from requestid from requested books table
$userIdSql = "select * from bookrequests where requestId=$requestId";
$userIdRes = mysqli_query($conn, $userIdSql);
$userIdItem = mysqli_fetch_assoc($userIdRes);
$userId = $userIdItem['userId'];
$isbn = $userIdItem['bookIsbn'];
//add data to accepted books
$acceptedSql = "insert into acceptedbooks (requestId,borrowDate,returnDate,userId) values ($requestId,CURRENT_DATE,DATE_ADD(CURDATE(), INTERVAL 30 DAY),$userId)";
$acceptedRes = mysqli_query($conn, $acceptedSql);
if ($acceptedRes) {
    //send notifi to requester , accepted request
    //add data accepted in notifications table
    $notiSql = "insert into notifications (requestId,status,userId) values ($requestId,'accept',$userId)";
    $notires = mysqli_query($conn, $notiSql);
    //update book request to accept from pending
    $updateReq = "update bookrequests set status='accept' where requestId=$requestId";
    $updateRes = mysqli_query($conn, $updateReq);
    //decrease copies of this book
    $copiesSql = "update books set copies=copies-1 where isbn=$isbn";
    $copiesRes = mysqli_query($conn, $copiesSql);
    // increase borrowed book count from bookcount table
    $borrowCountSql = "select * from bookcounts";
    $bookCountRes = mysqli_query($conn, $borrowCountSql);
    $countItem = mysqli_fetch_assoc($bookCountRes);
    $borrowCount = $countItem['borrowCount'];
    $borrowCount++;
    $updateBorrow = "update bookcounts set borrowCount=$borrowCount";
    mysqli_query($conn, $updateBorrow);

    header("location: ./request.php");
}


?>