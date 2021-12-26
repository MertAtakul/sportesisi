<?php

  include("config.php");
  
  // Define variables and initialize with empty values
  $username = $password = $confirm_password = "";
  $username_err = $password_err = $confirm_password_err = "";
  
  // Processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
  
      // Validate username
      if(empty(trim($_POST["username"]))){
          $username_err = "Lütfen kullanıcı adını giriniz.";
      } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
          $username_err = "Kullanıcı adı yalnızca harf,sayı ve alt çizgi içerebilir. ";
      } else{
          // Prepare a select statement
          $sql = "SELECT id FROM user WHERE username = ?";
          
          if($stmt = mysqli_prepare($db, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "s", $param_username);
              
              // Set parameters
              $param_username = trim($_POST["username"]);
              
              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  /* store result */
                  mysqli_stmt_store_result($stmt);
                  
                  if(mysqli_stmt_num_rows($stmt) == 1){
                      $username_err = "Bu kullanıcı adı ve şifre zaten alınmış.";
                  } else{
                      $username = trim($_POST["username"]);
                  }
              } else{
                  echo "Oops! Bir şeyler ters gitti. Lütfen daha sonra tekrar deneyiniz.";
              }

              // Close statement
              mysqli_stmt_close($stmt);
          }
      }
      
      // Validate password
      if(empty(trim($_POST["password"]))){
          $password_err = "Lütfen şifreyi giriniz.";     
      } elseif(strlen(trim($_POST["password"])) < 6){
          $password_err = "Şifreniz en az 6 karakter içermelidir.";
      } else{
          $password = trim($_POST["password"]);
      }
          
      // Check input errors before inserting in database
      if(empty($username_err) && empty($password_err)){
          
          $fullname = trim($_POST["fullname"]);
          $phone = trim($_POST["phone"]);
          $email = trim($_POST["email"]);

          // Prepare an insert statement
          $sql = "INSERT INTO user (username, userpassword, email, phone_number, full_name) VALUES (?, ?, ?, ?, ?)";
          
          if($stmt = mysqli_prepare($db, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $email , $phone, $fullname);
              
              // Set parameters
              $param_username = $username;
              $param_password = $password; // Creates a password hash
              
              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  // Redirect to dasboard page
                  $_SESSION['login_user'] = $username;

          header("location: dashboard.php");
              } else{
                  echo "Oops! Bir şeyler ";
              }

              // Close statement
              mysqli_stmt_close($stmt);
          }
      }
      
      // Close connection
      mysqli_close($db);
  }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Üye Ol · Spor Tesisi</title>
</head>

<body class="text-center">
    <main class="form-signin">

        <div class="mt-4"><a href="index.html"><img src="images/logo.png" alt="Just Sports Logo"></a></div>
        <h4 class="mt-4 mb-3 text-white">Just Sports'a Üye Ol</h4>

        <?php if(!empty($username_err) || !empty($password_err)){ ?>

        <div class="alert alert-danger" role="alert">
            <?php echo $username_err; ?>
            <?php echo $password_err; ?>
        </div>

        <?php } ?>

        <form action="" method="POST" style="max-width:300px;margin:auto;">
            <div class="mb-3">
                <label for="fullname" class="form-label text-white">Ad Soyad :</label>
                <input type="text" class="form-control" id="fullname" name="fullname">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-white">Email adresi :</label>
                <input type="email" class="form-control" id="e-mail" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text text-white">E-mailinizi asla başka birisi ile paylaşmayacağız.
                </div>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label text-white ">Telefon No :</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label text-white">Kullanıcı adınızı belirleyin :</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-white">Şifrenizi belirleyin :</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Üye ol</button>
        </form>
        <hr class="mt-4">
        <div class="col-12 text-white">
            <p class="text-center  mb-0">Zaten hesabım var. <a href="login.php">Giriş yap</a></p>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </main>
</body>

</html>