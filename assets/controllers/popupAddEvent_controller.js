import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        document.addEventListener('DOMContentLoaded', function() {
            const dayCells = document.querySelectorAll('.day-cell');
            const popupEvent = document.querySelector('.popup-add-event');
            const btnClosePopup = document.getElementById('btn-close-popup');
            const titlePopupEvent = document.querySelector('.popup-add-event-title');
            const eventForm = document.getElementById('popup-add-event-form');
            const eventStart = document.getElementById('popup-add-event-start');
        
            dayCells.forEach(dayCell => {
                dayCell.addEventListener('click', function() {
                    const dayDate = this.dataset.day;
                    const dayDateTime = `${dayDate}T00:00`;

                    titlePopupEvent.textContent = 'Jour ' + dayDate;                   
                    eventStart.value = dayDateTime ;
                    popupEvent.style.display = 'block';
                });
            });

            eventForm.addEventListener('submit', function(event) {
                event.preventDefault();
                // Récupère les valeurs du formulaire
                const eventTitle = document.getElementById('popup-add-title').value;
                const eventDesc = document.getElementById('popup-add-desc').value;
                const eventEnd = document.getElementById('popup-add-event-end').value;               
                const eventRecurrence = document.getElementById('popup-add-recurrence').checked;
                const eventRecurrenceEnd = document.getElementById('popup-add-recurrence-end').value;
        
                console.log(eventTitle);
                console.log(eventDesc);              
                console.log(eventStart);
                
                popupEvent.style.display ="none";
            });
        
            // // Ferme la popup
            btnClosePopup.addEventListener('click', function() {
                popupEvent.style.display = 'none';
            });
            // document.addEventListener('click', function(event) {
            //     if (!popupEvent.contains(event.target)) {
            //         popupEvent.style.display = 'none';
            //     }
            // });
        });       
    }
}