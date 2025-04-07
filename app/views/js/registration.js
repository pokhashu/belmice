//TODO СДЕЛАТЬ ЧТО ДАННЫЙ АДРЕС УЖЕ ЗАРЕГИСТРИРОВАН
let authCodeHash = 'h1qaza2wsxs3edch4rfv';
let _interval;
$("#email").on('change keydown', function(){
    if(/^\S+@\S+.\S+$/.test($(this).val())){
        $("#showConfirmationButton").removeClass("d-none");
    } else {
        $("#showConfirmationButton").addClass("d-none");
    }
});
$("#changeEmail").click(function(){
    $("#email").val("").attr("disabled", false).change();
    $("#confirmationField").addClass("d-none");
    $("#confirmationField input").val("");
    $(this).addClass("d-none");
});
$("#showConfirmationButton").click(function() {
    $.post("/app/ajax/SecHandler.php", {formName: 'sendEmailAuth', email: $("#email").val()}, function(response){
        authCodeHash = JSON.parse(response).h;
        $("#authSentInfo").removeClass("d-none");
    });
    let time = 5*60;
    $("#confirmationField").removeClass("d-none");
    $("#email").attr("disabled", true);
    $("#showConfirmationButton").attr("disabled", true);
    $("#changeEmail").addClass("d-none")
    const interval = setInterval(function() {
        time--;
        const minutes = Math.floor(time / 60);
        const seconds = time % 60;

        const formattedTime =
            (minutes < 10 ? '0' : '') + minutes + ':' +
            (seconds < 10 ? '0' : '') + seconds;
        $("#showConfirmationButton").text("Выслать код повторно через: "+formattedTime);

        if (time <= 0) {
            clearInterval(interval);
            $("#showConfirmationButton").attr("disabled", false);
            $("#showConfirmationButton").text('Выслать код подтверждения');
            $("#changeEmail").removeClass("d-none")
        }
    }, 1000);
    _interval = interval;
});

$("#authCode").on('keydown', function(e){
    $(this).one('keyup', function (){
        if($(this).val().length >= 4){
            if($.MD5($.MD5($(this).val()))===authCodeHash){
                $("label[for='email']").addClass("text-success").text("Email подтвержден");
                $("#changeEmail").addClass("d-none");
                $("#showConfirmationButton").addClass("d-none");
                $("#authCode").attr("disabled", true);
                $("#confirmationField").addClass("d-none");
                $(this).off("keydown").off("change");
                clearInterval(_interval);
            }
        }
    });
});


function showJur() {
    $("#Ind-form").addClass("d-none").removeClass("d-md-flex d-sm-block");
    $("#Jur-form").removeClass("d-none").addClass("d-md-flex d-sm-block");
    $("#showIndformBtn").removeClass("active text-light");
    $("#showJurformBtn").addClass("active text-light");
    $("#Jur-form input").each(function () {
        if ($(this).attr("id") !== "Jur-actsOnDocNumber" && $(this).attr("id") !== "Jur-actsOnDocDate") {
            $(this).addClass("validate");
        }
    });
    $("#Ind-form input").each(function () {
        $(this).removeClass("validate");
    });
    $('input.validate').on("change", function () {
        if ($(this).val() !== "") {
            $(this).removeClass("border border-danger border-2");
        }
    });
}
showJur();

function showInd() {
    $("#Jur-form").addClass("d-none").removeClass("d-md-flex d-sm-block");
    $("#Ind-form").removeClass("d-none").addClass("d-md-flex d-sm-block");
    $("#showIndformBtn").addClass("active text-light");
    $("#showJurformBtn").removeClass("active text-light");
    $("#Ind-form input").each(function () {
        $(this).addClass("validate");
    });
    $("#Jur-form input").each(function () {
        $(this).removeClass("validate");
    });
    $('input.validate').on("change", function () {
        if ($(this).val() !== "") {
            $(this).removeClass("border border-danger border-2");
        }
    });
}

$("#Jur-organizationUNPINN").on("change", function(){ //193644306
    $("#Jur-organizationName").val("");
    $("#Jur-address").val("");
    if($(this).val().length === 9){
        $.get("http://grp.nalog.gov.by/api/grp-public/data?unp="+$(this).val()+"&charset=UTF-8&type=json", function(data) {
            console.log(data);
            $("#Jur-organizationName").val(data.row.vnaimp);
            $("#Jur-address").val(data.row.vpadres);
        }, 'json')
            .fail(function() {
                $("#Jur-organizationName").attr("readonly", false)
                console.log('Error occurred while fetching data.');
            });
    } else if($(this).val().length === 10 || $(this).val().length === 12){
        let url = "http://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party";
        let token = "ffbc9832248f573eaf8ea799d3c33b99fd8c1ae6";
        let query = $(this).val();

        $.ajax({
            url: url,
            type: "POST",
            contentType: "application/json",
            headers: {
                "Authorization": "Token " + token
            },
            data: JSON.stringify({ query: query , count: 1}),
            success: function(response) {
                console.log(response);
                try {
                    $("#Jur-organizationName").val(response.suggestions[0].data.name.full_with_opf);
                    $("#Jur-address").val(response.suggestions[0].data.address.unrestricted_value);
                } catch (e) {
                    console.log(e.message);
                    $("#Jur-organizationName").attr("readonly", false)
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error: " + textStatus + " - " + errorThrown);
                $("#Jur-organizationName").attr("readonly", false)
            }
        });
    } else {
        alert("УНП состоит из 9 цифр!\nИНН состоит из 10 цифр!");
        $("#Jur-organizationName").val("");
        $("#Jur-address").val("");
    }

});
$("#Jur-actsOnTheBasisOf").on("change", function () {
    let v = $(this).find("option:selected").val();
    if (v === "1") {
        $(".Jur-docInfoToHide").addClass("d-none");
        $("#Jur-actsOnDocNumber").removeClass("validate");
        $("#Jur-actsOnDocDate").removeClass("validate");
    } else if (v === "2") {
        $(".Jur-docInfoToHide").removeClass("d-none");
        $("label[for='Jur-actsOnDocNumber']").text("№ доверенности");
        $("label[for='Jur-actsOnDocDate']").text("Дата доверенности");
        $("#Jur-actsOnDocNumber").addClass("validate");
        $("#Jur-actsOnDocDate").addClass("validate");

    } else if (v === "3") {
        $(".Jur-docInfoToHide").removeClass("d-none");
        $("label[for='Jur-actsOnDocNumber']").text("№ свидетельства");
        $("label[for='Jur-actsOnDocDate']").text("Дата свидетельства");
        $("#Jur-actsOnDocNumber").addClass("validate");
        $("#Jur-actsOnDocDate").addClass("validate");
    }
    $('input.validate').on("change", function () {
        if ($(this).val() !== "") {
            $(this).removeClass("border border-danger border-2");
        }
    });
});



//lvovich.getGender({ last: 'Ходько', first: 'Андрей', middle: 'Андреевич' })
// 'male'
// lvovich.incline({ last: 'Ходько', first: 'Андрей', middle: 'Андреевич' }, 'genitive')
// {gender: 'male', first: 'Андрея', last: 'Ходько', middle: 'Андреевича'}
$('input.validate').on("change", function () {
    if ($(this).val() !== "") {
        $(this).removeClass("border border-danger border-2");
    }
});
$("#submitButton").on("click", function(){
    let validated = true;
    let email = $("#email").val();
    let phone = $("#phone").val();
    let payerType = $("#showIndformBtn").hasClass("active") ? 1 : 2;
    let payerTypeString = payerType === 1 ? 'Ind-' : 'Jur-';
    let payerData = {};

    // Находим все инпуты и селекты в форме
    $('#' + payerTypeString + 'form').find('input, select, textarea').each(function (index) {
        let id = $(this).attr('id'); // Получаем id элемента
        if (id.startsWith(payerTypeString)) {
            let key = id.replace(payerTypeString, ''); // Убираем приставку 'Jur-'
            let value = $(this).is('select') ? $(this).val() : $(this).val(); // Получаем значение
            // Добавляем в словарь
            payerData[key] = value;
        }
    });
    $('input.validate').on("change", function () {
        if ($(this).val() !== "" || $(this).prop("checked")) {
            $(this).removeClass("border border-danger border-2");
        }
    });
    $('input.validate').each(function () {
        if ($(this).val() === "" && !$(this).prop("checked")) {
            $(this).addClass("border border-danger border-2");
            validated = false;
        }
    });
    let allFieldsFilled = Object.values(payerData).every(value => value !== "");
    if($.MD5($.MD5($("#authCode").val()))!==authCodeHash){
        Swal.fire({
            icon: "warning",
            title: "Внимание",
            text: "Вы должны подтвердить свою почту!",
        });
        return;
    }
    if (validated) {
        $.post("/app/ajax/CustomerRegistrationHandler.php", {formName: 'addCustomerUser', email: email, phone: phone, payerType: payerType, payerData: JSON.stringify(payerData)}, function(response){
            let r = JSON.parse(response);
            if(r.status === 'success'){
                $.cookie("customerUserId", r.userId, { expires: 7 }); //TODO сделать сохранения отпечатка при входе и проверять их типа md5(id+userAgent)
                document.location.href = "/login";
            }
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "Упс...",
            text: "Заполните все выделенные поля!!",
        });
    }
});