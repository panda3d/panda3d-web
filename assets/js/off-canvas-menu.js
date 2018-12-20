/**
 * Offside.js - Off Canvas Menu Setup
 */
var offCanvasMenu = offside('#off-canvas-menu', {
    buttonsSelector: '#off-canvas-toggle',
    // When enabled, off canvas menu pushes the page to the side
    // instead of overlaying on top of the page.
    // slidingElementsSelector:'#page',
    slidingSide: 'right',
});

// Set up an overlay to close the menu when a click is registered outside of it.
var offCanvasOverlay = document.querySelector('#off-canvas-overlay')
                .addEventListener('click', window.offside.factory.closeOpenOffside);
