<?php
   include("config.php");
   session_start();

   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

      $sql = "SELECT id FROM user WHERE username = '$myusername' and userpassword = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows($result);

      if($count == 1) {
         $_SESSION['login_user'] = $myusername;

         header("location: dashboard.php");

      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin · Spor Tesisi</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
    <main class="form-signin">

        <?php if (!empty($error)) {?>

        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>

        <?php } ?>

        <form action="" method="POST">
            <img class="mb-4" src="images/login_icon.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" placeholder="name@example.com">
                <label for="username">User Name</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>

            <!-- <div class="checkbox mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div> -->

            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
        </form>
    </main>
</body>
</html>