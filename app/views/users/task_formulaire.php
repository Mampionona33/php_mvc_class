<?php

function task_formulaire($task = null)
{
    return '<form action="create_task" method="POST">
        <input type="hidden" name="id" value="' . ($_SESSION["user"]["id"] ?? '') . '">    
        
        <label for="task_name">Nom de la tâche:</label>
        <input type="text" name="task_name" value="' . ($task ? $task->task_name : '') . '" required>
        
        <label for="num_task">Numéro de la tâche:</label>
        <input type="text" name="num_task" value="' . ($task ? $task->num_task : '') . '">
        
        <label for="id_type_task">ID du type de tâche:</label>
        <input type="text" name="id_type_task" value="' . ($task ? $task->id_type_task : '') . '" required>
        
        <label for="nbr_before">Nombre avant:</label>
        <input type="number" name="nbr_before" value="' . ($task ? $task->nbr_before : '0') . '">
        
        <label for="nbr_after">Nombre après:</label>
        <input type="number" name="nbr_after" value="' . ($task ? $task->nbr_after : '0') . '">
             
        <input type="submit" value="Enregistrer">
    </form>';
}
