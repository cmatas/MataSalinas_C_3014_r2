<?php
  function logIn($username, $password, $ip) {
    require_once('connect.php');
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $loginstring = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass='{$password}'";
    $loginTQ = "SELECT * FROM tbl_user WHERE user_name='{$username}'";
    $loginT = mysqli_query($link, $loginTQ);
    // echo $loginstring;
    $user_set = mysqli_query($link, $loginstring);
    // echo mysqli_num_rows();
    if(mysqli_num_rows($user_set)){
      $founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
      $id = $founduser['user_id'];
      // echo $id;
      $_SESSION['user_id'] = $id;
      $_SESSION['user_name'] = $founduser['user_fname'];
       $_SESSION['user_date'] = $founduser['user_date'];
      $_SESSION['user_attempts'] = $founduser['user_attempts'];
      if(mysqli_query($link, $loginstring)){


        $userat = $founduser['user_attempts'];
        if($userat <= 3){


        $update = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
        $updatequery = mysqli_query($link, $update);

        $time = "UPDATE tbl_user SET user_date = CURRENT_TIMESTAMP WHERE user_id = {$id}";
        $timeupdate = mysqli_query($link, $time);


        $attemptsquery =  "UPDATE tbl_user SET user_attempts = '0' WHERE user_name = '{$username}'";
        $attempts =  mysqli_query($link, $attemptsquery);
        $_SESSION['user_attempts'] =0;

      } else {
        redirect_to("admin_login.php");
      }
      }
      redirect_to("admin_index.php");
    }elseif($loginT){
      $founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
      $_SESSION['user_name'] = $founduser['user_fname'];
      // $_SESSION['user_attempts'] = $founduser['user_attempts'];

      $_SESSION['user_attempts'] +1;
      $at = $_SESSION['user_attempts'];


      // $attempts =  "UPDATE tbl_user SET user_attempts = '3' WHERE user_name = '{$username}'";
      $attemptsquery =  "UPDATE tbl_user SET user_attempts = '{$at}' WHERE user_name = '{$username}'";
      $attempts =  mysqli_query($link, $attemptsquery);

      $message = "Learn how to type menz";
      return $message;

    }

    mysqli_close($link);
  }

  // function lockoutUser($username, $password) {
  //   $username = mysqli_real_escape_string($link, $username);
  //
  // }

 ?>
