<?php
// this files is not called through config.php
require_once('config.php');

if(isset($_GET['caller_id'])){
  $dir = $_GET['caller_id'];
  if($dir == "logout"){
    logged_out();
  } else {
    echo "caller is was passed incorrectly";
  }
}


 ?>
