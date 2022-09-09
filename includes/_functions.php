<?php 
function verifyForm(string $desc, string $date, string $color){
    if(strlen($desc) > 255 || $date < date("Y-m-d") || preg_match('/^[a-f0-9]{6}$/', $color) !== 1){
      return false;
    }
    return true;
  }

  
?>