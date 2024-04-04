$(document).ready(function() {
    // Add click event handler to table rows
    $('tbody tr').click(function() {
        // Get the URL from the data attribute and redirect to the URL
        window.location.href = $(this).data('url');
    });
});
