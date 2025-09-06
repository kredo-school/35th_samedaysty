<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Flag Icons Test Page
        </h2>
    </x-slot>

    <!-- Flag Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css">

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-medium mb-4">Flag Icons Display Test</h3>

                    <!-- Country Selection Dropdown -->
                    <div class="mb-8 p-6 bg-gray-50 rounded-lg border">
                        <h4 class="font-medium mb-4">Country Selection Dropdown</h4>

                        <!-- Search Input -->
                        <div class="mb-4">
                            <label for="country-search" class="block text-sm font-medium text-gray-700 mb-2">
                                🔍 Search Countries
                            </label>
                            <input type="text" id="country-search" placeholder="Type to search countries..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1">
                                <label for="country-select" class="block text-sm font-medium text-gray-700 mb-2">
                                    Select a Country
                                </label>
                                <select id="country-select"
                                    class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white bg-no-repeat bg-right-0.5 bg-center bg-[length:1.5em_1.5em]"
                                    style="background-image: url('data:image/svg+xml,%3csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 20 20%22%3e%3cpath stroke=%22%236b7280%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%221.5%22 d=%22m6 8 4 4 4-4%22/%3e%3c/svg%3e')">
                                    <option value="">Choose a country...</option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Selected Country Info
                                </label>
                                <div id="selected-country-info"
                                    class="p-3 bg-white border border-gray-300 rounded-md min-h-[42px] flex items-center">
                                    <span class="text-gray-500">No country selected</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="mt-4 flex flex-wrap gap-2">
                            <button id="random-country"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm">
                                🎲 Random Country
                            </button>
                            <button id="clear-selection"
                                class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors text-sm">
                                🗑️ Clear Selection
                            </button>
                            <button id="show-all-flags"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors text-sm">
                                🏁 Show All Flags
                            </button>
                            <button id="filter-asia"
                                class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition-colors text-sm">
                                🌏 Asia Only
                            </button>
                        </div>
                    </div>

                    <!-- Sample Countries with Flags -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                        <div class="p-4 border rounded-lg">
                            <div class="flex items-center space-x-3">
                                <span class="fi fi-jp text-2xl"></span>
                                <div>
                                    <div class="font-medium">Japan</div>
                                    <div class="text-sm text-gray-600">Code: jp</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 border rounded-lg">
                            <div class="flex items-center space-x-3">
                                <span class="fi fi-th text-2xl"></span>
                                <div>
                                    <div class="font-medium">Thailand</div>
                                    <div class="text-sm text-gray-600">Code: th</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 border rounded-lg">
                            <div class="flex items-center space-x-3">
                                <span class="fi fi-id text-2xl"></span>
                                <div>
                                    <div class="font-medium">Indonesia</div>
                                    <div class="text-sm text-gray-600">Code: id</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 border rounded-lg">
                            <div class="flex items-center space-x-3">
                                <span class="fi fi-au text-2xl"></span>
                                <div>
                                    <div class="font-medium">Australia</div>
                                    <div class="text-sm text-gray-600">Code: au</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 border rounded-lg">
                            <div class="flex items-center space-x-3">
                                <span class="fi fi-ph text-2xl"></span>
                                <div>
                                    <div class="font-medium">Philippines</div>
                                    <div class="text-sm text-gray-600">Code: ph</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 border rounded-lg">
                            <div class="flex items-center space-x-3">
                                <span class="fi fi-us text-2xl"></span>
                                <div>
                                    <div class="font-medium">United States</div>
                                    <div class="text-sm text-gray-600">Code: us</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Flag Loading Test -->
                    <div class="mb-8">
                        <h4 class="font-medium mb-4">Dynamic Flag Loading from Database</h4>
                        <div id="dynamic-flags" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="p-4 border rounded-lg bg-gray-50">
                                <div class="text-center">
                                    <div class="text-gray-500">Loading...</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Flag Sizes Test -->
                    <div class="mb-8">
                        <h4 class="font-medium mb-4">Flag Icon Sizes</h4>
                        <div class="flex items-center space-x-4">
                            <div class="text-center">
                                <span class="fi fi-jp text-xs"></span>
                                <div class="text-xs text-gray-600">xs</div>
                            </div>
                            <div class="text-center">
                                <span class="fi fi-jp text-sm"></span>
                                <div class="text-xs text-gray-600">sm</div>
                            </div>
                            <div class="text-center">
                                <span class="fi fi-jp text-base"></span>
                                <div class="text-xs text-gray-600">base</div>
                            </div>
                            <div class="text-center">
                                <span class="fi fi-jp text-lg"></span>
                                <div class="text-xs text-gray-600">lg</div>
                            </div>
                            <div class="text-center">
                                <span class="fi fi-jp text-xl"></span>
                                <div class="text-xs text-gray-600">xl</div>
                            </div>
                            <div class="text-center">
                                <span class="fi fi-jp text-2xl"></span>
                                <div class="text-xs text-gray-600">2xl</div>
                            </div>
                            <div class="text-center">
                                <span class="fi fi-jp text-3xl"></span>
                                <div class="text-xs text-gray-600">3xl</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Load countries data and display dynamic flags
        async function loadAndDisplayCountries() {
            try {
                const response = await fetch('/api/countries');
                if (response.ok) {
                    const countries = await response.json();
                    window.countriesData = countries;
                    displayCountries(countries);
                    populateCountryDropdown(countries);
                } else {
                    console.error('Failed to load countries');
                }
            } catch (error) {
                console.error('Error loading countries:', error);
            }
        }

        // Populate country dropdown
        function populateCountryDropdown(countries) {
            const select = document.getElementById('country-select');
            const defaultOption = select.querySelector('option[value=""]');

            // Clear existing options except the first one
            select.innerHTML = '';
            select.appendChild(defaultOption);

            // Add country options with flags
            countries.forEach(country => {
                const option = document.createElement('option');
                option.value = country.code;
                option.textContent = `${country.name} (${country.code.toUpperCase()})`;
                option.dataset.countryName = country.name;
                option.dataset.countryCode = country.code;
                select.appendChild(option);
            });
        }

        // Handle country selection
        function handleCountrySelection() {
            const select = document.getElementById('country-select');
            const infoDiv = document.getElementById('selected-country-info');

            if (select.value) {
                const selectedOption = select.options[select.selectedIndex];
                const countryName = selectedOption.dataset.countryName;
                const countryCode = selectedOption.dataset.countryCode;

                infoDiv.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <span class="fi fi-${countryCode.toLowerCase()} text-2xl"></span>
                        <div>
                            <div class="font-medium">${countryName}</div>
                            <div class="text-sm text-gray-600">Code: ${countryCode.toUpperCase()}</div>
                        </div>
                    </div>
                `;
            } else {
                infoDiv.innerHTML = '<span class="text-gray-500">No country selected</span>';
            }
        }

        // Random country selection
        function selectRandomCountry() {
            if (window.countriesData && window.countriesData.length > 0) {
                const randomIndex = Math.floor(Math.random() * window.countriesData.length);
                const randomCountry = window.countriesData[randomIndex];

                const select = document.getElementById('country-select');
                select.value = randomCountry.code;
                handleCountrySelection();
            }
        }

        // Clear selection
        function clearSelection() {
            const select = document.getElementById('country-select');
            select.value = '';
            handleCountrySelection();
        }

        // Show all flags in a grid
        function showAllFlags() {
            const container = document.getElementById('dynamic-flags');
            if (window.countriesData) {
                displayCountries(window.countriesData);
            }
        }

        // Filter countries by search term
        function filterCountriesBySearch(searchTerm) {
            if (!window.countriesData) return;

            const filteredCountries = window.countriesData.filter(country =>
                country.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                country.code.toLowerCase().includes(searchTerm.toLowerCase())
            );

            populateCountryDropdown(filteredCountries);
        }

        // Filter countries by region (Asia example)
        function filterCountriesByRegion(region) {
            if (!window.countriesData) return;

            let filteredCountries;
            switch (region) {
                case 'asia':
                    const asiaCountries = ['Japan', 'China', 'South Korea', 'Thailand', 'Vietnam', 'Indonesia', 'Malaysia',
                        'Singapore', 'Philippines', 'India', 'Nepal', 'Cambodia', 'Laos', 'Myanmar', 'Maldives',
                        'Sri Lanka', 'Bangladesh', 'Pakistan', 'Afghanistan', 'Iran', 'Iraq', 'Kuwait', 'Saudi Arabia',
                        'Qatar', 'United Arab Emirates', 'Oman', 'Yemen', 'Jordan', 'Lebanon', 'Syria', 'Israel',
                        'Palestine', 'Cyprus', 'Turkey', 'Georgia', 'Armenia', 'Azerbaijan', 'Kazakhstan', 'Uzbekistan',
                        'Kyrgyzstan', 'Tajikistan', 'Turkmenistan', 'Mongolia', 'North Korea', 'Taiwan', 'Hong Kong'
                    ];
                    filteredCountries = window.countriesData.filter(country => asiaCountries.includes(country.name));
                    break;
                default:
                    filteredCountries = window.countriesData;
            }

            populateCountryDropdown(filteredCountries);
        }

        function displayCountries(countries) {
            const container = document.getElementById('dynamic-flags');
            container.innerHTML = '';

            // Display first 12 countries as examples
            const sampleCountries = countries.slice(0, 12);

            sampleCountries.forEach(country => {
                const countryDiv = document.createElement('div');
                countryDiv.className = 'p-4 border rounded-lg';
                countryDiv.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <span class="fi fi-${country.code.toLowerCase()} text-2xl"></span>
                        <div>
                            <div class="font-medium">${country.name}</div>
                            <div class="text-sm text-gray-600">Code: ${country.code}</div>
                        </div>
                    </div>
                `;
                container.appendChild(countryDiv);
            });
        }

                // Load countries when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadAndDisplayCountries();
            
            // Add event listeners
            const countrySelect = document.getElementById('country-select');
            const countrySearch = document.getElementById('country-search');
            const randomBtn = document.getElementById('random-country');
            const clearBtn = document.getElementById('clear-selection');
            const showAllBtn = document.getElementById('show-all-flags');
            const filterAsiaBtn = document.getElementById('filter-asia');
            
            // Country selection change
            countrySelect.addEventListener('change', handleCountrySelection);
            
            // Country search input
            countrySearch.addEventListener('input', (e) => {
                filterCountriesBySearch(e.target.value);
            });
            
            // Random country button
            randomBtn.addEventListener('click', selectRandomCountry);
            
            // Clear selection button
            clearBtn.addEventListener('click', clearSelection);
            
            // Show all flags button
            showAllBtn.addEventListener('click', showAllFlags);
            
            // Filter Asia button
            filterAsiaBtn.addEventListener('click', () => {
                filterCountriesByRegion('asia');
                countrySearch.value = '';
            });

            // Add focus/blur events for select styling
            countrySelect.addEventListener('focus', function() {
                this.style.backgroundImage = "url('data:image/svg+xml,%3csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 20 20%22%3e%3cpath stroke=%22%233b82f6%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%221.5%22 d=%22m6 8 4 4 4-4%22/%3e%3c/svg%3e')";
            });
            
            countrySelect.addEventListener('blur', function() {
                this.style.backgroundImage = "url('data:image/svg+xml,%3csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 20 20%22%3e%3cpath stroke=%22%236b7280%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%221.5%22 d=%22m6 8 4 4 4-4%22/%3e%3c/svg%3e')";
            });
        });
    </script>
</x-app-layout>
