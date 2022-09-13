<?php 

function getHtmlFromArrayToDo(array $array, string $classUl = null, string $classLi = null): string
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
    <div class='date-alert'>".verifyDate($v['date_reminder'])."</div>
    <div class='links'>
      <a class='link' href ='modify.php?action=modify&idtask=".$v['id_tasks']."'><img class='img-link' src='img/modif.png' alt='modifier'></a>
      <a class='link' href ='action.php?action=delete&idtask=".$v['id_tasks']."'><img class='img-link' src='img/cross.png' alt='supprimer'></a>
      <a class='link' href ='action.php?action=done&idtask=".$v['id_tasks']."'><img class='img-link' src='img/check.png' alt='terminer'></a>
    </div></li>";
    return "<ul$classUl>" . implode("", array_map($valueToLi, $array)) . "</ul>";
}

function getHtmlFromArrayDone(array $array, string $classUl = null, string $classLi = null): string
{
    if ($classUl) $classUl = " class=\"$classUl\"";
    if ($classLi) $classLi = " class=\"$classLi\"";
    $valueToLi = fn ($v) => "<li$classLi><div class='list-content'>
      <div class='left-content'>
        <a class='link' href ='action.php?action=return&idtask=".$v['id_tasks']."'><img class='img-link' src='img/back.png' alt='retour'></a>
        <p class='a-voir'>".$v['description']."</p>
      </div>
      <p class='a-voir'>".$v['date_reminder']."</p>
    </div></li>";
    return "<ul$classUl>" . implode("", array_map($valueToLi, $array)) . "</ul>";
}

function verifyForm(string $desc, string $date, string $color) :bool{
    if(strlen($desc) > 255 || $date < date("Y-m-d") || preg_match('/^[a-f0-9]{6}$/', $color) !== 1){
      return false;
    }
    return true;
  }

function verifyDate(string $d) :string{
  if($d === date("Y-m-d")) return "Dernier délai : Aujourd'hui";
  return "";
}


?>