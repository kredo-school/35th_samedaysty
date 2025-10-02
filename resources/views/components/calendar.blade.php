@props(['countryId' => null])

<div x-data="calendar({ countryId: {{ $countryId ? $countryId : 'null' }} })" x-init="init()"
    class="w-full bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-800 dark:to-gray-900 p-4 sm:p-6 lg:p-8 rounded-2xl relative z-0">
    <!-- Header -->
    <div
        class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl p-4 sm:p-6 mb-4 sm:mb-6 lg:mb-8 border border-white/20 dark:border-gray-700/50">
        <div class="flex items-center justify-between">
            <button @click="previousMonth()"
                class="p-2 sm:p-3 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-xl text-xl sm:text-2xl text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-all duration-200 hover:scale-105 font-bold">
                ‹
            </button>
            <div class="text-center">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400 bg-clip-text text-transparent"
                    x-text="currentMonthName + ' ' + currentYear"></h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1 sm:mt-2 text-xs sm:text-sm">Select dates to view travel
                    plans</p>
            </div>
            <button @click="nextMonth()"
                class="p-2 sm:p-3 hover:bg-blue-100 dark:hover:bg-blue-900 rounded-xl text-xl sm:text-2xl text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-all duration-200 hover:scale-105 font-bold">
                ›
            </button>
        </div>
    </div>

    <!-- Weekdays -->
    <div
        class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-xl shadow-lg p-2 sm:p-4 mb-4 sm:mb-6 border border-white/20 dark:border-gray-700/50">
        <div class="grid grid-cols-7 gap-1 sm:gap-2">
            <template x-for="day in weekDays" :key="day">
                <div class="text-center text-xs sm:text-sm lg:text-base font-semibold text-gray-600 dark:text-gray-300 py-2 sm:py-3 bg-gray-50 dark:bg-gray-700 rounded-lg"
                    x-text="day">
                </div>
            </template>
        </div>
    </div>

    <!-- Calendar Grid -->
    <div
        class="bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-xl shadow-lg p-2 sm:p-4 mb-4 sm:mb-6 border border-white/20 dark:border-gray-700/50">
        <div class="grid grid-cols-7 gap-1 sm:gap-2 lg:gap-3">
            <template x-for="date in calendarDays" :key="date.key">
                <div class="relative">
                    <button @click="selectDate(date)" :class="{
                            'bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 text-white shadow-lg hover:from-blue-600 hover:to-blue-700 dark:hover:from-blue-700 dark:hover:to-blue-800': date
                                .isSelected,
                            'bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 opacity-50': date.isOtherMonth,
                            'bg-white/80 dark:bg-gray-700/80 text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-600 hover:text-blue-700 dark:hover:text-blue-300 hover:shadow-md': !date
                                .isOtherMonth && !date.isSelected,
                            'bg-gradient-to-br from-red-100 to-pink-100 dark:from-red-900 dark:to-pink-900 text-red-600 dark:text-red-300 border-2 border-red-300 dark:border-red-500 shadow-md': date
                                .isToday
                        }"
                        class="h-12 sm:h-16 lg:h-20 w-full rounded-lg sm:rounded-xl text-sm sm:text-base lg:text-lg font-semibold transition-all duration-300 hover:scale-105 relative overflow-hidden"
                        :disabled="date.isOtherMonth" x-text="date.day">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-transparent to-white/10 dark:to-black/10 opacity-0 hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </button>

                    <!-- Event flags -->
                    <div
                        class="absolute -bottom-0.5 sm:-bottom-1 left-1/2 transform -translate-x-1/2 flex items-center justify-center max-w-full">
                        <div class="flex items-center justify-center max-w-full overflow-hidden">
                            <!-- Mobile: Show only 1 flag + counter -->
                            <template x-if="window.innerWidth < 640">
                                <div class="flex items-center space-x-0.5">
                                    <template x-for="(event, index) in getEventsForDate(date.date).slice(0, 1)"
                                        :key="event.id">
                                        <i x-show="event.extendedProps.country_code"
                                            :class="`fi fi-${event.extendedProps.country_code.toLowerCase()}`"
                                            class="text-xs flex-shrink-0"
                                            :title="event.title ? String(event.title) : ''"></i>
                                    </template>

                                    <!-- Mobile counter -->
                                    <div x-show="getEventsForDate(date.date).length > 1"
                                        class="text-xs font-bold text-blue-600 dark:text-blue-400 bg-white/95 dark:bg-gray-700/95 rounded-full px-1 py-0.5 shadow-sm border border-blue-200 dark:border-blue-500 flex-shrink-0 min-w-[16px] text-center"
                                        x-text="getEventsForDate(date.date).length > 1 ? `+${getEventsForDate(date.date).length - 1}` : ''"
                                        :title="`${getEventsForDate(date.date).length} total events`">
                                    </div>
                                </div>
                            </template>

                            <!-- Desktop: Show 2-3 flags + counter -->
                            <template x-if="window.innerWidth >= 640">
                                <div class="flex items-center space-x-0.5 sm:space-x-1">
                                    <template
                                        x-for="(event, index) in getEventsForDate(date.date).slice(0, window.innerWidth < 1024 ? 2 : 3)"
                                        :key="event.id">
                                        <i x-show="event.extendedProps.country_code"
                                            :class="`fi fi-${event.extendedProps.country_code.toLowerCase()}`"
                                            class="text-sm lg:text-lg flex-shrink-0"
                                            :title="event.title ? String(event.title) : ''"></i>
                                    </template>

                                    <!-- Desktop counter -->
                                    <div x-show="getEventsForDate(date.date).length > (window.innerWidth < 1024 ? 2 : 3)"
                                        class="text-xs sm:text-sm font-bold text-blue-600 dark:text-blue-400 bg-white/90 dark:bg-gray-700/90 rounded-full px-1 sm:px-1.5 py-0.5 shadow-sm border border-blue-200 dark:border-blue-500 flex-shrink-0"
                                        x-text="`+${getEventsForDate(date.date).length - (window.innerWidth < 1024 ? 2 : 3)}`"
                                        :title="`${getEventsForDate(date.date).length} total events`">
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Selected Date Events -->
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl p-4 sm:p-6 mb-4 sm:mb-6 border border-white/20 dark:border-gray-700/50"
        x-show="selectedDate">
        <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
            <div
                class="w-2 h-6 sm:h-8 bg-gradient-to-b from-blue-500 to-purple-500 dark:from-blue-400 dark:to-purple-400 rounded-full">
            </div>
            <h3 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-gray-100">Selected Date</h3>
        </div>
        <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300 mb-3 sm:mb-4">
            <span class="font-semibold text-blue-600 dark:text-blue-400" x-text="selectedDateFormatted"></span>
        </p>

        <div class="mt-4 sm:mt-6" x-show="getEventsForDate(selectedDate).length > 0">
            <h4
                class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 sm:mb-4 flex items-center gap-2">
                <span class="text-blue-500 dark:text-blue-400 text-lg sm:text-xl">📅</span>
                Travel Plans
            </h4>
            <div class="space-y-2 sm:space-y-3">
                <template x-for="event in getEventsForDate(selectedDate)" :key="event.id">
                    <a :href="`/plan/${event.id}/detail`"
                        class="block p-3 sm:p-4 lg:p-5 rounded-lg sm:rounded-xl bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-800 border border-blue-200 dark:border-gray-600 shadow-sm hover:shadow-md hover:border-blue-300 dark:hover:border-blue-500 transition-all duration-300 cursor-pointer">
                        <div class="flex items-center gap-2 sm:gap-3 mb-2 sm:mb-3">
                            <i x-show="event.extendedProps.country_code"
                                :class="`fi fi-${event.extendedProps.country_code.toLowerCase()}`"
                                class="text-lg sm:text-xl shadow-sm flex-shrink-0"></i>
                            <div class="font-bold text-gray-800 dark:text-gray-100 text-sm sm:text-base lg:text-lg hover:text-blue-600 dark:hover:text-blue-400 transition-colors"
                                x-text="event.title ? String(event.title) : ''"></div>
                        </div>
                        <div class="text-blue-600 dark:text-blue-400 text-xs sm:text-sm font-medium mb-1 sm:mb-2"
                            x-text="event.extendedProps.country ? `${String(event.extendedProps.country)} • ${event.extendedProps.participants}/${event.extendedProps.max_participants} participants` : ''">
                        </div>
                        <div class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed"
                            x-text="event.extendedProps.description ? String(event.extendedProps.description) : ''">
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </div>

    <!-- Go to Today -->
    <div class="flex justify-center">
        <button @click="goToToday()"
            class="bg-orange-500 dark:bg-orange-600 text-white py-2 px-3 sm:px-4 rounded-lg hover:bg-orange-600 dark:hover:bg-orange-700 text-xs sm:text-sm font-medium transition-colors duration-200">
            Go to Today
        </button>
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
                            title: String(plan.title || ''),
                            start: new Date(plan.start),
                            end: new Date(plan.end),
                            extendedProps: {
                                type: 'travel_plan',
                                travel_plan_id: plan.id,
                                country: String(plan.country || ''),
                                country_code: String(plan.country_code || ''),
                                participants: Number(plan.participants) || 0,
                                max_participants: Number(plan.max_participants) || 0,
                                description: String(plan.description || '')
                            }
                        }));
                        console.log('Events loaded:', this.events.length, 'events for country:', this.countryId);
                        console.log('Sample event:', this.events[0]);
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