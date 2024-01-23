<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <title>Library</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <?php

    //connect to database
    include("./subfiles/database/dbconnect.php");

    // navbar
    include("./subfiles/navbar.php");
    ?>

    <!-- main section` -->
    <section id="main" style="height:90vh;width:100vw;display:flex;">
        <div class="text-container"
            style="height:100%;width:50%;display:flex;justify-content:center;align-items:center;">
            <div class="h1" style="display:flex;justify-content:center;align-items:center;flex-direction:column;">
                <div class="text text-dark" style="text-align:center;font-size:3.5rem;">
                    Take a journey and<br><span class="h1" style="font-family: 'Chakra Petch', sans-serif;">connect with
                        the Books!</span>
                </div>
                <div class="text text-dark lead mt-5" style="text-align:left;">
                    Find wide range of books in our library. Search <br> the book of your best interest.
                </div>
                <a href="./pages/browse.php?submit=n" class="btn btn-danger mt-4 shadow-none">Browse</a>
            </div>
        </div>
        <div class="image-container"
            style="height:100%;width:50%;overflow:hidden;padding:30px;position:relative;display:flex;justify-content:center;">
            <div class="h2 p-2" style="position:absolute;color:white;background:rgba(0,0,0,.2);width:88%;top:64%;">
                <div style="text-align:center;font-family: 'Kaushan Script', cursive;font-size:2.5rem;">

                    Books are a uniquely portable magic
                </div>
                <div class="lead mt-3" style="margin-left:72%;">-Stephen King</div>
            </div>
            <img src="images/bookshelf.jpg" alt="" style="height:100%;width:100%;border-radius:10%;">
        </div>
    </section>

    <!-- top book section -->
    <?php
    include("./subfiles/trendingbookslider.php");
    ?>
    <!-- facts -->
    <div class="lead w-100 " style="text-align:center;margin:50px 0 15px 0;font-size:3rem;">
        Did you know?
    </div>
    <section class="facts" style="height:470px;width:100%;display:flex;justify-content:center;">
        <div class="fact-image w-50 h-100 p-5 d-flex justify-content-center">
            <img src="images/bookcollection.jpg" alt="" class="h-80 w-80 " style="border-radius:5%;">
        </div>
        <div class="fact-quotes w-50 h-100 mt-5" style="">
            <p>-If you read 20 minutes a day, you would <br>have read 1.8 million words in a year.</p>
            <p style="margin-left:400px;"> -The most sold book is the Bible.</p>
            <p>-There's a word for the fear of running <br> out of reading material. (Abibliophobia)</p>
            <p style="margin-left:400px;">-There are over 129 million <br> books in existence.</p>
            <p>-The Library of Congress is the world’s <br> largest library.</p>
            <div>
    </section>

    <!-- random books -->
    <?php

    include("./subfiles/recommendslider.php");
    ?>
    <!-- footer -->
    <?php

    include("./subfiles/footer.php");
    ?>
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