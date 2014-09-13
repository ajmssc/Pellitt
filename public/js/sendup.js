$(document).ready(function(){initSendup();});

function initSendup() {
    $('body').on('click',function(){sendup();});
}

function sendup() {
    parent.closeMenu();
}