import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        document.addEventListener('DOMContentLoaded', function() {
            const calendarWrapper = document.querySelector('.calendar-wrapper');
            
            calendarWrapper.addEventListener('click', function(event) {
                if (event.target.matches('.btn-nav-month')) {
                    event.preventDefault();
                    const monthId = event.target.getAttribute('data-month');
                    updateMonth(monthId);
                }
            });
        
                    
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
    }
}