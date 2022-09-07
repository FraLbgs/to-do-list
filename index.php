<?php

function getHtmlFromArray(array $array, string $classUl = null, string $classLi = null): string
{
    if ($classUl) $classUl = " class=\"$classUl\"";
    if ($classLi) $classLi = " class=\"$classLi\"";
    $valueToLi = fn ($v) => "<li$classLi style='background-color: #".$v['color']."'><div>".$v['description']."</div></li>";
    return "<ul$classUl>" . implode("", array_map($valueToLi, $array)) . "</ul>";
}

try {
    $dbCo = new PDO(
        'mysql:host=localhost;dbname=to_do_list;charset=utf8',
        'Franck',
        'onsenfout'
    );
    $dbCo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );
} catch (Exception $e) {
    die("Unable to connect to the database.
        " . $e->getMessage());
}

$query = $dbCo->prepare("SELECT description, color FROM tasks WHERE done = 0;");
$query->execute();
$result = $query->fetchAll();
// var_dump($result);


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="header">
    <h1 class="title">To Do List !!!!!!!</h1>
</header>


    <p class="sub-ttl">Tâches à effectuer : </p>
    <?= getHtmlFromArray($result, "tasks", "task") ?>




</body>

</html>