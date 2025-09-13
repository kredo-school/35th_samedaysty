<div x-data="calendar()" x-init="init()" class="w-full min-h-screen bg-white p-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <button @click="previousMonth()" class="p-4 hover:bg-gray-100 rounded-lg text-2xl">
            &lt;
        </button>
        <h2 class="text-4xl font-semibold text-gray-800" x-text="currentMonthName + ' ' + currentYear"></h2>
        <button @click="nextMonth()" class="p-4 hover:bg-gray-100 rounded-lg text-2xl">
            &gt;
        </button>
    </div>

    <!-- Weekdays -->
    <div class="grid grid-cols-7 gap-4 mb-6">
        <template x-for="day in weekDays" :key="day">
            <div class="text-center text-xl font-medium text-gray-500 py-4" x-text="day"></div>
        </template>
    </div>

    <!-- Calendar Grid -->
    <div class="grid grid-cols-7 gap-4">
        <template x-for="date in calendarDays" :key="date.key">
            <div class="relative">
                <button @click="selectDate(date)"
                    :class="{
                        'bg-blue-500 text-white hover:bg-blue-600': date.isSelected,
                        'bg-gray-100 text-gray-400': date.isOtherMonth,
                        'bg-white text-gray-700 hover:bg-gray-50': !date.isOtherMonth && !date.isSelected,
                        'bg-red-100 text-red-600': date.isToday
                    }"
                    class="h-24 w-full rounded-lg text-xl font-medium transition-colors duration-200"
                    :disabled="date.isOtherMonth" x-text="date.day"></button>

                <!-- Event flags -->
                <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 flex space-x-1">
                    <template x-for="event in getEventsForDate(date.date)" :key="event.id">
                        <i x-show="event.extendedProps.country_code"
                            :class="`fi fi-${event.extendedProps.country_code.toLowerCase()}`" class="text-lg"
                            :title="event.title"></i>
                    </template>
                </div>
            </div>
        </template>
    </div>

    <!-- Selected Date Events -->
    <div class="mt-8 p-6 bg-gray-50 rounded-lg" x-show="selectedDate">
        <p class="text-lg text-gray-600">
            Selected Date: <span class="font-medium" x-text="selectedDateFormatted"></span>
        </p>

        <div class="mt-3" x-show="getEventsForDate(selectedDate).length > 0">
            <h4 class="text-lg font-medium text-gray-700 mb-4">Events:</h4>
            <div class="space-y-2">
                <template x-for="event in getEventsForDate(selectedDate)" :key="event.id">
                    <div class="p-4 rounded-md text-base bg-gray-50 border-l-4 border-blue-500">
                        <div class="flex items-center gap-2">
                            <i x-show="event.extendedProps.country_code"
                                :class="`fi fi-${event.extendedProps.country_code.toLowerCase()}`" class="text-lg"></i>
                            <div class="font-medium" x-text="event.title"></div>
                        </div>
                        <div class="text-gray-500 mt-1"
                            x-text="event.extendedProps.country ? `${event.extendedProps.country} • ${event.extendedProps.participants}/${event.extendedProps.max_participants} participants` : ''">
                        </div>
                        <div class="text-gray-600" x-text="event.extendedProps.description"></div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Go to Today -->
    <div class="mt-8">
        <button @click="goToToday()"
            class="w-full bg-green-500 text-white py-4 px-6 rounded-lg hover:bg-green-600 text-lg font-medium">
            Go to Today
        </button>
    </div>
</div>
</div>

<!-- Alpine.js Calendar Script -->
<script>
    function calendar() {
        return {
            currentDate: new Date(),
            selectedDate: null,
            weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            events: [],

            init() {
                fetch('/travel-plans')
                    .then(res => res.json())
                    .then(data => {
                        this.events = data.map(plan => ({
                            id: plan.id,
                            title: plan.title,
                            start: new Date(plan.start),
                            end: new Date(plan.end),
                            extendedProps: {
                                type: 'travel_plan',
                                travel_plan_id: plan.id,
                                country: plan.country ?? '',
                                country_code: plan.country_code ?? '',
                                participants: plan.participants ?? 0,
                                max_participants: plan.max_participants ?? 0,
                                description: plan.description ?? ''
                            }
                        }));
                        console.log('Events loaded:', this.events);
                    });
            },

            get currentYear() {
                return this.currentDate.getFullYear();
            },
            get currentMonth() {
                return this.currentDate.getMonth();
            },
            get currentMonthName() {
                const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                    'September', 'October', 'November', 'December'
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
                const year = this.currentYear,
                    month = this.currentMonth;
                const firstDay = new Date(year, month, 1);
                const startDate = new Date(firstDay);
                startDate.setDate(startDate.getDate() - firstDay.getDay());
                const days = [],
                    today = new Date();
                for (let w = 0; w < 6; w++) {
                    for (let d = 0; d < 7; d++) {
                        const currentDate = new Date(startDate);
                        currentDate.setDate(startDate.getDate() + (w * 7) + d);
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
            isSameDate(d1, d2) {
                return d1.getFullYear() === d2.getFullYear() && d1.getMonth() === d2.getMonth() && d1.getDate() === d2
                    .getDate();
            },
            getEventsForDate(date) {
                if (!date) return [];
                const checkDate = new Date(date);
                checkDate.setHours(0, 0, 0, 0);
                return this.events.filter(e => {
                    const start = new Date(e.start);
                    start.setHours(0, 0, 0, 0);
                    const end = new Date(e.end);
                    end.setHours(0, 0, 0, 0);
                    return checkDate >= start && checkDate <= end;
                });
            },
            selectDate(date) {
                if (!date.isOtherMonth) {
                    this.selectedDate = date.date;
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
