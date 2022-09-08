<?php 
function verifyForm(string $desc, string $date, string $color, int $priority){
    if(strlen($desc) > 255 || $date < date("Y-m-d") || preg_match('/^[a-f0-9]{6}$/', $color) !== 1 || preg_match('/^[1-5]{1}$/', $priority) !== 1){
      return false;
    }
    return true;
  }

  
?>