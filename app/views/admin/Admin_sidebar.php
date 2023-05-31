<?php
function Admin_sidebar($admin_id = null)
{
    return <<<HTML
    <a href="dashboard?id=$admin_id">Manage users</a>
    <a href="manage_task_type?id=$admin_id">Manage task type</a>
    HTML;
}
