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
</head>

<body>
    <?php

    //connect to database
    include("../subfiles/database/dbconnect.php");

    // navbar
    include("../subfiles/navbar.php");
    //alert
    $passwordCheck = $_GET['p'];
    $emailExist = $_GET['e'];
    // $removedFromCart=$_GET['removed'];
    if ($passwordCheck == 'wrong') {
        echo '
      <div class="alert alert-danger alert-dismissible fade show position-absolute w-100 text-center" role="alert">
          <strong>Error!</strong> Password do not match.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      ';
    }
    if ($emailExist == 'exist') {
        echo '
      <div class="alert alert-danger alert-dismissible fade show position-absolute w-100 text-center" role="alert">
          <strong>Error!</strong> Email already exist.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      ';
    }

    ?>
    <div class="h2 text-center mb-5" style="margin-top:60px;">Create an account</div>
    <form autocomplete="off" action="handlesignup.php" method="POST" class="container"
        style="width:450px;height:470px;margin-top:15px;padding:20px 40px;border-radius:10px;">

        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control shadow-none" id="exampleInputEmail1" aria-describedby="emailHelp"
                name="username" maxlength="10" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <div class="text d-flex align-items-center">
                <input type="password" class="form-control shadow-none" id="password" aria-describedby="emailHelp"
                    name="password" required>

            </div>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <div class="text d-flex align-items-center">
                <input type="password" class="form-control shadow-none" id="password2" aria-describedby="emailHelp"
                    name="cpassword" required>

            </div>
        </div>
        <div class="main w-100 text-center">
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </div>

        <div class="newmember mt-4 text-center">
            Already have an account? <a href="login.php?c=none&e=none&p=none&vb=0">Log In</a>
        </div>
    </form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        const togglePassword = document
            .querySelector('#togglePassword');

        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {

            // Toggle the type attribute using
            // getAttribure() method
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';

            password.setAttribute('type', type);

            // Toggle the eye and bi-eye icon
            this.classList.toggle('bi-eye');
        });
    </script>

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