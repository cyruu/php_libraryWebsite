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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        #borrowed {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            width: 100vw;
            /* background-color: red; */
        }

        .details {
            min-height: 80vh;
            margin-top: 40px;
            width: 60%;
            /* background-color: blue; */
        }

        .details .h2 {
            margin-bottom: 65px;
        }

        .media {
            padding: 10px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            margin-bottom: 40px;
        }

        .media>img {
            height: 110px;
        }

        .title-status {
            display: flex;
            justify-content: space-between;
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
            margin-top: 10px;
            display: flex;
            font-size: .9rem;
            font-weight: 500;
        }

        .rt {
            margin-left: 100px;
        }

        .days {
            margin-top: 10px;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <?php

    include("../subfiles/database/dbconnect.php");

    include("../subfiles/navbar.php");
    if (isset($_SESSION['login'])) {
        $userId = $_SESSION['userid'];
    }

    ?>
    <div id="borrowed">
        <div class="details">
            <div class="h2">Borrowed books</div>
            <div class="books">
                <?php
                //request
                $borrowed = "";
                $return = "";

                // all books that was accepted to borrow by admin
                $sql = "select * from bookrequests where userId=$userId and status='accept'";
                $res = mysqli_query($conn, $sql);
                $noOfBoroowedBooks = $res->num_rows;
                if ($noOfBoroowedBooks == 0) {
                    echo "no borrowed books";
                } else {

                    // bookrequests table
                    while ($item = mysqli_fetch_assoc($res)) {
                        $borrowed = $item['requestDate'];

                        $isbn = $item['bookIsbn'];
                        $requestId = $item['requestId'];
                        $daysRemaining = 0;
                        //get no of days remaining
                        $datesql = "select DATEDIFF(returnDate,CURRENT_DATE) as days from bookrequests where requestId=$requestId";
                        $dateRes = mysqli_query($conn, $datesql);
                        while ($dateItem = mysqli_fetch_assoc($dateRes)) {
                            $daysRemaining = $dateItem['days'];
                        }
                        //get book name
                        $title = "lorem";
                        $cu = "";
                        $p = 0;
                        $bookname = "select * from books where isbn=$isbn";
                        $booknameres = mysqli_query($conn, $bookname);
                        // books table
                        while ($booknameItem = mysqli_fetch_assoc($booknameres)) {
                            $title = $booknameItem['title'];
                            $cu = $booknameItem['coverurl'];
                            $p = $booknameItem['published'];
                        }
                        echo
                            '
                        <div class="media">
                            <img src="../images/bookcovers/' . $cu . '" class="mr-4" alt="...">
                            <div class="media-body">
                                <div class="title-status">
                                    <h5 class="mt-0">' . $title . ' <span id="pub">(' . $p . ')</span> </h5>
                                    <p class="text-success">Currently borrowed</p>
                                </div>
                                
                                <div class="brw-rt">
                                    <div class="brw">Borrow Date:&nbsp; ' . $borrowed . ' </div>
                                    <div class="rt">Return Date: &nbsp;' . $return . '</div>
                                </div>
                                ';
                        ?>
                        <?php
                        if ($daysRemaining > 0) {

                            echo '
                                    <p class="text-success days">' . $daysRemaining . ' days remaining.</p>
                                    ';
                        } else {
                            echo '
                                    <p class="text-danger days">The borrowing time has expired. Please retun the book.</p>
                                    ';

                        }
                        ?>
                        <?php
                        echo '
                            </div>
                        </div>
                        ';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
</body>

</html>