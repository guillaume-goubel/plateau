import '../../styles/pages/home.css';

// Fonction pour détecter si l'utilisateur est sur mobile
function isMobile() {
    return /Android|iPhone|iPad|iPod|Opera Mini|IEMobile|WPDesktop/i.test(navigator.userAgent);
}

document.addEventListener("DOMContentLoaded", (event) => {
    
    // MENU POPUP
    if (typeof $.fn.magnificPopup === 'function') {
        if ($('#subscribe-popup').length > 0) {

            $(document).on('click', '.popup-modal-menu', function (e) {
                e.preventDefault();
                $.magnificPopup.open({
                    showCloseBtn: true,
                    items: {
                        src: '#subscribe-popup'
                    },
                    type: 'inline',
                    mainClass: 'my-mfp-zoom-in'
                });
            });
        }
    }

   // HEADER LINKS
   $(document).on('click', '.header-link', function (e) {
    e.preventDefault();
    let anchor = $(this).data('anchor');
    let menuBtn = document.querySelector('.navbar-toggler.float-start');

    if (anchor) {
        const targetElement = document.getElementById(anchor);
        if (targetElement) {
            if (isMobile()) {
                // Calculer la position avec un ajustement de 50px
                const offset = targetElement.getBoundingClientRect().top + window.scrollY - 70;

                // Effectuer le défilement manuel
                window.scrollTo({ top: offset, behavior: 'auto' });

                // Fermer le menu après un délai si nécessaire
                if (menuBtn) {
                    setTimeout(() => {
                        menuBtn.click();
                    }, 100);
                }
            } else {
                // Défilement fluide sans ajustement
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        } else {
            console.error(`Ancre introuvable : ${anchor}`);
        }
    }
});

});