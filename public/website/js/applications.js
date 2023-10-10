$(document).ready(function () {
    loadItems();
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
                loadItems(true)
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
    .on('click', '.edit-item', function (e) {
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
                $('textarea#text').val(response.data.text);
                $('input#id').val(response.data.id);
            }
        }).fail(function (error) {

        })
    })
    .on('keyup', '.application-search input#keyword', function () {
        loadItems(true);
    })
    .on('change', '.application-search select#status', function () {
        loadItems(true);
    })

function loadItems(newItem = false) {
    $.ajax({
        url: $('.application-items').data('url'),
        method: 'post',
        data: {
            keyword: $('input#keyword').val(),
            status: $('select#status').val()
        },
        dataType: 'json',
    }).done(function (response) {
        if (response.success === true) {
            if (newItem) {
                $('.application-items').html(response.view);
                $('textarea#text').val('');
            } else  {
                $('.application-items').append(response.view);
            }

        }
    })
}
