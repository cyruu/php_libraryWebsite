<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .current {
        font-size: 2rem;
    }
    </style>
</head>

<body>
    <?php
    $noOfBook = 1;
    $start = 0;
    $currentPage = 1;
    include("./subfiles/database/dbconnect.php");
    if (isset($_GET["p"])) {
        $currentPage = $_GET["p"];
        if ($currentPage >= 1) {
            $start = ($currentPage - 1) * $noOfBook;
        } else {
            $start = 0;
        }
    }
    $sql = "select * from books limit $start,$noOfBook";
    $result = $conn->query($sql);

    // Fetch the result as an associative array
    while ($row = $result->fetch_assoc()) {
        echo $row["isbn"] . " " . $row['title'] . '<br>';
    }

    $booksql = "select * from books";
    $bookresult = $conn->query($booksql);
    $total = $bookresult->num_rows;
    ?>
    <a href="?p=<?php echo ($currentPage > 1) ? $currentPage - 1 : 1 ?>">prev</a>
    <?php
    $noOfPage = ceil($total / $noOfBook);
    $threshold = 3;
    if ($currentPage >= $threshold) {


        if ($currentPage >= ($noOfPage - 2)) {

            for ($i = 1; $i < 3; $i++) {
                echo "<a href='?p=$i'>" . $i . "</a>&nbsp";

            }
            echo "&nbsp...&nbsp";
            for ($i = $noOfPage - 2; $i <= $noOfPage; $i++) {
                if ($i == $currentPage)
                    echo "<a href='?p=$i' style='font-size:2rem;'>" . $i . "</a>&nbsp";
                else
                    echo "<a href='?p=$i'>" . $i . "</a>&nbsp";

            }

        } else {

            echo "&nbsp...&nbsp";

            for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) {
                if ($i == $currentPage)
                    echo "<a href='?p=$i' style='font-size:2rem;'>" . $i . "</a>&nbsp";
                else
                    echo "<a href='?p=$i'>" . $i . "</a>&nbsp";
            }
            echo "&nbsp...&nbsp";
            for ($i = $noOfPage - 1; $i <= $noOfPage; $i++) {
                echo "<a href='?p=$i'>" . $i . "</a>&nbsp";

            }
        }

    } else {
        for ($i = 1; $i < 3; $i++) {
            if ($i == $currentPage)
                echo "<a href='?p=$i' style='font-size:2rem;'>" . $i . "</a>&nbsp";
            else
                echo "<a href='?p=$i'>" . $i . "</a>&nbsp";
        }
        echo "&nbsp...&nbsp";
        for ($i = $noOfPage - 1; $i <= $noOfPage; $i++) {
            echo "<a href='?p=$i'>" . $i . "</a>&nbsp";

        }

    }
    ?>
    <a href="?p=<?php echo ($currentPage == $noOfPage) ? $currentPage : $currentPage + 1 ?>">Next</a>

</body>

</html>