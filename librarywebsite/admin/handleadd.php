<?php
//connect to database
include("../subfiles/database/dbconnect.php");
$t = $_POST["title"];
$p = $_POST["published"];
$c = $_POST["copies"];
$genre = $_POST["gs"];
$d = $_POST["description"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$i = $_FILES["coverurl"];
$itemp = $_FILES["coverurl"]["tmp_name"];
$iname = $_FILES["coverurl"]["name"];
$pdf = $_FILES["pdf"];
$pdftemp = $_FILES["pdf"]["tmp_name"];
$pdfname = $_FILES["pdf"]["name"];
//image
$inameSeparate = explode(".", $iname);
$iextension = strtolower(end($inameSeparate));
//pdf
$pdfnameSeparate = explode(".", $pdfname);
$pdfextension = strtolower(end($pdfnameSeparate));

$iextensions = array("jpg", "png", "jpeg");
$pdfextensions = array("pdf");
// add image
$imageInserted = false;
$pdfInserted = false;
if (in_array($iextension, $iextensions)) {
    $uploadimage = '../images/bookcovers/' . $iname;
    move_uploaded_file($itemp, $uploadimage);
    $imageInserted = true;
    // $sql = "INSERT INTO `books` (`title`, `published`, `copies`, `description`, `coverurl`) VALUES ('" . $t . "', '" . $p . "', '" . $c . "', '" . $d . "', '" . $iname . "');";
    // $result = mysqli_query($conn, $sql);
    // if ($result) {

    // } else {
    //     echo 'not inserted';
    // }
} else {
    echo 'image not inserted<br>';
}
// add pdf
if (in_array($pdfextension, $pdfextensions)) {
    $uploadpdf = '../pdf/' . $pdfname;
    move_uploaded_file($pdftemp, $uploadpdf);
    //if(move_uplaoaded_file){}
    $pdfInserted = true;

} else {
    echo 'pdf not inserted<br>';
}

//if image and pdf valid
if ($imageInserted) {

    // add title publised ... in books
    $sql = "INSERT INTO `books` (`title`, `published`, `copies`, `description`, `coverurl`,`pdfurl`) VALUES ('" . $t . "', '" . $p . "', '" . $c . "', '" . $d . "', '" . $iname . "','" . $pdfname . "');";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $isbn = 0;
        $authorId = 0;
        // add authors
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
        // add data in book authors
        //get id of current book
        $getIsbn = "SELECT * from books where title='" . $t . "' AND  published=$p";
        $isbnResult = $conn->query($getIsbn);
        while ($bookIsbn = $isbnResult->fetch_assoc()) {
            $isbn = $bookIsbn["isbn"];
        }
        //select genre id ftom genrename
        $genreName = "select * from genres where gname='$genre'";
        $genreNameRes = $conn->query($genreName);
        while ($genreNameItem = $genreNameRes->fetch_assoc()) {
            $genreId = $genreNameItem["genreId"];
        }
        // add record in bookgenre
        $addGenreRecord = "INSERT INTO `bookgenres` values ($isbn,$genreId)";
        $genreResult = mysqli_query($conn, $addGenreRecord);
        if (!$genreResult) {
            echo 'error adding in bookgenres';
        }
        // add record in bookauthors
        $addAuthorRecord = "INSERT INTO `bookauthors` values ($isbn,$authorId)";
        $authorResult = mysqli_query($conn, $addAuthorRecord);
        if (!$authorResult) {
            echo 'error adding in bookauthors';
        }

        header("location: ./addbook.php?a=y");

    } else {
        echo 'failed inserting data in books';
    }

}

?>