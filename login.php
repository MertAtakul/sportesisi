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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">

    <title>Giriş Yap · Spor Tesisi</title>
</head>

<body class="text-center">
    <main class="form-signin">

        <h4 class="mt-4 mb-3 text-white">Just Sports'a Giriş Yap</h4>

        <?php if (!empty($error)) {?>

        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>

        <?php } ?>

        <form action="" method="POST" style="max-width:300px;margin:auto;">

            <div class="mb-3">
                <label for="username" class="form-label text-white">Kullanıcı adınızı giriniz :</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-white">Şifrenizi giriniz :</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <!-- <div class="checkbox mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div> -->

            <button class="w-100 btn btn-lg btn-primary" type="submit">Giriş yap</button>

        </form>
        <hr class="mt-4">
        <div class="col-12 text-white">
            <p class="text-center  mb-0">Henüz hesabınız yok mu? <a href="signup.php">Üye ol</a></p>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </main>
</body>

</html>