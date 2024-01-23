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
    :root {
        --themecolor: rgb(39, 92, 158);

        --selected: rgb(28, 69, 119);
        --hover: rgba(28, 69, 119, .35);

    }


    * {
        margin: 0;
        padding: 0;
    }

    body {
        overflow-x: hidden;
    }

    #dashboard {
        margin-left: 20vw;
        width: 80vw;
        height: 100vh;
        /* background-color: yellow; */
    }

    .active1 {
        border-left: 4px solid white;
        background-color: var(--selected);
    }

    main {
        width: 80vw;
        margin-left: 20vw;
        min-height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

        background-color: rgb(240, 240, 240);
    }

    .grid-cont {
        width: 90%;
        min-height: 600px;
        padding-top: 50px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(3, 1fr);
        align-items: space;
        justify-items: center;
        gap: 3rem;
    }

    .grid-item {

        width: 100%;
        background-color: white;
        border-radius: 10px;
        padding: 10px;

    }

    .title {
        font-size: .9rem;
        margin-left: 10px;
        margin-bottom: 0px;
    }

    .value {
        font-size: 2.7rem;
        font-weight: bold;
        margin: 10px 0;
        color: var(--themecolor);
    }

    .text-center {
        text-align: center;
    }

    .desc {
        font-size: .7rem;
    }

    .col-span {
        grid-column: span 2;
    }

    .row-span {
        grid-row: span 2;
    }

    .genre-cont {
        display: flex;
        align-items: center;
    }

    .genre-names {
        height: 90%;
        width: 50%;
        margin-left: 55px;
        border-left: 2px solid gray;
        padding: 0 18px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(6, 1fr);
        gap: 1px;
        align-items: center;
        /* background-color: red; */
        padding-left: 35px;
    }

    .genre-name {
        font-size: .75rem;
        color: var(--themecolor);
    }

    .return-cont {}
    </style>
</head>

<body>
    <?php
    include("../subfiles/database/dbconnect.php");
    include("./menus.php")
        ?>
    <main>

        <div class="grid-cont">
            <div class="grid-item">
                <p class="title">Total users</p>
                <?php
                $userSql = "select * from users";
                $userResult = mysqli_query($conn, $userSql);
                $userCount = mysqli_num_rows($userResult);

                ?>
                <p class="value text-center">
                    <?php echo $userCount ?>
                </p>
                <p class="desc text-center">people uses our website</p>
            </div>
            <div class="grid-item">
                <p class="title">Books</p>
                <?php
                $bookSql = "select * from books";
                $bookResult = mysqli_query($conn, $bookSql);
                $bookCount = mysqli_num_rows($bookResult);

                ?>
                <p class="value text-center">
                    <?php echo $bookCount ?>
                </p>
                <p class="desc text-center">registered books</p>
            </div>
            <div class="grid-item">
                <p class="title">Read</p>
                <?php
                $readSql = "select * from bookcounts;";
                $readResult = mysqli_query($conn, $readSql);
                $readItem = mysqli_fetch_assoc($readResult);
                $readCount = $readItem['readCount'];
                ?>
                <p class="value text-center">
                    <?php echo $readCount ?>
                </p>
                <p class="desc text-center">total books read online by users</p>
            </div>
            <div class="grid-item">
                <p class="title">Borrowed</p>
                <p class="value text-center">203</p>
                <p class="desc text-center">total books borrowed by users</p>
            </div>
            <div class="grid-item">
                <p class="title">Available</p>
                <?php
                $bookSql = "select * from books where copies>0";
                $bookResult = mysqli_query($conn, $bookSql);
                $bookCount = mysqli_num_rows($bookResult);

                ?>
                <p class="value text-center">
                    <?php echo $bookCount ?>
                </p>
                <p class="desc text-center">books available for borrow right now</p>
            </div>
            <div class="grid-item col-span genre-cont">
                <div class="genre-count mx-3">

                    <p class="title">Genres</p>
                    <?php
                    $genreSql = "select * from genres";
                    $genresResult = mysqli_query($conn, $genreSql);
                    $genreCount = mysqli_num_rows($genresResult);
                    ?>
                    <p class="value text-center">
                        <?php echo $genreCount; ?>
                    </p>
                    <p class="desc text-center">genres registered at the moment</p>
                </div>
                <div class="genre-names">
                    <?php
                    while ($genreItem = mysqli_fetch_assoc($genresResult)) {
                        echo '<div class="genre-name">' . $genreItem['gname'] . '</div>';
                    }
                    ?>

                </div>
            </div>
            <div class="grid-item">
                <p class="title">Requests</p>
                <div class="return1 mb-5">
                    <div class="value text-center">

                        <?php
                        $reqSql = "select * from bookrequests";
                        $reqres = mysqli_query($conn, $reqSql);
                        $reqcount = mysqli_num_rows($reqres);
                        echo $reqcount;
                        ?>

                    </div>
                    <div class="desc text-center">total requests for books</div>
                </div>
            </div>


        </div>
    </main>

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