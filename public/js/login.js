function initHome() {
    $('.loginInput').change(function() {togglePrompt();});
    $('#emailInput').focus(function() {hidePrompt('#loginPromptEmail');});
    $('#passwordInput').focus(function() {hidePrompt('#loginPromptPassword');});
    $('#emailInput').focusout(function() {togglePrompt();});
    $('#passwordInput').focusout(function() {togglePrompt();});
}

function togglePrompt() {
    if ($('#emailInput').val() != '') {
        $('#loginPromptEmail').css('visibility','hidden');
    } else {
        $('#loginPromptEmail').css('visibility','visible');
    }
    if ($('#passwordInput').val() != '') {
        $('#loginPromptPassword').css('visibility','hidden');
    } else {
        $('#loginPromptPassword').css('visibility','visible');
    }
}

function hidePrompt(promptName) {
    $(promptName).css('visibility','hidden');
}