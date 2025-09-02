<div x-data="calendar()" class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-6">
    <!-- Calendar Header -->
    <div class="flex items-center justify-between mb-4">
        <button @click="previousMonth()" class="p-2 hover:bg-gray-100 rounded-lg">
            <i class="fas fa-chevron-left text-gray-600"></i>
        </button>
        <h2 class="text-lg font-semibold text-gray-800" x-text="currentMonthName + ' ' + currentYear"></h2>
        <button @click="nextMonth()" class="p-2 hover:bg-gray-100 rounded-lg">
            <i class="fas fa-chevron-right text-gray-600"></i>
        </button>
    </div>

    <!-- Weekday Header -->
    <div class="grid grid-cols-7 gap-1 mb-2">
        <template x-for="day in weekDays" :key="day">
            <div class="text-center text-sm font-medium text-gray-500 py-2" x-text="day"></div>
        </template>
    </div>

    <!-- Calendar Grid -->
    <div class="grid grid-cols-7 gap-1">
        <template x-for="date in calendarDays" :key="date.key">
            <div class="relative">
                <button @click="selectDate(date)"
                    :class="{
                        'bg-blue-500 text-white hover:bg-blue-600': date.isSelected,
                        'bg-gray-100 text-gray-400': date.isOtherMonth,
                        'bg-white text-gray-700 hover:bg-gray-50': !date.isOtherMonth && !date.isSelected,
                        'bg-red-100 text-red-600': date.isToday
                    }"
                    class="h-10 w-10 rounded-lg text-sm font-medium transition-colors duration-200 relative"
                    :disabled="date.isOtherMonth" x-text="date.day"></button>

                <!-- Event Indicators -->
                <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 flex space-x-1">
                    <template x-for="event in getEventsForDate(date.date)" :key="event.id">
                        <div class="w-2 h-2 rounded-full" :style="`background-color: ${event.backgroundColor}`"
                            :title="event.title"></div>
                    </template>
                </div>
            </div>
        </template>
    </div>

    <!-- Selected Date Display -->
    <div class="mt-4 p-3 bg-gray-50 rounded-lg" x-show="selectedDate">
        <p class="text-sm text-gray-600">
            Selected Date: <span class="font-medium" x-text="selectedDateFormatted"></span>
        </p>

        <!-- Events for Selected Date -->
        <div class="mt-3" x-show="getEventsForDate(selectedDate).length > 0">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Events:</h4>
            <div class="space-y-2">
                <template x-for="event in getEventsForDate(selectedDate)" :key="event.id">
                    <div class="p-2 rounded-md text-xs"
                        :style="`background-color: ${event.backgroundColor}20; border-left: 3px solid ${event.backgroundColor}`">
                        <div class="font-medium" x-text="event.title"></div>
                        <div class="text-gray-600"
                            x-text="event.start.toLocaleTimeString('en-US', {hour: '2-digit', minute: '2-digit'})">
                        </div>
                        <template x-if="event.extendedProps && event.extendedProps.type === 'travel_plan'">
                            <div class="text-gray-500"
                                x-text="`${event.extendedProps.country} • ${event.extendedProps.participants}/${event.extendedProps.max_participants} participants`">
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Go to Today Button -->
    <div class="mt-4">
        <button @click="goToToday()"
            class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors duration-200">
            Go to Today
        </button>
    </div>
</div>

<script>
    function calendar() {
        return {
            currentDate: new Date(),
            selectedDate: null,
            weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

            // Mock data for events
            events: [{
                    id: 1,
                    title: 'Bali Relaxation Trip',
                    start: new Date().toISOString().split('T')[0] + 'T09:00:00',
                    end: new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T18:00:00',
                    backgroundColor: '#3B82F6',
                    extendedProps: {
                        type: 'travel_plan',
                        travel_plan_id: 1,
                        participants: 2,
                        max_participants: 4,
                        country: 'Indonesia'
                    }
                },
                {
                    id: 2,
                    title: 'Bangkok Adventure',
                    start: new Date(Date.now() + 14 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] +
                        'T10:00:00',
                    end: new Date(Date.now() + 21 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T17:00:00',
                    backgroundColor: '#10B981',
                    extendedProps: {
                        type: 'travel_plan',
                        travel_plan_id: 2,
                        participants: 2,
                        max_participants: 6,
                        country: 'Thailand'
                    }
                },
                {
                    id: 3,
                    title: 'Kyoto & Nara Historical Tour',
                    start: new Date(Date.now() + 5 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T08:00:00',
                    end: new Date(Date.now() + 8 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T19:00:00',
                    backgroundColor: '#F59E0B',
                    extendedProps: {
                        type: 'travel_plan',
                        travel_plan_id: 3,
                        participants: 1,
                        max_participants: 8,
                        country: 'Japan'
                    }
                },
                {
                    id: 4,
                    title: 'Travel Plan Meeting',
                    start: new Date(Date.now() + 2 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T14:00:00',
                    end: new Date(Date.now() + 2 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T15:30:00',
                    backgroundColor: '#6B7280',
                    extendedProps: {
                        type: 'meeting',
                        location: 'Online',
                        participants: ['John Tanaka', 'Sarah Sato']
                    }
                },
                {
                    id: 5,
                    title: 'Travel Preparation Check',
                    start: new Date(Date.now() + 1 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T10:00:00',
                    end: new Date(Date.now() + 1 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T11:00:00',
                    backgroundColor: '#059669',
                    extendedProps: {
                        type: 'preparation',
                        checklist: ['Passport', 'Flight Tickets', 'Hotel Booking']
                    }
                }
            ],

            get currentYear() {
                return this.currentDate.getFullYear();
            },

            get currentMonth() {
                return this.currentDate.getMonth();
            },

            get currentMonthName() {
                const months = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
                return months[this.currentMonth];
            },

            get selectedDateFormatted() {
                if (!this.selectedDate) return '';
                return this.selectedDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    weekday: 'long'
                });
            },

            get calendarDays() {
                const year = this.currentYear;
                const month = this.currentMonth;

                // Get first and last day of the month
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);

                // Get previous month's last day
                const prevMonthLastDay = new Date(year, month, 0);
                const prevMonthDays = prevMonthLastDay.getDate();

                // Calendar start date (including previous month dates)
                const startDate = new Date(firstDay);
                startDate.setDate(startDate.getDate() - firstDay.getDay());

                const days = [];
                const today = new Date();

                // Generate 6 weeks of dates
                for (let week = 0; week < 6; week++) {
                    for (let day = 0; day < 7; day++) {
                        const currentDate = new Date(startDate);
                        currentDate.setDate(startDate.getDate() + (week * 7) + day);

                        const isOtherMonth = currentDate.getMonth() !== month;
                        const isToday = this.isSameDate(currentDate, today);
                        const isSelected = this.selectedDate && this.isSameDate(currentDate, this.selectedDate);

                        days.push({
                            date: currentDate,
                            day: currentDate.getDate(),
                            key: currentDate.toISOString(),
                            isOtherMonth,
                            isToday,
                            isSelected
                        });
                    }
                }

                return days;
            },

            isSameDate(date1, date2) {
                return date1.getFullYear() === date2.getFullYear() &&
                    date1.getMonth() === date2.getMonth() &&
                    date1.getDate() === date2.getDate();
            },

            getEventsForDate(date) {
                if (!date) return [];

                return this.events.filter(event => {
                    const eventStart = new Date(event.start);
                    const eventEnd = new Date(event.end);
                    const checkDate = new Date(date);

                    // Check if the date falls within the event period
                    return checkDate >= eventStart && checkDate <= eventEnd;
                });
            },

            selectDate(date) {
                if (!date.isOtherMonth) {
                    this.selectedDate = date.date;
                    // Dispatch custom event
                    this.$dispatch('date-selected', {
                        date: date.date,
                        formatted: this.selectedDateFormatted,
                        events: this.getEventsForDate(date.date)
                    });
                }
            },

            previousMonth() {
                this.currentDate = new Date(this.currentYear, this.currentMonth - 1, 1);
            },

            nextMonth() {
                this.currentDate = new Date(this.currentYear, this.currentMonth + 1, 1);
            },

            goToToday() {
                this.currentDate = new Date();
                this.selectedDate = new Date();
            }
        }
    }
</script>
