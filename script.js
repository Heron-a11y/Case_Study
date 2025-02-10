// Gab jardin
document.addEventListener("DOMContentLoaded", () => {
    const addPatientBtn = document.getElementById("addPatientBtn");
    const addPatientModal = new bootstrap.Modal(document.getElementById("addPatientModal"));
    const addPatientForm = document.getElementById("addPatientForm");
    const patientList = document.getElementById("patientList");
    const menuToggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidebar");
    const mainContent = document.querySelector(".main-content");
    const sortByName = document.getElementById("sortByName");
    const sortByStatus = document.getElementById("sortByStatus");

    let nameSortOrder = "asc"; // Default sorting order

    // Sidebar Toggle Functionality
    menuToggle.addEventListener("click", () => {
        sidebar.classList.toggle("show");
        mainContent.classList.toggle("show");
    });

    // Show Modal on Button Click
    addPatientBtn.addEventListener("click", () => {
        addPatientModal.show();
    });

    // Handle Form Submission
    addPatientForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch("add_patient.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json()) 
        .then(data => {
            if (data.status === "success") {
                alert("✅ " + data.message);
                addPatientForm.reset();
                addPatientModal.hide();
                loadPatients(); 
            } else {
                alert("❌ Error: " + data.message);
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
            alert("An error occurred. Please try again.");
        });
    });

    function loadPatients() {
        const statusFilter = sortByStatus.value || "";
        let url = `fetch_patients.php?sortBy=Patient_name&order=${nameSortOrder}`;

        if (statusFilter && statusFilter !== "All Status") {
            url += `&status=${statusFilter}`;
        }

        console.log(`🔍 Fetching: ${url}`); // Debugging log

        fetch(url)
            .then(response => response.text())
            .then(data => {
                console.log("📊 Data Loaded:", data);
                patientList.innerHTML = data;
            })
            .catch(error => {
                console.error("❌ Error loading patients:", error);
                patientList.innerHTML = "<tr><td colspan='8'>Failed to load patient records.</td></tr>";
            });
    }

    // **Fix: Handle Sorting Correctly**
    sortByName.addEventListener("change", () => {
        nameSortOrder = sortByName.value; // Get value from select dropdown
        console.log(`🔄 Sorting Order Changed: ${nameSortOrder}`); // Debugging log
        loadPatients(); // Fetch new sorted list
    });

    // Event listener for filtering by Status
    sortByStatus.addEventListener("change", loadPatients);

    // Load patients initially
    loadPatients();
});
