<?php

/* 
Exemple d'utilisation :
----------------------
$table_name = "users";
$query = "WHERE age > 25 ORDER BY nom ASC";
$data = get_data($table_name, $query); 
*************************************
*->fetchAll(PDO::FETCH_ASSOC) : C'est une méthode de l'objet PDOStatement qui récupère tous les enregistrements de résultat de la requête dans un tableau.

*PDO::FETCH_ASSOC : C'est une constante définie par PDO qui spécifie le mode de récupération des données. Dans ce cas, FETCH_ASSOC signifie que chaque enregistrement est retourné sous la forme d'un tableau associatif, où les noms des colonnes de la table sont utilisés comme clés.
*/

function get_data($nom_table, $query)
{
    $db = connect_db();
    $sql = "SELECT * FROM $nom_table $query";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des données: " . $e->getMessage();
        exit();
    }
}