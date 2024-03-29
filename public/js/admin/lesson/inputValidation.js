document.addEventListener('DOMContentLoaded', function () {
    // Function to validate date fields
    function validateDateFields(startDate, endDate) {
        if (!startDate || !endDate) return true; // Allow if any date field is empty
        var start = new Date(startDate);
        var end = new Date(endDate);
        return start < end;
    }

    // Function to validate number fields
    function validateNumberFields(num1, num2) {
        if (isNaN(num1) || isNaN(num2)) return true; // Allow if any field is empty or non-numeric
        return num1 <= num2;
    }

    // Function to validate time slots
    function validateTimeSlots(startTimes, endTimes, days) {
        for (var i = 0; i < startTimes.length; i++) {
            var startTime = startTimes[i];
            var endTime = endTimes[i];
            var day = days[i];
            if (startTime && endTime) {
                var start = new Date('1970-01-01T' + startTime);
                var end = new Date('1970-01-01T' + endTime);
                if (start >= end) {
                    return "Some time slots have end times before start times.";
                }
                for (var j = i + 1; j < startTimes.length; j++) {
                    var nextStartTime = startTimes[j];
                    var nextEndTime = endTimes[j];
                    var nextDay = days[j];
                    if (day == nextDay && ((startTime <= nextStartTime && nextStartTime < endTime) || (startTime < nextEndTime && nextEndTime <= endTime))) {
                        return "Some time slots overlap.";
                    }
                }
            }
        }
        return true;
    }

    // Function to validate negative values
    function validateNegativeValue(value) {
        return isNaN(value) || value >= 0; // Allow if value is not a number or is non-negative
    }

    // Function to get the index of the selected difficulty in the difficulties datalist
    function getSelectedDifficultyIndex() {
        var difficultySelect = document.getElementById('difficulty');
        var selectedValue = difficultySelect.value;
        var difficultiesOptions = document.getElementById('difficulties').options;
        for (var i = 0; i < difficultiesOptions.length; i++) {
            if (difficultiesOptions[i].value === selectedValue) {
                return i;
            }
        }

        return -1; // Return -1 if the selected difficulty is not found in the datalist
    }

    // Function to get the value of the data-index attribute of an option in the difficulties datalist
    function getDifficultySortingIndex(optionIndex) {
        var difficultiesOptions = document.getElementById('difficulties').options;
        var option = difficultiesOptions[optionIndex];
        if (option) {
            return option.getAttribute('data-index');
        }
        return null; // Return null if the option does not exist
    }

// Function to validate the sorting index against existing difficulties
    function validateSortingIndex(sortingIndex) {
        var difficultiesDatalist = document.getElementById('difficulties');
        var sortingIndices = Array.from(difficultiesDatalist.options).map(option => parseInt(option.dataset.index));

        if (sortingIndices.includes(sortingIndex) && sortingIndex !== parseInt(getDifficultySortingIndex(getSelectedDifficultyIndex()))) {
            return "Sorting index already exists in the list of difficulties."
        }
        return true;
    }

    // Event listeners for input fields
    document.getElementById('season_start').addEventListener('change', function () {
        var seasonStart = this.value;
        var seasonEnd = document.getElementById('season_end').value;
        if (!validateDateFields(seasonStart, seasonEnd)) {
            alert("Season start must be before season end.");
            this.value = "";
        }
    });

    document.getElementById('season_end').addEventListener('change', function () {
        var seasonStart = document.getElementById('season_start').value;
        var seasonEnd = this.value;
        if (!validateDateFields(seasonStart, seasonEnd)) {
            alert("Season end must be after season start.");
            this.value = "";
        }
    });

    document.getElementById('age_min').addEventListener('change', function () {
        var ageMin = parseInt(this.value);
        var ageMax = parseInt(document.getElementById('age_max').value);
        if (!validateNumberFields(ageMin, ageMax)) {
            alert("Age min must be less than or equal to age max.");
            this.value = "";
        }
    });

    document.getElementById('age_max').addEventListener('change', function () {
        var ageMin = parseInt(document.getElementById('age_min').value);
        var ageMax = parseInt(this.value);
        if (!validateNumberFields(ageMin, ageMax)) {
            alert("Age max must be greater than or equal to age min.");
            this.value = "";
        }
    });

    // Event listener for sorting index change
    document.getElementById('sorting_index').addEventListener('change', function () {
        var sortingIndex = parseInt(this.value);
        if (!validateNegativeValue(sortingIndex)) {
            alert("Sorting index cannot be negative.");
            this.value = "";
        } else {
            var validationResult = validateSortingIndex(sortingIndex);
            if (validationResult !== true) {
                alert(validationResult);
                this.value = getDifficultySortingIndex(getSelectedDifficultyIndex());
            }
        }
    });

    document.getElementById('price').addEventListener('change', function () {
        if (!validateNegativeValue(parseFloat(this.value))) {
            alert("Price cannot be negative.");
            this.value = "";
        }
    });

    document.getElementById('timeslotsContainer').addEventListener('change', function () {
        var startTimes = document.querySelectorAll('[id^=start_time_]');
        var endTimes = document.querySelectorAll('[id^=end_time_]');
        var days = document.querySelectorAll('[id^=day_]');
        var validationResult = validateTimeSlots(Array.from(startTimes).map(el => el.value), Array.from(endTimes).map(el => el.value), Array.from(days).map(el => parseInt(el.value)));
        if (validationResult !== true) {
            alert(validationResult);
            // You may want to clear or adjust the overlapping time slots here
        }
    });
});
