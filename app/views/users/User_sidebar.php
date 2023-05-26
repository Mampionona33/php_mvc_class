<?php 
function User_sidebar($user_id){
    return <<<HTML
    <a href="create">new task</a>
    <a href="dashboard?id=$user_id">new task</a>
    HTML;
}
?>
