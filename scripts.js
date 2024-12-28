document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#date", { dateFormat: "Y-m-d" });
    flatpickr("#start-time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });
    flatpickr("#finish-time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });
});

document.getElementById('contact-form').addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/wp-content/themes/Divi-Child-Theme/send_email.php', true);
    xhr.onload = function () {
        const messageDiv = document.getElementById('form-message');
        if (xhr.status === 200) {
            messageDiv.textContent = 'Вашето съобщение беше изпратено успешно!';
            messageDiv.className = 'success';
            messageDiv.style.display = 'block';
        } else {
            messageDiv.textContent = 'Възникна грешка при изпращането на формата. Моля, опитайте отново.';
            messageDiv.className = 'error';
            messageDiv.style.display = 'block';
        }
    };
    xhr.send(formData);
});
