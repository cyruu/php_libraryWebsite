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

    body {
        overflow-x: hidden;
    }

    #manage {
        margin-left: 20vw;
        width: 80vw;
        height: 100vh;
        /* background-color: red; */
    }

    .active5 {
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
    </style>
</head>

<body>
    <?php
    include("./menus.php")
        ?>

    <div id="manage">
        <?php
        include("../subfiles/database/dbconnect.php");
        $userId = 0;
        if (isset($_SESSION['login'])) {
            $userId = $_SESSION['userid'];
        }
        ?>

        <div id="request">
            <div class="h2 text-dark mb-5 pt-5" style="text-align:center;">Borrowed Books</div>
            <div class="requests container">
                <?php
                $requestSql = "SELECT * FROM acceptedbooks ab inner join bookrequests br on ab.requestId=br.requestId inner join books b on br.bookIsbn=b.isbn inner join users u on br.userId=u.id";
                $requestRes = mysqli_query($conn, $requestSql);
                $requestCount = $requestRes->num_rows;
                if ($requestCount == 0) {
                    echo '
                    <div class="lead" style="font-size:2.5rem;text-align:center;margin-top:100px;">
                    <i class="ri-error-warning-fill text-danger" ></i> No books borrowed.
                    </div>
                ';

                }
                // there are book borrowed
                else {
                    while ($requestItem = mysqli_fetch_assoc($requestRes)) {
                        $requestId = $requestItem['requestId'];
                        $borrowDate = $requestItem['borrowDate'];
                        $returnDate = $requestItem['returnDate'];
                        $bookIsbn = $requestItem['bookIsbn'];
                        $username = $requestItem['username'];
                        $fname = $requestItem['fname'];
                        $lname = $requestItem['lname'];
                        $email = $requestItem['email'];
                        $title = $requestItem['title'];
                        $published = $requestItem['published'];
                        $coverurl = $requestItem['coverurl'];

                        echo '
                    
                    <div class="media">
                        <img src="../images/bookcovers/' . $coverurl . '" class="mr-4" alt="...">
                        <div class="media-body">
                            <div class="title-status mb-1">
                                <h5 class="mt-0">' . $title . ' <span style="font-size:.9rem;">(' . $published . ')</span> <span style="font-size:.8rem;margin-left:15px;">to&nbsp;<b>-' . $username . '</b></span></h5>
                                <p class="text-success">Waiting</p>
                            </div>
                            <div class="brw-rt">
                                <div class="brw">Name:&nbsp; <b>' . $fname . ' ' . $lname . '</b> </div>
                                <div class="rt">Email:&nbsp; <b>' . $email . '</b></div>
                            </div>
                            <div class="brw-rt mb-2">
                                <div class="brw">Borrowed Date:&nbsp; <b>' . $borrowDate . '</b> </div>
                                <div class="rt">Return Date:&nbsp; <b>' . $returnDate . '</b> </div>
                            </div>
                            <div class="brw-rt mb-0">';
                        ?>
                <?php
                        $daysRemaining = 0;
                        //get no of days remaining
                        $datesql = "select DATEDIFF(returnDate,CURRENT_DATE) as days from acceptedbooks where requestId=$requestId";
                        $dateRes = mysqli_query($conn, $datesql);
                        while ($dateItem = mysqli_fetch_assoc($dateRes)) {
                            $daysRemaining = $dateItem['days'];
                        }
                        if ($daysRemaining > 0) {
                            echo '
                                    <div class="brw text-success"><a href="handlereturned.php?r=' . $requestId . '" class="btn btn-success text-light mr-3">Reclaim</a>' . $daysRemaining . ' days remaining </div>
                                    ';
                        } else {
                            echo '
                                    <div class="brw text-danger"><a href="handlereturned.php?r=' . $requestId . '" class="btn btn-success text-light mr-3">Reclaim</a>Borrow time has expired! </div>
                                    ';

                        }
                        echo '
                            </div>
                            </div>
                            </div>
                            
                            
                            ';
                        ?>
                <?php


                    }
                }
                ?>
            </div>

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
                integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
                integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
                crossorigin="anonymous">
            </script>
</body>

</html>