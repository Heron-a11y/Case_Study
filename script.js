document.addEventListener("DOMContentLoaded", () => {
    const addPatientBtn = document.getElementById("addPatientBtn");
    const addPatientModalEl = document.getElementById("addPatientModal");
    const addPatientModal = new bootstrap.Modal(addPatientModalEl);
    const addPatientForm = document.getElementById("addPatientForm");
    const menuToggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidebar");
    const mainContent = document.querySelector(".main-content");

    // Sidebar Toggle Functionality
    menuToggle.addEventListener("click", () => {
        sidebar.classList.toggle("show");
        mainContent.classList.toggle("show");
    });

    addPatientBtn.addEventListener("click", () => {
        addPatientModal.show();
    });

    addPatientForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        try {
            let response = await fetch("add_patient.php", {
                method: "POST",
                body: formData
            });

            let data = await response.text();
            console.log("Server Response:", data); // Debugging

            if (data.trim().toLowerCase() === "success") {
                addPatientModal.hide();
                addPatientForm.reset();
                loadPatients();
            } else {
                alert("Error: Could not save patient. Please try again.");
            }
        } catch (error) {
            console.error("Fetch Error:", error);
            alert("An error occurred while saving. Check console for details.");
        }
    });

    async function loadPatients() {
        try {
            let response = await fetch("fetch_patients.php");
            let data = await response.text();
            document.getElementById("patientList").innerHTML = data;
        } catch (error) {
            console.error("Error fetching patients:", error);
        }
    }

    loadPatients();
});
