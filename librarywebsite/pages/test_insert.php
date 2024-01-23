<?php
//connect to database
include("../subfiles/database/dbconnect.php");
if (isset($_POST["submit"]) && $_POST["submit"] == "submit") {
    $t = $_POST["title"];
    $d = $_POST["description"];
    $p = $_POST["published"];
    $c = $_POST["copies"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $genre = $_POST["genre"];
    $i = $_FILES["image"];
    $itemp = $_FILES["image"]["tmp_name"];
    $iname = $_FILES["image"]["name"];
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
            $sql2 = "INSERT INTO   `authors` (`fname`,`lname`) VALUES ('" . $fname . "','" . $lname . "');";
            $result2 = mysqli_query($conn, $sql2);
            // get current authors id

            $getAuthorId = "SELECT * from authors where fname='" . $fname . "' AND lname='" . $lname . "'";
            $authorIdResult = $conn->query($getAuthorId);
            while ($author = $authorIdResult->fetch_assoc()) {
                $authorId = $author["authorId"];
            }
            // add data in book authors
            //get id of current book
            $getIsbn = "SELECT * from books where title='" . $t . "' AND  published=$p";
            $isbnResult = $conn->query($getIsbn);
            while ($bookIsbn = $isbnResult->fetch_assoc()) {
                $isbn = $bookIsbn["isbn"];
            }

            // add record in bookgenre
            $addGenreRecord = "INSERT INTO `bookgenres` values ($isbn,$genre)";
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

        } else {
            echo 'failed inserting data in books';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="height:100vh;display:flex;justify-content:center;align-items:center;height:100vh;flex-direction:column;">
    <form action="" method="post" enctype="multipart/form-data">
        title: <input type="text" name="title" id=""><br>
        image: <input type="file" name="image" id=""><br>
        pdf: <input type="file" name="pdf" id=""><br>
        desc: <input type="text" name="description" id=""><br>
        published: <input type="text" name="published" id=""><br>
        copies: <input type="number" name="copies" id=""><br>
        fname: <input type="text" name="fname"><br>
        lname: <input type="text" name="lname"><br>
        genre: <input type="number" name="genre"> <br>
        <input type="submit" name="submit" id="" value="submit">
    </form>
</body>

</html>