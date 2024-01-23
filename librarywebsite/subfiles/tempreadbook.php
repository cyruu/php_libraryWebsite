<?php
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
        width: 50vw;
    }

    .page {}

    .page input {
        width: 30px;
        text-align: center;
        outline: none;
        margin-right: 600px;
    }
</style>

<body class="bg-dark">
    <form action="" method="post" class="page">
        <span class="text-light">Go to page: </span>&nbsp;
        <input type="text" name="submit" value="1" autocomplete="off">
    </form>
    <embed class="pdf" src="../pdf/<?php echo $pdf ?>#toolbar=0&page=<?php echo $pageno ?>&zoom=70"
        type="application/pdf">
</body>

</html>