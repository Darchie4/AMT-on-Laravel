document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('difficulty').addEventListener('change', function () {
        var difficultyInput = this;
        var selectedOption = difficultyInput.value;
        var datalistOptions = document.getElementById('difficulties').querySelectorAll('option');

        var selectedOptionData = [...datalistOptions].find(option => option.value === selectedOption);
        if (selectedOptionData) {
            // If an existing difficulty is selected, fill the sorting index field
            var sortingIndex = selectedOptionData.dataset.index;
            document.getElementById('sorting_index').type = "number";
            document.getElementById('sorting_index').value = sortingIndex;
        } else {
            // If a new difficulty is typed, set the sorting index to the next available integer
            var maxIndex = [...datalistOptions].reduce((max, option) => Math.max(max, parseInt(option.dataset.index) || 0), 0);
            document.getElementById('sorting_index').type = "number";
            document.getElementById('sorting_index').value = maxIndex + 1;
        }
    });
});
