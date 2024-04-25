document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('difficulty').addEventListener('change', function () {
        var difficultyInput = this;
        var selectedOption = difficultyInput.value;
        var datalistOptions = document.getElementById('difficulties').querySelectorAll('option');

        var selectedOptionData = [...datalistOptions].find(option => option.value === selectedOption);
        document.getElementById('sorting_index_label').hidden = false;
        document.getElementById('sorting_index').hidden = false;

        if (selectedOptionData) {
            // If an existing difficulty is selected, fill the sorting index field
            document.getElementById('sorting_index').value = selectedOptionData.dataset.index;
        } else {
            // If a new difficulty is typed, set the sorting index to the next available integer
            var maxIndex = [...datalistOptions].reduce((max, option) => Math.max(max, parseInt(option.dataset.index) || 0), 0);
            document.getElementById('sorting_index').value = maxIndex + 1;
        }
    });
});
