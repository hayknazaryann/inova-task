$(document).ready(function () {

})
    .on('click', '#new-note', function () {
        $('textarea#note').val('')
    })
    .on('click', '#import', function () {
        document.getElementById('import-file').click();

    })
    .on('click', '#send', function (e) {
        e.preventDefault();
        const form = $('#applications-form'),
            url = form.attr('action');

        $.ajax({
            url: url,
            method: 'post',
            data: form.serializeWithFiles(),
            contentType: false,
            processData: false,
            dataType: 'json',
        }).done(function (response) {
            if (response.success === true) {
                $('textarea#text').val('');
                $('.application-items').prepend(response.application);
            }
        }).fail(function (error) {
            let response = JSON.parse(error.responseText);
            if (error.status === 422) {
                form.find('input[type="text"],textarea').removeClass('is-invalid').each(function (index, input) {
                    $(input).removeClass('is-invalid');
                    var inputName = $(input).attr('name');
                    if (inputName in response.errors) {
                        $(input).addClass('is-invalid');
                    }
                });
            }

            if (error.status === 400) {
                responseMessage('error', response.message);
            }
        })
    })
    .on('click', '.view-application', function (e) {
        e.preventDefault();
        const elm = $(this),
            url = elm.attr('href');
        $.ajax({
            url: url,
            method: 'get',
            contentType: false,
            processData: false,
            dataType: 'json',
        }).done(function (response) {
            if (response.success === true) {
                $('textarea#note').val(response.text);
            }
        }).fail(function (error) {

        })
    })
