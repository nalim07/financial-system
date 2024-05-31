function setDateTime() {
    const now = new Date();
    const dateTimeString = now.toISOString().replace('T', ' ').slice(0, 19);
    document.getElementById('date_time').value = dateTimeString;
}

window.onload = setDateTime;