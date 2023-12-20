<?php include_once '../inc/header.php';?>
<div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">

    <div class="signup">
        <form action="../controllers/login.controller.php" method="post">
            <label for="" aria-hidden="true">Login</label>
            <input type="email" name="email" placeholder="Email" required="">
            <input type="password" name="password" placeholder="Password" required="">
            <input type="submit" name="submit" value="Login">
        </form>
    </div>


</div>
<!--- Link JS File --->
<script src="../js/signup.php"></script>
<?php  include_once '../inc/footer.php'; ?>
