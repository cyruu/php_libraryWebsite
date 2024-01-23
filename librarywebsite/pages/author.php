<?php
//connect to database
include("../subfiles/database/dbconnect.php");
if (isset($_POST["submit"]) && $_POST["submit"] == "submit") {
    $f = $_POST["first"];
    $l = $_POST["second"];
    $g = $_POST["genre"];
    $sql = "select isbn from books where title=''";

}
?>