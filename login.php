<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>

<div class="form-box">
    <h2>Login</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="msg error"><?= $_GET['error'] ?></div>
    <?php endif; ?>

    <form action="login_action.php" method="POST">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="form-btn" type="submit">Login</button>
    </form>

    <div class="small-link">
        <a href="register.php">Don't have an account? Register</a>
    </div>
</div>

</body>
</html>
