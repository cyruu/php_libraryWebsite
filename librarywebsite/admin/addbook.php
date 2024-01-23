<?php
//connect to database
include("../subfiles/database/dbconnect.php");
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

    #addbook {
        margin-left: 20vw;
        width: 80vw;
        height: 100vh;
        position: relative;
        /* background-color: green; */
    }

    .alpha-bg {
        background-color: rgba(0, 0, 0, .75);
        height: 100%;
        width: 100%;
        position: absolute;
    }

    .active4 {
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
        width: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgb(82, 174, 157);
        color: white;
    }

    label>i {
        font-size: 1.5rem;
        margin-right: 10px;
    }

    .form-control:focus {
        box-shadow: none;
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

    .alert {
        background-color: white;
    }
    </style>
</head>

<body>
    <?php
    include("./menus.php");
    $addded = $_GET['a'];
    ?>

    <div id="addbook">
        <?php
        if ($addded == "y") {
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
        <div class="topic w-100" style="text-align:center;">
            <div class="h1 py-4" style="">Add Book</div>

        </div>
        <form class="container" style="width:60%;" action="handleadd.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Book Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" required>

            </div>
            <div class="second-cont">

                <div class="form-group">
                    <label for="published">Published</label>
                    <input type="number" class="form-control" name="published" id="published" required>
                </div>
                <div class="form-group">
                    <label for="copies">Copies</label>
                    <input type="number" class="form-control" name="copies" id="copies" required>
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <select name="gs" class="genre-option form-control" style="width:200px;" required>
                        <option value="" selected>All</option>
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
                <textarea name="description" id="des" class="form-control" name="des" style="width:100%;height:100px;"
                    required></textarea>
            </div>
            <div class="second-cont">

                <div class="form-group w-50 mr-4">
                    <label for="fname">Author's First Name</label>
                    <input type="text" class="form-control" name="fname" id="fname" required>
                </div>
                <div class="form-group w-50 ml-4">
                    <label for="lname">Author's Last Name</label>
                    <input type="text" class="form-control" name="lname" id="lname" required>
                </div>

            </div>
            <div class="second-cont mt-3">

                <div class="form-group w-50 mr-4 cover-cont">
                    <label for="cover"><i class="ri-file-image-line"></i>Upload Cover Image</label>
                    <input type="file" class="" name="coverurl" id="cover" required>
                </div>
                <div class="form-group w-50 ml-4 pdf-cont">
                    <label for="pdf"><i class="ri-file-pdf-2-line"></i>Attatch PDF</label>
                    <input type="file" class="" name="pdf" id="pdf">

                </div>

            </div>

            <input type="submit" name="submit" class="btn btn-dark mt-3" style="width:130px;" value="Add Book">

        </form>
    </div>

    <!-- Optional JavaScript -->
    <script>
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
        `<div class="spinner-border " role="status"><span class="sr-only ">Loading</span></div><div class="mt-2">Adding...</div>`;
    setTimeout(() => {
        textUp.innerText = "New book has been added.";
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