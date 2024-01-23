<?php
if (!session_id())
    session_start();

?>
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

        body {
            overflow-x: hidden;
        }

        #notification {
            width: 100%;
            min-height: 90vh;
            display: flex;
            align-items: center;
            flex-direction: column;
            /* background-color: green; */
        }

        .notis {
            min-height: 80vh;
            /* background-color: red; */
            margin-top: 30px;
        }

        .h1 {
            margin-top: 26px;
        }

        .media {
            border: 1px solid rgba(0, 0, 0, .2);
            padding: 5px 10px;
            border-radius: 10px;
            margin-bottom: 25px;
            width: 70%;
        }

        .media-body {
            display: flex;
            flex-direction: column;
        }

        .first {
            display: flex;
            justify-content: space-between;
            margin-right: 20px;
            font-size: .9rem;
            height: 24px;
        }

        .first>p {
            font-size: 1rem;
            font-weight: bold;
        }

        .reqdate {
            font-size: .9rem;
        }
    </style>
</head>

<body>
    <?php
    include("../subfiles/database/dbconnect.php");
    include("../subfiles/navbar.php");
    $userId = 0;
    if (isset($_SESSION['login'])) {
        $userId = $_SESSION['userid'];
    }
    ?>
    <div id="notification">
        <div class="notis container " style="width:62%;">
            <div class="h1" style="margin-bottom:55px;font-size:2rem">Notifications</div>
            <?php
            $notiSql = "select * from notifications where userId=$userId order by notificationId desc";
            $notiRes = mysqli_query($conn, $notiSql);
            $notiCount = $notiRes->num_rows;
            if ($notiCount == 0) {
                echo '
                    <div style="text-align:center;">No Notifications</div>
                ';
            } else {

                while ($notiItem = mysqli_fetch_assoc($notiRes)) {
                    $status = $notiItem['status'];
                    $requestId = $notiItem['requestId'];
                    //bookrequest table
                    $bookreqSql = "select * from bookrequests where requestId=$requestId";
                    $bookreqres = mysqli_query($conn, $bookreqSql);
                    while ($bookreqItem = mysqli_fetch_assoc($bookreqres)) {
                        $bookIsbn = $bookreqItem['bookIsbn'];
                        $reqdate = $bookreqItem['requestDate'];
                        //books table
                        $title = "lorem";
                        $cu = "";
                        $bookname = "select * from books where isbn=$bookIsbn";
                        $booknameres = mysqli_query($conn, $bookname);
                        // books table
                        while ($booknameItem = mysqli_fetch_assoc($booknameres)) {
                            $title = $booknameItem['title'];
                            $cu = $booknameItem['coverurl'];
                        }
                    }
                    echo '
                        <div class="media">
                            <img src="../images/bookcovers/' . $cu . '" class="mr-3" alt="..." height="45">
                            <div class="media-body">
                                <div class="first"> 
                                    <p class="mt-0">' . $title . '</p>
                                    ';
                    if ($status == 'accept') {

                        echo '
                            <span
                                class="text-success"><i class="fa-solid fa-circle-check mr-1"></i>Accepted
                            </span>';
                    } elseif ($status == 'reject') {

                        echo '
                            <span
                                class="text-danger"><i class="fa-solid fa-circle-xmark mr-1"></i>Rejected
                            </span>';
                    } elseif ($status == 'returned') {
                        echo '
                            <span
                                class="text-success"><i class="fa-solid fa-check mr-1"></i>Returned
                            </span>';
                    }


                    echo '
                                </div>
                                <div class="reqdate">
                                    Request Date: <b>' . $reqdate . '</b>
                                </div>
                            </div>
                        </div>
                        ';
                }

            }
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