var script = document.createElement('script');
script.src = 'http://code.jquery.com/jquery-1.11.0.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);

$(document).ready(function () {
    $('.navbar-custom-menu').append('<div class="backoffice-profile-link"></div>');
    $('.backoffice-profile-link').click(function () {
        window.location.href = '/profile';
    });
});