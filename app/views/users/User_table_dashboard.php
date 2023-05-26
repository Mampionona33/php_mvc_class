<?php
function User_table_dashboard($tasks)
{
    $tableContent = '<table>
                        <thead>
                            <tr>
                                <th>Numéro de tâche</th>
                                <th>Type de tâche</th>
                                <th>Nombre avant</th>
                                <th>Nombre après</th>
                                <th>Durée du traitement</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';

    foreach ($tasks as $task) {
        $taskId = $task['id_task'];
        $taskNumber = $task['num_task'];
        $taskType = $task['id_type_task'];
        $beforeNumber = $task['nbr_before'];
        $afterNumber = $task['nbr_after'];
        $processingTime = $task['processing_time'];

        $tableContent .= "<tr>
                            <td>$taskNumber</td>
                            <td>$taskType</td>
                            <td>$beforeNumber</td>
                            <td>$afterNumber</td>
                            <td>$processingTime</td>
                            <td>
                                <button onclick=\"playTask($taskId)\">Play</button>
                                <button onclick=\"editTask($taskId)\">Edit</button>
                            </td>
                          </tr>";
    }

    $tableContent .= '</tbody></table>';

    return $tableContent;
}
