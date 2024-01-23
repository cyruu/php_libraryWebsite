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

    }

    .book {
        width: 100%;
    }

    .bookdetail {
        display: flex;
        margin: 90px auto;
        width: 60vw;
        min-height: 65vh;
        background-color: rgb(251, 251, 251);
    }

    .detail {
        padding: 25px;
        font-family: 'Poppins', sans-serif;
        width: 65%;
        min-height: 100%;
    }

    .cover {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100%;
        width: 35%;
        background-color: rgb(235, 235, 235);

    }

    .cover img {
        height: 90%;
        width: 85%;

    }

    .booktitle {

        font-size: 2.4rem;

    }

    .authorgenre {
        display: flex;

    }

    .published {
        padding-left: 5px;
        color: gray;
        margin-bottom: 35px;
        font-size: .85rem;
    }

    .des {
        font-size: .8rem;
        text-align: left;
        margin-bottom: 20px;
        min-height: 130px;

    }

    .author,
    .genrecont {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: .9rem;
        margin-bottom: 15px;

    }



    .authortext,
    .genretext {
        width: 75px;

        font-weight: bold;
    }

    .authorname,
    .genrename {
        color: gray;
        font-size: .8rem;
    }

    .buttons {
        display: flex;
        margin-top: 20px;
        text-decoration: none;
    }

    .read,
    .borrow {

        padding: 8px 20px;
        background-color: red;
    }

    .read {
        margin-left: 55px;
    }

    .borrow {
        margin-left: 80px;
    }

    .related {
        min-height: 200px;
        margin: 0 auto 50px;
        width: 90%;
    }

    .relatedbooks {
        display: flex;
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

    .genrenames {}

    .image-cont:hover .genre {


        opacity: 1;

    }

    #bookmark-icon {
        position: relative;
    }

    #bookmark-icon::before {
        position: absolute;
        content: "Add to bookmark";
        text-decoration: none;
        pointer-events: none;
        font-size: .55rem;
        display: block;
        background-color: gray;
        color: white;
        padding: 4px 4px;
        top: 4px;
        left: -90px;
        opacity: 0;
        transition: all .1s ease;
    }

    #bookmark-icon:hover::before {
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
    </style>
</head>

<body>
    <?php
    include("../subfiles/database/dbconnect.php");
    //navbar
    include("../subfiles/navbar.php");
    $isbn = $_GET['i'];
    $added = $_GET['a'];
    $alreadyAdded = $_GET['aa'];
    if (isset($_SESSION['login'])) {

        $userId = $_SESSION["userid"];
    }

    ;
    //messages
    if ($added == 'y') {
        echo '
      <div class="alert alert-success alert-dismissible fade show position-absolute w-100 text-center" role="alert">
          Added to bookmarks.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      ';
    }

    if ($alreadyAdded == 'y') {
        echo '
      <div class="alert alert-danger alert-dismissible fade show position-absolute w-100 text-center" role="alert">
          Already added to bookmarks.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      ';
    }
    $sql = "SELECT * FROM `books` where isbn=$isbn";

    $result = $conn->query($sql);

    // Fetch the result as an associative array
    while ($row = $result->fetch_assoc()) {
        $t = $row['title'];
        $p = $row['published'];
        $c = $row['copies'];
        $d = $row['description'];
        $cover = $row['coverurl'];
        $pdf = $row['pdfurl'];
        echo '
            
        ';
    }
    ?>
    <section class="book">

        <div class="bookdetail">
            <div class="detail">
                <?php
                $genreName = "";
                // genre name from bookgenres and genres table
                $genresql = "SELECT * FROM bookgenres bg inner join genres g on bg.genreId=g.genreId where bg.isbn=$isbn";

                $genreresult = $conn->query($genresql);
                while ($genreItem = $genreresult->fetch_assoc()) {
                    $genreName = $genreItem["gname"];
                    $genreId = $genreItem['genreId'];
                }
                echo '
                <div style="display:flex;justify-content:space-between;align-items:center;">
                <div class="booktitle">' . $t . '</div>';
                ?>
                <?php
                if (isset($_SESSION['login'])) {
                    $bookmarkSql = "SELECT * from bookmarks where isbn=$isbn and userId=$userId";
                    $bookmarkResult = mysqli_query($conn, $bookmarkSql);
                    if (mysqli_num_rows($bookmarkResult) == 0) {
                        echo
                            '
                        <a  href="handlebookmark.php?i=' . $isbn . '" class="readlist mr-3" id="bookmark-icon"><i class="fa-regular fa-bookmark" style="font-size:2rem;color:#dc3545;"></i></a>
                        ';
                    } else {
                        echo
                            '
                    <a  href="handlebookmark.php?i=' . $isbn . '" class="readlist mr-3" id="bookmark-icon"><i class="fa-solid fa-bookmark" style="font-size:2rem;color:#dc3545;"></i></a>
                    ';
                    }
                } else {
                    echo
                        '
                    <a  href="#login" onclick="redirectToLoginThenViewbook()" class="readlist mr-3" id="bookmark-icon"><i class="fa-regular fa-bookmark" style="font-size:2rem;color:#dc3545;"></i></a>
                    ';

                }


                echo '
                </div>
                <div class="published">' . $p . '</div>
                <div class="des">
                ' . $d . '
                </div>
                <div class="authorgenre">

                    <div class="author">
                        <div class="authortext">Authors : </div>
                        <div class="authornames">
                        '; ?>
                <?php
                // genre name from bookgenres and genres table
                $authorsql = "SELECT * FROM bookauthors ba inner join authors a on ba.authorId=a.authorId where ba.isbn=$isbn";

                $authorresult = $conn->query($authorsql);
                while ($authorItem = $authorresult->fetch_assoc()) {
                    $fname = $authorItem["fname"];
                    $lname = $authorItem["lname"];
                    echo '
                                <div class="authorname">' . $fname . ' ' . $lname . '</div>
                                
                                ';
                }
                echo '
                </div>
                    </div>
                    <div class="genrecont">
                        <div class="genretext">Genre : </div>
                        <div class="genrenames">';
                ?>
                <?php
                $genreSql = "SELECT * FROM bookgenres bg inner join genres b on bg.genreId=b.genreId where ba.isbn=$isbn";

                $genreResult = $conn->query($genresql);
                while ($genreItem = $genreResult->fetch_assoc()) {
                    $gname = $genreItem['gname'];
                    echo '
                            <div class="genrename">' . $gname . '</div>
                            ';
                }
                ?>
                <?php
                echo '
                        </div>
                    </div>
                </div>';
                ?>
                <?php
                echo '
                            
                        
                <div class="buttons">
                ';
                ?>
                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    //if pdf not availabe
                    if (empty($pdf)) {
                        echo '
                        <!-- Button trigger modal -->
                        <button type="button" class="read btn btn-dark mt-4 shadow-none px-5" data-toggle="modal" data-target="#exampleModalCenter">
                        Read
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="width:375px;" role="document">
                            <div class="modal-content">
                            <div class="modal-header d-flex justify-content-center align-items-center" style="flex-direction:column;position:relative;padding-bottom:8px;" >
                                <p class="modal-title w-100  d-flex justify-content-center align-items-center" id="exampleModalCenterTitle" style="font-size:1rem;height:40px;"> <i class="ri-error-warning-line text-danger" style="font-size:3rem;position:absolute;top:5px;left:15px;"></i>Pdf not availbe for</p>
                                <p class="" style="height:30px;margin:0 0 0 8px;font-size:1.3rem;"><b>' . $t . '</b></p>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position:absolute;top:15px;right:15px;">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="font-size:.9rem;">
                                Please visit again after we have made the pdf available!
                            </div>
                            
                            </div>
                        </div>
                        </div>
                        ';
                        if ($c < 1) {

                            echo '
                            <!-- Button trigger modal -->
                            <button type="button" class="borrow btn btn-dark mt-4 shadow-none px-5" data-toggle="modal" data-target="#exampleModalCenter' . $isbn . '">
                            Borrow
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter' . $isbn . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" style="width:375px;" role="document">
                                <div class="modal-content">
                                <div class="modal-header d-flex justify-content-center align-items-center" style="flex-direction:column;position:relative;padding-bottom:8px;" >
                                    <p class="modal-title w-100  d-flex justify-content-center align-items-center" id="exampleModalCenterTitle" style="font-size:1rem;height:40px;"> <i class="ri-error-warning-line text-danger" style="font-size:3rem;position:absolute;top:5px;left:15px;"></i>Book not available for borrow</p>
                                    <p class="" style="height:30px;margin:0 0 0 8px;font-size:1.3rem;"><b>' . $t . '</b></p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position:absolute;top:15px;right:15px;">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="font-size:.9rem;">
                                    Please visit again when book is available!
                                </div>
                                
                                </div>
                            </div>
                            </div>
                            ';
                        } else {

                            echo '
                            <a href="borrow.php?i=' . $isbn . '&e=n" class="borrow btn btn-success mt-4 shadow-none px-5">Borrow</a>
                            ';
                        }
                        //pdf available
                    } else {
                        echo '
                        <a href="../subfiles/readbook.php?i=' . $isbn . '" target="_blank" class="read btn btn-danger mt-4 shadow-none px-5">Read</a>
                        ';
                        if ($c < 1) {

                            echo '
                            <!-- Button trigger modal -->
                            <button type="button" class="borrow btn btn-dark mt-4 shadow-none px-5" data-toggle="modal" data-target="#exampleModalCenter' . $isbn . '">
                            Borrow
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter' . $isbn . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" style="width:375px;" role="document">
                                <div class="modal-content">
                                <div class="modal-header d-flex justify-content-center align-items-center" style="flex-direction:column;position:relative;padding-bottom:8px;" >
                                    <p class="modal-title w-100  d-flex justify-content-center align-items-center" id="exampleModalCenterTitle" style="font-size:1rem;height:40px;"> <i class="ri-error-warning-line text-danger" style="font-size:3rem;position:absolute;top:5px;left:15px;"></i>Book not available for borrow</p>
                                    <p class="" style="height:30px;margin:0 0 0 8px;font-size:1.3rem;"><b>' . $t . '</b></p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position:absolute;top:15px;right:15px;">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="font-size:.9rem;">
                                    Please visit again when book is available!
                                </div>
                                
                                </div>
                            </div>
                            </div>
                            ';
                        } else {
                            echo '
                            <a href="borrow.php?i=' . $isbn . '&e=n" class="borrow btn btn-success mt-4 shadow-none px-5">Borrow</a>
                            ';

                        }
                    }
                } else {
                    echo
                        '
                    <a href="#" onclick="redirectToLoginThenViewbook()" class="read btn btn-dark mt-4 shadow-none px-5">Read</a>
                        
                    <a href="#" onclick="redirectToLoginThenViewbook()" class="borrow btn btn-dark mt-4 shadow-none px-5">Borrow</a>
                    ';
                }
                ?>
                <?php
                echo '

                </div>
            </div>
            <div class="cover">
                <img src="../images/bookcovers/' . $cover . '" alt="">
            </div>

        </div>
        ';
                ?>
                <!-- end of book div -->
                <section class="related bg-light">
                    <div class="h2 my-0 "
                        style="margin-left: 580px;padding:0px 0px 50px 0;height:10%;display:flex;align-items:center;color:gray;">
                        <i class="fa-solid fa-star mr-2 pt-1" style="font-size:1rem;"></i>Related Books
                    </div>
                    <div class="relatedbooks">
                        <?php
                        $sql = "SELECT * FROM `bookgenres` where genreId=$genreId";

                        $result = $conn->query($sql);

                        //get isbn of book with genreId
                        while ($row = $result->fetch_assoc()) {
                            $isbn = $row['isbn'];
                            //select book from isbn
                            $booksql = "SELECT * FROM `books` where isbn=$isbn";
                            $bookresult = $conn->query($booksql);
                            while ($books = $bookresult->fetch_assoc()) {
                                $genreName = "";
                                // genre name from bookgenres and genres table
                                $genresql = "SELECT * FROM bookgenres bg inner join genres g on bg.genreId=g.genreId where bg.isbn=$isbn";

                                $genreresult = $conn->query($genresql);
                                while ($genreItem = $genreresult->fetch_assoc()) {
                                    $genreName = $genreItem["gname"];
                                }
                                echo '
                        <div class="card" style="width: 19rem;height:310px;background:none;border:none;margin:auto;">
                            <a href="../pages/viewbook.php?i=' . $isbn . '&a=n&aa=n" class="image-cont m-auto"
                                style="overflow:hidden;position:relative;height:85%;width:60%;border:5px solid white;border-radius:8px;margin:0px 0px 0px 0px;transition: all .3s ease;"
                                onmouseover="this.style.border=`5px solid #5cb85c`;this.style.transform=`scale(1.035)`"
                                onmouseout="this.style.border=`5px solid white`;this.style.transform=`scale(1)`">
                                <img src="../images/bookcovers/' . $books['coverurl'] . '" style="height:100%;width:100%;" alt="">
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
                                echo '
                                <div class="dark"></div>
                               <div class="view" style="transition:transform .25s ease;">
                                    View
                               </div>
                            </a>
                            <div class="title" style="width:60%;margin:5px auto;">
                                <a href="#" class="topic text-dark"
                                    style="font-weight:bold;font-size:1rem;text-decoration:none;">' . $books['title'] . '
                                </a>
                                <p class="year my-0" style="font-size:.9rem;">' . $books['published'] . '</p>
                            </div>

                        </div>
                        ';
                            }
                        }
                        ?>

                    </div>
                </section>
    </section>

    <!-- footer -->
    <?php

    include("../subfiles/footer.php");
    ?>
    <!-- Optional JavaScript -->
    <script>
    function redirectToLoginThenViewbook() {
        // Use window.location.href to navigate to login.php
        window.location.href = '/library/pages/login.php?c=none&e=none&p=none&vb=<?php echo $isbn ?>';
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