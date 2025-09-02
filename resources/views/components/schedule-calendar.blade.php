<div x-data="scheduleCalendar()" class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <!-- Calendar Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-4">
            <button @click="previousMonth()" class="p-2 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-chevron-left text-gray-600"></i>
            </button>
            <h2 class="text-xl font-semibold text-gray-800" x-text="currentMonthName + ' ' + currentYear"></h2>
            <button @click="nextMonth()" class="p-2 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-chevron-right text-gray-600"></i>
            </button>
        </div>

        <!-- Go to Today Button -->
        <button @click="goToToday()"
            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            Go to Today
        </button>
    </div>

    <!-- Schedule Addition Form -->
    <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
        <h3 class="font-medium text-blue-800 mb-3">Add Schedule</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-blue-700 mb-1">Date</label>
                <input type="date" x-model="newSchedule.date"
                    class="w-full px-3 py-2 border border-blue-300 rounded-lg text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-blue-700 mb-1">Time</label>
                <input type="time" x-model="newSchedule.time"
                    class="w-full px-3 py-2 border border-blue-300 rounded-lg text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-blue-700 mb-1">Title</label>
                <input type="text" x-model="newSchedule.title" placeholder="Schedule Title"
                    class="w-full px-3 py-2 border border-blue-300 rounded-lg text-sm">
            </div>
            <div class="flex items-end">
                <button @click="addSchedule()" :disabled="!newSchedule.date || !newSchedule.title"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 disabled:bg-gray-300 disabled:cursor-not-allowed">
                    Add
                </button>
            </div>
        </div>
    </div>

    <!-- Calendar Body -->
    <div class="grid grid-cols-7 gap-1">
        <!-- Weekday Header -->
        <template x-for="day in weekDays" :key="day">
            <div class="text-center text-sm font-medium text-gray-500 py-2 bg-gray-50 rounded-t-lg" x-text="day">
            </div>
        </template>

        <!-- Calendar Grid -->
        <template x-for="date in calendarDays" :key="date.key">
            <div class="min-h-32 border border-gray-200 p-2 relative"
                :class="{
                    'bg-gray-50': date.isOtherMonth,
                    'bg-red-50': date.isToday
                }">

                <!-- Date Header -->
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium"
                        :class="{
                            'text-gray-400': date.isOtherMonth,
                            'text-red-600 font-bold': date.isToday,
                            'text-gray-700': !date.isOtherMonth && !date.isToday
                        }"
                        x-text="date.day"></span>

                    <!-- Schedule count for that day -->
                    <span x-show="getSchedulesForDate(date.date).length > 0"
                        class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full"
                        x-text="getSchedulesForDate(date.date).length"></span>
                </div>

                <!-- Schedule List -->
                <div class="space-y-1 max-h-20 overflow-y-auto">
                    <template x-for="schedule in getSchedulesForDate(date.date)" :key="schedule.id">
                        <div class="text-xs p-1 rounded cursor-pointer transition-colors"
                            :class="getScheduleColor(schedule.category)" @click="editSchedule(schedule)"
                            :title="schedule.title + ' - ' + schedule.description">
                            <div class="font-medium truncate" x-text="schedule.time"></div>
                            <div class="truncate" x-text="schedule.title"></div>
                        </div>
                    </template>
                </div>

                <!-- Schedule Addition Button (click on that date) -->
                <button @click="quickAddSchedule(date.date)"
                    class="absolute bottom-1 right-1 w-6 h-6 bg-blue-500 text-white rounded-full text-xs hover:bg-blue-600 transition-colors"
                    :class="{ 'opacity-0 group-hover:opacity-100': !date.isOtherMonth }">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </template>
    </div>

    <!-- Schedule Detail Modal -->
    <div x-show="showScheduleModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        @click.self="closeScheduleModal()">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-medium mb-4" x-text="editingSchedule ? 'Edit Schedule' : 'Add Schedule'"></h3>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" x-model="modalSchedule.date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                    <input type="time" x-model="modalSchedule.time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" x-model="modalSchedule.title" placeholder="Schedule Title"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea x-model="modalSchedule.description" placeholder="Schedule Details"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg h-20"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select x-model="modalSchedule.category" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        <option value="work">Work</option>
                        <option value="personal">Personal</option>
                        <option value="meeting">Meeting</option>
                        <option value="event">Event</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button @click="closeScheduleModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                    Cancel
                </button>
                <button @click="saveSchedule()" :disabled="!modalSchedule.date || !modalSchedule.title"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:bg-gray-300">
                    Save
                </button>
                <button x-show="editingSchedule" @click="deleteSchedule()"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Monthly Schedule List -->
    <div class="mt-8">
        <h3 class="text-lg font-medium mb-4">This Month's Schedule List</h3>
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="space-y-2 max-h-64 overflow-y-auto">
                <template x-for="schedule in getCurrentMonthSchedules()" :key="schedule.id">
                    <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 rounded-full" :class="getScheduleColor(schedule.category)"></div>
                            <div>
                                <div class="font-medium" x-text="schedule.title"></div>
                                <div class="text-sm text-gray-600">
                                    <span x-text="formatDate(schedule.date)"></span> -
                                    <span x-text="schedule.time"></span>
                                </div>
                                <div x-show="schedule.description" class="text-xs text-gray-500 mt-1"
                                    x-text="schedule.description"></div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button @click="editSchedule(schedule)" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button @click="deleteScheduleById(schedule.id)" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </template>
                <div x-show="getCurrentMonthSchedules().length === 0" class="text-gray-500 text-center py-4">
                    No schedules for this month
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function scheduleCalendar() {
        return {
            currentDate: new Date(),
            schedules: [],
            scheduleIdCounter: 1,
            showScheduleModal: false,
            editingSchedule: null,
            modalSchedule: {
                date: '',
                time: '',
                title: '',
                description: '',
                category: 'work'
            },
            newSchedule: {
                date: '',
                time: '',
                title: '',
                description: '',
                category: 'work'
            },
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

                        days.push({
                            date: currentDate,
                            day: currentDate.getDate(),
                            key: currentDate.toISOString(),
                            isOtherMonth,
                            isToday
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

            getSchedulesForDate(date) {
                return this.schedules.filter(schedule => this.isSameDate(schedule.date, date))
                    .sort((a, b) => a.time.localeCompare(b.time));
            },

            getCurrentMonthSchedules() {
                return this.schedules.filter(schedule =>
                    schedule.date.getMonth() === this.currentMonth &&
                    schedule.date.getFullYear() === this.currentYear
                ).sort((a, b) => {
                    if (a.date.getTime() !== b.date.getTime()) {
                        return a.date.getTime() - b.date.getTime();
                    }
                    return a.time.localeCompare(b.time);
                });
            },

            getScheduleColor(category) {
                const colors = {
                    work: 'bg-blue-100 text-blue-800 hover:bg-blue-200',
                    personal: 'bg-green-100 text-green-800 hover:bg-green-200',
                    meeting: 'bg-purple-100 text-purple-800 hover:bg-purple-200',
                    event: 'bg-orange-100 text-orange-800 hover:bg-orange-200',
                    other: 'bg-gray-100 text-gray-800 hover:bg-gray-200'
                };
                return colors[category] || colors.other;
            },

            addSchedule() {
                if (!this.newSchedule.date || !this.newSchedule.title) return;

                this.schedules.push({
                    id: this.scheduleIdCounter++,
                    date: new Date(this.newSchedule.date),
                    time: this.newSchedule.time || '00:00',
                    title: this.newSchedule.title,
                    description: this.newSchedule.description || '',
                    category: this.newSchedule.category
                });

                // Reset form
                this.newSchedule = {
                    date: '',
                    time: '',
                    title: '',
                    description: '',
                    category: 'work'
                };
            },

            quickAddSchedule(date) {
                this.modalSchedule = {
                    date: this.formatDateForInput(date),
                    time: '',
                    title: '',
                    description: '',
                    category: 'work'
                };
                this.editingSchedule = null;
                this.showScheduleModal = true;
            },

            editSchedule(schedule) {
                this.editingSchedule = schedule;
                this.modalSchedule = {
                    date: this.formatDateForInput(schedule.date),
                    time: schedule.time,
                    title: schedule.title,
                    description: schedule.description,
                    category: schedule.category
                };
                this.showScheduleModal = true;
            },

            saveSchedule() {
                if (!this.modalSchedule.date || !this.modalSchedule.title) return;

                if (this.editingSchedule) {
                    // Edit
                    Object.assign(this.editingSchedule, {
                        date: new Date(this.modalSchedule.date),
                        time: this.modalSchedule.time || '00:00',
                        title: this.modalSchedule.title,
                        description: this.modalSchedule.description || '',
                        category: this.modalSchedule.category
                    });
                } else {
                    // Add new
                    this.schedules.push({
                        id: this.scheduleIdCounter++,
                        date: new Date(this.modalSchedule.date),
                        time: this.modalSchedule.time || '00:00',
                        title: this.modalSchedule.title,
                        description: this.modalSchedule.description || '',
                        category: this.modalSchedule.category
                    });
                }

                this.closeScheduleModal();
            },

            deleteSchedule() {
                if (this.editingSchedule) {
                    this.schedules = this.schedules.filter(s => s.id !== this.editingSchedule.id);
                    this.closeScheduleModal();
                }
            },

            deleteScheduleById(id) {
                this.schedules = this.schedules.filter(s => s.id !== id);
            },

            closeScheduleModal() {
                this.showScheduleModal = false;
                this.editingSchedule = null;
                this.modalSchedule = {
                    date: '',
                    time: '',
                    title: '',
                    description: '',
                    category: 'work'
                };
            },

            formatDate(date) {
                return date.toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    weekday: 'long'
                });
            },

            formatDateForInput(date) {
                return date.toISOString().split('T')[0];
            },

            previousMonth() {
                this.currentDate = new Date(this.currentYear, this.currentMonth - 1, 1);
            },

            nextMonth() {
                this.currentDate = new Date(this.currentYear, this.currentMonth + 1, 1);
            },

            goToToday() {
                this.currentDate = new Date();
            }
        }
    }
</script>
