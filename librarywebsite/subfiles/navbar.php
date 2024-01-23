<?php
if (!session_id())
    session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <title>navbar</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Niconne&display=swap');

        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
        }

        #drop-links a {
            transition: all .3s ease;
        }

        #drop-links a:hover {
            background-color: rgb(240, 240, 240);
        }

        #dropdown {
            border: none;
            outline: none;
            background: none;
        }


        #drop-links {}

        #dropdown+#drop-links {
            opacity: 0.0;
            transform: translateY(-10px);
            visibility: hidden;
        }

        #dropdown:focus+#drop-links {
            visibility: visible;
            transform: translateY(0);
            opacity: 1;
            /* visibility: visible; */
        }

        .down {
            display: flex;
            margin-left: 10px;
            transition: transform .3s ease;

        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light"
        style="box-shadow:0px 2px 5px rgba(0, 0, 0, 0.2);background:white;height:10vh;position:sticky;top:0px;z-index:30;">
        <!-- logo -->
        <a class="navbar-brand ml-5" href="#" onclick="redirectToIndex()"
            style="font-size:1.3rem;display:flex;justify-content:center;align-items:center;">
            <!-- <img src="images/logo.png" alt="" height="40"> -->
            <span class="ml-2" style="font-family: 'Niconne', cursive;font-size:2rem;">Library</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- container -->

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin:0 0 0 20%;height:100%;">
            <!-- search -->
            <form class="form-inline my-2 my-lg-0" style="background:rgb(240, 240, 240);width:300px;height:40px;display:flex;justify-content: center;
        align-items: center;border-radius:25px;overflow:hidden;" action="/library/pages/browse.php" method="GET">
                <input class="mr-sm-2 px-3" type="search" placeholder="Search" aria-label="Search" name="st"
                    style="border:none;background:none;outline:none;flex:1;color:gray;">
                <button class="btn btn-outline-dark shadow-none" type="submit"
                    style="border:none;outline:none;height:100%;padding:0 15px;"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
                <input type="hidden" name="submit" value="Search">
                <input type="hidden" name="gs" value="">
                <input type="hidden" name="ps" value="">
            </form>

            <!-- menus -->
            <ul class="navbar-nav" style="margin-left:15%;display:flex;align-items:center;position:relative;">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="redirectToIndex()">Home</a>
                </li>
                <!-- <li class="nav-item ml-3">
                    <a class="nav-link p-0" href="#"><i class="fa-solid fa-bell mr-2"
                            style="font-size:1.5rem;"></i>Notifications</a>
                </li> -->
                <li class="nav-item ml-3" style="color:gray;">
                    |
                </li>
                <li class="nav-item ml-3 mr-5">
                    <a class="nav-link" href="#" onclick="redirectToBrowse()">Browse</a>
                </li>

                <!-- //logins -->
                <?php
                // include("./database/dbconnect.php");
                

                // if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    echo '

                    <button  class="nav-item"id="dropdown" style="margin-left:120px;cursor:pointer;">
                        <span class="nav-link" style="font-size:1.1rem;text-transform: capitalize;display:flex;justify-content:center;align-items:center;">
                        <i class="fa-solid fa-user mr-1 nav-link" style="font-size:1.3rem;"></i>' . $_SESSION['username'] . ' <div class="down" id="down-icon"><i class="ri-arrow-drop-down-line" style="font-size:1.7rem;"></i></div>
                        </span>
                    </button>
                        <div id="drop-links" style="transition:all .3s ease;position:absolute;min-height:100px;min-width:200px;background:white;border:1px solid rgb(210,210,220);left:65%;top:130%;display:flex;flex-direction:column;">
                        <a href="#" onclick="reirecttoborrowedbooks()" style="color:black;height:40px;text-decoration:none;padding:0 13px;font-size:1rem;display:flex;align-items:center;"><i class="ri-booklet-line mr-2"></i>Borrowed</a>
                        <a href="#" onclick="redirectToNotifications()" style="color:black;height:40px;text-decoration:none;padding:0 13px;font-size:1rem;display:flex;align-items:center;"><i class="ri-notification-2-line mr-2"></i></i>Notifications</a>
                        <a href="#" onclick="redirectToBookmark()" style="color:black;height:40px;text-decoration:none;padding:0 13px;font-size:1rem;display:flex;align-items:center;"><i class="fa-regular fa-bookmark mr-2"></i>Bookmarks</a>
                        <a href="#logout" onclick="redirectToLogout()"style="color:black;height:40px;text-decoration:none;padding:0 13px;font-size:1rem;display:flex;align-items:center;"><i class="ri-logout-box-line mr-2"></i>Logout</a>
                        
                        </div>
                    
                    ';
                    // iif logged in
                } else {
                    echo '<li class="nav-item " style="margin-left:120px;">
                    <a class="nav-link" href="#" onclick="redirectToLogin()">Login</a>
                </li>

                <li class="nav-item ml-3">
                    <a class="nav-link" href="#" onclick="redirectToSignup()">Signup</a>
                </li>';
                }
                ?>



            </ul>

        </div>
    </nav>

    <!-- Optional JavaScript -->
    <script>
        function redirectToIndex() {
            // Use window.location.href to navigate to index.php
            window.location.href = '/library';
        }

        function redirectToLogin() {
            // Use window.location.href to navigate to login.php
            window.location.href = '/library/pages/login.php?c=none&e=none&p=none&vb=0';
        }

        function redirectToSignup() {
            // Use window.location.href to navigate to Signup.php
            window.location.href = '/library/pages/Signup.php?p=none&e=none';
        }

        function redirectToLogout() {
            // Use window.location.href to navigate to Signup.php
            window.location.href = '/library/pages/logout.php';
        }

        function redirectToBookmark() {
            // Use window.location.href to navigate to Signup.php
            window.location.href = '/library/pages/bookmark.php';
        }

        function redirectToBrowse() {
            // Use window.location.href to navigate to Signup.php
            window.location.href = '/library/pages/browse.php?submit=n';
        }

        function reirecttoborrowedbooks() {
            // Use window.location.href to navigate to Signup.php
            window.location.href = '/library/pages/borrowedbooks.php';
        }

        function redirectToNotifications() {
            // Use window.location.href to navigate to Signup.php
            window.location.href = '/library/pages/notifications.php';
        }

        const dropdownBtn = document.getElementById("dropdown");
        const dropIcon = document.getElementById("down-icon");
        dropdownBtn.addEventListener("focus", () => {
            dropIcon.style.transform = "rotate(180deg)";
        });
        dropdownBtn.addEventListener("blur", () => {
            dropIcon.style.transform = "rotate(0deg)";
        });
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