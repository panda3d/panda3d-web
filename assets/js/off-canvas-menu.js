/**
 * Offside.js - Off Canvas Menu Setup
 */
var offCanvasMenu = offside('#off-canvas-menu', {
    buttonsSelector: '#off-canvas-toggle',
    slidingElementsSelector:'#page',
    slidingSide: 'right',
});

// Set up an overlay to close the menu when a click is registered outside of it.
var offCanvasOverlay = document.querySelector('#off-canvas-overlay')
                .addEventListener('click', window.offside.factory.closeOpenOffside);
