import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // --- Authentication State ---
    // This meta tag should be present in your layouts/public.blade.php
    // <meta name="user-authenticated" content="{{ Auth::check() ? 'true' : 'false' }}">
    const metaAuth = document.querySelector('meta[name="user-authenticated"]');
    const userIsAuthenticated = metaAuth?.content === "true";

    // --- Sign Out Button (Optional: Laravel's Blade form for logout is preferred) ---
    // The <form action="{{ route('logout') }}" method="POST"> in your Blade template
    // is the correct and primary way to handle logout.
    // This JavaScript block is a prototype action and can typically be removed.
    const signOutButton = document.getElementById('signOutButton');
    if (signOutButton) {
        signOutButton.addEventListener('click', () => {
            // This alert is just for demonstration; the form submission handles actual logout.
            alert("You have been signed out (prototype action).");
            // If you were handling logout purely via JS (not recommended for Laravel auth),
            // you would typically submit the logout form or make an AJAX request here.
            // For now, the Blade form handles the actual logout.
        });
    }

    // --- Invalid Action Modal (Keeping its structure in case it's used elsewhere) ---
    // This modal will no longer be triggered by link clicks based on 'data-requires-auth'
    // as that protection logic has been removed from this app.js.
    // However, the modal's functionality (showing/hiding, login/signup links) is preserved
    // if you intend to trigger it programmatically from other parts of your application.
    const invalidActionModal = document.getElementById('invalidActionModal');
    const closeInvalidActionBtn = invalidActionModal?.querySelector('.modal-close-btn');
    const loginLinkInInvalidModal = invalidActionModal?.querySelector('.btn-login');
    const signupLinkInInvalidModal = invalidActionModal?.querySelector('.btn-signup');

    // Functions to show/hide the modal (can be called from other JS events)
    function showModal(modalElement) {
        if (modalElement) modalElement.style.display = 'block';
    }

    function hideModal(modalElement) {
        if (modalElement) modalElement.style.display = 'none';
    }

    // Event listeners for the modal's close button and internal links
    if (closeInvalidActionBtn) {
        closeInvalidActionBtn.addEventListener('click', () => {
            hideModal(invalidActionModal);
        });
    }

    if (loginLinkInInvalidModal) {
        loginLinkInInvalidModal.addEventListener('click', () => {
            window.location.href = "/login";
        });
    }

    if (signupLinkInInvalidModal) {
        signupLinkInInvalidModal.addEventListener('click', () => {
            window.location.href = "/register";
        });
    }

    // --- Statistics Page Logic ---
    // This part handles the year navigation for the statistics graph.
    const yearSpan = document.querySelector('.line-graph-card .date-nav span:nth-child(2)');
    const prevArrow = document.querySelector('.line-graph-card .date-nav .arrow:first-child');
    const nextArrow = document.querySelector('.line-graph-card .date-nav .arrow:last-child');

    if (yearSpan && prevArrow && nextArrow) {
        let currentYear = parseInt(yearSpan.textContent);

        prevArrow.addEventListener('click', () => {
            currentYear--;
            yearSpan.textContent = currentYear;
            console.log('Previous year:', currentYear);
        });

        nextArrow.addEventListener('click', () => {
            currentYear++;
            yearSpan.textContent = currentYear;
            console.log('Next year:', currentYear);
        });
    }

    // --- Profile Page Logic ---
    // This part handles clicks on the edit and add email buttons on the profile page.
    const editButton = document.querySelector('.profile-card .btn-edit');
    const addEmailButton = document.querySelector('.profile-card .btn-add-email');

    if (editButton) {
        editButton.addEventListener('click', () => {
            console.log('Edit button clicked on profile page.');
            // Add your logic for editing profile here (e.g., show a form)
        });
    }

    if (addEmailButton) {
        addEmailButton.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default link/button action if it's a placeholder
            console.log('Add Email Address button clicked on profile page.');
            // Add your logic for adding an email here
        });
    }

    // --- Removed Protection Logic ---
    // The previous logic for `data-requires-auth="true"` and the navbar auth toggle
    // has been removed from this file, as per your updated requirements.
    // Client-side protection for flags and collections is now handled by the
    // script directly embedded in `home page.blade.php` using `alert()`.
});
