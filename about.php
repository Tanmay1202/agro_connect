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
    <title>About - Pest Alert System</title>
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
                    <li><a href="guide.php" class="px-3 py-2 rounded-md hover:bg-green-700">Pest Guide</a></li>
                    <li><a href="about.php" class="px-3 py-2 rounded-md bg-gradient-to-r from-green-700 to-green-800 hover:from-green-800 hover:to-green-900">About</a></li>
                    <li><a href="logout.php" class="px-3 py-2 rounded-md hover:bg-green-700">Logout</a></li>
                    <li><a href="profile.php" class="px-3 py-2 rounded-md hover:bg-green-700">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-700 to-blue-800 mb-8 text-center">About the Pest Alert System</h1>
        
        <!-- About Section -->
        <section class="max-w-3xl mx-auto mb-12 bg-white bg-opacity-90 backdrop-blur-lg rounded-lg shadow-lg p-8">
            <div class="prose prose-green max-w-none">
                <h2 class="text-2xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-800 mb-4">Our Mission</h2>
                <p class="mb-4">
                    The Real-Time Pest and Disease Alert System is designed to empower farmers with timely information and resources to protect their crops. Our platform combines real-time monitoring with comprehensive pest and disease identification to help farmers make informed decisions about crop protection.
                </p>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">Key Features</h3>
                <ul class="list-disc list-inside space-y-2 mb-4">
                    <li><strong>Real-Time Dashboard:</strong> Monitor current pest and disease threats with live updates and risk assessments for different crops.</li>
                    <li><strong>Comprehensive Guide:</strong> Access detailed information about common pests and diseases, including identification tips and treatment solutions.</li>
                    <li><strong>Smart Alerts:</strong> Receive timely notifications about potential threats based on crop selection and environmental conditions.</li>
                </ul>

                <h3 class="text-xl font-semibold text-gray-800 mb-3">How It Works</h3>
                <p class="mb-4">
                    Our system uses advanced monitoring techniques to track pest populations and disease conditions in real-time. By combining this data with crop-specific information, we provide targeted alerts and recommendations to help farmers take preventive action before significant damage occurs.
                </p>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section class="max-w-xl mx-auto">
            <div class="bg-white bg-opacity-90 backdrop-blur-lg rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-800 mb-6">Contact Us</h2>
                <form id="contactForm" class="space-y-6" onsubmit="handleSubmit(event)">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            required 
                            aria-required="true"
                        >
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            required 
                            aria-required="true"
                        >
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea 
                            id="message" 
                            name="message" 
                            rows="4" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent"
                            required 
                            aria-required="true"
                        ></textarea>
                    </div>
                    <button 
                        type="submit"
                        class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-2 px-4 rounded-md hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-300"
                    >
                        Send Message
                    </button>
                </form>
            </div>
        </section>
    </main>

    <script>
        function handleSubmit(event) {
            event.preventDefault();
            
            // Get form values
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            // Show success message
            alert(`Thank you for your message, ${name}!\n\nWe've received your feedback and will get back to you at ${email} soon.`);
            
            // Reset form
            event.target.reset();
        }
    </script>
</body>
</html>
