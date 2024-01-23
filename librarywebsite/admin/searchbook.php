<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <title>Administration</title>
    <style>
    * {
        margin: 0;
        padding: 0;
    }

    #booklist {
        margin-left: 20vw;
        width: 80vw;
        height: 100vh;
        /* background-color: red; */
    }

    .active2 {
        border-left: 4px solid white;
        background-color: rgb(77, 52, 132);
    }

    header {
        height: 8vh;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form {
        border-bottom: 1.3px solid gray;
        /* padding: 5px 0; */
        width: 300px;
    }

    #booklist>i {
        font-size: 1.3rem;
    }

    button {
        border: none;
        outline: none;
        background: none;
    }

    #search {
        width: 250px;
        padding: 5px;
        border: none;
        margin-left: 10px;
        outline: none;
    }

    table {
        text-align: center;
        width: 100%;
        margin-top: 20px;
        font-size: .9rem;
    }

    th {
        font-size: .9rem;
    }

    tr {
        height: 50px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.25);
    }

    tr:first-child {
        height: 35px;
        border-bottom: 2px solid gray;
    }

    tr:nth-child(2) {
        border: none;
        height: 30px;
    }

    tr>th:nth-child(3) {
        width: 35%;
    }

    tr>th:last-child {
        width: 25%;
    }

    .btn {
        font-size: .8rem;
        padding: 5px 10px;
    }

    main {
        width: 80%;
        margin: auto;
    }

    .logo {
        position: absolute;
        left: 450px;
        color: black;
        text-decoration: none;
        transition: all .2s ease;
    }

    .logo:hover {
        text-decoration: none;
        color: black;
        transform: scale(1.1);
        background-color: none;
    }
    </style>
</head>

<body>
    <?php
    include("./menus.php")
        ?>

    <div id="booklist">
        <header>

            <a class="logo" href="./booklist.php"><i class="ri-list-check" style="margin-right:7px;"></i>Booklist</a>

            <form action="searchbook.php" method="get">
                <button type="submit" value=""><i class=" ri-search-line"></i></button>
                <input type="text" id="search" name="st" required placeholder="Search" autocomplete="off">
            </form>
        </header>
        <main>
            <table>
                <tr>
                    <th>ISBN</th>
                    <th>Book</th>
                    <th>Title</th>
                    <th>Published</th>
                    <th>Action</th>

                </tr>
                <tr></tr>
                <?php
                $searchText = $_GET['st'];
                include("../subfiles/database/dbconnect.php");
                $bookSql = "SELECT * FROM books where title like '%$searchText%'";

                $bookRes = $conn->query($bookSql);
                $found = $bookRes->num_rows;
                if ($found == 0) {
                    echo '
                    <tr>
                    <td></td>
                    <td></td>
                        <td style="display:flex;justify-content:center;align-items:center;">
                        <i class="ri-error-warning-fill text-danger mr-3" style="font-size:2.5rem;"></i>
                        not found
                        </td>
                    </tr>
                    ';

                }
                while ($bookItem = $bookRes->fetch_assoc()) {
                    echo
                        '
                            <tr>
                                <td>' . $bookItem['isbn'] . '</td>
                                <td>
                                    <img src="../images/bookcovers/' . $bookItem['coverurl'] . '" alt="" style="height:40px;">
                                </td>
                                <td>' . $bookItem['title'] . '</td>
                                <td>' . $bookItem['published'] . '</td>
                                <td>
                                    <!-- edit -->
                                    <a href="./editbook.php?i=' . $bookItem['isbn'] . '&e=nu " class="btn btn-outline-dark px-1 py-0 mr-2"><i class="ri-edit-fill"style="font-weight:light;font-size:1.2rem;"></i></a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-danger shadow-none px-1 py-0 ml-2" data-toggle="modal"
                                        data-target="#exampleModalCenter' . $bookItem['isbn'] . '">
                                        <i class="ri-delete-bin-2-line" style="font-weight:light;font-size:1.2rem;"></i>
                                       
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter' . $bookItem['isbn'] . '" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        ';
                }
                ?>

            </table>
        </main>
    </div>

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