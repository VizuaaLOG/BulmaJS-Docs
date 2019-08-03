import { getSelectedVersion, loadScript } from './helpers';

require('./fontawesome');
require('./prism');

Prism.plugins.customClass.prefix('prism-');

function afterLoadScript() {
    if(getSelectedVersion(true, false) == 0 && getSelectedVersion(false, true) <= 10) {
        Bulma.traverseDOM();
    } else {
        Bulma.parseDocument();
    }

    if(window.afterBulmaLoad) {
        for(var i = 0; i < window.afterBulmaLoad.length; i++) {
            window.afterBulmaLoad[i]();
        }
    }
}

// Load the correct BulmaJS file
loadScript('/assets/bulmajs/' + getSelectedVersion() + '/dist/bulma.js', afterLoadScript, () => {
    loadScript('/assets/bulmajs/master/dist/bulma.js', afterLoadScript, () => alert("We was unable to load a version of BulmaJS there may be some display or functionality issues with this site."));
});

// Version selector
function changeVersion(event) {
    let newValue = event.target.value;
    
    window.location.href = window.location.href.replace(getSelectedVersion(), newValue);
}

let $versionSelector = document.getElementById('version-selector');

if($versionSelector) {
    $versionSelector.addEventListener('change', changeVersion);

    $versionSelector.value = getSelectedVersion();
}