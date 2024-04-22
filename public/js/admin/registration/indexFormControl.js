document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll("input[type='checkbox']");
    const moveAllButton = document.getElementById("moveAllButton");
    const moveSelectedButton = document.getElementById("moveSelectedButton");
    const deleteAllButton = document.getElementById("deleteAllButton");
    const deleteSelectedButton = document.getElementById("deleteSelectedButton");
    const rows = document.querySelectorAll("tr");

    // Function to check if any checkbox is checked
    function anyCheckboxChecked() {
        for (const checkbox of checkboxes) {
            if (checkbox.checked) {
                return true;
            }
        }
        return false;
    }

    rows.forEach(row => {
        row.addEventListener("click", function () {
            const checkbox = row.querySelector("input[type='checkbox']");
            if (checkbox) {
                checkbox.checked = !checkbox.checked;
                updateButtonsVisibility()
            }
        });
    });

    // Function to update the visibility of buttons
    function updateButtonsVisibility() {
        if (anyCheckboxChecked()) {
            moveAllButton.style.display = "none";
            moveSelectedButton.style.display = "block"; // Show the move selected button
            deleteAllButton.style.display = "none";
            deleteSelectedButton.style.display = "block"; // Show the move selected button
        } else {
            moveAllButton.style.display = "block"; // Show the move all button
            moveSelectedButton.style.display = "none";
            deleteAllButton.style.display = "block"; // Show the move all button
            deleteSelectedButton.style.display = "none";
        }
    }

    // Listen for changes in checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", updateButtonsVisibility);
    });

    // Initialize button visibility
    updateButtonsVisibility();
});
