<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>

    </style>
</head>

<body>
    <?php

    //connect to database
    include("../subfiles/database/dbconnect.php");

    // navbar
    include("../subfiles/navbar.php");
    //acc created
    $createdAcc = $_GET['c'];
    $emailExist = $_GET['e'];
    $passwordMatch = $_GET['p'];
    $vbIsbn = $_GET['vb'];
    // $removedFromCart=$_GET['removed'];
    if ($createdAcc == 'created') {
        echo '
      <div class="alert alert-success alert-dismissible fade show position-absolute w-100 text-center" role="alert">
          <strong>Account created!</strong> You can log in now.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      ';
    }

    if ($emailExist == 'notexist') {
        echo '
      <div class="alert alert-danger alert-dismissible fade show position-absolute w-100 text-center" role="alert">
          <strong>Error!</strong> Email does not exist.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      ';
    }

    if ($passwordMatch == 'nomatch') {
        echo '
      <div class="alert alert-danger alert-dismissible fade show position-absolute w-100 text-center" role="alert">
          <strong>Error!</strong> Incorrect password.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      ';
    }

    ?>
    <div class="h2 text-center" style="margin-top:80px;">Login to your account</div>
    <form action="handlelogin.php?vb=<?php echo $vbIsbn; ?>" autocomplete="off" method="POST" class="container "
        style="width:450px;margin-top:30px;padding:40px;border-radius:10px;">
        <div class="form-group" style="font-size:1rem;">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control shadow-none" id="exampleInputEmail1" aria-describedby="emailHelp"
                name="username" required>
            <div class="form-group mt-3">

                <label>Password</label>
                <div class="text d-flex align-items-center">
                    <input type="password" class="form-control shadow-none" aria-describedby="emailHelp" name="password"
                        id="password" required>
                    <i class="bi bi-eye-slash" style="cursor:pointer;" id="togglePassword"></i>
                </div>



            </div>
            <div class="main w-100 text-center">
                <button type="submit" class="btn btn-primary shadow-none mt-3">Log In</button>
            </div>
            <div class="newmember mt-4 text-center">
                New Member? <a href="signup.php?p=none&e=none">Register Now</a>
            </div>

    </form>





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