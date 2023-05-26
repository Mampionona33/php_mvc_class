<?php 
function User_sidebar($user_id){
    return <<<HTML
    <a href="create_task">new task</a>
    <a href="dashboard?id=$user_id">dashboard</a>
    HTML;
}
?>
