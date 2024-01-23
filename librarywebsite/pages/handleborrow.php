<?php
include("../subfiles/database/dbconnect.php");
if (!session_id())
    session_start();

?>
<?php
$isbn = $_GET['i'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$why = $_POST['why'];
$userId = 0;
if (isset($_SESSION['login'])) {
    $userId = $_SESSION['userid'];
}

$alreadyRequest = "select * from bookrequests where userId=$userId and bookIsbn=$isbn";
$alreadyRes = mysqli_query($conn, $alreadyRequest);
$reqCount = $alreadyRes->num_rows;
// can add new request
if ($reqCount == 0) {
    $newReq = "insert into bookrequests (userId,bookIsbn,requestDate,fname,lname,descr,email,status) values ($userId,$isbn,CURRENT_DATE,'$fname','$lname','$why','$email','pending')";
    $newReqRes = mysqli_query($conn, $newReq);
    header("location: borrow.php?i=$isbn&e=a");
}
// this book is already requested by this user
else {
    header("location: borrow.php?i=$isbn&e=aa");
}
?>