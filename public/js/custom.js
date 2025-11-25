window.addEventListener("load", function () {
    const progressBar = document.getElementById("progressBar");
    const preload = document.getElementById("preload");

    // Simular progreso inicial rápido (hasta 80%)
    let progress = 0;
    const initialInterval = setInterval(() => {
        progress += Math.random() * 10;
        if (progress >= 80) {
            progress = 80;
            clearInterval(initialInterval);
            
            // Una vez que llegamos al 80%, esperamos a que todo cargue completamente
            if (document.readyState === 'complete') {
                completeLoading();
            } else {
                window.addEventListener('load', completeLoading);
            }
        }
        progressBar.style.width = progress + "%";
    }, 100);

    function completeLoading() {
        // Completar la barra al 100%
        progressBar.style.width = "100%";

        // Esperar 2 segundos para mostrar el 100% y luego ocultar
        setTimeout(() => {
            preload.classList.add("preload-hidden");

            // Eliminar el preload después de la animación
            setTimeout(() => {
                if (preload && preload.parentNode) {
                    preload.remove();
                }
            }, 500);
        }, 2000); // Reducido a 2 segundos
    }

    // Como respaldo, si la página tarda demasiado en cargar
    // ocultar el preload después de 3 segundos como máximo
    setTimeout(() => {
        if (preload && !preload.classList.contains("preload-hidden")) {
            progressBar.style.width = "100%";
            setTimeout(() => {
                preload.classList.add("preload-hidden");
                setTimeout(() => {
                    if (preload && preload.parentNode) {
                        preload.remove();
                    }
                }, 500);
            }, 2000); // Reducido a 2 segundos
        }
    }, 3000); // Este timeout de respaldo se mantiene en 3 segundos
});

// Ocultar el preload cuando la página esté completamente cargada
document.addEventListener("DOMContentLoaded", function () {
    // [El resto de tu código JavaScript permanece igual]
    const menuBtn = document.getElementById("menuBtn");
    const sidebar = document.getElementById("sidebar");
    const sidebarBackdrop = document.getElementById("sidebar-backdrop");
    const profileBtn = document.getElementById("profileBtn");
    const profileBtnMobile = document.getElementById("profileBtnMobile");
    const profileMenu = document.getElementById("profileMenu");
    const sidebarItems = document.querySelectorAll(".sidebar-item");
    const collapsibleBtns = document.querySelectorAll(".collapsible-btn");

    // Estado del sidebar
    let sidebarOpen = false;

    // Alternar sidebar
    if (menuBtn && sidebar && sidebarBackdrop) {
        menuBtn.addEventListener("click", function () {
            sidebarOpen = !sidebarOpen;
            if (sidebarOpen) {
                sidebar.classList.remove("-translate-x-full");
                sidebarBackdrop.classList.remove("hidden");
            } else {
                sidebar.classList.add("-translate-x-full");
                sidebarBackdrop.classList.add("hidden");
            }
        });

        // Cerrar sidebar al hacer clic en el backdrop
        sidebarBackdrop.addEventListener("click", function () {
            sidebarOpen = false;
            sidebar.classList.add("-translate-x-full");
            sidebarBackdrop.classList.add("hidden");
        });
    }

    // Alternar menú de perfil
    function toggleProfileMenu() {
        if (profileMenu) {
            profileMenu.classList.toggle("hidden");
        }
    }

    if (profileBtn) profileBtn.addEventListener("click", toggleProfileMenu);
    if (profileBtnMobile)
        profileBtnMobile.addEventListener("click", toggleProfileMenu);

    // Cerrar menú de perfil al hacer clic fuera de él
    document.addEventListener("click", function (event) {
        if (profileMenu && !profileMenu.classList.contains("hidden")) {
            const isProfileBtn =
                (profileBtn && profileBtn.contains(event.target)) ||
                (profileBtnMobile && profileBtnMobile.contains(event.target));
            const isProfileMenuClick = profileMenu.contains(event.target);

            if (!isProfileBtn && !isProfileMenuClick) {
                profileMenu.classList.add("hidden");
            }
        }
    });

    // Alternar menús colapsables
    if (collapsibleBtns.length > 0) {
        collapsibleBtns.forEach((btn) => {
            btn.addEventListener("click", function () {
                const content = this.nextElementSibling;
                const icon = this.querySelector(".fa-chevron-down");

                // Cerrar otros menús abiertos primero
                document
                    .querySelectorAll(".collapsible-content.open")
                    .forEach((openContent) => {
                        if (openContent !== content) {
                            openContent.classList.remove("open");
                            const otherIcon =
                                openContent.previousElementSibling.querySelector(
                                    ".fa-chevron-down"
                                );
                            if (otherIcon)
                                otherIcon.classList.remove("rotate-180");
                        }
                    });

                // Alternar la clase 'open' en el contenido
                if (
                    content &&
                    content.classList.contains("collapsible-content")
                ) {
                    content.classList.toggle("open");
                }

                // Rotar el icono
                if (icon) {
                    icon.classList.toggle("rotate-180");
                }
            });
        });
    }

    // Remover cualquier clase 'active' que pueda estar presente al cargar
    sidebarItems.forEach((item) => {
        item.classList.remove("active");
    });
});
