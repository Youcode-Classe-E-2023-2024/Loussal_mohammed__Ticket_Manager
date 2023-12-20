<?php
function loader($class) {
    require "../classes/{$class}.php";
}
spl_autoload_register('loader');

$database = new Database();
$department = new Department();
$ticket = new Ticket();
$users = new Users();