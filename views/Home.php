<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your Website</title>
    <link rel="stylesheet" href="static/styles.css">
</head>
<body>
    <header>
        <h1 class="heading">Welcome to Your Website</h1>
        <h3 class="title">Explore Our Services</h3>
    </header>

    <div class="container">
        <div class="card-container">
            <!-- Login Card -->
            <div class="card">
                <h2>Login</h2>
                <p>Login to access your account</p>
                <form action="index.php" method="POST"> <!-- Removed query parameter from action -->
                    <input type="hidden" name="action" value="loginUser"> <!-- Action included as a hidden input -->
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" id="psw-login" name="password" placeholder="Password" required>
                    <input type="checkbox" onclick="togglePasswordVisibility('psw-login')"> Show Password
                    <button type="submit" class="btn">Login</button>
                </form>
            </div>

            <!-- Register Card -->
            <div class="card">
                <h2>Register</h2>
                <p>Create a new account</p>
                <form action="index.php" method="POST"> <!-- Removed query parameter from action -->
                    <input type="hidden" name="action" value="registerUser"> <!-- Action included as a hidden input -->
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" id="psw-register" name="password" placeholder="Password" required>
                    <input type="checkbox" onclick="togglePasswordVisibility('psw-register')"> Show Password
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <button type="submit" class="btn">Register</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(passwordId) {
            var passwordInput = document.getElementById(passwordId);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>
