<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require("./db.php");
$list = getList();
// print "<pre>";
// print_r($list);
// print "</pre>";

// print "<pre>";
// print_r(@$_POST);
// print "</pre>";

$sum = getPercentage();
// print "<pre>";
// print_r($sum);
// print "</pre>";

?>


<!DOCTYPE html>
<html lang="en" data-lt-installed="true">

<head>
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">

    <meta charset="utf-8">
    <meta name="description" content="My description">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body></body>
<main style="font-size:15px;">
    <section style="background-color:#abcdcb; border-radius: 25px;display:flex; flex-direction:column; padding : 5%; gap:5%;">

        <h1 style="text-align:center;"> Poll Result: Programming Logic Vibes 🎯🎯</h1>
        <?php foreach ($list as $id => $option): ?>

            <div style="display: grid;grid-template-columns: 1fr  0.1fr 2fr;   justify-content:center;gap:5px; ">
                <p><?= $option['name']; ?></p>
                <h4><?= round(($option['score'] / $sum[0]['sum']) * 100); ?>% </h4>
                <div>
                    <p style="width:<?= round(($option['score'] / $sum[0]['sum']) * 100); ?>% ;height:20px; background-color:#062b27; margin:20px;"> </p>
                </div>

            </div>


        <?php endforeach; ?>



    </section>
    <a href="index.php" style="margin-left:70%; margin-right:auto;"><i>Back to Vote Page!</i></a>




</main>

</body>

</html>