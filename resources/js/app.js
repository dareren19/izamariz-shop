import "./bootstrap";
import Swal from 'sweetalert2';
window.Swal = Swal;

document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements
    const searchToggleBtn = document.getElementById('search-toggle-btn');
    const menuToggleBtn = document.getElementById('menu-toggle-btn');
    const searchContainer = document.getElementById('search-container');
    const mobileMenu = document.getElementById('mobile-menu');
    const searchInput = document.getElementById('search-input');
    const menuOpenIcon = document.getElementById('menu-open-icon');
    const menuCloseIcon = document.getElementById('menu-close-icon');
    
    // State variables
    let isMenuOpen = false;
    let isSearchOpen = false;
    
    // Toggle search function
    function toggleSearch() {
        isSearchOpen = !isSearchOpen;
        
        if (isSearchOpen) {
            // Show search container
            searchContainer.classList.remove('hidden');
            // Hide mobile menu if open
            if (isMenuOpen) {
                toggleMenu(false);
            }
            // Focus search input after a delay
            setTimeout(() => {
                if (searchInput) {
                    searchInput.focus();
                }
            }, 50);
        } else {
            // Hide search container
            searchContainer.classList.add('hidden');
        }
    }
    
    // Toggle menu function
    function toggleMenu(forceState = null) {
        if (forceState !== null) {
            isMenuOpen = forceState;
        } else {
            isMenuOpen = !isMenuOpen;
        }
        
        if (isMenuOpen) {
            // Show mobile menu
            mobileMenu.classList.remove('hidden');
            menuOpenIcon.classList.add('hidden');
            menuCloseIcon.classList.remove('hidden');
            // Hide search if open
            if (isSearchOpen) {
                toggleSearch();
            }
        } else {
            // Hide mobile menu
            mobileMenu.classList.add('hidden');
            menuOpenIcon.classList.remove('hidden');
            menuCloseIcon.classList.add('hidden');
        }
    }
    
    // Close menus on larger screens
    function handleResize() {
        if (window.innerWidth >= 768) { // md breakpoint
            if (isMenuOpen) {
                toggleMenu(false);
            }
            if (isSearchOpen) {
                toggleSearch();
            }
        }
    }
    
    // Close menu when clicking outside (optional)
    document.addEventListener('click', function(event) {
        const header = document.getElementById('main-header');
        const isClickInside = header.contains(event.target);
        
        if (!isClickInside && isMenuOpen) {
            toggleMenu(false);
        }
    });
    
    // Close menu when clicking a link
    mobileMenu.addEventListener('click', function(event) {
        if (event.target.tagName === 'A') {
            toggleMenu(false);
        }
    });
    
    // Event Listeners
    if (searchToggleBtn) {
        searchToggleBtn.addEventListener('click', toggleSearch);
    }
    
    if (menuToggleBtn) {
        menuToggleBtn.addEventListener('click', () => toggleMenu());
    }
    
    // Close search on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            if (isSearchOpen) {
                toggleSearch();
            }
            if (isMenuOpen) {
                toggleMenu(false);
            }
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', handleResize);
    
    // Initialize on load
    handleResize();
});


