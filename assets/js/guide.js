// Pest and Disease Guide Data
const guideData = [
    {
        id: 1,
        name: "Aphids",
        type: "pest",
        symptoms: [
            "Curling or distorted leaves",
            "Yellowing of leaves",
            "Sticky residue on leaves (honeydew)",
            "Presence of small green, black, or white insects"
        ],
        solutions: [
            "Introduce natural predators (ladybugs, lacewings)",
            "Apply insecticidal soap or neem oil",
            "Remove heavily infested plant parts",
            "Maintain proper plant spacing for airflow"
        ]
    },
    {
        id: 2,
        name: "Wheat Rust",
        type: "disease",
        symptoms: [
            "Orange-brown pustules on leaves and stems",
            "Reduced plant vigor",
            "Yellowing of leaves",
            "Reduced grain quality"
        ],
        solutions: [
            "Plant resistant varieties",
            "Apply fungicides at early disease onset",
            "Rotate crops with non-host plants",
            "Monitor weather conditions for disease risk"
        ]
    },
    {
        id: 3,
        name: "Fall Armyworm",
        type: "pest",
        symptoms: [
            "Ragged feeding damage on leaves",
            "Circular holes in leaves",
            "Presence of frass (excrement)",
            "Damaged growing points"
        ],
        solutions: [
            "Early detection and monitoring",
            "Apply biological control agents",
            "Use pheromone traps",
            "Time planting to avoid peak pest periods"
        ]
    },
    {
        id: 4,
        name: "Rice Blast",
        type: "disease",
        symptoms: [
            "Diamond-shaped lesions on leaves",
            "White to gray centers in lesions",
            "Infected grains and nodes",
            "Reduced yield"
        ],
        solutions: [
            "Use disease-resistant varieties",
            "Apply fungicides preventively",
            "Maintain proper water management",
            "Avoid excessive nitrogen fertilization"
        ]
    },
    {
        id: 5,
        name: "Corn Borer",
        type: "pest",
        symptoms: [
            "Broken tassels",
            "Holes in stalks",
            "Stunted growth",
            "Yield loss"
        ],
        solutions: [
            "Release natural enemies",
            "Apply targeted insecticides",
            "Practice crop rotation",
            "Plant early in the season"
        ]
    }
];

// Initialize the guide when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const modal = document.getElementById('detailsModal');

    // Initialize guide grid
    renderGuideGrid(guideData);

    // Set up search functionality
    searchInput.addEventListener('input', handleSearch);

    // Set up keyboard navigation for modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});

// Render the guide grid with provided data
function renderGuideGrid(data) {
    const grid = document.getElementById('guideGrid');
    grid.innerHTML = data.map(item => createGuideCard(item)).join('');
}

// Create a guide card HTML
function createGuideCard(item) {
    const typeClass = item.type === 'pest' 
        ? 'bg-red-100 text-red-800' 
        : 'bg-yellow-100 text-yellow-800';

    return `
        <div class="guide-card bg-white bg-opacity-90 rounded-lg shadow-md p-6 transition-all duration-300 hover:shadow-lg hover:scale-105 cursor-pointer"
             onclick="showDetails(${item.id})"
             role="listitem"
             aria-label="${item.name} - ${item.type}"
             tabindex="0"
             onkeypress="(e) => { if (e.key === 'Enter') showDetails(${item.id}) }">
            <h3 class="text-xl font-semibold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-800 mb-2">
                ${item.name}
            </h3>
            <span class="inline-block ${typeClass} px-2 py-1 rounded-full text-sm font-medium capitalize mb-3">
                ${item.type}
            </span>
            <div class="text-gray-600">
                <p class="font-medium mb-1">Key Symptoms:</p>
                <ul class="list-disc list-inside text-sm space-y-1">
                    ${item.symptoms.slice(0, 2).map(symptom => `
                        <li>${symptom}</li>
                    `).join('')}
                </ul>
                <p class="text-sm text-green-600 mt-2">Click for more details →</p>
            </div>
        </div>
    `;
}

// Handle search functionality
function handleSearch(e) {
    const searchTerm = e.target.value.toLowerCase();
    const filteredData = guideData.filter(item => {
        const nameMatch = item.name.toLowerCase().includes(searchTerm);
        const symptomsMatch = item.symptoms.some(symptom => 
            symptom.toLowerCase().includes(searchTerm)
        );
        return nameMatch || symptomsMatch;
    });
    
    renderGuideGrid(filteredData);
}

// Show details modal
function showDetails(id) {
    const item = guideData.find(item => item.id === id);
    if (!item) return;

    const modal = document.getElementById('detailsModal');
    const typeClass = item.type === 'pest' 
        ? 'bg-red-100 text-red-800' 
        : 'bg-yellow-100 text-yellow-800';

    // Update modal content
    document.getElementById('modalTitle').textContent = item.name;
    document.getElementById('modalType').textContent = item.type;
    document.getElementById('modalType').className = `ml-2 px-2 py-1 rounded-full text-sm font-medium capitalize ${typeClass}`;
    
    document.getElementById('modalSymptoms').innerHTML = item.symptoms
        .map(symptom => `<li>${symptom}</li>`)
        .join('');
    
    document.getElementById('modalSolutions').innerHTML = item.solutions
        .map(solution => `<li>${solution}</li>`)
        .join('');

    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    // Focus on modal for accessibility
    modal.focus();
}

// Close modal
function closeModal() {
    const modal = document.getElementById('detailsModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
