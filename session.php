<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from user where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);   
   
   if(!isset($_SESSION['login_user']) || $row == null){
      header("location:login.php");
      die();
   }else{
      $login_session = $row['username'];
   }
?>