<?php
$ttl = "To do list";
include_once "includes/_header.php";

function getHtmlFromArray(array $array, string $classUl = null, string $classLi = null): string
{
    if ($classUl) $classUl = " class=\"$classUl\"";
    if ($classLi) $classLi = " class=\"$classLi\"";
    $valueToLi = fn ($v) => "<li$classLi style='background-color: #".$v['color']."'><div class='list-content'>".$v['description'].
    "   <a href ='index.php?action=done&idtask=".$v['id_tasks']."'>Supprimer</a></div></li>";
    return "<ul$classUl>" . implode("", array_map($valueToLi, $array)) . "</ul>";
}


$query = $dbCo->prepare("SELECT id_tasks, description, color FROM tasks WHERE done = 0;");
$query->execute();
$result = $query->fetchAll();
// var_dump($result);

?>

<div class="container">
    <h2 class="sub-ttl">Tâches à effectuer : </h2>
    <?= getHtmlFromArray($result, "tasks", "task") ?>
    <div class="new-task"><a class="link-new-task" href="create-task.php">Créer une nouvelle tâche</a></div>
</div>

<?php
var_dump($_GET);
if(isset($_GET['action']) && $_GET['action'] === "done" && isset($_GET['idtask'])){
    $query = $dbCo->prepare("UPDATE tasks
    SET done = 1
    WHERE id_tasks = :idtasks;");
    $query->execute([
        "idtasks" => $_GET['idtask']
    ]);
    header("location:index.php");
}
?>

<script src="js/script.js"></script>
</body>

</html>