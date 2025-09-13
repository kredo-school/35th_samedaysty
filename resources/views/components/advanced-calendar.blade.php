<div x-data="advancedCalendar()" class="w-full min-h-screen bg-white p-8">
    <!-- Calendar Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-6">
            <button @click="previousMonth()" class="p-4 hover:bg-gray-100 rounded-lg text-2xl">
                <i class="fas fa-chevron-left text-gray-600"></i>
            </button>
            <h2 class="text-5xl font-semibold text-gray-800" x-text="currentMonthName + ' ' + currentYear"></h2>
            <button @click="nextMonth()" class="p-4 hover:bg-gray-100 rounded-lg text-2xl">
                <i class="fas fa-chevron-right text-gray-600"></i>
            </button>
        </div>

        <!-- Mode Toggle -->
        <div class="flex space-x-3">
            <button @click="mode = 'single'"
                :class="mode === 'single' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                class="px-4 py-2 rounded-lg text-base font-medium transition-colors">
                Single
            </button>
            <button @click="mode = 'range'"
                :class="mode === 'range' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                class="px-4 py-2 rounded-lg text-base font-medium transition-colors">
                Range
            </button>
            <button @click="mode = 'multiple'"
                :class="mode === 'multiple' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                class="px-4 py-2 rounded-lg text-base font-medium transition-colors">
                Multiple
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Calendar Body -->
        <div class="lg:col-span-2">
            <!-- Weekday Header -->
            <div class="grid grid-cols-7 gap-4 mb-6">
                <template x-for="day in weekDays" :key="day">
                    <div class="text-center text-xl font-medium text-gray-500 py-4" x-text="day"></div>
                </template>
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 gap-4">
                <template x-for="date in calendarDays" :key="date.key">
                    <button @click="selectDate(date)" @mouseenter="if (mode === 'range' && rangeStart) hoverDate = date"
                        @mouseleave="hoverDate = null"
                        :class="{
                            'bg-blue-500 text-white hover:bg-blue-600': date.isSelected,
                            'bg-blue-200 text-blue-800': date.isInRange,
                            'bg-gray-100 text-gray-400': date.isOtherMonth,
                            'bg-white text-gray-700 hover:bg-gray-50': !date.isOtherMonth && !date.isSelected && !date
                                .isInRange,
                            'bg-red-100 text-red-600': date.isToday,
                            'bg-green-100 text-green-700': date.hasEvent
                        }"
                        class="h-24 w-full rounded-lg text-xl font-medium transition-colors duration-200 relative"
                        :disabled="date.isOtherMonth" x-text="date.day">
                        <!-- Event Indicator -->
                        <div x-show="date.hasEvent" class="absolute bottom-2 left-1/2 transform -translate-x-1/2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        </div>
                    </button>
                </template>
            </div>
        </div>

        <!-- Side Panel -->
        <div class="space-y-6">
            <!-- Selected Dates Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-medium mb-3">Selected Dates</h3>
                <div x-show="selectedDates.length > 0" class="space-y-2">
                    <template x-for="date in selectedDates" :key="date.toISOString()">
                        <div class="text-sm text-gray-600">
                            <span x-text="formatDate(date)"></span>
                        </div>
                    </template>
                </div>
                <div x-show="selectedDates.length === 0" class="text-gray-500 text-sm">
                    Please select a date
                </div>
            </div>

            <!-- Event Addition -->
            <div class="bg-blue-50 p-4 rounded-lg">
                <h3 class="font-medium mb-3">Add Event</h3>
                <div class="space-y-3">
                    <input type="text" x-model="newEvent.title" placeholder="Event Title"
                        class="w-full px-3 py-2 border border-blue-300 rounded-lg text-sm">
                    <textarea x-model="newEvent.description" placeholder="Event Description"
                        class="w-full px-3 py-2 border border-blue-300 rounded-lg text-sm h-20"></textarea>
                    <button @click="addEvent()" :disabled="!newEvent.title || selectedDates.length === 0"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed text-sm">
                        Add Event
                    </button>
                </div>
            </div>

            <!-- Event List -->
            <div class="bg-green-50 p-4 rounded-lg">
                <h3 class="font-medium mb-3">Event List</h3>
                <div class="space-y-2 max-h-40 overflow-y-auto">
                    <template x-for="event in events" :key="event.id">
                        <div class="bg-white p-3 rounded-lg border border-green-200">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-medium text-sm" x-text="event.title"></h4>
                                    <p class="text-xs text-gray-600 mt-1" x-text="event.description"></p>
                                    <p class="text-xs text-green-600 mt-1" x-text="formatDate(event.date)"></p>
                                </div>
                                <button @click="removeEvent(event.id)" class="text-red-500 hover:text-red-700 text-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </template>
                    <div x-show="events.length === 0" class="text-gray-500 text-sm">
                        No events
                    </div>
                </div>
            </div>

            <!-- Go to Today Button -->
            <button @click="goToToday()"
                class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors duration-200">
                Go to Today
            </button>
        </div>
    </div>
</div>

<script>
    function advancedCalendar() {
        return {
            currentDate: new Date(),
            selectedDates: [],
            rangeStart: null,
            rangeEnd: null,
            hoverDate: null,
            mode: 'single', // 'single', 'range', 'multiple'
            events: [],
            newEvent: {
                title: '',
                description: ''
            },
            eventIdCounter: 1,
            weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

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

            get calendarDays() {
                const year = this.currentYear;
                const month = this.currentMonth;

                const firstDay = new Date(year, month, 1);
                const startDate = new Date(firstDay);
                startDate.setDate(startDate.getDate() - firstDay.getDay());

                const days = [];
                const today = new Date();

                for (let week = 0; week < 6; week++) {
                    for (let day = 0; day < 7; day++) {
                        const currentDate = new Date(startDate);
                        currentDate.setDate(startDate.getDate() + (week * 7) + day);

                        const isOtherMonth = currentDate.getMonth() !== month;
                        const isToday = this.isSameDate(currentDate, today);
                        const isSelected = this.isDateSelected(currentDate);
                        const isInRange = this.isDateInRange(currentDate);
                        const hasEvent = this.hasEventOnDate(currentDate);

                        days.push({
                            date: currentDate,
                            day: currentDate.getDate(),
                            key: currentDate.toISOString(),
                            isOtherMonth,
                            isToday,
                            isSelected,
                            isInRange,
                            hasEvent
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

            isDateSelected(date) {
                return this.selectedDates.some(selectedDate => this.isSameDate(selectedDate, date));
            },

            isDateInRange(date) {
                if (!this.rangeStart || !this.rangeEnd) return false;

                const start = new Date(this.rangeStart);
                const end = new Date(this.rangeEnd);
                const current = new Date(date);

                return current >= start && current <= end;
            },

            hasEventOnDate(date) {
                return this.events.some(event => this.isSameDate(event.date, date));
            },

            selectDate(date) {
                if (date.isOtherMonth) return;

                switch (this.mode) {
                    case 'single':
                        this.selectedDates = [date.date];
                        this.rangeStart = null;
                        this.rangeEnd = null;
                        break;

                    case 'range':
                        if (!this.rangeStart) {
                            this.rangeStart = date.date;
                            this.rangeEnd = date.date;
                            this.selectedDates = [date.date];
                        } else {
                            this.rangeEnd = date.date;
                            this.selectedDates = this.getDatesInRange(this.rangeStart, this.rangeEnd);
                        }
                        break;

                    case 'multiple':
                        const index = this.selectedDates.findIndex(selectedDate =>
                            this.isSameDate(selectedDate, date.date)
                        );

                        if (index > -1) {
                            this.selectedDates.splice(index, 1);
                        } else {
                            this.selectedDates.push(date.date);
                        }
                        break;
                }

                // Dispatch custom event
                this.$dispatch('dates-selected', {
                    dates: this.selectedDates,
                    mode: this.mode
                });
            },

            getDatesInRange(start, end) {
                const dates = [];
                const current = new Date(start);
                const endDate = new Date(end);

                while (current <= endDate) {
                    dates.push(new Date(current));
                    current.setDate(current.getDate() + 1);
                }

                return dates;
            },

            formatDate(date) {
                return date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    weekday: 'long'
                });
            },

            addEvent() {
                if (!this.newEvent.title || this.selectedDates.length === 0) return;

                this.selectedDates.forEach(date => {
                    this.events.push({
                        id: this.eventIdCounter++,
                        title: this.newEvent.title,
                        description: this.newEvent.description,
                        date: new Date(date)
                    });
                });

                this.newEvent.title = '';
                this.newEvent.description = '';
            },

            removeEvent(eventId) {
                this.events = this.events.filter(event => event.id !== eventId);
            },

            previousMonth() {
                this.currentDate = new Date(this.currentYear, this.currentMonth - 1, 1);
            },

            nextMonth() {
                this.currentDate = new Date(this.currentYear, this.currentMonth + 1, 1);
            },

            goToToday() {
                this.currentDate = new Date();
                this.selectedDates = [new Date()];
                this.rangeStart = null;
                this.rangeEnd = null;
            }
        }
    }
</script>
