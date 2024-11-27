<?php

function connectToDB()
{
    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'vote';
    $db_port = 8889;
    try {
        $db = new PDO('mysql:host=' . $db_host . '; port=' . $db_port . '; dbname=' . $db_db, $db_user, $db_password);
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        die();
    }
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    return $db;
}


function getList(): array
{
    $sql = "select * from items;";

    $stmt = connectToDB()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function addNew($n)
{
    $db = connectToDB();
    $sql = "INSERT INTO items (name, score) VALUES (:new, 1);";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':new' => $n,

    ]);
    return $db->lastInsertId();
}


function addScore($id)
{

    $db = connectToDB();
    $sql = "UPDATE items SET score = score + 1 WHERE (id = :id);";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':id' => $id,

    ]);
    return $db->lastInsertId();
}


function getPercentage()
{
    $db = connectToDB();
    $sql = "select sum(score) as sum from items ";

    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
