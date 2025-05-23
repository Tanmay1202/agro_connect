<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location: loginPage.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pest Alert System - Dashboard</title>
    <!-- Tailwind CSS via CDN -->
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
                    <li><a href="index.php" class="px-3 py-2 rounded-md bg-gradient-to-r from-green-700 to-green-800 hover:from-green-800 hover:to-green-900">Dashboard</a></li>
                    <li><a href="guide.php" class="px-3 py-2 rounded-md hover:bg-green-700">Pest Guide</a></li>
                    <li><a href="about.php" class="px-3 py-2 rounded-md hover:bg-green-700">About</a></li>
                    <li><a href="logout.php" class="px-3 py-2 rounded-md hover:bg-green-700">Logout</a></li>
                    <li><a href="Profile.php" class="px-3 py-2 rounded-md hover:bg-green-700">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-700 to-blue-800 mb-8">Pest Alert Dashboard</h1>
        
        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Crop Summary Widget -->
            <div class="lg:col-span-1">
                <div class="bg-white bg-opacity-90 backdrop-blur-lg rounded-lg shadow-lg p-6 border border-green-100" aria-label="Crop Summary">
                    <h2 class="text-xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-800 mb-4">Crop Summary</h2>
                    <div class="mb-4">
                        <label for="cropSelect" class="block text-sm font-medium text-gray-700 mb-2">Select Crop</label>
                        <select id="cropSelect" class="w-full border border-green-200 rounded-md px-3 py-2 focus:ring-green-500 focus:border-green-500 bg-white bg-opacity-90">
                            <option value="wheat">Wheat</option>
                            <option value="rice">Rice</option>
                            <option value="maize">Maize</option>
                        </select>
                    </div>
                    <div id="cropDetails" class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">Risk Level:</span>
                            <span id="riskLevel" class="px-2 py-1 rounded text-sm font-medium"></span>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-600 mb-2">Active Threats:</h3>
                            <ul id="threatsList" class="list-disc list-inside text-sm text-gray-700"></ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Feed -->
            <div class="lg:col-span-2">
                <div class="bg-white bg-opacity-90 backdrop-blur-lg rounded-lg shadow-lg p-6 border border-green-100" aria-label="Alert Feed">
                    <h2 class="text-xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-800 mb-4">Real-Time Alerts</h2>
                    <div id="alertFeed" class="space-y-4 max-h-[600px] overflow-y-auto" aria-live="polite">
                        <!-- Alert cards will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/js/main.js"></script>
</body>
</html>
