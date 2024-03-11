function clearFilters() {
    // Uncheck the checked roles
    document.querySelectorAll('#filter_form input[type="checkbox"]').forEach((checkbox) => {
        checkbox.checked = false;
    });

    // Submit the filters form
    document.getElementById('filter_form').submit();
}
