document.addEventListener('DOMContentLoaded', () => {
    const checkLoginIcon = (callback) => {
        const loginIcon = document.getElementById('loginIcon');
        if (loginIcon) {
            loginIcon.addEventListener('click', (e) => {
                e.preventDefault();
                const loginModal = document.getElementById('loginModal');
                loginModal.style.display = 'flex';
            });
            if (callback) callback(); // Thirr callback nëse ekziston
        } else {
            console.warn('loginIcon nuk është gjetur ende.');
        }
    };

    // Kontrollo DOM-in me një callback
    setTimeout(() => checkLoginIcon(() => console.log('Kontrolli për loginIcon përfundoi.')), 500);
});
