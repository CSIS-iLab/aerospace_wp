/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function($) {

    var container, button, close, menu, overlay, links, i, len, breakpoint;

    container = document.getElementById('site-navigation');
    if (!container) {
        return;
    }

    button = container.getElementsByTagName('button')[0];
    if ('undefined' === typeof button) {
        return;
    }


    close = document.getElementById('mobile-close');
    if (!close) {
        return;
    }

    menu = container.getElementsByTagName('ul')[0];

    overlay = document.getElementById('site-overlay');
    if (!overlay) {
        return;
    }

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute('aria-expanded', 'false');
    if (-1 === menu.className.indexOf('nav-menu')) {
        menu.className += ' nav-menu';
    }

    button.onclick = function() {
        toggleMenu();
    };

    close.onclick = function() {
        toggleMenu();
    };

    function toggleMenu() {
        breakpoint = getComputedStyle(document.body).getPropertyValue("--breakpoint").replace(/\"/g, '');
        if (-1 !== container.className.indexOf('toggled')) {
            closeMenu();
        } else {
            openMenu();
        }
    };

    $(window).resize(function() {
        breakpoint = getComputedStyle(document.body).getPropertyValue("--breakpoint").replace(/\"/g, '');
        closeMenu();
    }).resize();


    function closeMenu() {
        breakpoint = getComputedStyle(document.body).getPropertyValue("--breakpoint").replace(/\"/g, '');
        container.className = container.className.replace(' toggled', '');
        document.body.className = document.body.className.replace(' toggled', '');
        overlay.className = overlay.className.replace(' toggled', '');
        button.setAttribute('aria-expanded', 'false');
        menu.setAttribute('aria-expanded', 'false');

        if (breakpoint == "xsmall" || breakpoint == "small") {
            $(".menu-item-has-children").removeClass("open");
            $(".menu-item-has-children .submenu-container").slideUp("fast");
        } else {
            $(".menu-item-has-children .submenu-container").slideDown("fast");
            $(".menu-item-has-children").addClass("open");
        }
    }

    function openMenu() {
        container.className += ' toggled';
        overlay.className += ' toggled';
        document.body.className += ' toggled';
        button.setAttribute('aria-expanded', 'true');
        menu.setAttribute('aria-expanded', 'true');
        
    }

    overlay.onclick = function() {
        if ($("#site-navigation").hasClass("toggled")) {
            closeMenu();
        }
    }


    $(".menu-item-has-children").on("click", function() {
        $this = $(this);
        if ($("#site-navigation").hasClass("toggled")) {
            //console.log("click")
            $(".submenu-container", $this).slideToggle("fast");
            $(".menu-item-has-children").toggleClass("open");
        }
    })


    // Get all the link elements within the menu.
    links = menu.getElementsByTagName('a');

    // Each time a menu link is focused or blurred, toggle focus.
    for (i = 0, len = links.length; i < len; i++) {
        links[i].addEventListener('focus', toggleFocus, true);
        links[i].addEventListener('blur', toggleFocus, true);
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while (-1 === self.className.indexOf('nav-menu')) {

            // On li elements toggle the class .focus.
            if ('li' === self.tagName.toLowerCase()) {
                if (-1 !== self.className.indexOf('focus')) {
                    self.className = self.className.replace(' focus', '');
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    (function(container) {
        var touchStartFn, i,
            parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

        if ('ontouchstart' in window) {
            touchStartFn = function(e) {
                var menuItem = this.parentNode,
                    i;

                if (!menuItem.classList.contains('focus')) {
                    e.preventDefault();
                    for (i = 0; i < menuItem.parentNode.children.length; ++i) {
                        if (menuItem === menuItem.parentNode.children[i]) {
                            continue;
                        }
                        menuItem.parentNode.children[i].classList.remove('focus');
                    }
                    menuItem.classList.add('focus');
                } else {
                    menuItem.classList.remove('focus');
                }
            };

            for (i = 0; i < parentLink.length; ++i) {
                parentLink[i].addEventListener('touchstart', touchStartFn, false);
            }
        }
    }(container));
})(jQuery);