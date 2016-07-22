function ngReloadScript(url) {
    var old = document.querySelector('script[src*="' + url + '"]');
    var s = document.createElement('script');
    s.type = "text/javascript";
    s.src = url;
    document.head.appendChild(s);
    old.remove();
}