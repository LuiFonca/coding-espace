document.addEventListener('DOMContentLoaded', function() {
    // ===== SIDEBAR TOGGLE ===== (Correção principal)
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('-translate-x-full');
        mainContent.classList.toggle('ml-0');
        mainContent.classList.toggle('md:ml-64'); 
    });

    // ===== DROPDOWN PROFILE ===== 
    const dropdownProfile = document.getElementById('dropdown-profile');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownProfile.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function(e) {
        if (!dropdownProfile.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.style.display = 'none';
        }
    });

    // ===== DARK MODE TOGGLE =====
    const darkModeToggle = document.createElement('button');
    darkModeToggle.innerHTML = '<i class="ri-moon-line"></i>';
    darkModeToggle.className = 'p-2 rounded-full bg-blue-600 text-white ml-2';
    
    darkModeToggle.addEventListener('click', function() {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
        this.innerHTML = document.documentElement.classList.contains('dark') 
            ? '<i class="ri-sun-line"></i>' 
            : '<i class="ri-moon-line"></i>';
    });

    if (localStorage.getItem('darkMode') === 'true') {
        document.documentElement.classList.add('dark');
        darkModeToggle.innerHTML = '<i class="ri-sun-line"></i>';
    }

    document.querySelector('.nav-right').prepend(darkModeToggle);
});