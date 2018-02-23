<?php
// function randompass() {
//     $ranString = '_%&*$#abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
//     $password = array();
//     $ranStringlenght = strlen($ranString) - 1;
//     for ($i = 0; $i < 8; $i++) {
//         $n = rand(0, $ranStringlenght);
//         $password[] = $ranString[$n];
//     }
//     return implode($password);
// }

// function criptpass() {
//   $password = 'pedo';
//   $criptmethod = 'AES-128-CTR';
//   $criptkey = shuffle('_%&*$#abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
//   $criptiv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($criptmethod));
//   $criptans = openssl_encrypt($password, $criptmethod, $criptkey, 0, $criptiv) . "::" . bin2hex($criptiv);
//   unset($password, $criptmethod, $criptkey, $criptiv);
//
//   return $criptans;
// }

function createUser($fname, $username, $email, $criptans, $lvlist) {
  include('connect.php');

  $uperstring = "INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$username}', '{$criptans}', '{$email}', NULL, 'no', '0', '{$lvlist}')";
  // echo $uperstring;
  $userquery = mysqli_query($link, $uperstring);
  if($userquery) {
    redirect_to('admin_index.php');
  }else{
    $message = "Something went wrong";
    return $message;
  }

  mysqli_close($link);
}
?>
