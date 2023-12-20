<?php include_once '../inc/header.php';?>
<link rel="stylesheet" href="../css/style.css">
<title>Sign up</title>
</head>
<body>
<div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">

    <div class="signup">
        <form action="../controllers/signup.controller.php" method="post">
            <label for="" aria-hidden="true">Sign up</label>
            <input type="text" name="name" placeholder="Name" required="">
            <input type="email" name="email" placeholder="Email" required="">
            <input type="password" name="password" placeholder="Password" required="" value="" >

            <input type="password" name="confirm_password" placeholder="Confirm Password" required="">
            <input type="submit" name="submit" value="Sign up">
        </form>
    </div>


</div>
<div class="insert-post-ads1" style="margin-top:20px;">

</div>
</div>
<!--- Link JS File --->
<script src="../js/signup.php"></script>
<?php  include_once '../inc/footer.php'; ?>
</body>
</html>

