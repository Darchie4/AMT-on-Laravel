// Retrieve locations data from data-locations attribute
const locations = JSON.parse(document.currentScript.getAttribute('data-locations'));

function addTimeslot() {
    const container = document.getElementById('timeslotsContainer');
    const timeslotCount = container.getElementsByClassName('timeslot').length;

    const timeslotDiv = document.createElement('div');
    timeslotDiv.classList.add('timeslot');

    timeslotDiv.innerHTML = `
        <hr class="hr">
        <div class="row g-2">
            <div class="col">
                <label for="start_time_${timeslotCount}">Start Time</label>
                <input class="form-control" type="time" id="start_time_${timeslotCount}" name="start_times[]" required>
            </div>
            <div class="col">
                <label for="end_time_${timeslotCount}">End Time</label>
                <input class="form-control" type="time" id="end_time_${timeslotCount}" name="end_times[]" required>
            </div>
        </div>
        <div class="row g-2">
            <div class="col">
                <label for="day_${timeslotCount}">Day of Week</label>
                <select class="form-control" id="day_${timeslotCount}" name="days[]" required>
                    <option value="0">Monday</option>
                    <option value="1">Tuesday</option>
                    <option value="2">Wednesday</option>
                    <option value="3">Thursday</option>
                    <option value="4">Friday</option>
                    <option value="5">Saturday</option>
                    <option value="6">Sunday</option>
                </select>
            </div>
            <div class="col">
                <label for="location_${timeslotCount}">Location</label>
                <select class="form-control" id="location_${timeslotCount}" name="locations[]" required>
                    ${locations.map(location => `<option value="${location.id}">${location.name}</option>`).join('')}
                </select>
            </div>
        </div>
        <button type="button" class="btn btn-danger remove-timeslot-btn" onclick="removeTimeslot(this)">Remove Timeslot</button>
    `;

    container.appendChild(timeslotDiv);
}

function removeTimeslot(button) {
    const timeslotDiv = button.parentElement;
    timeslotDiv.remove();
}
