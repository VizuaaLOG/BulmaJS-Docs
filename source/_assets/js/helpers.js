/**
 * Returns the selected documentation version from the URL
 * 
 * @returns {String}
 */
export function getSelectedVersion() {
    var regex = /documentation\/(?:(\d+)\.)?(?:(\d+)\.)?(\*|\d+)/;
    var url = window.location.href;

    var match = url.match(regex);
    
    if(!match) {
        return 'master';
    }

    return match[1] + '.' + match[3];
}

/**
 * Load a script into the document.
 * 
 * @param {String} url The path to load
 * @param {Function} onload The function to call when the script has loaded
 * @param {Function} onerror The function to call if the script errors during load
 * 
 * @returns {void}
 */
export function loadScript(url, onload, onerror) {
    let script = document.createElement('script');
    script.setAttribute('src', url);
    script.onerror = onerror;
    script.onload = onload;
    document.head.appendChild(script);
}