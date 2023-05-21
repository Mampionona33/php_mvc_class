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

function create_table($nom_table, $col)
{
    $db = connect_db();

    $columns = [];
    foreach ($col as $column) {
        $columnName = $column['name'];
        $columnType = $column['type'];
        $isRequired = $column['required'] ? 'NOT NULL' : '';
        $isAutoIncrement = $column['auto_increment'] ? 'AUTO_INCREMENT' : '';

        $columns[] = "$columnName $columnType $isRequired $isAutoIncrement";
    }

    $columnsString = implode(', ', $columns);
    $sql = "CREATE TABLE IF NOT EXISTS $nom_table ($columnsString);";
    $db->exec($sql);
}
