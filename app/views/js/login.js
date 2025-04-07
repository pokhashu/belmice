let authCodeHash = 'h1qaza2wsxs3edch4rfv';
let _interval;
let iscdsc;

$("#email").on('change keydown', function () {
    if (/^\S+@\S+.\S+$/.test($(this).val())) {
        $("#showConfirmationButton").removeClass("d-none");
    } else {
        $("#showConfirmationButton").addClass("d-none");
    }
});
$("#changeEmail").click(function () {
    $("#email").val("").attr("disabled", false).change();
    $("#confirmationField").addClass("d-none");
    $("#confirmationField input").val("");
    $(this).addClass("d-none");
});
$("#showConfirmationButton").click(function () {
    $.post("/app/models/CustomerUser.php", {formName: 'userExists', email: $("#email").val()}, function (response) {
        let ue = JSON.parse(response).ue;
        if (!ue) {
            Swal.fire({
                icon: "warning",
                title: "Внимание",
                html: "Вам необходимо пройти <a href='/signup'>регистрацию</a>!",
            });

        }
        iscdsc = JSON.parse(response).id;
        if(ue){
            $.post("/app/ajax/SecHandler.php", {formName: 'sendEmailAuth', email: $("#email").val()}, function (response) {
                authCodeHash = JSON.parse(response).h;
                $("#authSentInfo").removeClass("d-none");
            });
            let time = 5 * 60;
            $("#confirmationField").removeClass("d-none");
            $("#email").attr("disabled", true);
            $("#showConfirmationButton").attr("disabled", true);
            $("#changeEmail").addClass("d-none")
            const interval = setInterval(function () {
                time--;
                const minutes = Math.floor(time / 60);
                const seconds = time % 60;

                const formattedTime =
                    (minutes < 10 ? '0' : '') + minutes + ':' +
                    (seconds < 10 ? '0' : '') + seconds;
                $("#showConfirmationButton").text("Выслать код повторно через: " + formattedTime);

                if (time <= 0) {
                    clearInterval(interval);
                    $("#showConfirmationButton").attr("disabled", false);
                    $("#showConfirmationButton").text('Выслать код подтверждения');
                    $("#changeEmail").removeClass("d-none")
                }
            }, 1000);
            _interval = interval;
        }
    });
});

$("#authCode").on('keydown', function (e) {
    $(this).one('keyup', function () {
        if ($(this).val().length >= 4) {
            if ($.MD5($.MD5($(this).val())) === authCodeHash) {
                $("label[for='email']").addClass("text-success").text("Email подтвержден");
                $("#changeEmail").addClass("d-none");
                $("#showConfirmationButton").addClass("d-none");
                $("#authCode").attr("disabled", true);
                $("#confirmationField").addClass("d-none");
                $(this).off("keydown").off("change");
                clearInterval(_interval);
                let timerInterval;
                Swal.fire({
                    title: "Вы успешно вошли!",
                    text: "Теперь вы можете проходить регистрацию!",
                    icon: "success",
                    timer: 1000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    didOpen: () => {
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        $.cookie("customerUserId", iscdsc, { expires: 7 }); //TODO сделать сохранения отпечатка при входе и проверять их типа md5(id+userAgent)
                        document.location.href = "/";
                    }
                });
            }
        }
    });
});
