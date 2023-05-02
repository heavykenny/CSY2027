$(document).ready(function () {
    let success = $("#success-alert");
    let error = $("#error-alert");
    success.hide();
    error.hide();


    function showAlert(type, message) {
        if (type == 'error') {
            $("#messagePopupE").text(message);
            error.fadeTo(2000, 500).slideUp(500, function () {
                error.slideUp(500);
            });
        } else if (type == 'success') {
            $("#messagePopupS").text(message);
            success.fadeTo(2000, 500).slideUp(500, function () {
                success.slideUp(500);
            });
        }
    }

    window.showAlert = showAlert;
});
