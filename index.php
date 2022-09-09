<?php
$ttl = "To do list";
include_once "includes/_header.php";

function getHtmlFromArray(array $array, string $classUl = null, string $classLi = null): string
{
    if ($classUl) $classUl = " class=\"$classUl\"";
    if ($classLi) $classLi = " class=\"$classLi\"";
    $valueToLi = fn ($v) => "<li$classLi style='background-color: #".$v['color']."'><div class='list-content'>".$v['description'].
    "   <div><a href ='modify.php?action=modify&idtask=".$v['id_tasks']."'>Modifier</a>
        <a href ='action.php?action=done&idtask=".$v['id_tasks']."'>Terminer</a></div></li>";
    return "<ul$classUl>" . implode("", array_map($valueToLi, $array)) . "</ul>";
}


$query = $dbCo->prepare("SELECT id_tasks, description, color FROM tasks WHERE done = 0 ORDER BY priority;");
$query->execute();
$result = $query->fetchAll();
// var_dump($result);

?>

<div class="container">
    <h2 class="sub-ttl">Tâches à effectuer : </h2>
    <?= getHtmlFromArray($result, "tasks", "task") ?>
    <div class="new-task"><a class="link-new-task" href="create-task.php">Créer une nouvelle tâche</a></div>
</div>



<script src="js/script.js"></script>
</body>

</html>