<?php
if (!session_id())
    session_start();

$userId = $_SESSION['userid'];
$isbn = $_GET['i'];
$pageno = 1;
if (isset($_POST["submit"])) {
    $page = $_POST['submit'];
    $pageno = $page;
}
//connect to database
include("../subfiles/database/dbconnect.php");
$sql = "SELECT * FROM `books` where isbn=$isbn";

$result = $conn->query($sql);
$title = "";
$pdf = "";
// Fetch the result as an associative array
while ($row = $result->fetch_assoc()) {
    $title = $row["title"];
    $pdf = $row["pdfurl"];
}
// add read record to reads table
$readSql = "select * from bookcounts;";
$readResult = mysqli_query($conn, $readSql);
$readItem = mysqli_fetch_assoc($readResult);
$readCount = $readItem['readCount'];
$readCount++;
$updateReadSql = "update bookcounts set readCount=$readCount";
$updatereadResult = mysqli_query($conn, $updateReadSql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title ?>
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

    }

    .pdf {
        height: 90vh;
        width: 70vw;
    }

    .disableBlock {
        position: absolute;
        top: 40px;
        left: 75%;

        height: 47px;
        width: 110px;
        background-color: #323639;
    }
</style>

<body class="bg-dark">

    <div class="disableBlock"></div>
    <embed class="pdf" src="../pdf/<?php echo $pdf ?>" type="application/pdf">
</body>

</html>