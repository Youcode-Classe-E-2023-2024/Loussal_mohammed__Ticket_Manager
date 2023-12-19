<?php include_once '../inc/header.php';?>
<div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">

    <div class="signup">
        <form action="../controllers/signup.controller.php" method="post">
            <label for="chk" aria-hidden="true">Sign up</label>
            <input type="text" name="txt" placeholder="User name" required="">
            <input type="email" name="email" placeholder="Email" required="">
            <input type="password" name="pswd" placeholder="Password" required="">
            <button>Sign up</button>
        </form>
    </div>

    <div class="login">
        <form action="../controllers/login.controller.php" method="post">
            <label for="chk" aria-hidden="true">Login</label>
            <input type="email" name="email" placeholder="Email" required="">
            <input type="password" name="pswd" placeholder="Password" required="">
            <button>Login</button>
        </form>
    </div>
</div>
<!--- Link JS File --->
<script src="../js/signup.php"></script>
<?php  include_once '../inc/footer.php'; ?>
