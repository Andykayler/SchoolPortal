// This script could be used to dynamically update the course percentage in case it needs to be interactive or fetched from a server.
// For now, we are assuming the percentage is hard-coded in the HTML via the data attribute.

document.addEventListener('DOMContentLoaded', () => {
    const circles = document.querySelectorAll('.progress-circle');
    
    circles.forEach(circle => {
        const percentage = circle.getAttribute('data-percentage');
        // You can add animations or other dynamic features here if needed.
    });
});
