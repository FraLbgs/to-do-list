<?php 

function getHtmlFromArray(array $array, string $classUl = null, string $classLi = null): string
{
    if ($classUl) $classUl = " class=\"$classUl\"";
    if ($classLi) $classLi = " class=\"$classLi\"";
    $valueToLi = fn ($v) => "<li$classLi style='background-color: #".$v['color']."'><div class='list-content'>
    <div class='left-content'><div class='up-down'>
      <a class='up' href='action.php?action=up&idtask=".$v['id_tasks']."'><img class='img-up-down' src='img/up.png' alt='up'></a>
      <a class='down' href='action.php?action=down&idtask=".$v['id_tasks']."'><img class='img-up-down' src='img/down.png' alt='up'></a>
    </div>
    <div>
      <p class='desc'>".$v['description']."</p>
      <p class='desc'>".$v['date_reminder']."</p>
    </div>
    </div>
    <div class='links'><a href ='modify.php?action=modify&idtask=".$v['id_tasks']."'>Modifier</a>
    <a href ='action.php?action=delete&idtask=".$v['id_tasks']."'>Supprimer</a>
    <a href ='action.php?action=done&idtask=".$v['id_tasks']."'>Terminer</a></div></li>";
    return "<ul$classUl>" . implode("", array_map($valueToLi, $array)) . "</ul>";
}

function verifyForm(string $desc, string $date, string $color){
    if(strlen($desc) > 255 || $date < date("Y-m-d") || preg_match('/^[a-f0-9]{6}$/', $color) !== 1){
      return false;
    }
    return true;
  }

  
?>