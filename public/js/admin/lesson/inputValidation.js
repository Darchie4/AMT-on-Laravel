document.addEventListener('DOMContentLoaded', function () {
    async function getLabel(file, label) {
        try {
            const data = await $.getJSON('/lang/' + file + '/' + label);
            return data.label;
        } catch (error) {
            console.error('Error:', error);
            return 'An error occurred while retrieving the label.';
        }
    }

    // Function to validate date fields
    function validateDateFields(startDate, endDate) {
        if (!startDate || !endDate) return true; // Allow if any date field is empty
        var start = new Date(startDate);
        var end = new Date(endDate);
        if (end < new Date("2000-01-01")) {
            return true;
        }
        return start < end;
    }

    // Function to validate number fields
    function validateNumberFields(num1, num2) {
        if (isNaN(num1) || isNaN(num2)) return true; // Allow if any field is empty or non-numeric
        return num1 <= num2;
    }

    // Function to validate time slots
    async function validateTimeSlots(startTimes, endTimes, days) {
        for (var i = 0; i < startTimes.length; i++) {
            var startTime = startTimes[i];
            var endTime = endTimes[i];
            var day = days[i];
            if (startTime && endTime) {
                var start = new Date('1970-01-01T' + startTime);
                var end = new Date('1970-01-01T' + endTime);
                if (start >= end) {
                    return await getLabel('customlabels', 'lesson_create_error_end_or_startime_reverse');
                }
                for (var j = i + 1; j < startTimes.length; j++) {
                    var nextStartTime = startTimes[j];
                    var nextEndTime = endTimes[j];
                    var nextDay = days[j];
                    if (day === nextDay && ((startTime <= nextStartTime && nextStartTime < endTime) || (startTime < nextEndTime && nextEndTime <= endTime))) {
                        return await getLabel('customlabels', 'lesson_create_error_timeslot_overlap');
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

    // Event listeners for input fields
    document.getElementById('season_start').addEventListener('change', async function () {
        var seasonStart = this.value;
        var seasonEnd = document.getElementById('season_end').value;
        if (!validateDateFields(seasonStart, seasonEnd)) {
            alert(await getLabel('customlabels', 'lesson_create_error_season_endBeforeStart'));
            this.value = "";
        }
    });

    document.getElementById('season_end').addEventListener('change', async function () {
        var seasonStart = document.getElementById('season_start').value;
        var seasonEnd = this.value;
        if (!validateDateFields(seasonStart, seasonEnd)) {
            alert(await getLabel('customlabels', 'lesson_create_error_season_startAfterEnd'));
            this.value = "";
        }
    });

    document.getElementById('age_min').addEventListener('change', async function () {
        var ageMin = parseInt(this.value);
        var ageMax = parseInt(document.getElementById('age_max').value);
        if (!validateNumberFields(ageMin, ageMax)) {
            alert(await getLabel('customlabels', 'lesson_create_error_age_minLargerThanMax'));
            this.value = "";
        }
    });

    document.getElementById('age_max').addEventListener('change', async function () {
        var ageMin = parseInt(document.getElementById('age_min').value);
        var ageMax = parseInt(this.value);
        if (!validateNumberFields(ageMin, ageMax)) {
            alert(await getLabel('customlabels', 'lesson_create_error_age_maxSmallerThanMin'));
            this.value = "";
        }
    });

    document.getElementById('sorting_index').addEventListener('change', async function () {
        var sortingIndex = parseInt(this.value);
        if (!validateNegativeValue(sortingIndex)) {
            alert(await getLabel('customlabels', 'lesson_create_error_valueCannotBeLesThanZero'));
            this.value = "";
        }
    });

    document.getElementById('total_signup_space').addEventListener('change', async function () {
        if (!validateNegativeValue(parseFloat(this.value))) {
            alert(await getLabel('customlabels', 'lesson_create_error_valueCannotBeLesThanZero'));
            this.value = "";
        }
    });

    document.getElementById('timeslotsContainer').addEventListener('change', async function () {
        var startTimes = document.querySelectorAll('[id^=start_time_]');
        var endTimes = document.querySelectorAll('[id^=end_time_]');
        var days = document.querySelectorAll('[id^=day_]');
        var validationResult = await validateTimeSlots(Array.from(startTimes).map(el => el.value), Array.from(endTimes).map(el => el.value), Array.from(days).map(el => parseInt(el.value)));
        if (validationResult !== true) {
            alert(validationResult);
        }
    });
});
