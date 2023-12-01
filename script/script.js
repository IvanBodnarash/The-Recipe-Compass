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

// Sort buttons toggle styles

// function changeColor(event, sortBy) {
//     // event.preventDefault();
//     // Find all elements with 'selected' class and remove this class

//     let buttons = document.querySelectorAll('.sort-block a');

//     buttons.forEach(function (button) {
//         button.classList.remove('selected');
//     });

//     let selectedButton = event.target;
//     // Add class 'selected' to pressed button

//     selectedButton.classList.add('selected');

//     let currentURL = window.location.href;
//     let urlParts = currentURL.split('?');

//     let newURL = urlParts[0] + '?content=recipes&sort=' + sortBy;

//     window.history.replaceState({}, document.title, newURL);

//     loadRecipes(sortBy);
// }

// function loadRecipes(sortBy) {
//     // Викликайте AJAX або оновлюйте вміст рецептів за новим сортуванням
//     // Ви можете використовувати, наприклад, fetch або jQuery.ajax
//     // Приклад з використанням fetch:
//     fetch('index.php?sort=' + sortBy)
//         .then(response => response.json())
//         .then(data => {
//             // Оновлюйте вміст рецептів в DOM за новим сортуванням
//             // Наприклад, оновіть вміст .recipes-wrapper з новими рецептами
//             document.querySelector('.recipes-wrapper').innerHTML = data.recipesHTML;
//         })
//         .catch(error => console.error('Error fetching recipes:', error));
// }