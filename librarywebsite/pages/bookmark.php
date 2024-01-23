<?php
if (!session_id())
    session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <title>Library</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    body {
        width: 100%;
        overflow-x: hidden;
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

    .delete-btn {
        padding: 10px 16px;
        border-radius: 50%;
        background-color: rgb(252, 85, 85);
        position: absolute;
        top: -5%;
        right: -5%;
        z-index: 15;
        cursor: pointer;
        transition: transform .3s ease;
    }

    .delete-btn:hover {

        background-color: rgb(252, 85, 85);
        animation: deletehover .7s linear infinite;
    }

    @keyframes deletehover {
        0% {
            transform: rotate(0deg) scale(1);
        }

        25% {
            transform: rotate(20deg) scale(1.1);

        }

        50% {
            transform: rotate(0deg) scale(1);

        }

        75% {
            transform: rotate(-20deg) scale(1.1);

        }

        100% {
            transform: rotate(0deg) scale(1);

        }
    }
    </style>
</head>

<body>
    <?php
    include("../subfiles/database/dbconnect.php");
    //navbar
    include("../subfiles/navbar.php");
    ?>
    <section id="bookmarks">
        <div class="h2 my-0 mb-5" style="display:flex;align-items:center;color:gray;">
            <i class="fa-solid fa-star mr-2 pt-1" style="font-size:1rem;"></i>Your Bookmarks

        </div>
        <div class="books mt-4">
            <!-- card -->
            <?php
            if (isset($_SESSION["login"])) {
                $userId = $_SESSION['userid'];
            }
            $bookmarksql = "SELECT * FROM `bookmarks` where userId=$userId";

            $bookmarkresult = mysqli_query($conn, $bookmarksql);
            if (mysqli_num_rows($bookmarkresult) == 0) {
                echo '<div class="lead mt-5 pt-5">No books marked yet. <a href="#" onclick="redirectToBrowse()">Browse</a></div>';
            } else {
                //each book marked by user -> get isbn
                while ($bookmarkrow = mysqli_fetch_assoc($bookmarkresult)) {
                    $bookmarkIsbn = $bookmarkrow["isbn"];

                    $sql = "SELECT * from books where isbn=$bookmarkIsbn";
                    $result = mysqli_query($conn, $sql);
                    // Fetch the result as an associative array
                    while ($row = mysqli_fetch_assoc($result)) {
                        $isbn = $row["isbn"];
                        $genreName = "";
                        // genre name from bookgenres and genres table
                        $genresql = "SELECT * FROM bookgenres bg inner join genres g on bg.genreId=g.genreId where bg.isbn=$isbn";

                        $genreresult = $conn->query($genresql);
                        while ($genreItem = $genreresult->fetch_assoc()) {
                            $genreName = $genreItem["gname"];
                        }
                        echo '
                                <div class="card mr-5 mb-5" style="width: 11rem;height:310px;background:none;border:none;position:relative;">
                                <a href="handleremovebookmark.php?i=' . $isbn . '" class="delete-btn" style="color:black;"><i class="fa-solid fa-xmark"></i></a>
                                    <a href="viewbook.php?i=' . $isbn . '&a=n&aa=n" class="image-cont"
                                        style="overflow:hidden;position:relative;height:85%;width:100%;border:5px solid gray;border-radius:8px;margin:0px 0px 6px 0px;transition: all .3s ease;"
                                        onmouseover="this.style.border=`5px solid #5cb85c`;this.style.transform=`scale(1)`"
                                        onmouseout="this.style.border=`5px solid gray`;this.style.transform=`scale(1)`">
                                        <img src="../images/bookcovers/' . $row['coverurl'] . '" style="height:100%;width:100%;" alt="">
                                        <div class="genre">
                                            ' . $genreName . '
                                        </div>
                                        <div class="dark"></div>
                                       <div class="view" style="transition:transform .25s ease;">
                                            View
                                       </div>
                                    </a>
                                    <div class="title" style="height:15%;width:100%;">
                                        <a href="#" class="topic text-dark hover-text-danger"
                                            style="font-weight:bold;font-size:1rem;text-decoration:none;">' . $row['title'] . '
                                        </a>
                                        <p class="year my-0" style="font-size:.9rem;">' . $row['published'] . '</p>
                                    </div>
        
                                </div>
                                ';
                    }
                }
            }
            ?>

        </div>
    </section>
    <!-- footer -->
    <?php

    include("../subfiles/footer.php");
    ?>
    <!-- Optional JavaScript -->
    <script>
    function redirectToBrowse() {
        window.location.href = '/library/pages/browse.php?submit=n';
    }
    </script>
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