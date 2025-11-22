<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>

<div class="form-box">
    <h2>Register</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="msg error"><?= $_GET['error'] ?></div>
    <?php endif; ?>

    <form action="register_action.php" method="POST">

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="form-btn" type="submit">Create Account</button>
    </form>

    <div class="small-link">
        <a href="login.php">Already have an account? Login</a>
    </div>
</div>

</body>
</html>
