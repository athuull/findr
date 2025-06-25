<form name="frmUser" method="post" action="process_login.php">
    <div class="message text-center">
    <?php
    session_start();
    // IF login error is set, it displays the error and unsets it
    if (!empty($_SESSION['login_error'])) {
        echo $_SESSION['login_error'];
        unset($_SESSION['login_error']);
    }

    if (!empty($_SESSION['register_success'])) {
        echo $_SESSION['register_success'];
        unset($_SESSION['register_success']);
    }
    ?>
</div>

    <h1 class="text-center">Login</h1>

    <div>
        <div class="row">
            <label>Username</label>
            <input type="text" name="userName" class="full-width" required>
        </div>

        <div class="row">
            <label>Password</label>
            <input type="password" name="password" class="full-width" required>
        </div>

        <div class="row">
            <input type="submit" name="submit" value="Submit" class="full-width">
        </div>
    </div>
</form>
