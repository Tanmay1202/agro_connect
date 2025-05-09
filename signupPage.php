<?php
include 'api/db_connect.php';

$stmt = null; // Initialize $stmt

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['firstName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirmPassword = trim($_POST['confirmPassword'] ?? '');

    if ($password !== $confirmPassword) {
        $error_message = "Passwords do not match!";
    } else {
        $check_stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error_message = "Username already taken!";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);

            if ($stmt->execute()) {
                header("Location: loginPage.php");
                exit();
            } else {
                $error_message = "ERROR: " . $conn->error;
            }
            if ($stmt) $stmt->close(); // Close only if prepared
        }
        if ($check_stmt) $check_stmt->close(); // Close check statement
    }

    $conn->close(); // Close connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnviRon Sign Up</title>
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
                    <li><a href="guide.php" class="px-3 py-2 rounded-md hover:bg-green-700">Guide</a></li>
                    <li><a href="about.php" class="px-3 py-2 rounded-md hover:bg-green-700">About</a></li>
                    <li><a href="loginPage.php" class="px-3 py-2 rounded-md hover:bg-green-700">Login</a></li>
                    <li><a href="signupPage.php" class="px-3 py-2 rounded-md bg-gradient-to-r from-green-700 to-green-800">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sign Up Form -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white bg-opacity-90 backdrop-blur-lg rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-700 to-blue-800 mb-6 text-center">
                Create Account
            </h1>
            <form class="space-y-6" action="" method="POST">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" 
                               id="firstName" 
                               name="firstName" 
                               required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="Name">
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
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
                           placeholder="Create a password">
                </div>
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" 
                           id="confirmPassword" 
                           name="confirmPassword" 
                           required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Confirm your password">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="terms" 
                           required
                           class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        I agree to the <a href="#" class="text-green-600 hover:text-green-700">Terms and Conditions</a>
                    </label>
                </div>
                <div>
                    <button type="submit" 
                            class="w-full py-2 px-4 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-md hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-300">
                        Create Account
                    </button>
                </div>
            </form>
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="loginPage.php" class="font-medium text-green-600 hover:text-green-700">
                        Sign in here
                    </a>
                </p>
                <?php if (isset($error_message)) echo "<p class='text-red-600'>$error_message</p>"; ?>
            </div>
        </div>
    </main>
</body>
</html>