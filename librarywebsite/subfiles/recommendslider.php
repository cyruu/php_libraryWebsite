<style>
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
</style>

<?php
include("./subfiles/database/dbconnect.php");
?>
<section class="top bg-dark p-2" style="margin-top:20px;height:420px;color:gray;">
    <div class="h2 my-0 "
        style="margin-left: 610px;padding:0px 0px 0 0;height:10%;display:flex;align-items:center;color:gray;">
        <i class="fa-solid fa-star mr-2 pt-1" style="font-size:1rem;"></i>Recommended Books

    </div>
    <div id="carouselExampleControls3" class="carousel slide " data-ride="carousel"
        style="width:100%;height:90%;padding:0 10px;position:relative;">
        <div class="carousel-inner h-100 ">
            <!-- first slide -->
            <div class="carousel-item active h-100">
                <div class="collection h-100 w-100"
                    style="display:flex;justify-content:space-evenly;align-items:center;">
                    <!-- card -->
                    <?php
                    $sql = "SELECT * FROM `books` order by rand() limit 5";

                    $result = $conn->query($sql);

                    // Fetch the result as an associative array
                    while ($row = $result->fetch_assoc()) {
                        $isbn = $row["isbn"];
                        $genreName = "";
                        // genre name from bookgenres and genres table
                        $genresql = "SELECT * FROM bookgenres bg inner join genres g on bg.genreId=g.genreId where bg.isbn=$isbn";

                        $genreresult = $conn->query($genresql);
                        while ($genreItem = $genreresult->fetch_assoc()) {
                            $genreName = $genreItem["gname"];
                        }
                        echo '
                        <div class="card" style="width: 11rem;height:310px;background:none;border:none;">
                            <a href="pages/viewbook.php?i=' . $isbn . '&a=n&aa=n" class="image-cont"
                                style="overflow:hidden;position:relative;height:85%;width:100%;border:5px solid white;border-radius:8px;margin:0px 0px 6px 0px;transition: all .3s ease;"
                                onmouseover="this.style.border=`5px solid #5cb85c`;this.style.transform=`scale(1.035)`"
                                onmouseout="this.style.border=`5px solid white`;this.style.transform=`scale(1)`">
                                <img src="./images/bookcovers/' . $row['coverurl'] . '" style="height:100%;width:100%;" alt="">
                                <div class="genre">
                                    ' . $genreName . '
                                </div>
                                <div class="dark"></div>
                               <div class="view" style="transition:transform .25s ease;">
                                    View
                               </div>
                            </a>
                            <div class="title" style="height:15%;width:100%;">
                                <a href="#" class="topic text-light hover-text-danger"
                                    style="font-weight:bold;font-size:1rem;text-decoration:none;">' . $row['title'] . '
                                </a>
                                <p class="year my-0" style="font-size:.9rem;">' . $row['published'] . '</p>
                            </div>

                        </div>
                        ';
                    }
                    ?>


                </div>
            </div>


            <!-- second slide -->
            <div class="carousel-item h-100">
                <div class="collection h-100 w-100"
                    style="display:flex;justify-content:space-evenly;align-items:center;">


                    <!-- card -->
                    <?php
                    $sql = "SELECT * FROM `books` order by rand() limit 5";

                    $result = $conn->query($sql);

                    // Fetch the result as an associative array
                    while ($row = $result->fetch_assoc()) {
                        $isbn = $row["isbn"];
                        $genreName = "";
                        // genre name from bookgenres and genres table
                        $genresql = "SELECT * FROM bookgenres bg inner join genres g on bg.genreId=g.genreId where bg.isbn=$isbn";

                        $genreresult = $conn->query($genresql);
                        while ($genreItem = $genreresult->fetch_assoc()) {
                            $genreName = $genreItem["gname"];
                        }
                        echo '
                        <div class="card" style="width: 11rem;height:310px;background:none;border:none;">
                            <a href="pages/viewbook.php?i=' . $isbn . '&a=n&aa=n" class="image-cont"
                                style="overflow:hidden;position:relative;height:85%;width:100%;border:5px solid white;border-radius:8px;margin:0px 0px 6px 0px;transition: all .3s ease;"
                                onmouseover="this.style.border=`5px solid #5cb85c`;this.style.transform=`scale(1.035)`"
                                onmouseout="this.style.border=`5px solid white`;this.style.transform=`scale(1)`">
                                <img src="./images/bookcovers/' . $row['coverurl'] . '" style="height:100%;width:100%;" alt="">
                                <div class="genre">
                                    ' . $genreName . '
                                </div>
                                <div class="dark"></div>
                               <div class="view" style="transition:transform .25s ease;">
                                    View
                               </div>
                            </a>
                            <div class="title" style="height:15%;width:100%;">
                                <a href="#" class="topic text-light hover-text-danger"
                                    style="font-weight:bold;font-size:1rem;text-decoration:none;">' . $row['title'] . '
                                </a>
                                <p class="year my-0" style="font-size:.9rem;">' . $row['published'] . '</p>
                            </div>

                        </div>
                        ';
                    }
                    ?>
                </div>

            </div>

        </div>
        <a class="carousel-control-prev"
            style="background:gray;height:50px;width:50px;border-radius:50%;position:absolute;top:40%;left:15px;"
            href="#carouselExampleControls3" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon text-dark" aria-hidden="true" style=""></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls3"
            style="background:gray;height:50px;width:50px;border-radius:50%;position:absolute;top:40%;right:15px;"
            role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>