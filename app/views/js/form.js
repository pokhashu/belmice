let formUrl = new URL(window.location).pathname.split('/').pop();

const swiperForm = new Swiper('.slider-wrapper', {
    loop: true,
    grabCursor: true,
    spaceBetween: 30,
    // Pagination bullets
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: true
    },
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    // Responsive breakpoints
    breakpoints: {
        0: {
            slidesPerView: 1
        },
        768: {
            slidesPerView: 2
        },
        1024: {
            slidesPerView: 2
        }
    }
});

let CurrentTourId = 0;

function inc(field) {
    let f = $(field);
    let v = parseInt(f.val());
    if (v < 300) {
        f.val(v + 1);
    }
    if (isNaN(v)) {
        f.val(1);
    }
    $(field).trigger('change');

}

function dec(field) {
    let f = $(field);
    let v = parseInt(f.val());
    if (v > 0) {
        f.val(v - 1);
    }
    if (isNaN(v)) {
        f.val(0);
    }
    $(field).trigger('change');
}

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
}

function addTourToSignedup(button) {
    let cardItem = $(button).closest('.card-item');
    // Получаем data-id
    let id = cardItem.data('id');
    let title = cardItem.find(".user-name").text();
    cardItem.find(".message-button").addClass("message-button-signedUp").text("Вы записаны").attr("onclick", "removeTourFromSignedup('" + id + "')");

    $("#signedupTours").append(`
            <div class="card text-dark bg-light mb-3 signedupTour" data-id="${id}">
                    <div class="card-header">
                        <div class="d-flex flex-row justify-content-between">
                            <h3>${title}</h3>
                            <button type="button" onclick="removeTourFromSignedup('${id}')" class="btn btn-sm btn-danger" style="height: 40px !important; width: 40px !important;"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-md-row flex-column justify-content-around">
                            <div class="d-flex flex-column">
                                <h4>Количество детей (до 18 лет)</h4>
                                <div class="input-group mb-3">
                                    <button type="button" onclick="dec('#childrenInTour-${id}')" class="btn btn-outline-secondary input-group-text"><i class="fa fa-minus"></i></button>
                                    <input type="text" pattern="\\d*" inputmode="numeric" class="peopleAmount digitsOnly form-control border border-1 border-secondary text-center validate digitsOnly" placeholder="1" id="childrenInTour-${id}">
                                    <button type="button" onclick="inc('#childrenInTour-${id}')" class="btn btn-outline-secondary input-group-text"><i class="fa fa-plus"></i></button>

                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <h4>Количество взрослых</h4>
                                <div class="input-group mb-3">
                                    <button type="button" onclick="dec('#adultsInTour-${id}')" class="btn btn-outline-secondary input-group-text"><i class="fa fa-minus"></i></button>
                                    <input type="text" pattern="\\d*" inputmode="numeric" class="peopleAmount digitsOnly form-control border border-1 border-secondary text-center validate digitsOnly" placeholder="1" id="adultsInTour-${id}">
                                    <button type="button" onclick="inc('#adultsInTour-${id}')" class="btn btn-outline-secondary input-group-text"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        `);
    $(".peopleAmount").on("change", function () {
        if (parseInt($(this).val()) > 300) {
            $(this).val(300);
        } else if (parseInt($(this).val()) < 0) {
            $(this).val(0);
        }
    });
    $(".digitsOnly").keypress(function (e) {
        let txt = String.fromCharCode(e.which);
        if (!txt.match(/[0-9]/)) {
            return false;
        }
    });
    $('input.validate').on("change", function () {
        if ($(this).val() !== "") {
            $(this).removeClass("border border-danger border-2");
        }
    });
}

function removeTourFromSignedup(id) {
    $(".signedupTour[data-id='" + id + "']").remove();
    $(".card-item[data-id='" + id + "']").find(".message-button").removeClass("message-button-signedUp").text("Записаться").attr("onclick", "addTourToSignedup(this)");
}


$(".peopleAmount").on("change", function () {
    if (parseInt($(this).val()) > 300) {
        $(this).val(300);
    } else if (parseInt($(this).val()) < 0) {
        $(this).val(0);
    }
});
$(".digitsOnly").keypress(function (e) {
    let txt = String.fromCharCode(e.which);
    if (!txt.match(/[0-9]/)) {
        return false;
    }
});
// TODO
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
});
$('input.validate').on("change", function () {
    if ($(this).val() !== "") {
        $(this).removeClass("border border-danger border-2");
    }
});


$("form").on("submit", function (e) {
    e.preventDefault();
    let validated = true;

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

    if (validated) {
        let name = $("#name").val();
        let surname = $("#surname").val();
        let email = $("#email").val();
        let phone = $("#phone").val();
        let childrenAmount = parseInt($("#childrenAmount").val());
        let parentsAmount = parseInt($("#parentsAmount").val());
        let adultsAmount = parseInt($("#adultsAmount").val());
        let specials = [];
        $(".specials").each(function () {
            if ($(this).prop("checked")) {
                specials.push($(this).attr("id"));
            }
        });
        let signedupTours = [];
        $(".signedupTour").each(function () {
            let id = $(this).data("id");
            signedupTours.push({
                "id": id,
                "adults": parseInt($("#adultsInTour-" + id).val()),
                "children": parseInt($("#childrenInTour-" + id).val())
            });
        });

        let comment = $("#comment").val();
        let agreementWithTerms = $("#agreementWithTerms").prop("checked");
        let agreementWithPersonalDataPolicy = $("#agreementWithPersonalDataPolicy").prop("checked");
        let agreementWithOtherConditions = $("#agreementWithOtherConditions").prop("checked");

        $.post("/app/ajax/FormHandler.php", {
            formName: 'addAnswer', formId: formId, answers: {
                name: name,
                surname: surname,
                email: email,
                phone: phone,
                childrenAmount: childrenAmount,
                parentsAmount: parentsAmount,
                adultsAmount: adultsAmount,
                specials: specials,
                signedupTours: signedupTours,
                comment: comment,
                consents: {agreementWithTerms: agreementWithTerms,
                    agreementWithPersonalDataPolicy: agreementWithPersonalDataPolicy,
                    agreementWithOtherConditions: agreementWithOtherConditions},

            }
        }, function (response) {
            if(JSON.parse(response).status === 'success'){
                Swal.fire({
                    title: "Отлично!",
                    text: "Ваша заявка успешно принята. Ожидайте подтверждение на почту.",
                    icon: "success"
                });
                $.post("/app/ajax/FormHandler.php", {formName: 'sendApproval', email: $("#email").val(), phone: $("#phone").val(), name: $("#name").val(), surname: $("#surname").val(), applicationId: JSON.parse(response).applicationId}, function(response){
                    authCodeHash = JSON.parse(response).h;
                    $("#authSentInfo").removeClass("d-none");
                });


                setTimeout(function() {
                    window.location.href = window.location.origin + '/';
                }, 3000);
            }
        });



    } else {
        alert("Заполните выделенные поля");
        $("html, body").animate({scrollTop: $("body")}, 800);
    }

});

function transliterate(text) {
    text = text.toLowerCase();
    text = text
        .replace(/[^a-zа-щыэ-яё0-9\s-]/g, '') // Удаляем все, кроме букв, цифр и пробелов
        .trim() // Убираем пробелы в начале и конце
        .replace(/\s+/g, '-'); // Заменяем пробелы на дефисы
    const russianToEnglish = {
        "а": "a",
        "б": "b",
        "в": "v",
        "г": "g",
        "д": "d",
        "е": "e",
        "ё": "yo",
        "ж": "zh",
        "з": "z",
        "и": "i",
        "й": "y",
        "к": "k",
        "л": "l",
        "м": "m",
        "н": "n",
        "о": "o",
        "п": "p",
        "р": "r",
        "с": "s",
        "т": "t",
        "у": "u",
        "ф": "f",
        "х": "kh",
        "ц": "ts",
        "ч": "ch",
        "ш": "sh",
        "щ": "shch",
        "ъ": "",
        "ь": "",
        "ы": "y",
        "э": "e",
        "ю": "yu",
        "я": "ya"
    };
    return text.split('').map(function (char) {
        return russianToEnglish[char] || char; // Возвращаем соответствие или символ, если нет
    }).join('')
        .replace(/-+/g, '-');
}
