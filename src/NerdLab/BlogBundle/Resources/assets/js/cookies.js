/**
 * @license MIT
 */

$('document').ready(function() {

    var isAccepted = readCookie('cookies_acceptation');

    if (isAccepted !== 'accepted') {
        showCookiesDialog();
    }

});


function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0)
            return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else
        var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function showCookiesDialog() {
    $('body').append('<div id="cookies-dialog" style="display: block;"><p>Ta strona używa Cookies. Dowiedz się więcej o celu ich używania - przeczytaj naszą politykę prywatności.<br /> Korzystając ze strony wyrażasz zgodę na używanie cookie, zgodnie z aktualnymi ustawieniami przeglądarki. <button id="cookies_accept" class="btn btn-sm btn-success">Akceptuję</button><br /><a rel="nofollow" href="http://nerdlab.pl/polityka-cookies/">Zapoznaj się z naszą polityką cookies</a></div></p>');
    $('#cookies_accept').click(function() {
        createCookie('cookies_acceptation','accepted',365);
        $('#cookies-dialog').remove();
    });
}

