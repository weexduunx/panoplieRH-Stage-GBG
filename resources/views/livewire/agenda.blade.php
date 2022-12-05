<style>
    #calendar-container {
        display: grid;
        grid-template-columns: 200px 1fr;
        padding: 20px;
    }

    #events {
        grid-column: 1;
    }

    #calendar {
        grid-column: 2;
        height: 700px;
    }

    .dropEvent {
        background-color: #108f34;
        color: white;
        padding: 5px 16px;
        margin-bottom: 10px;
        text-align: center;
        display: inline-block;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }
    p{
        font-size: 12px;
        font-weight: normal;
        margin-bottom: 10px;
        padding: 5px 5px;

    }
</style>
<div>
    <div id='calendar-container' wire:ignore>
        <div id="events">
            <div data-event='{"title":"Evénement A"}' class="dropEvent">Evénement A</div>
            <div data-event='{"title":"Evénement B"}' class="dropEvent">Evénement B</div>
            <div data-event='{"title":"Evénement C"}' class="dropEvent">Evénement C</div>
            <p>Vous pouvez tester un Drag and Drop pour agencer votre calendrier </p>
        </div>
        <div id='calendar'></div>
    </div>
</div>
@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>
    <script>
        create_UUID = () => {
            let dt = new Date().getTime();
            const uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, c => {
                let r = (dt + Math.random() * 16) % 16 | 0;
                dt = Math.floor(dt / 16);
                return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
            });
            return uuid;
        }
        document.addEventListener('livewire:load', function() {
            const Calendar = FullCalendar.Calendar;
            const calendarEl = document.getElementById('calendar');
            const calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                locale: '{{ config('app.locale') }}',
                events: JSON.parse(@this.events),
                editable: true,
                eventResize: info => @this.eventChange(info.event),
                eventDrop: info => @this.eventChange(info.event),
                selectable: true,
                select: arg => {
                    const title = prompt('Titre :');
                    const id = create_UUID();
                    if (title) {
                        calendar.addEvent({
                            id: id,
                            title: title,
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay
                        });
                        @this.eventAdd(calendar.getEventById(id));
                    };
                    calendar.unselect();
                },
                eventReceive: info => {
                    const id = create_UUID();
                    info.event.setProp('id', id);
                    @this.eventAdd(info.event);
                },
                eventClick: info => {
                    if (confirm("Voulez-vous vraiment supprimer cet événement ?")) {
                        info.event.remove();
                        @this.eventRemove(info.event.id);
                    }
                }
            });
            calendar.render();
            const Draggable = FullCalendar.Draggable;
            new Draggable(document.getElementById('events'), {
                itemSelector: '.dropEvent'
            });
        });
    </script>

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
@endpush
