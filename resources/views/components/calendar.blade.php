@props(['countryId' => null])

<div x-data="calendar({ countryId: {{ $countryId ? $countryId : 'null' }} })" x-init="init()"
    class="w-full min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-8">
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 mb-8 border border-white/20">
        <div class="flex items-center justify-between">
            <button @click="previousMonth()"
                class="p-3 hover:bg-blue-100 rounded-xl text-2xl text-blue-600 hover:text-blue-700 transition-all duration-200 hover:scale-105 font-bold">
                ‹
            </button>
            <div class="text-center">
                <h2 class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"
                    x-text="currentMonthName + ' ' + currentYear"></h2>
                <p class="text-gray-500 mt-2 text-sm">Select dates to view travel plans</p>
            </div>
            <button @click="nextMonth()"
                class="p-3 hover:bg-blue-100 rounded-xl text-2xl text-blue-600 hover:text-blue-700 transition-all duration-200 hover:scale-105 font-bold">
                ›
            </button>
        </div>
    </div>

    <!-- Weekdays -->
    <div class="bg-white/60 backdrop-blur-sm rounded-xl shadow-lg p-4 mb-6 border border-white/20">
        <div class="grid grid-cols-7 gap-2">
            <template x-for="day in weekDays" :key="day">
                <div class="text-center text-lg font-semibold text-gray-600 py-3 bg-gray-50 rounded-lg" x-text="day">
                </div>
            </template>
        </div>
    </div>

    <!-- Calendar Grid -->
    <div class="bg-white/60 backdrop-blur-sm rounded-xl shadow-lg p-4 mb-6 border border-white/20">
        <div class="grid grid-cols-7 gap-3">
            <template x-for="date in calendarDays" :key="date.key">
                <div class="relative">
                    <button @click="selectDate(date)" :class="{
                            'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg hover:from-blue-600 hover:to-blue-700': date
                                .isSelected,
                            'bg-gray-100 text-gray-400 opacity-50': date.isOtherMonth,
                            'bg-white/80 text-gray-700 hover:bg-blue-50 hover:text-blue-700 hover:shadow-md': !date
                                .isOtherMonth && !date.isSelected,
                            'bg-gradient-to-br from-red-100 to-pink-100 text-red-600 border-2 border-red-300 shadow-md': date
                                .isToday
                        }"
                        class="h-20 w-full rounded-xl text-lg font-semibold transition-all duration-300 hover:scale-105 relative overflow-hidden"
                        :disabled="date.isOtherMonth" x-text="date.day">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-transparent to-white/10 opacity-0 hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </button>

                    <!-- Event flags -->
                    <div class="absolute bottom-0 left-0 right-0 px-1 pb-1">
                        <div class="flex flex-wrap justify-center items-center gap-1 max-h-8 overflow-hidden">
                            <template x-for="(event, index) in getEventsForDate(date.date).slice(0, 3)" :key="event.id">
                                <div class="relative group">
                                    <i x-show="event.extendedProps.country_code"
                                        :class="`fi fi-${event.extendedProps.country_code.toLowerCase()}`"
                                        class="text-base shadow-md border border-white/50 rounded-sm hover:scale-110 transition-transform duration-200"
                                        :title="`${event.title} - ${event.extendedProps.country}`"></i>
                                </div>
                            </template>
                            <!-- Show count if more than 3 events -->
                            <div x-show="getEventsForDate(date.date).length > 3"
                                class="text-xs bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-full px-2 py-1 font-semibold shadow-md border border-white/30 hover:scale-105 transition-transform duration-200"
                                :title="`${getEventsForDate(date.date).length} travel plans total`"
                                x-text="`+${getEventsForDate(date.date).length - 3}`">
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Selected Date Events -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 mb-6 border border-white/20"
        x-show="selectedDate">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-2 h-8 bg-gradient-to-b from-blue-500 to-purple-500 rounded-full"></div>
            <h3 class="text-xl font-bold text-gray-800">Selected Date</h3>
        </div>
        <p class="text-lg text-gray-600 mb-4">
            <span class="font-semibold text-blue-600" x-text="selectedDateFormatted"></span>
        </p>

        <div class="mt-6" x-show="getEventsForDate(selectedDate).length > 0">
            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <span class="text-blue-500 text-xl">📅</span>
                Travel Plans
            </h4>
            <div class="space-y-3">
                <template x-for="event in getEventsForDate(selectedDate)" :key="event.id">
                    <a :href="`/plan/${event.id}/detail`"
                        class="block p-5 rounded-xl bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-300 cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <i x-show="event.extendedProps.country_code"
                                :class="`fi fi-${event.extendedProps.country_code.toLowerCase()}`"
                                class="text-xl shadow-sm"></i>
                            <div class="font-bold text-gray-800 text-lg hover:text-blue-600 transition-colors"
                                x-text="event.title"></div>
                        </div>
                        <div class="text-blue-600 text-sm font-medium mb-2"
                            x-text="event.extendedProps.country ? `${event.extendedProps.country} • ${event.extendedProps.participants}/${event.extendedProps.max_participants} participants` : ''">
                        </div>
                        <div class="text-gray-600 text-sm leading-relaxed" x-text="event.extendedProps.description">
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </div>

    <!-- Go to Today -->
    <div class="flex justify-center">
        <button @click="goToToday()"
            class="bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600 text-sm font-medium transition-colors duration-200">
            Go to Today
        </button>
    </div>
</div>
</div>

<!-- Alpine.js Calendar Script -->
<script>
    function calendar({ countryId = null } = {}) {
        return {
            currentDate: new Date(),
            selectedDate: null,
            weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            events: [],
            countryId: countryId,

            init() {
                this.loadEvents();
            },

            loadEvents() {
                const params = new URLSearchParams();
                if (this.countryId) {
                    params.append('country', this.countryId);
                }

                const url = '/travel-plans?' + params.toString();
                console.log('Loading events from:', url, 'countryId:', this.countryId);

                fetch(url)
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
                        console.log('Events loaded:', this.events.length, 'events for country:', this.countryId);
                    })
                    .catch(error => {
                        console.error('Error loading events:', error);
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