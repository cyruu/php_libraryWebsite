<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

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

    body {
        overflow-x: hidden;
    }

    #request {
        margin-left: 20vw;
        width: 80vw;
        min-height: 100vh;
        padding: 35px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        /* background-color: green; */
    }

    .active3 {
        border-left: 4px solid white;
        background-color: var(--selected);
    }

    .media {
        padding: 10px;
        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        margin-bottom: 30px;
    }

    .media>img {
        height: 90px;
    }

    .title-status {
        display: flex;
        justify-content: space-between;
        height: 28px;
    }

    .title-status>h5 {
        font-size: 1.4rem;
    }

    .title-status>p {
        font-size: .9rem;
        margin-right: 30px;
    }

    #pub {
        font-size: .9rem;
        font-weight: light;
    }

    .brw-rt {
        margin-top: 0px;
        display: flex;
        font-size: .9rem;
        font-weight: 500;
    }

    .brw {
        width: 320px;
        /* background-color: red; */
    }

    .rt {
        margin-left: 10px;
    }

    .requests {

        width: 70%;
        /* background-color: red; */
        min-height: 75vh;
    }

    #descr {
        margin-bottom: 6px;
        font-size: .9rem;
    }

    .btn {
        font-size: .9rem;
        padding: 5px 10px;
    }

    .btn {
        font-size: .8rem;
        padding: 5px 10px;
    }

    .pagination {
        margin-top: 10px;
    }

    .pages {
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
    include("../subfiles/database/dbconnect.php");
    if (isset($_SESSION['login'])) {
        $userId = $_SESSION['userid'];
    }
    include("./menus.php");
    $noOfBook = 5;
    $start = 0;
    $currentPage = 1;
    $noRequests = true;
    if (isset($_GET["p"])) {
        $currentPage = $_GET["p"];
        if ($currentPage >= 1) {
            $start = ($currentPage - 1) * $noOfBook;
        } else {
            $start = 0;
        }
    }
    $totalSql = "select * from bookrequests where status='pending'";
    $totalRes = $conn->query($totalSql);
    $total = $totalRes->num_rows;
    ?>

    <div id="request">
        <div class="h2 text-dark mb-5" style="text-align:center;">Book Requests</div>
        <div class="requests container">
            <?php
            $requestSql = "select * from bookrequests where status='pending' order by requestDate desc limit $start,$noOfBook";
            $requestRes = mysqli_query($conn, $requestSql);
            $requestCount = $requestRes->num_rows;
            if ($requestCount == 0) {
                echo '
                    <div class="lead" style="font-size:2.5rem;text-align:center;margin-top:100px;">
                    <i class="ri-error-warning-fill text-danger" ></i> No Requests.
                    </div>
                ';

            }
            // there are book requests
            else {
                $noRequests = false;
                while ($requestItem = mysqli_fetch_assoc($requestRes)) {
                    $requestId = $requestItem['requestId'];
                    $userId = $requestItem['userId'];
                    $bookIsbn = $requestItem['bookIsbn'];
                    $requestDate = $requestItem['requestDate'];
                    $fname = $requestItem['fname'];
                    $lname = $requestItem['lname'];
                    $descr = $requestItem['descr'];
                    $email = $requestItem['email'];
                    // book detail rom book isbn
                    $bookSql = "select * from books where isbn=$bookIsbn";
                    $bookRes = mysqli_query($conn, $bookSql);
                    $bookItem = mysqli_fetch_assoc($bookRes);
                    $title = $bookItem['title'];
                    $published = $bookItem['published'];
                    $coverurl = $bookItem['coverurl'];
                    $copies = $bookItem['copies'];
                    // get user detail from userId
                    $userSql = "select * from users where id=$userId";
                    $userRes = mysqli_query($conn, $userSql);
                    $userItem = mysqli_fetch_assoc($userRes);
                    $username = $userItem['username'];

                    echo '
                    
                    <div class="media">
                        <img src="../images/bookcovers/' . $coverurl . '" class="mr-4" alt="...">
                        <div class="media-body">
                            <div class="title-status mb-1">
                                <h5 class="mt-0">' . $title . ' <span style="font-size:.9rem;">(' . $published . ')</span> <span style="font-size:.8rem;margin-left:15px;">from&nbsp;<b>-' . $username . '</b></span></h5>
                                <p class="text-success">Pending</p>
                            </div>
                            <p id="descr">' . $descr . '</p>
                            <div class="brw-rt">
                                <div class="brw">Name:&nbsp; <b>' . $fname . ' ' . $lname . '</b> </div>
                                <div class="rt">Email:&nbsp; <b>' . $email . '</b></div>
                            </div>
                            <div class="brw-rt mb-2">
                                <div class="brw">Request Date:&nbsp; <b>' . $requestDate . '</b> </div>
                            </div>
                            <div class="brw-rt">
                            ';
                    ?>
            <?php
                    if ($copies > 0) {

                        echo '
                                    <a href="handleaccept.php?ri=' . $requestId . '" class="btn btn-success"><i class="ri-check-line"></i> Accept</a>
                                    ';
                    } else {
                        echo
                            '
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="ri-check-line"></i> Accept
                        </button>

                        <!-- Modal -->
                        <div class="modal fade"  id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="height:80px;padding-top:12px;">
                            <div class="modal-header" style="border:none;">
                            <span style="width:100%;text-align:center;">This book is unavailable at moment</span>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            </div>
                        </div>
                        </div>
                        ';
                    }
                    echo '
                                <a href="./handlereject.php?ri=' . $requestId . '" class="btn btn-danger ml-3 "><i class="ri-close-circle-line"></i> Reject</a>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }
            ?>
        </div>
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
            if ($currentPage != $noOfPage && !$noRequests)
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