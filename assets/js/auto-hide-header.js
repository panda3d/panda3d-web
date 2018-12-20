/**
 * Auto Hide Header
 *
 * Hide the header when scrolling down the page, and show it again when
 * scrolling up.
 */

// Set initial scroll position
var prevScrollPos = window.pageYOffset;

// Grab header element style and height value
var header = document.getElementById('header'),
    style = window.getComputedStyle(header);
var headerHeight = parseInt(style.getPropertyValue('height'), 10);

window.onscroll = function() {
    // Get current page offset and calculate difference to determine how
    // the header should move.
    var currentScrollPos = window.pageYOffset;
    var scrollDifference = prevScrollPos - currentScrollPos;

    // Get value of 'top' CSS class, convert to integer
    var top = parseInt(style.getPropertyValue('top'), 10);
    var topAdjusted = top + scrollDifference;

    if (scrollDifference > 0) {
        // If scrolling up, change 'top until header is fully visible
        // (top = 0)
        topAdjusted = Math.min(topAdjusted, 0);
        header.style.top = topAdjusted.toString() + 'px';
    } else if (scrollDifference < 0) {
        // If scrolling up, change 'top' until header is fully hidden
        // (top = -headerHeight)
        topAdjusted = Math.max(topAdjusted, -headerHeight);
        header.style.top = topAdjusted.toString() + 'px';
    }

    prevScrollPos = currentScrollPos;
};
