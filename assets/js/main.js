// Main JavaScript file for the Pest Alert System

// Mock data for crops and their threats
const cropData = {
    wheat: {
        threats: [
            "Wheat Rust Disease",
            "Aphids",
            "Powdery Mildew"
        ],
        riskLevel: "moderate"
    },
    rice: {
        threats: [
            "Rice Blast",
            "Brown Plant Hopper",
            "Bacterial Leaf Blight"
        ],
        riskLevel: "high"
    },
    maize: {
        threats: [
            "Fall Armyworm",
            "Corn Leaf Blight",
            "Stalk Rot"
        ],
        riskLevel: "low"
    }
};


// Mock alerts data
const mockAlerts = [
    {
        message: "High population of aphids detected in wheat fields",
        severity: "critical",
        timestamp: new Date(Date.now() - 1000 * 60 * 5) // 5 minutes ago
    },
    {
        message: "Favorable conditions for powdery mildew development",
        severity: "warning",
        timestamp: new Date(Date.now() - 1000 * 60 * 15) // 15 minutes ago
    },
    {
        message: "Rice blast disease risk increasing due to humidity",
        severity: "critical",
        timestamp: new Date(Date.now() - 1000 * 60 * 30) // 30 minutes ago
    }
];


// Initialize the dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const cropSelect = document.getElementById('cropSelect');
    const alertFeed = document.getElementById('alertFeed');
    
    // Initialize with stored crop selection or default to wheat
    const storedCrop = localStorage.getItem('selectedCrop') || 'wheat';
    cropSelect.value = storedCrop;
    updateCropSummary(storedCrop);

    // Handle crop selection change
    cropSelect.addEventListener('change', function() {
        const selectedCrop = this.value;
        localStorage.setItem('selectedCrop', selectedCrop);
        updateCropSummary(selectedCrop);
    });

    // Initialize alerts
    updateAlertFeed(mockAlerts);

    // Set up periodic updates
    setInterval(() => {
        generateNewAlert();
    }, 10000); // Generate new alert every 10 seconds
});

function updateCropSummary(cropName) {
    const data = cropData[cropName];
    const riskLevel = document.getElementById('riskLevel');
    const threatsList = document.getElementById('threatsList');

    // Update risk level with appropriate color
    riskLevel.textContent = data.riskLevel.toUpperCase();
    riskLevel.className = 'px-2 py-1 rounded text-sm font-medium ' + getRiskLevelClass(data.riskLevel);

    // Update threats list
    threatsList.innerHTML = data.threats
        .map(threat => `<li>${threat}</li>`)
        .join('');
}


function getRiskLevelClass(level) {
    switch(level.toLowerCase()) {
        case 'high':
            return 'bg-red-100 text-red-800';
        case 'moderate':
            return 'bg-yellow-100 text-yellow-800';
        case 'low':
            return 'bg-green-100 text-green-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
}

function updateAlertFeed(alerts) {
    const alertFeed = document.getElementById('alertFeed');
    const alertsHTML = alerts.map(alert => createAlertCard(alert)).join('');
    alertFeed.innerHTML = alertsHTML;
}

function createAlertCard(alert) {
    const severityClass = alert.severity === 'critical' 
        ? 'bg-red-100 border-red-500 text-red-700' 
        : 'bg-yellow-100 border-yellow-500 text-yellow-700';

    return `
        <div class="alert-card ${severityClass} border-l-4 p-4 rounded-r-lg transition-transform hover:scale-105">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <p class="font-medium">${alert.message}</p>
                    <p class="text-sm mt-1">${formatTimestamp(alert.timestamp)}</p>
                </div>
                <span class="text-sm font-semibold uppercase">${alert.severity}</span>
            </div>
        </div>
    `;
}

function formatTimestamp(date) {
    const now = new Date();
    const diffMinutes = Math.floor((now - date) / (1000 * 60));
    
    if (diffMinutes < 1) return 'Just now';
    if (diffMinutes < 60) return `${diffMinutes} minutes ago`;
    
    return date.toLocaleTimeString();
}

function generateNewAlert() {
    const messages = [
        "New pest activity detected in northern fields",
        "Weather conditions favorable for disease development",
        "Preventive spraying recommended for crop protection",
        "Pest population exceeding threshold levels"
    ];

    const newAlert = {
        message: messages[Math.floor(Math.random() * messages.length)],
        severity: Math.random() > 0.5 ? 'critical' : 'warning',
        timestamp: new Date()
    };

    mockAlerts.unshift(newAlert);
    if (mockAlerts.length > 10) mockAlerts.pop(); // Keep only last 10 alerts
    
    updateAlertFeed(mockAlerts);
}