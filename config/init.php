<?php
function loader($model) {
    require "../models/{$model}.php";
}
spl_autoload_register('loader');

$database = new Database();
$department = new Department();
$ticket = new Ticket();
$users = new Users();