<?php ini_set('display_errors', '1');
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

$voteId = @$_POST['option'];
$submit = @$_POST['submit'];

$errors = [];
$optionArray = [];
for ($i = 0; $i < count($list); $i++) {
    $optionArray[] = $list[$i]['name'];
}
// print "<pre>";
// print_r($optionArray);
// print "</pre>";

if (isset($submit) && isset($voteId)) {

    if (isset($voteId) && strlen($_POST['new']) < 3) {
        if (strlen($_POST['new']) < 1) {
            $errors[] = "Pleas fill the Other Section!";
        } else if (strlen($_POST['new']) < 3) {
            $errors[] = "Other section is very short";
        }
    } else {
        if ($voteId < 1 && strlen($_POST['new']) > 3) {
            if (is_numeric($_POST['new'])) {
                $errors[] = "Other can not be a Number!";
            } else if (in_array($_POST['new'], $optionArray)) {
                $errors[] = "Your Other vibe already Exist! please choose it";
            } else {
                $new = @$_POST['new'];
                // print $new;
                addNew($new);
                header("location: result.php");
            }
        }
    }
    if ($voteId >= 1) {
        addScore($voteId);
        header("location: result.php");
    }
}

if (isset($submit) && !isset($voteId)) {

    $errors[] = "Please share with us your progress :) ";
}

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

<body>
    <main style="font-size:20px;">
        <form action="index.php" method="post" style="background-color:#abcdcb; border-radius: 25px; margin: 10% auto">
            <h1 style="text-align:center;"> 🔍 Poll: Programming Logic Vibes – Which One’s You?</h1>
            <?php foreach ($list as $id => $option): ?>
                <aside>
                    <input type="radio" name="option" id="option" value="<?= $option['id'] ?>"> <?= $option['name']; ?> </input>

                </aside>
            <?php endforeach; ?>

            <input type="radio" name="option" id="option" value="0"> Other </input>
            <input type="text" id="new" name="new">
            <h2>Vote and share your programming journey! 🚀💬</h2>
            <input type="submit" name="submit" id="submit" style="width:50%; margin-left:25%;" />
            <?php foreach ($errors as $error): ?>
                <section style="background-color:#f7f7a4; border-radius: 25px; ">
                    <h3 style="color:#9c5b5b;"><?= $error; ?></h3>
                </section>

            <?php endforeach; ?>
        </form>

    </main>

</body>

</html>