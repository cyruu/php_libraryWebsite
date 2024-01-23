<?php
include("../subfiles/database/dbconnect.php");
$isbn = $_GET['i'];
$t = $_POST["title"];
$p = $_POST["published"];
$c = $_POST["copies"];
$genre = $_POST["gs"];
$d = $_POST["description"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
// if pdf is set
if (!empty($_FILES["pdf"])) {
    $pdf = $_FILES["pdf"];
    $pdftemp = $_FILES["pdf"]["tmp_name"];
    $pdfname = $_FILES["pdf"]["name"];
    $pdfnameSeparate = explode(".", $pdfname);
    $pdfextension = strtolower(end($pdfnameSeparate));
    $pdfextensions = array("pdf");
    // add pdf
    if (in_array($pdfextension, $pdfextensions)) {
        $uploadpdf = '../pdf/' . $pdfname;
        move_uploaded_file($pdftemp, $uploadpdf);
        //if(move_uplaoaded_file){}
        $pdfSql = 'update books set pdfurl="' . $pdfname . '"where isbn=' . $isbn;
        $pdfres = $conn->query($pdfSql);

    }
}
//update book table
$bookSql = 'update books set title="' . $t . '",published=' . $p . ', copies=' . $c . ',description="' . $d . '" where isbn=' . $isbn;
$bookRes = $conn->query($bookSql);

//genre update
//select genre id ftom genrename
$genreId = 0;
$authorId = 0;
$genreName = "select * from genres where gname='$genre'";
$genreNameRes = $conn->query($genreName);
while ($genreNameItem = $genreNameRes->fetch_assoc()) {
    $genreId = $genreNameItem["genreId"];
}
// update book genres
$updateBookGenre = "update bookgenres set genreId=$genreId where isbn=$isbn";
$updateBookGenreRes = mysqli_query($conn, $updateBookGenre);
//update author
//check if author already exists
$authorCheckSql = "select * from authors where fname='$fname' and lname='$lname'";
$checkAuthorRes = $conn->query($authorCheckSql);
$authorFound = $checkAuthorRes->num_rows;
//there is already author in table
if ($authorFound > 0) {
    $checkAuthorItem = $checkAuthorRes->fetch_assoc();
    $authorId = $checkAuthorItem['authorId'];

}
// add new author to the table
else {

    $sql2 = "INSERT INTO   `authors` (`fname`,`lname`) VALUES ('" . $fname . "','" . $lname . "');";
    $result2 = mysqli_query($conn, $sql2);
    // get current authors id

    $getAuthorId = "SELECT * from authors where fname='" . $fname . "' AND lname='" . $lname . "'";
    $authorIdResult = $conn->query($getAuthorId);
    while ($author = $authorIdResult->fetch_assoc()) {
        $authorId = $author["authorId"];
    }
}
//update bookauthors
$updateBookauthor = "update bookauthors set authorId=$authorId where isbn=$isbn";
$updateBookauthorRes = mysqli_query($conn, $updateBookauthor);
if ($updateBookauthorRes) {
    header("location: ./editbook.php?i=$isbn&e=u");
}
?>