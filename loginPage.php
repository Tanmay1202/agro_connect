<?php
session_start();
include 'api/db_connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();

    if($stored_password && $password === $stored_password)
    {
        $_SESSION['username'] = $username;//store username in session
        header("Location: index.php");
        exit();
    }
    else
    {
        $_SESSION['error message'] = "Invalid Credentials, retry or <a href='signupPage.html'>Sign Up</a>";
        header("Location: loginPage.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pest Alert System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4CAF50',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-50 min-h-screen">
    <!-- Navigation -->
    <nav class="sticky top-0 bg-gradient-to-r from-green-600 to-green-700 text-white shadow-lg z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold">AgroConnect</span>
                </div>
                <ul class="flex space-x-4">
                    <li><a href="index.php" class="px-3 py-2 rounded-md hover:bg-green-700">Dashboard</a></li>
                    <li><a href="guide.php" class="px-3 py-2 rounded-md hover:bg-green-700">Pest Guide</a></li>
                    <li><a href="about.php" class="px-3 py-2 rounded-md hover:bg-green-700">About</a></li>
                    <li><a href="loginPage.php" class="px-3 py-2 rounded-md bg-gradient-to-r from-green-700 to-green-800">Login</a></li>
                    <li><a href="signupPage.php" class="px-3 py-2 rounded-md hover:bg-green-700">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Form -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white bg-opacity-90 backdrop-blur-lg rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-700 to-blue-800 mb-6 text-center">
                Welcome Back
            </h1>
            <form class="space-y-6" action="" method="POST">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" 
                           id="username" 
                           name="username" 
                           required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Enter your username">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Enter your email">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Enter your password">
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="remember-me" 
                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="text-sm text-green-600 hover:text-green-700">
                        Forgot password?
                    </a>
                </div>
                <div>
                    <?php
                        // session_start();//must be the first line before any ouput to initialize seesion
                        if(isset($_SESSION['error message']))
                        {
                            echo $_SESSION['error message'];
                            unset($_SESSION['error message']);
                        }
                    ?>
                </div>
                <div>
                    <button type="submit" 
                            class="w-full py-2 px-4 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-md hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-300">
                        Log In
                    </button>
                </div>
            </form>
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a href="signupPage.html" class="font-medium text-green-600 hover:text-green-700">
                        Sign up here
                    </a>
                </p>
            </div>
        </div>
    </main>
</body>
</html>


