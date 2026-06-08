/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	var container, toggle, button, menu;

	container = document.getElementById( 'navigation' );
	if ( ! container ) {
		return;
	}
	toggle = document.getElementById( 'menu-toggle' );
	if ( ! toggle ) {
		return;
	}

	button = toggle.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};


	
} )();


// dropdown menu.
document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('.disclosure-toggle');

    toggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            
            // Get the target sub-menu ID from the button's aria-controls attribute
            const subMenuId = this.getAttribute('aria-controls');
            const subMenu = document.getElementById(subMenuId);

            if (!subMenu) return;

            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            // Toggle state attributes on the button and sub-menu
            this.setAttribute('aria-expanded', !isExpanded);
            subMenu.setAttribute('aria-hidden', isExpanded);

            // Optional: Toggle helper classes for styling transitions
            this.classList.toggle('is-open', !isExpanded);
            subMenu.classList.toggle('is-open', !isExpanded);
        });
    });

    // Close open menus when clicking outside of them
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.menu-item-has-children')) {
            closeAllSubMenus();
        }
    });

    // Close open menus when pressing the Escape key (Accessibility best practice)
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeAllSubMenus();
        }
    });

    // Helper function to reset all menus to a collapsed state
    function closeAllSubMenus() {
        toggles.forEach(toggle => {
            const subMenuId = toggle.getAttribute('aria-controls');
            const subMenu = document.getElementById(subMenuId);

            toggle.setAttribute('aria-expanded', 'false');
            toggle.classList.remove('is-open');
            
            if (subMenu) {
                subMenu.setAttribute('aria-hidden', 'true');
                subMenu.classList.remove('is-open');
            }
        });
    }
});