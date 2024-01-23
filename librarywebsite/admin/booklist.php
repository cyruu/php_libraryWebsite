<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <title>Administration</title>
    <style>
    * {
        margin: 0;
        padding: 0;
    }

    :root {
        --themecolor: rgb(39, 92, 158);

        --selected: rgb(28, 69, 119);
        --hover: rgba(28, 69, 119, .35);

    }

    #booklist {
        margin-left: 20vw;
        width: 80vw;
        height: 100vh;
        /* background-color: red; */
    }

    .active2 {
        border-left: 4px solid white;
        background-color: var(--selected);
    }

    header {
        height: 8vh;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form {
        border-bottom: 1.3px solid gray;
        /* padding: 5px 0; */
        width: 300px;
    }

    a>i {
        font-size: 1.2rem;
    }

    button {
        border: none;
        outline: none;
        background: none;
    }

    #search {
        width: 250px;
        padding: 5px;
        border: none;
        margin-left: 10px;
        outline: none;
    }

    main {
        width: 80%;
        margin: auto;
    }

    table {
        text-align: center;
        width: 100%;
        margin-top: 8px;
        font-size: .9rem;
    }

    th {
        font-size: .9rem;
    }

    tr {
        height: 50px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.25);
    }

    tr:first-child {
        height: 35px;
        border-bottom: 2px solid gray;
    }

    tr:last-child {
        border-bottom: 0;
    }

    tr:nth-child(2) {
        border: none;
        height: 30px;
    }

    tr>th:nth-child(3) {
        width: 35%;
    }

    tr>th:last-child {
        width: 25%;
    }

    .btn {
        font-size: .8rem;
        padding: 5px 10px;
    }

    .pagination {
        margin-top: 10px;
    }

    .pages {
        position: absolute;
        bottom: 20px;
        left: 40%;
        display: flex;
        justify-content: space-between;
        width: 450px;
        /* background-color: blue; */
        margin: auto;
    }

    .pages>a {
        padding: 3px 8px;
    }

    .fa-angles-right {
        padding-top: 3px;
    }

    .left-arr {
        padding-bottom: 3px;
    }
    </style>
</head>

<body>
    <?php
    include("./menus.php")
        ?>

    <div id="booklist">
        <header>
            <form action="searchbook.php" method="get">
                <button type="submit" value=""><i class=" ri-search-line"></i></button>
                <input type="text" id="search" name="st" required placeholder="Search" autocomplete="off">
            </form>
        </header>
        <!-- pagination -->
        <?php
        include("../subfiles/database/dbconnect.php");
        $noOfBook = 10;
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
        $totalSql = "select * from books";
        $totalRes = $conn->query($totalSql);
        $total = $totalRes->num_rows;

        ?>

        <main>
            <table>
                <tr>
                    <th>ISBN</th>
                    <th>Book</th>
                    <th>Title</th>
                    <th>Published</th>
                    <th>Action</th>

                </tr>
                <tr></tr>
                <?php

                $bookSql = "SELECT * FROM books limit $start,$noOfBook";

                $bookRes = $conn->query($bookSql);
                while ($bookItem = $bookRes->fetch_assoc()) {
                    echo
                        '
                            <tr>
                                <td>' . $bookItem['isbn'] . '</td>
                                <td>
                                    <img src="../images/bookcovers/' . $bookItem['coverurl'] . '" alt="" style="height:40px;">
                                </td>
                                <td>' . $bookItem['title'] . '</td>
                                <td>' . $bookItem['published'] . '</td>
                                <td>
                                    <!-- edit -->
                                    <a href="./editbook.php?i=' . $bookItem['isbn'] . '&e=nu " class="btn btn-outline-dark px-1 py-0 mr-2"><i class="ri-edit-fill"></i></a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-danger shadow-none px-1 py-0 ml-2" data-toggle="modal"
                                        data-target="#exampleModalCenter' . $bookItem['isbn'] . '">
                                        <i class="ri-delete-bin-2-line" style="font-weight:light;font-size:1.2rem;"></i>
                                       
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter' . $bookItem['isbn'] . '" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                ' . $bookItem['title'] . '
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        ';
                }
                ?>

            </table>
        </main>
        <div class="pagination">

            <?php

            $noOfPage = ceil($total / $noOfBook);
            $threshold = 3;
            echo '<div class="pages">';
            if ($currentPage != 1)
                echo "<a href='?p=" . ($currentPage > 1 ? $currentPage - 1 : 1) . "' class='btn btn-outline-success' style='text-decoration:none; width:60px;'><i class='fa-solid fa-angles-right left-arr' style='font-size:.8rem;transform:rotate(180deg);'></i></a>";
            else
                echo "<a style='opacity:0;pointer-events:none;'></a>";
            if ($noOfPage > 4) {
                if ($currentPage >= $threshold) {
                    if ($currentPage >= ($noOfPage - 2)) {
                        for ($i = 1; $i < 3; $i++) {
                            if ($i == $currentPage) {
                                echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                            } else {
                                echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;'>" . $i . "</a>";

                            }

                        }
                        echo "<a href='' style='pointer-events:none;' class='btn btn-outline-success'>...</a>";
                        for ($i = $noOfPage - 2; $i <= $noOfPage; $i++) {
                            if ($i == $currentPage) {
                                echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                            } else {
                                echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;'>" . $i . "</a>";
                            }
                        }
                    } else {
                        if ($currentPage > 2) {

                            for ($i = 1; $i < 2; $i++) {
                                echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;'>" . $i . "</a>";
                            }
                        }
                        echo "<a href='' style='pointer-events:none;' class='btn btn-outline-success'>...</a>";


                        for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) {
                            if ($i == $currentPage)
                                echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                            else
                                echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;'>" . $i . "</a>";

                        }
                        echo "<a href='' style='pointer-events:none;' class='btn btn-outline-success'>...</a>";

                        for ($i = $noOfPage - 1; $i <= $noOfPage; $i++) {
                            echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;'>" . $i . "</a>";


                        }
                    }
                } else {
                    for ($i = 1; $i < 3; $i++) {
                        if ($i == $currentPage)
                            echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                        else
                            echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;'>" . $i . "</a>";

                    }
                    echo "<a href='' style='pointer-events:none;' class='btn btn-outline-success'>...</a>";

                    for ($i = $noOfPage - 1; $i <= $noOfPage; $i++) {
                        if ($i == $currentPage) {

                            echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;background:#28a745;'>" . $i . "</a>";
                        } else {
                            echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;'>" . $i . "</a>";

                        }


                    }

                }
            } else {
                for ($i = 1; $i <= $noOfPage; $i++) {
                    if ($i == $currentPage) {
                        echo "<a href='?p=$i' class='btn btn-outline-success' style='text-decoration:none;background:#28a745;color:white;'>" . $i . "</a>";
                    } else {

                        echo "<a href='?p=$i' class='btn btn-outline-success'style='text-decoration:none;'>" . $i . "</a>";
                    }
                }
            }
            if ($currentPage != $noOfPage)
                echo "<a href='?p=" . ($currentPage == $noOfPage ? $currentPage : $currentPage + 1) . "' class='btn btn-outline-success' style='text-decoration:none; width:60px;'><i class='fa-solid fa-angles-right' style='font-size:.8rem;'></i></a>";
            else
                echo "<a style='opacity:0;pointer-events:none;' class='btn btn-outline-success'></a>";
            echo '</div>';
            ?>

        </div>
    </div>

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