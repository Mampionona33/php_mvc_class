<?php

/* 
Exemple d'utilisation :
----------------------

*************************************
*->fetchAll(PDO::FETCH_ASSOC) : C'est une méthode de l'objet PDOStatement qui récupère tous les enregistrements de résultat de la requête dans un tableau.

*PDO::FETCH_ASSOC : C'est une constante définie par PDO qui spécifie le mode de récupération des données. Dans ce cas, FETCH_ASSOC signifie que chaque enregistrement est retourné sous la forme d'un tableau associatif, où les noms des colonnes de la table sont utilisés comme clés.
*/

function get_data($nom_table, $list_colonne=[],$condition="")
{
    $db = connect_db();
    $query = "SELECT";

     // Si la liste de colonnes est vide, sélectionner toutes les colonnes avec *
     if (empty($list_colonne)) {
        $query .= "*";
    } else {
        // Sinon, ajouter les colonnes à la requête
        $query .= implode(", ", $list_colonne);
    }

    // Ajouter la table à la requête
    $query .= " FROM " . $nom_table;

    // Si une condition est spécifiée, l'ajouter à la requête
    if (!empty($condition)) {
        $query .= " WHERE " . $condition;
    }
    
    $stmt = $db->prepare($query);

    try {
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des données: " . $e->getMessage();
        exit();
    }
}