function setupNavigation() {
    // Hamburger menu toggle
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('show');
        });
    }

    // Login Modal
    const loginIcon = document.getElementById('loginIcon');
    const loginModal = document.getElementById('loginModal');
    const closeBtn = document.getElementById('closeBtn');
    const initialPosition = { top: 50, left: 50 };

    if (loginIcon) {
        loginIcon.addEventListener('click', () => {
            loginModal.style.display = 'block';
            loginModal.style.top = `${initialPosition.top}px`;
            loginModal.style.left = `${initialPosition.left}px`;
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            loginModal.style.display = 'none';
        });
    }

    loginModal.addEventListener('dblclick', () => {
        loginModal.style.top = `${initialPosition.top}px`;
        loginModal.style.left = `${initialPosition.left}px`;
    });

    window.addEventListener('click', (e) => {
        if (e.target === loginModal) {
            loginModal.style.display = 'none';
        }
    });

    // Drag
    let offsetX = 0, offsetY = 0;

    loginModal.addEventListener('dragstart', (e) => {
        const rect = loginModal.getBoundingClientRect();
        offsetX = e.clientX - rect.left;
        offsetY = e.clientY - rect.top;
    });

    document.addEventListener('dragover', (e) => {
        e.preventDefault();
    });

    document.addEventListener('drop', (e) => {
        e.preventDefault();
        const x = e.clientX - offsetX;
        const y = e.clientY - offsetY;
        loginModal.style.top = `${y}px`;
        loginModal.style.left = `${x}px`;
    });
}
