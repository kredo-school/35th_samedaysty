<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Calendar Components Comparison (AlpineJS vs FullCalendar)
        </h2>
    </x-slot>

    <!-- FullCalendar CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.10/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.10/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.10/index.global.min.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- FullCalendar Basic Sample -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">FullCalendar Basic Sample</h3>
                        <p class="text-gray-600 mb-4">Basic calendar display using FullCalendar library</p>
                        <div id="fullcalendar-basic" class="bg-white rounded-lg shadow-lg p-4"></div>
                    </div>

                    <!-- FullCalendar with Events -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">FullCalendar with Sample Events</h3>
                        <p class="text-gray-600 mb-4">FullCalendar with sample travel plan events</p>
                        <div id="fullcalendar-events" class="bg-white rounded-lg shadow-lg p-4"></div>
                    </div>

                    <!-- FullCalendar Interactive -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">FullCalendar Interactive</h3>
                        <p class="text-gray-600 mb-4">Interactive calendar with event management, drag & drop, and
                            travel plan details</p>
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2">
                                <div id="fullcalendar-interactive" class="bg-white rounded-lg shadow-lg p-4"></div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-medium mb-4">Event Management</h4>
                                <div id="event-form" class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                        <input type="text" id="event-title"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Start Date &
                                            Time</label>
                                        <input type="datetime-local" id="event-start"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">End Date &
                                            Time</label>
                                        <input type="datetime-local" id="event-end"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                                        <select id="event-color"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="#3B82F6">Blue</option>
                                            <option value="#10B981">Green</option>
                                            <option value="#F59E0B">Yellow</option>
                                            <option value="#EF4444">Red</option>
                                            <option value="#8B5CF6">Purple</option>
                                        </select>
                                    </div>
                                    <button id="add-event"
                                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                                        Add Event
                                    </button>
                                </div>
                                <div id="event-list" class="mt-6">
                                    <h5 class="font-medium mb-2">Event List</h5>
                                    <div id="events-container" class="space-y-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FullCalendar Different Views -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">FullCalendar Different Views</h3>
                        <p class="text-gray-600 mb-4">Switch between Month, Week, Day, and List views</p>
                        <div class="mb-4">
                            <div class="flex space-x-2">
                                <button id="view-month"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">Month</button>
                                <button id="view-week"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">Week</button>
                                <button id="view-day"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">Day</button>
                                <button id="view-list"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">List</button>
                            </div>
                        </div>
                        <div id="fullcalendar-views" class="bg-white rounded-lg shadow-lg p-4"></div>
                    </div>

                    <!-- Basic Calendar -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">Basic Calendar</h3>
                        <x-calendar />
                    </div>

                    <!-- Event Handling Calendar -->
                    <div class="mb-8" x-data="{ selectedDateInfo: null }">
                        <h3 class="text-lg font-medium mb-4">AlpineJS Calendar with Mock Data</h3>
                        <p class="text-gray-600 mb-4">AlpineJS calendar with travel plan events and detailed information
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-calendar @date-selected="selectedDateInfo = $event.detail" />
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="font-medium mb-2">Selected Date Information:</h4>
                                <div x-show="selectedDateInfo" class="space-y-2">
                                    <p><strong>Date:</strong> <span x-text="selectedDateInfo.formatted"></span></p>
                                    <p><strong>ISO String:</strong> <span
                                            x-text="selectedDateInfo.date.toISOString()"></span></p>
                                    <p><strong>Timestamp:</strong> <span
                                            x-text="selectedDateInfo.date.getTime()"></span>
                                    </p>

                                    <!-- Events for Selected Date -->
                                    <div x-show="selectedDateInfo.events && selectedDateInfo.events.length > 0"
                                        class="mt-4">
                                        <h5 class="font-medium text-gray-700 mb-2">Events on this date:</h5>
                                        <div class="space-y-2">
                                            <template x-for="event in selectedDateInfo.events" :key="event.id">
                                                <div class="p-3 rounded-md border"
                                                    :style="`border-left: 4px solid ${event.backgroundColor}`">
                                                    <div class="font-medium text-sm" x-text="event.title"></div>
                                                    <div class="text-xs text-gray-600 mt-1">
                                                        <span
                                                            x-text="new Date(event.start).toLocaleTimeString('en-US', {hour: '2-digit', minute: '2-digit'})"></span>
                                                        <span x-text="' - '"></span>
                                                        <span
                                                            x-text="new Date(event.end).toLocaleTimeString('en-US', {hour: '2-digit', minute: '2-digit'})"></span>
                                                    </div>
                                                    <template
                                                        x-if="event.extendedProps && event.extendedProps.type === 'travel_plan'">
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            <span x-text="event.extendedProps.country"></span>
                                                            <span x-text="' • '"></span>
                                                            <span
                                                                x-text="`${event.extendedProps.participants}/${event.extendedProps.max_participants} participants`"></span>
                                                        </div>
                                                    </template>
                                                    <template
                                                        x-if="event.extendedProps && event.extendedProps.type === 'meeting'">
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            <span
                                                                x-text="`Location: ${event.extendedProps.location}`"></span>
                                                        </div>
                                                    </template>
                                                    <template
                                                        x-if="event.extendedProps && event.extendedProps.type === 'preparation'">
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            <span
                                                                x-text="`Checklist: ${event.extendedProps.checklist.join(', ')}`"></span>
                                                        </div>
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <div x-show="!selectedDateInfo.events || selectedDateInfo.events.length === 0"
                                        class="text-gray-500 mt-4">
                                        No events on this date
                                    </div>
                                </div>
                                <div x-show="!selectedDateInfo" class="text-gray-500">
                                    Please select a date
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Multiple Calendars -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">Multiple Calendars</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <h4 class="font-medium mb-2">Calendar 1</h4>
                                <x-calendar />
                            </div>
                            <div>
                                <h4 class="font-medium mb-2">Calendar 2</h4>
                                <x-calendar />
                            </div>
                            <div>
                                <h4 class="font-medium mb-2">Calendar 3</h4>
                                <x-calendar />
                            </div>
                        </div>
                    </div>

                    <!-- Custom Styled Calendar -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">Custom Styled Calendar</h3>
                        <div class="max-w-md mx-auto">
                            <div x-data="calendar()"
                                class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl shadow-xl p-6 border border-blue-200">
                                <!-- Calendar Header -->
                                <div class="flex items-center justify-between mb-6">
                                    <button @click="previousMonth()"
                                        class="p-2 hover:bg-blue-200 rounded-lg transition-colors">
                                        <i class="fas fa-chevron-left text-blue-600"></i>
                                    </button>
                                    <h2 class="text-xl font-bold text-blue-800"
                                        x-text="currentMonthName + ' ' + currentYear"></h2>
                                    <button @click="nextMonth()"
                                        class="p-2 hover:bg-blue-200 rounded-lg transition-colors">
                                        <i class="fas fa-chevron-right text-blue-600"></i>
                                    </button>
                                </div>

                                <!-- Weekday Header -->
                                <div class="grid grid-cols-7 gap-1 mb-3">
                                    <template x-for="day in weekDays" :key="day">
                                        <div class="text-center text-sm font-bold text-blue-600 py-2" x-text="day">
                                        </div>
                                    </template>
                                </div>

                                <!-- Calendar Grid -->
                                <div class="grid grid-cols-7 gap-1">
                                    <template x-for="date in calendarDays" :key="date.key">
                                        <button @click="selectDate(date)"
                                            :class="{
                                                'bg-blue-600 text-white hover:bg-blue-700 shadow-lg': date.isSelected,
                                                'bg-gray-200 text-gray-400': date.isOtherMonth,
                                                'bg-white text-gray-700 hover:bg-blue-100 border border-gray-200': !date
                                                    .isOtherMonth && !date.isSelected,
                                                'bg-red-200 text-red-700 border-2 border-red-400': date.isToday
                                            }"
                                            class="h-12 w-12 rounded-lg text-sm font-medium transition-all duration-200 transform hover:scale-105"
                                            :disabled="date.isOtherMonth" x-text="date.day"></button>
                                    </template>
                                </div>

                                <!-- Selected Date Display -->
                                <div class="mt-6 p-4 bg-white rounded-lg border border-blue-200"
                                    x-show="selectedDate">
                                    <p class="text-sm text-blue-600">
                                        Selected Date: <span class="font-bold" x-text="selectedDateFormatted"></span>
                                    </p>
                                </div>

                                <!-- Go to Today Button -->
                                <div class="mt-4">
                                    <button @click="goToToday()"
                                        class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 px-4 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 font-medium shadow-lg">
                                        Go to Today
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Advanced Calendar Component -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">Advanced Calendar Component</h3>
                        <p class="text-gray-600 mb-4">Single selection, range selection, multiple selection modes with
                            event management features</p>
                        <x-advanced-calendar />
                    </div>

                    <!-- Schedule Calendar Component -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium mb-4">Schedule Calendar Component</h3>
                        <p class="text-gray-600 mb-4">Monthly schedule display with add, edit, and delete functionality
                        </p>
                        <x-schedule-calendar />
                    </div>

                    <!-- Feature Description -->
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                        <h3 class="text-lg font-medium text-blue-800 mb-4">Calendar Component Features</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-medium text-blue-700 mb-2">Basic Calendar</h4>
                                <ul class="space-y-2 text-blue-700 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Month display and navigation (previous/next month buttons)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Date selection functionality</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Today's date highlighting</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Selected date display</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Go to today button</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Custom event dispatch (date-selected)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Responsive design</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-blue-700 mb-2">Advanced Calendar</h4>
                                <ul class="space-y-2 text-blue-700 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Three selection modes (single, range, multiple)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Event management functionality</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Event addition and deletion</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Event indicator display</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Side panel information display</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Hover effects during range selection</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Custom events (dates-selected)</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-medium text-blue-700 mb-2">Schedule Calendar</h4>
                                <ul class="space-y-2 text-blue-700 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Monthly schedule display</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Schedule addition, editing, and deletion</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Category-based color coding</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Time-based sorting</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Modal-based detailed editing</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>This month's schedule list</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        <span>Quick addition functionality</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar JavaScript -->
    <script>
        // Mock Data for Calendar Testing
        const mockData = {
            users: [{
                    id: 1,
                    username: 'John Tanaka',
                    email: 'john@example.com',
                    profile_picture_url: '/images/avatar1.jpg'
                },
                {
                    id: 2,
                    username: 'Sarah Sato',
                    email: 'sarah@example.com',
                    profile_picture_url: '/images/avatar2.jpg'
                },
                {
                    id: 3,
                    username: 'Mike Yamada',
                    email: 'mike@example.com',
                    profile_picture_url: '/images/avatar3.jpg'
                },
                {
                    id: 4,
                    username: 'Emma Suzuki',
                    email: 'emma@example.com',
                    profile_picture_url: '/images/avatar4.jpg'
                },
                {
                    id: 5,
                    username: 'David Takahashi',
                    email: 'david@example.com',
                    profile_picture_url: '/images/avatar5.jpg'
                }
            ],
            travelPlans: [{
                    id: 1,
                    user_id: 1,
                    title: 'Bali Relaxation Trip',
                    country: 'Indonesia',
                    start_date: new Date().toISOString().split('T')[0],
                    end_date: new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                    description: 'Relaxing trip to Bali for ultimate relaxation',
                    max_participants: 4,
                    styles: ['chill', 'relax']
                },
                {
                    id: 2,
                    user_id: 2,
                    title: 'Bangkok Adventure',
                    country: 'Thailand',
                    start_date: new Date(Date.now() + 14 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                    end_date: new Date(Date.now() + 21 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                    description: 'Adventure through the streets of Bangkok',
                    max_participants: 6,
                    styles: ['activity', 'adventure']
                },
                {
                    id: 3,
                    user_id: 3,
                    title: 'Kyoto & Nara Historical Tour',
                    country: 'Japan',
                    start_date: new Date(Date.now() + 5 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                    end_date: new Date(Date.now() + 8 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                    description: 'Learning about Japanese history and culture',
                    max_participants: 8,
                    styles: ['culture', 'history']
                },
                {
                    id: 4,
                    user_id: 4,
                    title: 'Sydney Australia Trip',
                    country: 'Australia',
                    start_date: new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                    end_date: new Date(Date.now() + 37 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                    description: 'Enjoying the city of Sydney',
                    max_participants: 5,
                    styles: ['city', 'food']
                },
                {
                    id: 5,
                    user_id: 5,
                    title: 'Cebu Island Philippines',
                    country: 'Philippines',
                    start_date: new Date(Date.now() + 10 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                    end_date: new Date(Date.now() + 15 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
                    description: 'Diving adventure in Cebu Island',
                    max_participants: 4,
                    styles: ['adventure', 'nature']
                }
            ],
            participations: [{
                    id: 1,
                    user_id: 2,
                    travel_plan_id: 1,
                    status: 'accepted',
                    joined_at: new Date(Date.now() - 5 * 24 * 60 * 60 * 1000)
                },
                {
                    id: 2,
                    user_id: 3,
                    travel_plan_id: 1,
                    status: 'pending',
                    joined_at: new Date(Date.now() - 3 * 24 * 60 * 60 * 1000)
                },
                {
                    id: 3,
                    user_id: 1,
                    travel_plan_id: 2,
                    status: 'accepted',
                    joined_at: new Date(Date.now() - 7 * 24 * 60 * 60 * 1000)
                },
                {
                    id: 4,
                    user_id: 4,
                    travel_plan_id: 2,
                    status: 'accepted',
                    joined_at: new Date(Date.now() - 6 * 24 * 60 * 60 * 1000)
                },
                {
                    id: 5,
                    user_id: 5,
                    travel_plan_id: 3,
                    status: 'accepted',
                    joined_at: new Date(Date.now() - 4 * 24 * 60 * 60 * 1000)
                }
            ],
            events: [{
                    id: 1,
                    title: 'Bali Relaxation Trip',
                    start: new Date().toISOString().split('T')[0] + 'T09:00:00',
                    end: new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T18:00:00',
                    backgroundColor: '#3B82F6',
                    borderColor: '#3B82F6',
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
                    borderColor: '#10B981',
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
                    borderColor: '#F59E0B',
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
                    title: 'Sydney Australia Trip',
                    start: new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] +
                        'T11:00:00',
                    end: new Date(Date.now() + 37 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T16:00:00',
                    backgroundColor: '#EF4444',
                    borderColor: '#EF4444',
                    extendedProps: {
                        type: 'travel_plan',
                        travel_plan_id: 4,
                        participants: 0,
                        max_participants: 5,
                        country: 'Australia'
                    }
                },
                {
                    id: 5,
                    title: 'Cebu Island Philippines',
                    start: new Date(Date.now() + 10 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] +
                        'T07:00:00',
                    end: new Date(Date.now() + 15 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T20:00:00',
                    backgroundColor: '#8B5CF6',
                    borderColor: '#8B5CF6',
                    extendedProps: {
                        type: 'travel_plan',
                        travel_plan_id: 5,
                        participants: 0,
                        max_participants: 4,
                        country: 'Philippines'
                    }
                },
                {
                    id: 6,
                    title: 'Travel Plan Meeting',
                    start: new Date(Date.now() + 2 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T14:00:00',
                    end: new Date(Date.now() + 2 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T15:30:00',
                    backgroundColor: '#6B7280',
                    borderColor: '#6B7280',
                    extendedProps: {
                        type: 'meeting',
                        location: 'Online',
                        participants: ['John Tanaka', 'Sarah Sato']
                    }
                },
                {
                    id: 7,
                    title: 'Travel Preparation Check',
                    start: new Date(Date.now() + 1 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T10:00:00',
                    end: new Date(Date.now() + 1 * 24 * 60 * 60 * 1000).toISOString().split('T')[0] + 'T11:00:00',
                    backgroundColor: '#059669',
                    borderColor: '#059669',
                    extendedProps: {
                        type: 'preparation',
                        checklist: ['Passport', 'Flight Tickets', 'Hotel Booking']
                    }
                }
            ]
        };

        document.addEventListener('DOMContentLoaded', function() {
            // 基本的なFullCalendar
            const basicCalendar = new FullCalendar.Calendar(document.getElementById('fullcalendar-basic'), {
                initialView: 'dayGridMonth',
                locale: 'ja',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 400
            });
            basicCalendar.render();

            // サンプルイベント付きFullCalendar
            const eventsCalendar = new FullCalendar.Calendar(document.getElementById('fullcalendar-events'), {
                initialView: 'dayGridMonth',
                locale: 'ja',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 400,
                events: mockData.events,
                eventClick: function(info) {
                    const event = info.event;
                    const props = event.extendedProps;

                    let details = `Title: ${event.title}\n`;
                    details += `Start: ${event.start.toLocaleString('en-US')}\n`;
                    details += `End: ${event.end.toLocaleString('en-US')}\n`;

                    if (props.type === 'travel_plan') {
                        details += `Country: ${props.country}\n`;
                        details += `Participants: ${props.participants}/${props.max_participants}\n`;
                    } else if (props.type === 'meeting') {
                        details += `Location: ${props.location}\n`;
                        details += `Participants: ${props.participants.join(', ')}\n`;
                    } else if (props.type === 'preparation') {
                        details += `Checklist: ${props.checklist.join(', ')}\n`;
                    }

                    alert(details);
                }
            });
            eventsCalendar.render();

            // インタラクティブFullCalendar
            let selectedDate = null;
            const interactiveCalendar = new FullCalendar.Calendar(document.getElementById(
                'fullcalendar-interactive'), {
                initialView: 'dayGridMonth',
                locale: 'ja',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 400,
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: true,
                events: mockData.events,
                select: function(arg) {
                    selectedDate = arg.startStr;
                    document.getElementById('event-start').value = arg.startStr + 'T10:00';
                    document.getElementById('event-end').value = arg.endStr + 'T11:00';
                },
                eventClick: function(arg) {
                    const event = arg.event;
                    const props = event.extendedProps;

                    if (props.type === 'travel_plan') {
                        showTravelPlanDetails(event);
                    } else {
                        if (confirm('Delete this event?')) {
                            event.remove();
                            updateEventList();
                        }
                    }
                },
                eventDrop: function(arg) {
                    updateEventList();
                },
                eventResize: function(arg) {
                    updateEventList();
                }
            });
            interactiveCalendar.render();

            // Travel Plan Details Display
            function showTravelPlanDetails(event) {
                const props = event.extendedProps;
                const travelPlan = mockData.travelPlans.find(p => p.id === props.travel_plan_id);
                const participants = mockData.participations.filter(p => p.travel_plan_id === props.travel_plan_id);

                let details = `=== Travel Plan Details ===\n`;
                details += `Title: ${travelPlan.title}\n`;
                details += `Country: ${travelPlan.country}\n`;
                details += `Period: ${travelPlan.start_date} to ${travelPlan.end_date}\n`;
                details += `Description: ${travelPlan.description}\n`;
                details += `Participants: ${props.participants}/${props.max_participants}\n`;
                details += `Styles: ${travelPlan.styles.join(', ')}\n\n`;

                if (participants.length > 0) {
                    details += `Participant List:\n`;
                    participants.forEach(p => {
                        const user = mockData.users.find(u => u.id === p.user_id);
                        details += `- ${user.username} (${p.status})\n`;
                    });
                }

                alert(details);
            }

            // イベント追加機能
            document.getElementById('add-event').addEventListener('click', function() {
                const title = document.getElementById('event-title').value;
                const start = document.getElementById('event-start').value;
                const end = document.getElementById('event-end').value;
                const color = document.getElementById('event-color').value;

                if (title && start && end) {
                    interactiveCalendar.addEvent({
                        title: title,
                        start: start,
                        end: end,
                        backgroundColor: color,
                        borderColor: color,
                        extendedProps: {
                            type: 'custom',
                            created_by: 'user'
                        }
                    });

                    // フォームをクリア
                    document.getElementById('event-title').value = '';
                    document.getElementById('event-start').value = '';
                    document.getElementById('event-end').value = '';
                    document.getElementById('event-color').value = '#3B82F6';

                    updateEventList();
                } else {
                    alert('Please fill in all fields.');
                }
            });

            // イベントリスト更新
            function updateEventList() {
                const container = document.getElementById('events-container');
                const events = interactiveCalendar.getEvents();

                container.innerHTML = '';
                events.forEach(event => {
                    const eventDiv = document.createElement('div');
                    eventDiv.className = 'p-2 bg-white border rounded-md';

                    const props = event.extendedProps;
                    let eventInfo = '';

                    if (props.type === 'travel_plan') {
                        const travelPlan = mockData.travelPlans.find(p => p.id === props.travel_plan_id);
                        eventInfo = `
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-medium">${event.title}</div>
                                    <div class="text-sm text-gray-600">
                                        ${travelPlan.country} • ${props.participants}/${props.max_participants}人
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        ${event.start.toLocaleDateString('ja-JP')} 
                                        ${event.allDay ? '' : event.start.toLocaleTimeString('ja-JP', {hour: '2-digit', minute: '2-digit'})}
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button onclick="showTravelPlanDetails('${event.id}')" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="deleteEvent('${event.id}')" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                    } else {
                        eventInfo = `
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-medium">${event.title}</div>
                                    <div class="text-sm text-gray-600">
                                        ${event.start.toLocaleDateString('ja-JP')} 
                                        ${event.allDay ? '' : event.start.toLocaleTimeString('ja-JP', {hour: '2-digit', minute: '2-digit'})}
                                    </div>
                                </div>
                                <button onclick="deleteEvent('${event.id}')" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        `;
                    }

                    eventDiv.innerHTML = eventInfo;
                    container.appendChild(eventDiv);
                });
            }

            // Global delete function
            window.deleteEvent = function(eventId) {
                const event = interactiveCalendar.getEventById(eventId);
                if (event) {
                    event.remove();
                    updateEventList();
                }
            };

            // Global details display function
            window.showTravelPlanDetails = function(eventId) {
                const event = interactiveCalendar.getEventById(eventId);
                if (event) {
                    showTravelPlanDetails(event);
                }
            };

            // 異なるビューを持つFullCalendar
            const viewsCalendar = new FullCalendar.Calendar(document.getElementById('fullcalendar-views'), {
                initialView: 'dayGridMonth',
                locale: 'ja',
                headerToolbar: false, // カスタムボタンを使用
                height: 400,
                events: mockData.events
            });
            viewsCalendar.render();

            // ビュー切り替えボタン
            document.getElementById('view-month').addEventListener('click', function() {
                viewsCalendar.changeView('dayGridMonth');
                updateViewButtons('month');
            });

            document.getElementById('view-week').addEventListener('click', function() {
                viewsCalendar.changeView('timeGridWeek');
                updateViewButtons('week');
            });

            document.getElementById('view-day').addEventListener('click', function() {
                viewsCalendar.changeView('timeGridDay');
                updateViewButtons('day');
            });

            document.getElementById('view-list').addEventListener('click', function() {
                viewsCalendar.changeView('listWeek');
                updateViewButtons('list');
            });

            function updateViewButtons(activeView) {
                const buttons = ['view-month', 'view-week', 'view-day', 'view-list'];
                buttons.forEach(buttonId => {
                    const button = document.getElementById(buttonId);
                    if (buttonId === `view-${activeView}`) {
                        button.className =
                            'px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors';
                    } else {
                        button.className =
                            'px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors';
                    }
                });
            }

            // Set month view as active initially
            updateViewButtons('month');

            // Initialize event list
            updateEventList();
        });
    </script>
</x-app-layout>
