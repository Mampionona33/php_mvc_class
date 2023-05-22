<?php
function create_data($nom_table, $data)
{
    $db = connect_db();
    $fields = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));

    $sql = "INSERT INTO $nom_table ($fields) VALUES ($placeholders)";

    $stmt = $db->prepare($sql);

    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    try {
        $stmt->execute();
        return $data;
    } catch (PDOException $e) {
        echo "Erreur lors de la création des données : " . $e->getMessage();
        exit();
    }
}