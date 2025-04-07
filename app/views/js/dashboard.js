$(document).ready(function() {
    function TestimonialToMain(id, toMain){
        $.post("/app/ajax/DashboardHandler.php", {formName: 'setTestimonialToMain', id: id, toMain: toMain}, function(response){
            return response;
        });
    }

    $.post("/app/ajax/DashboardHandler.php", {formName: 'getTestimonials'}, function(response){
        let data = JSON.parse(response).data;
        $.each(data, function(index,t){
            index = t.id;
            $("#testimonialsGallery").append(`
                <div class="image-block">
                    <input type="checkbox" id="select-${index}" class="image-checkbox" ${t.toMain===1?"checked":""}>
                    <label for="select-${index}" class="star-checkbox"></label>
                    <img src="/public/images/testimonials/${t.fileName}" alt="Image" class="image" id="testimonialImage-${index}">
                </div>
            `);
            $("#testimonialImage-"+index).on("click", function (){
                let id = index;
                let checked = $('#select-'+index).prop("checked");
                $('#select-'+index).prop("checked", !checked);
                TestimonialToMain(id, !checked);
            });
        });
    });



    $('#uploadTestimonial').on('submit', function(e) {
        e.preventDefault(); // Отменяем стандартное поведение формы

        let inputFiles = document.getElementById('uploadTestimonialFiles');
        let formData = new FormData();

        // Добавляем файлы в FormData
        for (let i = 0; i < inputFiles.files.length; i++) {
            formData.append('images[]', inputFiles.files[i]);
        }
        formData.append('formName', 'uploadTestimonials'); // Добавляем поле formName
        let images = formData.getAll('images[]');
        console.log('Данные images[]: ', images);

// Если хотите вывести каждый файл по отдельности
        images.forEach(function(file, index) {
            console.log('Файл ' + (index + 1) + ': ', file.name); // Вывод имени файла
        });
        $.ajax({
            url: '/app/ajax/DashboardHandler.php', // Укажите URL, куда отправляется запрос
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Обработка успешного ответа
                location.reload();
            },
            error: function(xhr, status, error) {
                // Обработка ошибки
                console.error('Ошибка при загрузке:', error);
                alert('Ошибка при загрузке файлов.');
            }
        });
    });
});