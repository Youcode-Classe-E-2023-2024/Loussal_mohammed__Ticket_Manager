<?php
include_once '../controllers/login.controller.php';
session_start();
global $users;
if(!$users->isLoggedIn()) {
    header('Location: login.php');
}
include_once '../inc/header.php';
$userList = $users->listUser('email', $_SESSION['userEmail']);
?>
<title>Helpdesk System with PHP & MySQL</title>
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css" />
<div class="container">
    <div class="row home-sections">
        <h2>Helpdesk System</h2>
        <?php include('../inc/menu.php'); ?>
    </div>
    <div class="">
        <p>View and manage tickets that may have responses from support team.</p>

        <div class="panel-heading">
            <div class="row">
                <div class="col-md-10">
                    <h3 class="panel-title"></h3>
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" name="add" id="createTicket" class="btn btn-success btn-xs">Create Ticket</button>
                </div>
            </div>
        </div>
        <table id="listTickets" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Ticket ID</th>
                <th>Tag</th>
                <th>Departments</th>
                <th>Created By</th>
                <th>Created</th>
                <th>Status</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
        </table>
    </div>
    <?php include('addTicketModel.php'); ?>
</div>

<script src="js/general.js"></script>
<script src="js/tickets.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<?php include_once ('../inc/footer.php');?>
