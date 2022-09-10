<?php
$ttl = "To do list";
include_once "includes/_header.php";
require_once "includes/_functions.php";

$query = $dbCo->prepare("SELECT id_tasks, description, color FROM tasks WHERE done = 0 ORDER BY priority;");
$query->execute();
$result = $query->fetchAll();

?>

<div class="container">
    <h2 class="sub-ttl">Tâches à effectuer : </h2>
    <?= getHtmlFromArray($result, "tasks", "task") ?>
    <div class="new-task"><a class="link-new-task" href="create-task.php">Créer une nouvelle tâche</a></div>
</div>



<script src="js/script.js"></script>
</body>

</html>