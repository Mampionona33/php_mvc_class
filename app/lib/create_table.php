<?php
/* 
    exemple usage :
    $columns = [
    [
        'name' => 'id',
        'type' => 'INT',
        'required' => true,
        'auto_increment' => true,
    ],
    [
        'name' => 'name',
        'type' => 'VARCHAR(255)',
        'required' => true,
        'auto_increment' => false,
    ],
    [
        'name' => 'email',
        'type' => 'VARCHAR(255)',
        'required' => false,
        'auto_increment' => false,
    ],
];

create_table('users', $columns);
*/

require_once "./connect_db.php";

require_once "./connect_db.php";

function create_table($nom_table, $col)
{
    try {
        $db = connect_db();

        $columns = [];
        $primaryKeys = [];

        foreach ($col as $column) {
            $columnName = $column['name'];
            $columnType = $column['type'];
            $isRequired = $column['required'] ? 'NOT NULL' : '';
            $isAutoIncrement = $column['auto_increment'] ? 'AUTO_INCREMENT' : '';

            if ($columnType === 'ENUM') {
                $enumValues = "'" . implode("', '", $column['values']) . "'";
                $defaultValue = "'" . $column['values'][0] . "'";
                $columns[] = "$columnName $columnType($enumValues) $isRequired $isAutoIncrement DEFAULT $defaultValue";
            } else {
                $columns[] = "$columnName $columnType $isRequired $isAutoIncrement";
            }

            if ($column['auto_increment']) {
                $primaryKeys[] = $columnName;
            }
        }

        $columnsString = implode(', ', $columns);
        $primaryKeysString = implode(', ', $primaryKeys);

        $sql = "CREATE TABLE IF NOT EXISTS $nom_table ($columnsString, PRIMARY KEY ($primaryKeysString));";
        $db->exec($sql);

        // echo "Table créée avec succès !";
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de la création de la table : " . $e->getMessage();
    }
}




