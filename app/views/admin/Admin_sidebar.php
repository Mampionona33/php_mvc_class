<?php
function Admin_sidebar($admin_id = null)
{
    return <<<HTML
    <a href="manage_users">Manage users</a>
    <a href="manage_task_type">Manage task type</a>
    HTML;
}