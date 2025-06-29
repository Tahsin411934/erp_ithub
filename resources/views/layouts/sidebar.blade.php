<div id="sidebar" class="flex flex-shrink-0 h-screen sticky top-0 bg-white border-r border-gray-200 shadow-lg">
    <!-- Sidebar Container -->
    <div class="flex flex-col h-full transition-all duration-300 ease-in-out" id="sidebar-container">
        <!-- Sidebar Header -->
        <div id="divHide" class="flex items-center w-60 justify-between h-16 px-4 bg-blue-100 shadow-md">
            <span id="sidebar-logo-text" class="text-gray-950 text-xl font-semibold whitespace-nowrap transition-all duration-300 sidebar-text">IT HUB ERP</span>
            <button id="sidebar-toggle" class="p-2 rounded-md text-white bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500" title="Collapse sidebar">
                <svg class="w-5 h-5" id="toggle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <div class="flex flex-col flex-grow px-2 py-4 overflow-y-auto scrollbar-hide" id="nav-container">
            <nav class="flex-1 space-y-2">
                <!-- Dashboard -->
                <div class="px-2">
                    <a href="/dashboard" class="flex items-center px-3 py-3 text-sm font-medium text-gray-700 rounded-lg bg-blue-50 group hover:bg-blue-100 transition">
                        <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text">Dashboard</span>
                    </a>
                </div>

                <!-- Academic Management Section -->
                <div class="px-2">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 ml-3 whitespace-nowrap sidebar-text">Academic Management</h3>
                    
                    <!-- Session Management -->
                    <div id="session-dropdown" class="mb-1">
                        <button class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group transition focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text text-left">Session Management</span>
                            </div>
                            <svg class="w-4 h-4 flex-shrink-0 transition-transform duration-200 text-gray-500" id="session-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="session-dropdown-list" class="mt-1 space-y-1 pl-8 hidden">
                           
                            <a href="/sessions"
                                class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 group transition">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-3"></span>
                                <span class="whitespace-nowrap transition-all duration-300 sidebar-text">All Sessions</span>
                            </a>
                           
                        </div>
                    </div>

                    <!-- Course Management -->
                    <div id="course-dropdown" class="mb-1">
                        <button class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group transition focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text text-left">Course Management</span>
                            </div>
                            <svg class="w-4 h-4 flex-shrink-0 transition-transform duration-200 text-gray-500" id="course-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="course-dropdown-list" class="mt-1 space-y-1 pl-8 hidden">
                           
                            <a href="/courses"
                                class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 group transition">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-3"></span>
                                <span class="whitespace-nowrap transition-all duration-300 sidebar-text">All Courses</span>
                            </a>
                           
                        </div>
                    </div>
                </div>
 <!-- Student Accounts Section -->
                <div class="px-2 pt-4">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 ml-3 whitespace-nowrap sidebar-text">Student Management</h3>
                      <a href="/students/create" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group transition mb-1">
                        <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"></path>
                        </svg>
                        <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text">Registration</span>
                    </a>
                    <!-- Accounts -->
                    <div id="accounts-dropdown" class="mb-1">
                        <button class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group transition focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text text-left">Students</span>
                            </div>
                            <svg class="w-4 h-4 flex-shrink-0 transition-transform duration-200 text-gray-500" id="accounts-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                      
                        <div id="accounts-dropdown-list" class="mt-1 space-y-1 pl-8 hidden">
                            <a href="/accounts/balances" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 group transition">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-3"></span>
                                <span class="whitespace-nowrap transition-all duration-300 sidebar-text">Account Balances</span>
                            </a>
                            <a href="/accounts/transactions"
                                class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 group transition">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-3"></span>
                                <span class="whitespace-nowrap transition-all duration-300 sidebar-text">Transaction History</span>
                            </a>
                            <a href="/accounts/statements"
                                class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 group transition">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-3"></span>
                                <span class="whitespace-nowrap transition-all duration-300 sidebar-text">Generate Statements</span>
                            </a>
                        </div>
                    </div>

                    
                </div>
                <!-- Payment Management Section -->
                <div class="px-2 pt-4">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 ml-3 whitespace-nowrap sidebar-text">Payment Management</h3>
                    
                    <!-- Payments -->
                    <div id="payments-dropdown" class="mb-1">
                        <button class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group transition focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text text-left">Payments</span>
                            </div>
                            <svg class="w-4 h-4 flex-shrink-0 transition-transform duration-200 text-gray-500" id="payments-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="payments-dropdown-list" class="mt-1 space-y-1 pl-8 hidden">
                            <a href="/payments/session" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 group transition">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-3"></span>
                                <span class="whitespace-nowrap transition-all duration-300 sidebar-text">Due Payment</span>
                            </a>
                          
                        </div>
                    </div>

                    <!-- Invoices -->
                    <div id="invoices-dropdown" class="mb-1">
                        <button class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group transition focus:outline-none">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"></path>
                                </svg>
                                <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text text-left">Invoices</span>
                            </div>
                            <svg class="w-4 h-4 flex-shrink-0 transition-transform duration-200 text-gray-500" id="invoices-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="invoices-dropdown-list" class="mt-1 space-y-1 pl-8 hidden">
                            <a href="/invoices/create" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 group transition">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-3"></span>
                                <span class="whitespace-nowrap transition-all duration-300 sidebar-text">Create Invoice</span>
                            </a>
                            <a href="/invoices"
                                class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 group transition">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-3"></span>
                                <span class="whitespace-nowrap transition-all duration-300 sidebar-text">All Invoices</span>
                            </a>
                            <a href="/invoices/overdue"
                                class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-100 group transition">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-3"></span>
                                <span class="whitespace-nowrap transition-all duration-300 sidebar-text">Overdue Invoices</span>
                            </a>
                        </div>
                    </div>

                    <!-- Fee Structure -->
                    <a href="/fee-structure" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group transition mb-1">
                        <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text">Fee Structure</span>
                    </a>

                    <!-- Payment Reports -->
                    <a href="/payment-reports" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group transition mb-1">
                        <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text">Payment Reports</span>
                    </a>
                </div>

               

                <!-- System Administration -->
                <div class="px-2 pt-4">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 ml-3 whitespace-nowrap sidebar-text">Reports</h3>
                    
                    <!-- Payment Settings -->
                    <a href="/payment-settings" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group transition mb-1">
                        <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text">Payment Settings</span>
                    </a>

                    <!-- Payment Gateways -->
                    <a href="/payment-gateways" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 group transition mb-1">
                        <svg class="w-5 h-5 flex-shrink-0 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <span class="ml-3 whitespace-nowrap transition-all duration-300 sidebar-text">Payment Gateways</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Sidebar Footer (User Profile) -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center min-w-0">
                    <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="User profile">
                    <div class="ml-3 overflow-hidden sidebar-text">
                        <p class="text-sm font-medium text-gray-900 truncate">Admin User</p>
                        <p class="text-xs font-medium text-gray-500 truncate">Administrator</p>
                    </div>
                </div>
                <a href="/logout" class="text-gray-500 hover:text-gray-700 p-1 rounded-md hover:bg-gray-100 transition" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Completely hide scrollbar but keep functionality */
    .scrollbar-hide {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;  /* Chrome, Safari and Opera */
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarContainer = document.getElementById('sidebar-container');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const toggleIcon = document.getElementById('toggle-icon');
    const logoText = document.getElementById('sidebar-logo-text');
    const divHide = document.getElementById('divHide');
    const sidebarTexts = document.querySelectorAll('.sidebar-text:not(#sidebar-logo-text)');
    const dropdownContents = document.querySelectorAll('[id$="-dropdown-list"]');
    const dropdownIcons = document.querySelectorAll('[id$="-dropdown-icon"]');
    
    // Check localStorage for saved state
    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    
    if (isCollapsed) {
        collapseSidebar();
    }
    
    sidebarToggle.addEventListener('click', function() {
        const isCollapsed = sidebarContainer.classList.contains('w-20');
        
        if (isCollapsed) {
            expandSidebar();
            localStorage.setItem('sidebarCollapsed', 'false');
        } else {
            collapseSidebar();
            localStorage.setItem('sidebarCollapsed', 'true');
        }
    });
    
    function collapseSidebar() {
        sidebarContainer.classList.add('w-20');
        sidebarContainer.classList.remove('w-60');
        divHide.classList.remove('w-60');
        
        // Change icon to double arrow right
        toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>';
        
        // Hide logo text
        logoText.classList.add('hidden');
        
        // Hide all other sidebar texts
        sidebarTexts.forEach(el => el.classList.add('hidden'));
        
        // Center align navigation icons when collapsed
        document.querySelectorAll('#nav-container a, #nav-container button').forEach(el => {
            if (!el.classList.contains('justify-center')) {
                el.classList.add('justify-center');
            }
        });
        
        // Close all dropdowns
        dropdownContents.forEach(dropdown => dropdown.classList.add('hidden'));
        dropdownIcons.forEach(icon => icon.classList.remove('rotate-180'));
    }
    
    function expandSidebar() {
        sidebarContainer.classList.remove('w-20');
        sidebarContainer.classList.add('w-60');
        
        // Change icon to double arrow left
        toggleIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>';
        
        // Show logo text
        logoText.classList.remove('hidden');
        
        // Show all sidebar texts
        sidebarTexts.forEach(el => el.classList.remove('hidden'));
        
        // Remove center alignment from navigation items
        document.querySelectorAll('#nav-container a, #nav-container button').forEach(el => {
            el.classList.remove('justify-center');
        });
    }
    
    // Dropdown toggle functionality
    document.querySelectorAll('[id$="-dropdown"] button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdownId = this.parentElement.id;
            const contentId = `${dropdownId}-list`;
            const iconId = `${dropdownId}-icon`;
            
            const content = document.getElementById(contentId);
            const icon = document.getElementById(iconId);
            
            // Toggle current dropdown
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
            
            // Close all other dropdowns
            document.querySelectorAll('[id$="-dropdown-list"]').forEach(otherContent => {
                if (otherContent.id !== contentId) {
                    otherContent.classList.add('hidden');
                    const otherIconId = otherContent.id.replace('-list', '-icon');
                    const otherIcon = document.getElementById(otherIconId);
                    if (otherIcon) otherIcon.classList.remove('rotate-180');
                }
            });
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        dropdownContents.forEach(content => content.classList.add('hidden'));
        dropdownIcons.forEach(icon => icon.classList.remove('rotate-180'));
    });
});
</script>