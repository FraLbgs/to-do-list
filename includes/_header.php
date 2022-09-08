<?php
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$ttl?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <h1 class="title">To Do List !!!!!!!</h1>
    </header>