import { getSelectedVersion, loadScript } from './helpers';

require('./fontawesome');
require('./prism');

Prism.plugins.customClass.prefix('prism-');

// Load the correct BulmaJS file
loadScript('/assets/bulmajs/' + getSelectedVersion() + '/dist/bulma.js', () => Bulma.traverseDOM(), () => {
    loadScript('/assets/bulmajs/master/dist/bulma.js', () => Bulma.traverseDOM(), () => alert("We was unable to load a version of BulmaJS there may be some display or functionality issues with this site."));
});