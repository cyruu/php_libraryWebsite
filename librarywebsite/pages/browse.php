<?php
if (!session_id())
    session_start();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Browse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body {
        overflow-x: hidden;
    }

    #browse-menu {

        min-height: 30vh;
        width: 100%;
        /* background: blue; */
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-direction: column;
    }

    form {
        width: 40%;
        /* background-color: red; */
    }

    .browse-search {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    #search-text {
        border-radius: 4px;
        padding: 5px 10px;
        border: none;
        outline: none;
        background-color: white;
        margin-right: 15px;
        flex: 1;
    }

    #search-btn {
        padding: 6px 15px;
        border: none;
        outline: none;
    }

    .genre-section {}

    .genre-option {
        margin-right: 30px;
    }

    .genre-option {
        width: 140px;
        outline: none;
        margin-bottom: 20px;
        /* padding: 5px 5px; */
    }

    select {
        -webkit-appearance: none;
        background: url("../images/arrow.svg") no-repeat center;
        background-size: 20px;
        background-position: calc(100% - 3px) center;
        background-color: white;
        padding: 5px 8px;
    }

    .browse-options {
        display: flex;
    }

    option {}

    .available {
        margin: auto 0px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    input[type="checkbox"] {

        height: 20px;
        width: 20px;
        border-radius: 5px;
        background-color: white;
        margin-right: 8px;


    }

    #browse {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    #browse-books {
        /* background-color: red; */
        min-height: 300px;
        width: 80%;
        /* background-color: red; */
        display: flex;
        align-items: flex-start;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }

    #bookmarks {
        min-height: 90vh;
        width: 100%;
        /* background: blue; */
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin: 50px 0;

    }

    .books {
        min-height: 500px;
        width: 80%;
        /* background-color: red; */
        display: flex;
        align-items: flex-start;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }

    .dark {
        height: 100%;
        width: 100%;

        position: absolute;
        top: 0;
        transition: all .2s ease;
    }

    .view {
        background-color: #5cb85c;
        color: white;
        font-family: sans-serif;
        font-size: 1rem;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        padding: 7px 25px;
        opacity: 0;
    }

    .image-cont:hover .dark {
        background-color: rgba(0, 0, 0, .65);
    }

    .image-cont:hover .view {

        transform: translate(-50%, -55px);
        opacity: 1;
        /* transform: translateY(-25%); */
    }

    .genre {
        position: absolute;
        top: 50%;
        left: 50%;
        font-family: sans-serif;
        transform: translate(-50%, -50%);
        font-size: 1.4rem;
        font-weight: bold;
        opacity: 0;
        color: white;
        z-index: 5;
        transition: all .3s ease;
    }


    .image-cont:hover .genre {
        opacity: 1;

    }

    .author {
        display: flex;
        align-items: flex-start;
    }

    .genrecont {
        margin-left: 100px;

        display: flex;
        align-items: flex-start;
    }

    .multi-genre {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 1.5rem;
    }

    .pages {
        max-width: 400px;
        margin: 0 auto;
        /* background-color: red; */
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        margin-bottom: 30px;
        margin-top: 20px;
        position: relative;
    }

    .pages a {
        height: 30px;
        width: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        /* background-color: blue; */
        border: 2px solid #28a745;
        /* border: 2px solid #28a745; */
        border-radius: 5px;
        color: #28a745;
        transition: all .2s ease;

    }

    .pages>a:hover {
        background-color: #28a745;
        color: white;
    }

    .count {
        position: absolute;
        left: -98%;
        color: #28a745;
        font-size: 1.1rem;
        ;
    }

    .notfound {
        position: absolute;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <?php

    include("../subfiles/database/dbconnect.php");
    //navbar
    include("../subfiles/navbar.php");
    ?>

    <section id="browse-menu" class="bg-dark mb-3">
        <div class="h2 my-0 mb-3 pt-2" style="display:flex;align-items:center;color:gray;justify-content:center;">
            <i class="fa-solid fa-star mr-2 pt-1" style="font-size:1rem;"></i>Browse

        </div>
        <!-- form -->
        <form action="" method="GET">
            <div class="browse-search">
                <input type="text" id="search-text" class="shadow-none" name="st">
                <input type="submit" name="submit" value="Search" id="search-btn" class="btn btn-success shadow-none">
            </div>
            <div class="browse-options">
                <div class="genre-section">
                    <div class="option-text mb-2" style="color:rgb(222, 222, 222);">Genre</div>
                    <select name="gs" class="genre-option text-dark">
                        <option value="" selected>All</option>
                        <?php
                        $optionSql = "select * from genres";
                        $optionResult = mysqli_query($conn, $optionSql);
                        while ($optionItem = mysqli_fetch_assoc($optionResult)) {
                            echo '
                                <option value="' . $optionItem['gname'] . '" class="">' . $optionItem['gname'] . '</option>
                                ';
                        }
                        ?>


                    </select>
                </div>
                <div class="genre-section">
                    <div class="option-text mb-2" style="color:rgb(222, 222, 222);">Published</div>
                    <select name="ps" class="genre-option text-dark">
                        <option value="" selected>All</option>
                        <option value="2023" class="">2023</option>
                        <option value="2022" class="">2022</option>
                        <option value="2021" class="">2021</option>
                        <option value="2011-2020">2011-2020</option>
                        <option value="2001-2010">2001-2010</option>
                        <option value="1991-2000">1991-2000</option>
                        <option value="1981-1990">1981-1990</option>
                        <option value="0-1980">below 1980</option>

                    </select>
                </div>
                <div class="available">
                    <input type="checkbox" name="av" id="available-box"> <span class="text-light">Available
                        for
                        borrow</span>
                </div>
            </div>
        </form>

    </section>
    <!-- pagination -->
    <?php
    $sql = "";
    $noOfBook = 5;
    $start = 0;
    $currentPage = 1;


    if ($_GET['submit'] == 'Search') {
        // echo "submitted <br>";
        $searchText = $_GET['st'];
        $genreSelected = $_GET['gs'];
        $publishedSelected = $_GET['ps'];

        if (isset($_GET["p"])) {
            $currentPage = $_GET["p"];
            if ($currentPage >= 1) {
                $start = ($currentPage - 1) * $noOfBook;
            } else {
                $start = 0;
            }
        }

        //check if search text is empty or only white spaces
        // just pressed search btn without any condition
        if ((empty(trim($_GET['st']))) && empty($_GET['gs']) && empty($_GET['ps']) && !isset($_GET['av'])) {
            // echo "search text not found";
            $sql = "select * from books limit $start,$noOfBook";
            $booksql = "select * from books";
            $bookresult = $conn->query($booksql);
            $total = $bookresult->num_rows;
            $noOfPage = ceil($total / $noOfBook);
            $threshold = 3;
            $sql = "select * from books limit $start,$noOfBook";
            echo '<div class="pages">';
            echo "<div class='count'>(" . $total . ") books found.</div>";
            if ($currentPage != 1)
                echo "<a href='?st=&submit=Search&gs=&ps=&p=" . ($currentPage > 1 ? $currentPage - 1 : 1) . "' style='text-decoration:none; width:60px;'><i class='fa-solid fa-angles-right' style='font-size:.8rem;transform:rotate(180deg);'></i></a>";
            else
                echo "<a style='opacity:0;pointer-events:none;'></a>";
            if ($noOfPage > 4) {
                if ($currentPage >= $threshold) {
                    if ($currentPage >= ($noOfPage - 2)) {

                        for ($i = 1; $i < 3; $i++) {
                            echo "<a href='?st=&submit=Search&gs=&ps=&p=$i' style='text-decoration:none;'>" . $i . "</a>";
                        }
                        echo "<a href='' style='pointer-events:none;'>...</a>";
                        for ($i = $noOfPage - 2; $i <= $noOfPage; $i++) {
                            if ($i == $currentPage) {
                                echo "<a href='?st=&submit=Search&gs=&ps=&p=$i' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                            } else {
                                echo "<a href='?st=&submit=Search&gs=&ps=&p=$i' style='text-decoration:none;'>" . $i . "</a>";
                            }
                        }
                    } else {

                        echo "<a href='' style='pointer-events:none;'>...</a>";


                        for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) {
                            if ($i == $currentPage)
                                echo "<a href='?st=&submit=Search&gs=&ps=&p=$i' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                            else
                                echo "<a href='?st=&submit=Search&gs=&ps=&p=$i' style='text-decoration:none;'>" . $i . "</a>";

                        }
                        echo "<a href='' style='pointer-events:none;'>...</a>";

                        for ($i = $noOfPage - 1; $i <= $noOfPage; $i++) {
                            echo "<a href='?st=&submit=Search&gs=&ps=&p=$i' style='text-decoration:none;'>" . $i . "</a>";


                        }
                    }
                } else {
                    for ($i = 1; $i < 3; $i++) {
                        if ($i == $currentPage)
                            echo "<a href='?st=&submit=Search&gs=&ps=&p=$i' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                        else
                            echo "<a href='?st=&submit=Search&gs=&ps=&p=$i' style='text-decoration:none;'>" . $i . "</a>";

                    }
                    echo "<a href='' style='pointer-events:none;'>...</a>";

                    for ($i = $noOfPage - 1; $i <= $noOfPage; $i++) {
                        echo "<a href='?st=&submit=Search&gs=&ps=&p=$i' style='text-decoration:none;'>" . $i . "</a>";


                    }

                }
            } else {
                for ($i = 1; $i <= $noOfPage; $i++) {
                    echo "<a href='?st=&submit=Search&gs=&ps=&p=$i' style='text-decoration:none;'>" . $i . "</a>";
                }
            }
            if ($currentPage != $noOfPage)
                echo "<a href='?st=&submit=Search&gs=&ps=&p=" . ($currentPage == $noOfPage ? $currentPage : $currentPage + 1) . "' style='text-decoration:none; width:60px;'><i class='fa-solid fa-angles-right' style='font-size:.8rem;'></i></a>";
            else
                echo "<a style='opacity:0;pointer-events:none;'></a>";
            echo '</div>';


        }
        //any one option in not empty
        else {
            // echo "somethings there";
            $av = "";
            $booksql = "";
            if (isset($_GET['av'])) {
                $av = $_GET['av'];
            }
            //published
            $published = $_GET['ps'];
            $from = 0;
            $to = 0;
            //published is selected
            if ($published != "") {
                //contains -
                if (strstr($published, "-")) {
                    // two parts
                    $publishedParts = explode("-", $published);
                    $from = (int) $publishedParts[0];
                    $to = (int) $publishedParts[1];
                }

            }
            // echo "only available";
            if ($av != "") {
                //no date selected
                if (empty($published)) {
                    $sql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and g.gname like '%$genreSelected%' and  b.copies>0 limit $start,$noOfBook";
                    $booksql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and g.gname like '%$genreSelected%' and b.copies>0";

                }
                //if only one published date
                else if (!strstr($published, "-")) {

                    $sql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and b.published=$published and g.gname like '%$genreSelected%' and  b.copies>0 limit $start,$noOfBook";
                    $booksql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and b.published=$published and g.gname like '%$genreSelected%' and b.copies>0";
                }
                // multiple date
                else {
                    $sql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and b.published>=$from and b.published<=$to and g.gname like '%$genreSelected%' and  b.copies>0 limit $start,$noOfBook";
                    $booksql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and b.published>=$from and b.published<=$to and g.gname like '%$genreSelected%' and b.copies>0";

                }
                //all available
            } else {
                //no date selected
                if (empty($published)) {
                    $sql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and g.gname like '%$genreSelected%'  limit $start,$noOfBook";
                    $booksql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and g.gname like '%$genreSelected%'";
                    //if only one published date
                } else if (!strstr($published, "-")) {

                    $sql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and b.published=$published and g.gname like '%$genreSelected%' limit $start,$noOfBook";
                    $booksql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and b.published=$published and g.gname like '%$genreSelected%'";
                }


                // multiple date
                else {
                    $sql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and b.published>=$from and b.published<=$to and g.gname like '%$genreSelected%' limit $start,$noOfBook";
                    $booksql = "select distinct(b.isbn) from books b inner join bookgenres bg on b.isbn=bg.isbn inner join genres g on bg.genreId=g.genreId where b.title like '%$searchText%' and b.published>=$from and b.published<=$to and g.gname like '%$genreSelected%'";

                }


            }
            $bookresult = $conn->query($booksql);
            $total = $bookresult->num_rows;
            $noOfPage = ceil($total / $noOfBook);
            $threshold = 3;
            echo '<div class="pages">';
            if ($noOfPage == 0) {
                echo "<div class='notfound lead' style='font-size:4rem;'><i class='fa-solid fa-circle-exclamation mr-4 text-danger'></i>Not Found</div>";
            } else {
                echo "<div class='count'>(" . $total . ") books found.</div>";

            }
            if ($noOfPage != 0) {

                if ($currentPage != 1)
                    echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=" . ($currentPage > 1 ? $currentPage - 1 : 1) . "&av=$av' style='text-decoration:none; width:60px;'><i class='fa-solid fa-angles-right' style='font-size:.8rem;transform:rotate(180deg);'></i></a>";
                else
                    echo "<a style='opacity:0;pointer-events:none;'></a>";
            }
            if ($noOfPage > 4) {
                if ($currentPage >= $threshold) {
                    if ($currentPage >= ($noOfPage - 2)) {

                        for ($i = 1; $i < 3; $i++) {
                            echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;'>" . $i . "</a>";
                        }
                        echo "<a href='' style='pointer-events:none;'>...</a>";
                        for ($i = $noOfPage - 2; $i <= $noOfPage; $i++) {
                            if ($i == $currentPage) {
                                echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                            } else {
                                echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;'>" . $i . "</a>";
                            }
                        }
                    } else {

                        echo "<a href='' style='pointer-events:none;'>...</a>";


                        for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) {
                            if ($i == $currentPage)
                                echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                            else
                                echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;'>" . $i . "</a>";

                        }
                        echo "<a href='' style='pointer-events:none;'>...</a>";

                        for ($i = $noOfPage - 1; $i <= $noOfPage; $i++) {
                            echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;'>" . $i . "</a>";


                        }
                    }
                } else {
                    for ($i = 1; $i < 3; $i++) {
                        if ($i == $currentPage)
                            echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                        else
                            echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;'>" . $i . "</a>";

                    }
                    echo "<a href='' style='pointer-events:none;'>...</a>";

                    for ($i = $noOfPage - 1; $i <= $noOfPage; $i++) {
                        echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;'>" . $i . "</a>";


                    }

                }
            } else {
                for ($i = 1; $i <= $noOfPage; $i++) {
                    if ($i == $currentPage)
                        echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                    else {
                        echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=$i&av=$av' style='text-decoration:none;'>" . $i . "</a>";

                    }
                }
            }
            if ($noOfPage != 0) {
                if ($currentPage != $noOfPage)
                    echo "<a href='?st=$searchText&submit=Search&gs=$genreSelected&ps=$publishedSelected&p=" . ($currentPage == $noOfPage ? $currentPage : $currentPage + 1) . "&av=$av' style='text-decoration:none; width:60px;'><i class='fa-solid fa-angles-right' style='font-size:.8rem;'></i></a>";
                else
                    echo "<a style='opacity:0;pointer-events:none;'></a>";
                echo '</div>';
            }


        }

    } else {
        //not submitted browse
        // echo "default";
    
        $start = 0;
        $currentPage = 1;

        if (isset($_GET["p"])) {
            $currentPage = $_GET["p"];
            if ($currentPage >= 1) {
                $start = ($currentPage - 1) * $noOfBook;
            } else {
                $start = 0;
            }
        }
        $booksql = "select * from books";
        $bookresult = $conn->query($booksql);
        $total = $bookresult->num_rows;
        $noOfPage = ceil($total / $noOfBook);
        $threshold = 3;
        $sql = "select * from books limit $start,$noOfBook";

        echo '<div class="pages">';

        if ($currentPage != 1)
            echo "<a href='?submit=n&p=" . ($currentPage > 1 ? $currentPage - 1 : 1) . "' style='text-decoration:none; width:60px;'><i class='fa-solid fa-angles-right' style='font-size:.8rem;transform:rotate(180deg);'></i></a>";
        else
            echo "<a style='opacity:0;pointer-events:none;'></a>";
        if ($noOfPage > 4) {
            if ($currentPage >= $threshold) {
                if ($currentPage >= ($noOfPage - 2)) {

                    for ($i = 1; $i < 3; $i++) {
                        echo "<a href='?submit=n&p=$i' style='text-decoration:none;'>" . $i . "</a>";
                    }
                    echo "<a href='' style='pointer-events:none;'>...</a>";
                    for ($i = $noOfPage - 2; $i <= $noOfPage; $i++) {
                        if ($i == $currentPage) {
                            echo "<a href='?submit=n&p=$i' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                        } else {
                            echo "<a href='?submit=n&p=$i' style='text-decoration:none;'>" . $i . "</a>";
                        }
                    }
                } else {

                    echo "<a href='' style='pointer-events:none;'>...</a>";


                    for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) {
                        if ($i == $currentPage)
                            echo "<a href='?submit=n&p=$i' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                        else
                            echo "<a href='?submit=n&p=$i' style='text-decoration:none;'>" . $i . "</a>";

                    }
                    echo "<a href='' style='pointer-events:none;'>...</a>";

                    for ($i = $noOfPage - 1; $i <= $noOfPage; $i++) {
                        echo "<a href='?submit=n&p=$i' style='text-decoration:none;'>" . $i . "</a>";


                    }
                }
            } else {
                for ($i = 1; $i < 3; $i++) {

                    if ($i == $currentPage)
                        echo "<a href='?submit=n&p=$i' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                    else
                        echo "<a href='?submit=n&p=$i' style='text-decoration:none;'>" . $i . "</a>";

                }
                echo "<a href='' style='pointer-events:none;'>...</a>";

                for ($i = $noOfPage - 1; $i <= $noOfPage; $i++) {
                    echo "<a href='?submit=n&p=$i' style='text-decoration:none;'>" . $i . "</a>";


                }

            }
        } else {
            for ($i = 1; $i <= $noOfPage; $i++) {
                if ($i == $currentPage) {

                    echo "<a href='?submit=n&p=$i' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                } else {
                    echo "<a href='?submit=n&p=$i' style='text-decoration:none;'>" . $i . "</a>";

                }
            }
        }
        if ($currentPage != $noOfPage)
            echo "<a href='?submit=n&p=" . ($currentPage == $noOfPage ? $currentPage : $currentPage + 1) . "' style='text-decoration:none; width:60px;'><i class='fa-solid fa-angles-right' style='font-size:.8rem;'></i></a>";
        else
            echo "<a style='opacity:0;pointer-events:none;'></a>";
        echo '</div>';
    }

    ?>
    <!-- browse books -->
    <section id="browse" style='display:flex;flex-direction:column;'>

        <section id="browse-books" class="mx-auto mt-3">
            <!-- card -->
            <?php

            $result = $conn->query($sql);

            // Fetch the result as an associative array
            while ($row = $result->fetch_assoc()) {
                $isbn = $row["isbn"];
                //book table sql for other columns other than b.isbn
                $bookColQuery = "select * from  books where isbn=$isbn";
                $bookColQueryResult = $conn->query($bookColQuery);
                $bookColItem = $bookColQueryResult->fetch_assoc();
                $genreName = "";
                // genre name from bookgenres and genres table
                $genresql = "SELECT * FROM bookgenres bg inner join genres g on bg.genreId=g.genreId where bg.isbn=$isbn";

                $genreresult = $conn->query($genresql);
                while ($genreItem = $genreresult->fetch_assoc()) {
                    $genreName = $genreItem["gname"];
                }
                echo '
                            <div class="card mr-5 mb-5" style="width: 11rem;height:310px;background:none;border:none;">
                                <a href="viewbook.php?i=' . $isbn . '&a=n&aa=n" class="image-cont"
                                    style="overflow:hidden;position:relative;height:85%;width:100%;border:5px solid gray;border-radius:8px;margin:0px 0px 6px 0px;transition: all .3s ease;"
                                    onmouseover="this.style.border=`5px solid #5cb85c`;this.style.transform=`scale(1.035)`"
                                    onmouseout="this.style.border=`5px solid gray`;this.style.transform=`scale(1)`">
                                    <img src="../images/bookcovers/' . $bookColItem['coverurl'] . '" style="height:100%;width:100%;" alt="">
                                    ';
                ?>
            <?php
                $genreSql = "SELECT * FROM bookgenres bg inner join genres b on bg.genreId=b.genreId where ba.isbn=$isbn";

                $genreResult = $conn->query($genresql);
                if ($genreresult->num_rows == 1) {

                    echo '
                                <div class="genre">
                                ' . $genreName . '
                                </div>
                                ';
                } else {
                    echo '
                                    <div class="genre multi-genre">
                                ';
                    while ($genreItem = $genreResult->fetch_assoc()) {

                        $gname = $genreItem["gname"];
                        echo '
                                        <p class="gname">' . $gname . '</p>
                                        ';
                    }
                    echo '</div>';
                }
                ?>
            <?php
                echo '
                <div class="dark"></div>
                                   <div class="view" style="transition:transform .25s ease;">
                                        View
                                   </div>
                                </a>
                                <div class="title" style="height:15%;width:100%;">
                                    <a href="#" class="topic text-dark hover-text-danger"
                                        style="font-weight:bold;font-size:1rem;text-decoration:none;">' . $bookColItem['title'] . '
                                    </a>
                                    <p class="year my-0" style="font-size:.9rem;">' . $bookColItem['published'] . '</p>
                                </div>
    
                            </div>
                            ';
            }

            ?>
        </section>
        <?php

        ?>
    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>