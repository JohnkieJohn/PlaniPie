import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

document.addEventListener('DOMContentLoaded', function() {
    const calendarWrapper = document.querySelector('.calendar-wrapper');

    calendarWrapper.addEventListener('click', function(event) {
        if (event.target.matches('.btn-nav-month')) {
            event.preventDefault();
            const monthId = event.target.getAttribute('data-month');
            updateMonth(monthId);
        }
    });

    function updateMonth(monthId) {
        fetch(`/calendar/monthly/${monthId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            const calendarContent = tempDiv.querySelector('.calendar-wrapper').innerHTML;
            document.querySelector('.calendar-wrapper').innerHTML = calendarContent;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    
    
});