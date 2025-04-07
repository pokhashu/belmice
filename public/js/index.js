$(".digitsOnly").keypress(function (e) {
    let txt = String.fromCharCode(e.which);
    if (!txt.match(/[0-9]/)) {
        return false;
    }
});