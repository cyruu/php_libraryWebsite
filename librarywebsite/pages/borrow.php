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

        #borrow {
            height: 90vh;
            width: 100vw;
            /* background-color: red; */
            /* padding: 0 50px; */
            position: relative;

        }

        .h1 {
            /* background-color: blue; */
            text-align: center;
            padding: 15px 0;
        }

        .form-control:focus {
            background-color: red;
        }

        .second-cont {
            display: flex;
            justify-content: space-between;
        }

        #area {
            height: 100px;
        }

        .form-img {
            margin-top: 50px;
            display: flex;
        }

        .img-cont {
            height: 350px;
            width: 240px;
            /* background-color: red; */
        }

        .img-cont>img {
            border: 3px solid grey;
            height: 100%;
            width: 100%;
        }

        .form-img>form {
            margin: 0 140px;
        }

        #borrow .alert {
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

        #borrow .alert {
            background-color: white;
        }
    </style>
</head>

<body>
    <?php
    $isbn = $_GET['i'];
    $updated = $_GET['e'];
    include("../subfiles/database/dbconnect.php");
    //navbar
    $bookSql = "select * from books where isbn=$isbn";
    $bookRes = $conn->query($bookSql);
    $cu = "";
    $t = "";
    while ($item = $bookRes->fetch_assoc()) {
        $cu = $item['coverurl'];
        $t = $item['title'];
    }
    include("../subfiles/navbar.php");
    ?>
    <section id="borrow">

        <?php
        $msg = "";
        function alertBox()
        {
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
        if ($updated == "aa") {
            $msg = "<span class='text-danger'>Failed! This book has already been requested.</span>";
            alertBox();
        }
        if ($updated == "a") {
            $msg = "Your request has been submitted.";
            alertBox();
        }
        ?>
        <div class="h1">Borrow</div>
        <div class="form-img">


            <form class="container w-50" action="handleborrow.php?i=<?php echo $isbn; ?>" method="post">
                <div class="second-cont">

                    <div class="form-group w-100 mr-3">
                        <label for="first-name">First Name</label>
                        <input type="text" name="fname" class="form-control shadow-none" id="first-name" placeholder=""
                            required>
                    </div>
                    <div class="form-group w-100 mr-3">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="lname" class="form-control shadow-none" id="last-name" placeholder=""
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control shadow-none" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="why">Why you want this book?</label>
                    <textarea class="form-control shadow-none" name="why" id="area" required></textarea>
                </div>
                <p class="text-danger">You can only borrow book for 1 month.</p>
                <button type="submit" class="btn btn-dark">Request for book</button>
            </form>
            <div class="img-cont">
                <img src="../images/bookcovers/<?php echo $cu; ?>" alt="">
                <p style="margin:12px 0;text-align:center;font-weight:bold;font-size:1.3rem;">
                    <?php echo $t; ?>
                </p>
            </div>
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
            `<div class="spinner-border " role="status"><span class="sr-only ">Loading</span></div><div class="mt-2">Requesting...</div>`;
        setTimeout(() => {
            textUp.innerHTML = "<?php echo $msg; ?>";
        }, 800);
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