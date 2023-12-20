<?php
include 'init.php';

$selectedDepartments = isset($_POST['departments']) ? $_POST['departments'] : array();

if (!empty($_POST['action']) && $_POST['action'] == 'auth') {
    $users->login();
}
if (!empty($_POST['action']) && $_POST['action'] == 'listTicket') {
    $tickets->showTickets();
}
if (!empty($_POST['action']) && $_POST['action'] == 'createTicket') {
    $selectedDepartments = isset($_POST['departments']) ? $_POST['departments'] : array();
    $tickets->createTicket($selectedDepartments);
}
if (!empty($_POST['action']) && $_POST['action'] == 'getTicketDetails') {
    $tickets->getTicketDetails();
}
if (!empty($_POST['action']) && $_POST['action'] == 'updateTicket') {
    $tickets->updateTicket();
}
if (!empty($_POST['action']) && $_POST['action'] == 'closeTicket') {
    $tickets->closeTicket();
}
if (!empty($_POST['action']) && $_POST['action'] == 'saveTicketReplies') {
    $tickets->saveTicketReplies();
}
?>
