import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        document.addEventListener('DOMContentLoaded', function() {
            const calendarWrapper = document.querySelector('.calendar-wrapper');             
            const yearElement = document.querySelector('.title-year');
            let currentYear = parseInt(yearElement.textContent);

            calendarWrapper.addEventListener('click', function(event) {
                if (event.target.matches('.btn-nav-month')) {
                    event.preventDefault();
                    const monthId = event.target.getAttribute('data-month');
                    updateMonth(monthId);
                }
                if (event.target.matches('.btn-nav-year.btn-prev')) {
                    event.preventDefault();     
                    currentYear -= 1; 
                    updateYearTitle(currentYear);                
                }
                if (event.target.matches('.btn-nav-year.btn-next')) {
                    event.preventDefault();     
                    currentYear += 1; 
                    updateYearTitle(currentYear);                      
                }
            });                   
        });

        // Mets à jour le mois
        function updateMonth(monthId) {
            const yearElement = document.querySelector('.title-year');
            let currentYear = parseInt(yearElement.textContent);
            fetch(`/calendar/monthly/${monthId}/${currentYear}`, {
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

        // Mets à jour l'année (côté client)
        function updateYearTitle(newYear) {
            const yearElement = document.querySelector('.title-year');
            const monthElement = document.querySelector('.title-month');
            const currentMonthNumber = monthElement.getAttribute('data-month');

            yearElement.textContent = newYear;
            updateYear(currentMonthNumber, newYear);
        }

        // Mets à jour l'année (côté serveur)
        function updateYear(currentMonthNumber, newYear) {
            fetch(`/calendar/monthly/${currentMonthNumber}/${newYear}`, {
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