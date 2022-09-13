<?php
$ttl = "To do list";
include_once "includes/_header.php";
require_once "includes/_functions.php";

$actions =[
    0 => "Tâche terminée et archivée",
    1 => "Tâche correctement supprimée",
    2 => "Retour de la tâche effectué correctement",
    3 => "Priorité correctement changée",
    4 => "Tâche correctement modifiée",
    5 => "Action annulée, une erreur s'est produite"
];

$query = $dbCo->prepare("SELECT id_tasks, description, color, date_reminder FROM tasks WHERE done = 0 ORDER BY priority;");
$query->execute();
$result = $query->fetchAll();

?>

<div class="container">
    <div>
        <div class="hidden" id="confirm-msg">
            <?php
                if(isset($_GET['action']) && $_GET['action'] == 0) echo $actions[0];
                if(isset($_GET['action']) && $_GET['action'] == 1) echo $actions[1];
                if(isset($_GET['action']) && $_GET['action'] == 2) echo $actions[2];
                if(isset($_GET['action']) && $_GET['action'] == 3) echo $actions[3];
                if(isset($_GET['action']) && $_GET['action'] == 4) echo $actions[4];
                if(isset($_GET['action']) && $_GET['action'] == 5) echo $actions[5];
            ?>
        </div>
        <h2 class="sub-ttl">Tâches à effectuer : </h2>
        <?= getHtmlFromArrayToDo($result, "tasks", "task") ?>
        <!-- <div class="new-task"><a class="link-new-task" href="create-task.php">Créer une nouvelle tâche</a></div> -->
    </div>
</div>

<script src="js/script.js?<?=time()?>"></script>
</body>

</html>
	