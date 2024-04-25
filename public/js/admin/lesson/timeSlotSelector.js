// Retrieve locations data from data-locations attribute
const locations = JSON.parse(document.currentScript.getAttribute('data-locations'));

async function getLabel(file, label) {
    try {
        const data = await $.getJSON('/lang/' + file + '/' + label);
        return data.label;
    } catch (error) {
        console.error('Error:', error);
        return 'An error occurred while retrieving the label.';
    }
}

async function addTimeslot() {
    const container = document.getElementById('timeslotsContainer');
    const timeslotCount = container.getElementsByClassName('timeslot').length;

    const timeslotDiv = document.createElement('div');
    timeslotDiv.classList.add('timeslot');

    timeslotDiv.innerHTML = `
        <div id="timeslot">
            <hr class="hr">
            <div class="row g-2">
                <div class="col">
                    <label for="start_time_${timeslotCount}"><b>${await getLabel('lesson', 'admin_create_startTime')}</b></label>
                    <input class="form-control" type="time" id="start_time_${timeslotCount}" name="start_times[]" required>
                </div>
                <div class="col">
                    <label for="end_time_${timeslotCount}"><b>${await getLabel('lesson', 'admin_create_endTime')}</b></label>
                    <input class="form-control" type="time" id="end_time_${timeslotCount}" name="end_times[]" required>
                </div>
            </div>
            <div class="row g-2">
                <div class="col">
                    <label for="day_${timeslotCount}"><b>${await getLabel('lesson', 'admin_create_weekDay_title')}</b></label>
                    <select class="form-control" id="day_${timeslotCount}" name="days[]" required>
                        <option value="0">${await getLabel('lesson', 'admin_create_weekDay_monday')}</option>
                        <option value="1">${await getLabel('lesson', 'admin_create_weekDay_tuesday')}</option>
                        <option value="2">${await getLabel('lesson', 'admin_create_weekDay_wednesday')}</option>
                        <option value="3">${await getLabel('lesson', 'admin_create_weekDay_thursday')}</option>
                        <option value="4">${await getLabel('lesson', 'admin_create_weekDay_friday')}</option>
                        <option value="5">${await getLabel('lesson', 'admin_create_weekDay_saturday')}</option>
                        <option value="6">${await getLabel('lesson', 'admin_create_weekDay_sunday')}</option>
                    </select>
                </div>
                <div class="col">
                    <label for="location_${timeslotCount}"><b>${await getLabel('lesson', 'admin_create_location')}</b>
                    <select class="form-control" id="location_${timeslotCount}" name="locations[]" required>
                        ${locations.map(location => `<option value="${location.id}">${location.name}</option>`).join('')}
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-danger remove-timeslot-btn" onclick="removeTimeslot(this)">${await getLabel('lesson', 'admin_create_button_removeTimeslot')}</button>
        </div>
    `;

    container.appendChild(timeslotDiv);
}

let timeslotsToDelete = [];
function removeTimeslot(button) {
    const timeslotId = button.parentElement.value;
    timeslotsToDelete.push(timeslotId);
    const timeslotDiv = button.parentElement;
    timeslotDiv.remove();
}

// Function to submit the form
function submitForm() {
    console.log(timeslotsToDelete);
    // Add the array of timeslot IDs to a hidden input field in the form
    document.getElementById('timeslotsToDeleteInput').value = JSON.stringify(timeslotsToDelete);
    document.getElementById('lessonForm').submit();
}
