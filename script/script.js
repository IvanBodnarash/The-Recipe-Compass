"use strict"

const isMobile = {
    Android: function () {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function () {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function () {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function () {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function () {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function () {
        return (
            isMobile.Android() ||
            isMobile.BlackBerry() ||
            isMobile.iOS() ||
            isMobile.Opera() ||
            isMobile.Windows());
    }
};

if (isMobile.any()) {
    document.body.classList.add('_touch');

    // let menuArrows = document.querySelectorAll('.menu__arrow');
    // if (menuArrows.length > 0) {
    //     for (let i = 0; i < menuArrows.length; i++) {
    //         const menuArrow = menuArrows[i];
    //         menuArrow.addEventListener('click', function (e) {
    //             menuArrow.parentElement.classList.toggle('_active');
    //         });
    //     }
    // }

} else {
    document.body.classList.add('_pc');
}

// Menu

const iconMenu = document.querySelector('.menu-icon');

if (iconMenu) {
    const navbarMenu = document.querySelector('.navbar-nav');
    iconMenu.addEventListener('click', function (e) {
        document.body.classList.toggle('_lock')
        iconMenu.classList.toggle('_active');
        navbarMenu.classList.toggle('_active');
    });
}

// Scroll arrow

document.addEventListener('DOMContentLoaded', function () {
    let scrollButton = document.getElementById('scroll-to-top');

    window.onscroll = function () {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollButton.classList.remove('hidden');
        } else {
            scrollButton.classList.add('hidden');
        }
    };

    scrollButton.addEventListener('click', function () {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    });
});