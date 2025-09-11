# AlpineJS Calendar Components

This project provides three AlpineJS calendar components with different levels of functionality.

## Component Overview

### 1. Basic Calendar (`x-calendar`)
A simple calendar component with basic date selection functionality.

### 2. Advanced Calendar (`x-advanced-calendar`)
A calendar component with advanced features including event management, multiple selection modes, and range selection.

### 3. Schedule Calendar (`x-schedule-calendar`)
A practical calendar component with monthly schedule display, add, edit, and delete functionality.

## Usage

### Basic Calendar

```blade
<!-- Basic usage -->
<x-calendar />

<!-- With event handling -->
<div x-data="{ selectedDate: null }">
    <x-calendar @date-selected="selectedDate = $event.detail" />
    <div x-show="selectedDate">
        Selected Date: <span x-text="selectedDate.formatted"></span>
    </div>
</div>
```

### Advanced Calendar

```blade
<!-- Basic usage -->
<x-advanced-calendar />

<!-- With event handling -->
<div x-data="{ selectedDates: [] }">
    <x-advanced-calendar @dates-selected="selectedDates = $event.detail.dates" />
    <div x-show="selectedDates.length > 0">
        Number of selected dates: <span x-text="selectedDates.length"></span>
    </div>
</div>
```

### Schedule Calendar

```blade
<!-- Basic usage -->
<x-schedule-calendar />

<!-- Customization example -->
<div x-data="{ customSchedules: [] }">
    <x-schedule-calendar />
    <!-- Manage schedule data externally -->
</div>
```

## Feature Details

### Basic Calendar Features

- ✅ Month display and navigation (previous/next month buttons)
- ✅ Date selection functionality
- ✅ Today's date highlighting
- ✅ Selected date display
- ✅ Go to today button
- ✅ Custom event dispatch (`date-selected`)
- ✅ Responsive design

### Advanced Calendar Features

- ✅ Three selection modes (single, range, multiple)
- ✅ Event management functionality
- ✅ Event addition and deletion
- ✅ Event indicator display
- ✅ Side panel information display
- ✅ Hover effects during range selection
- ✅ Custom events (`dates-selected`)

### Schedule Calendar Features

- ✅ Monthly schedule display
- ✅ Schedule addition, editing, and deletion
- ✅ Category-based color coding (Work, Personal, Meeting, Event, Other)
- ✅ Time-based sorting
- ✅ Modal-based detailed editing
- ✅ This month's schedule list display
- ✅ Quick addition functionality
- ✅ Responsive design

## Events

### `date-selected` Event (Basic Calendar)

Fired when a date is selected.

```javascript
{
    date: Date,           // Selected date object
    formatted: String     // Formatted date string
}
```

### `dates-selected` Event (Advanced Calendar)

Fired when dates are selected.

```javascript
{
    dates: Array<Date>,   // Array of selected dates
    mode: String          // Selection mode ('single', 'range', 'multiple')
}
```

## Customization

### Style Customization

Components use Tailwind CSS classes, so you can customize styles by changing CSS classes.

### Functionality Extension

AlpineJS components can be easily extended. For example:

```javascript
// Custom calendar function
function customCalendar() {
    return {
        ...calendar(), // Inherit basic functionality
        // Add custom functionality
        customFunction() {
            // Custom logic
        }
    }
}
```

## Test Page

Access the test page at `/calendar-test`.

```bash
php artisan serve
```

Open your browser and navigate to `http://localhost:8000/calendar-test`.

## Dependencies

- AlpineJS 3.x
- Tailwind CSS
- Font Awesome (for icons)

## File Structure

```
resources/views/
├── components/
│   ├── calendar.blade.php          # Basic calendar component
│   ├── advanced-calendar.blade.php # Advanced calendar component
│   └── schedule-calendar.blade.php # Schedule calendar component
├── calendar-test.blade.php         # Test page
└── layouts/
    └── app.blade.php               # Main layout

routes/
└── web.php                         # Route definitions

CALENDAR_README.md                  # This file
```

## License

This project is released under the MIT License.
