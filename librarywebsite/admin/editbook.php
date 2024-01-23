<?php
//connect to database
include("../subfiles/database/dbconnect.php");
$isbn = $_GET['i'];
$bookSql = "select * from books where isbn=$isbn";
$bookRes = $conn->query($bookSql);
$t = "";
$p = 0;
$c = 0;
$g = "";
$d = "";
$af = "";
$al = "";
$cu = "";
$pdf = "";
$genreId = 1;
while ($item = $bookRes->fetch_assoc()) {
    $t = $item['title'];
    $p = $item['published'];
    $c = $item['copies'];
    $cu = $item['coverurl'];
    $pdf = $item['pdfurl'];
    $d = $item['description'];
}
//get genre
//get genre id
$genreSql = "select * from bookgenres where isbn=$isbn";
$genreRes = $conn->query($genreSql);
while ($genreItem = $genreRes->fetch_assoc()) {
    $genreId = $genreItem['genreId'];
}
//gernre name
$genrenameSql = "select * from genres where genreId=$genreId";
$genrenameRes = $conn->query($genrenameSql);
while ($genrenameItem = $genrenameRes->fetch_assoc()) {
    $g = $genrenameItem['gname'];
}
//get author
//get author id
$authorSql = "select * from bookauthors where isbn=$isbn";
$authorRes = $conn->query($authorSql);
while ($authorItem = $authorRes->fetch_assoc()) {
    $authorId = $authorItem['authorId'];
}
//author name
$authornameSql = "select * from authors where authorId=$authorId";
$authornameRes = $conn->query($authornameSql);
while ($authornameItem = $authornameRes->fetch_assoc()) {
    $af = $authornameItem['fname'];
    $al = $authornameItem['lname'];
}
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

    :root {
        --themecolor: rgb(39, 92, 158);

        --selected: rgb(28, 69, 119);
        --hover: rgba(28, 69, 119, .35);

    }

    body {
        overflow-x: hidden;
    }

    .form-control:focus {
        box-shadow: none;
    }

    #addbook {
        margin-left: 20vw;
        width: 80vw;
        min-height: 100vh;
        background-color: rgb(240, 240, 240);
        position: relative;
        padding-bottom: 50px;
        /* background-color: green; */
    }

    .active2 {
        border-left: 4px solid white;
        background-color: var(--selected);
    }

    .second-cont {
        display: flex;
        justify-content: space-between;
    }

    input[type="file"] {
        display: none;
    }

    .cover-cont>label,
    .pdf-cont>label {

        height: 50px;
        width: 160px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgb(82, 174, 157);
        color: white;
        margin: 0;
    }

    label>i {
        font-size: 1.5rem;
        margin-right: 10px;
    }

    .form-img {
        display: flex;
    }

    .img-cont {
        height: 400px;
        width: 280px;
        /* background-color: red; */
        border: 3px solid grey;
    }

    .img-cont>img {
        height: 100%;
        width: 100%;
    }

    .back:hover {
        text-decoration: none;
        color: black;
    }

    #addbook .alert {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 300px;
        height: 100px;
        z-index: 10;
        /* box-shadow: 0px 0px 1000px rgba(0, 0, 0, 1.7); */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .alpha-bg {
        background-color: rgba(0, 0, 0, .75);
        height: 100%;
        width: 100%;
        position: absolute;
    }

    .alert {
        background-color: white;
    }
    </style>
</head>

<body>
    <?php
    include("./menus.php");
    $updated = $_GET['e'];
    ?>

    <div id="addbook">
        <?php
        if ($updated == "u") {
            echo
                '
                <div class="alpha-bg"></div>
                <div class="alert m-0 alert-success alert-dismissible fade show position-absolute text-center" role="alert">
                    <p id="text-up" class="mt-3"></p>
                    <button type="button" id="close-btn" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" >&times;</span>
                    </button>
                </div>

                ';
        }
        ?>
        <div class="topic w-100" style="text-align:center;position:relative;">
            <a href="./booklist.php" class="back" style="position:absolute;left:100px;top:20px;color:black;"><i
                    class="ri-arrow-left-line" style="font-size:2rem;"></i></a>
            <div class="h1 py-4" style="">Edit Book</div>

        </div>
        <div class="form-img">
            <form class="container" style="width:60%;margin:0 65px;" action="handleedit.php?i=<?php echo $isbn ?>"
                method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Book Title</label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" value="<?php echo $t; ?>" required>

                </div>
                <div class="second-cont">

                    <div class="form-group">
                        <label for="published">Published</label>
                        <input type="number" class="form-control" name="published" id="published"
                            value="<?php echo $p; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="copies">Copies</label>
                        <input type="number" class="form-control" name="copies" id="copies" value="<?php echo $c; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select name="gs" class="genre-option form-control" style="width:200px;" required>
                            <option value="<?php echo $g; ?>" selected>
                                <?php echo $g; ?>
                            </option>
                            <?php
                            $optionSql = "select * from genres";
                            $optionResult = mysqli_query($conn, $optionSql);
                            while ($optionItem = mysqli_fetch_assoc($optionResult)) {
                                echo '
                                <option value="' . $optionItem['gname'] . '" class="">' . $optionItem['gname'] . '</option>
                                ';
                            }
                            ?>


                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="des">Description</label>
                    <textarea name="description" id="des" class="form-control" name="des" maxlength="500"
                        style=" width:100%;height:170px;" required></textarea>
                </div>
                <div class="second-cont">

                    <div class="form-group w-50 mr-4">
                        <label for="fname">Author's First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $af; ?>"
                            required>
                    </div>
                    <div class="form-group w-50 ml-4">
                        <label for="lname">Author's Last Name</label>
                        <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $al; ?>"
                            required>
                    </div>

                </div>
                <div class="second-cont mt-0">
                    <?php
                    if (empty($pdf)) {
                        echo '
                        
                            <div class="form-group w-50 pdf-cont d-flex m-0">
                            <label for="pdf"><i class="ri-file-pdf-2-line"></i>Attatch PDF</label>
                            <p class="ml-3 text-danger">PDF for this book is <br>not available.</p>
                            <input type="file" class="" name="pdf" id="pdf">

                </div>
                        
                ';
                    }
                    ?>


                </div>

                <input type="submit" class="btn btn-dark" style="width:130px;" value="Save Changes">



            </form>

            <div class="img-cont">
                <img src="../images/bookcovers/<?php echo $cu; ?>" alt="">
            </div>
        </div>

    </div>

    <!-- Optional JavaScript -->
    <script>
    const textArea = document.getElementById("des");
    des.innerText = '<?php echo $d; ?>';

    const alphaBg = document.getElementsByClassName("alpha-bg");
    const alertDisplay = document.getElementsByClassName("alert");
    const closeBtn = document.getElementById("close-btn");
    const textUp = document.getElementById("text-up");
    alphaBg[0].addEventListener("click", () => {
        alphaBg[0].style.display = "none";
        alphaBg[0].style.pointerEvents = "none";
        alertDisplay[0].style.pointerEvents = "none";
        alertDisplay[0].style.display = "none";
    })
    closeBtn.addEventListener("click", () => {
        alphaBg[0].style.display = "none";
        alphaBg[0].style.pointerEvents = "none";
    })
    textUp.innerHTML =
        `<div class="spinner-border " role="status"><span class="sr-only ">Loading</span></div><div class="mt-2">Saving...</div>`;
    setTimeout(() => {
        textUp.innerText = "Your changes has been saved";
    }, 800);
    </script>
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