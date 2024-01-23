<head>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        * {
            margin: 0;
            font-family: 'roboto';
        }

        :root {
            --themecolor: rgb(39, 92, 158);

            --selected: rgb(28, 69, 119);
            --hover: rgba(28, 69, 119, .35);

        }

        .menu {
            /* opacity: .2; */
            position: fixed;
            z-index: 10;
            width: 20vw;
            height: 100vh;
            background-color: var(--themecolor);
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
        }

        .profile {
            margin-top: 50px;
            text-align: center;
        }

        .profile-icon {
            background-color: white;
            padding: 2rem 2.3rem;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .menu-items {
            margin-top: 50px;
            width: 100%;
            /* background-color: red; */
            font-size: 1.05rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            height: 40px;
            padding-left: 20px;
        }

        .menu-items a {

            text-decoration: none;
            color: white;

        }

        .menu-items>a:hover {
            background-color: var(--hover);
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="menu">
        <div class="profile">
            <p>Admin</p>
            <div class="profile-icon" style="margin-top:15px;">

                <i class="fa-solid fa-user-tie" style="font-size:6rem;color:var(--themecolor);"></i>
            </div>
            <p>CyCy Maharjan</p>
        </div>
        <div class="menu-items">
            <a class="menu-item active1" href="./dashboard.php"> <i class="ri-dashboard-fill"
                    style="margin-right:7px;"></i>Dashboard
            </a>

            <a class="menu-item active2" href="./booklist.php"><i class="ri-list-check"
                    style="margin-right:7px;"></i>Booklist</a>
            <a class="menu-item active3" href="./request.php"><i class="ri-notification-fill"
                    style="margin-right:7px;"></i>Requests
            </a>
            <a class="menu-item active4" href="./addbook.php?a=n"><i class="ri-health-book-fill"
                    style="margin-right:7px;"></i>Add Book
            </a>
            <a class="menu-item active5" href="./managebooks.php"><i class="ri-booklet-fill"
                    style="margin-right:7px;"></i>Manage Books
            </a>

        </div>
    </div>
</body>