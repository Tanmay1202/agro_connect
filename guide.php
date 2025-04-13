<?php
session_start();
if(!isset($_SESSION['username']))
{
    header('Location: loginPage.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pest and Disease Guide - Pest Alert System</title>
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
                    <li><a href="index.php" class="px-3 py-2 rounded-md hover:bg-green-700">Dashboard</a></li>
                    <li><a href="guide.php" class="px-3 py-2 rounded-md bg-gradient-to-r from-green-700 to-green-800 hover:from-green-800 hover:to-green-900">Pest Guide</a></li>
                    <li><a href="about.php" class="px-3 py-2 rounded-md hover:bg-green-700">About</a></li>
                    <li><a href="logout.php" class="px-3 py-2 rounded-md hover:bg-green-700">Logout</a></li>
                    <li><a href="profile.php" class="px-3 py-2 rounded-md hover:bg-green-700">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-700 to-blue-800 mb-8">Pest and Disease Guide</h1>
        
        <!-- Search Section -->
        <div class="mb-8">
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <input 
                        type="search" 
                        id="searchInput"
                        class="w-full px-4 py-3 rounded-lg border border-green-200 focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white bg-opacity-90"
                        placeholder="Search by pest/disease name or symptom..."
                        aria-label="Search pests and diseases"
                    >
                    <span class="absolute right-3 top-3 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <!-- Guide Grid -->
        <div id="guideGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" role="list" aria-label="Pest and disease guide list">
            <!-- Cards will be dynamically inserted here -->
        </div>
    </main>

    <!-- Modal Template -->
    <div id="detailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="bg-white bg-opacity-90 backdrop-blur-lg rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 id="modalTitle" class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-800"></h2>
                    <button 
                        class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 rounded-lg"
                        onclick="closeModal()"
                        aria-label="Close modal"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="space-y-4">
                    <div>
                        <span class="text-sm font-medium text-gray-500">Type:</span>
                        <span id="modalType" class="ml-2 px-2 py-1 rounded-full text-sm font-medium"></span>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">Symptoms</h3>
                        <ul id="modalSymptoms" class="list-disc list-inside text-gray-600 space-y-1"></ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">Solutions</h3>
                        <ul id="modalSolutions" class="list-disc list-inside text-gray-600 space-y-1"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/guide.js"></script>
</body>
</html>
