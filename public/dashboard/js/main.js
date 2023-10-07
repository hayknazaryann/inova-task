(function () {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        if (all) {
            select(el, all).forEach(e => e.addEventListener(type, listener))
        } else {
            select(el, all).addEventListener(type, listener)
        }
    }

    /**
     * Sidebar toggle
     */
    if (select('.toggle-sidebar-btn')) {
        on('click', '.toggle-sidebar-btn', function (e) {
            select('body').classList.toggle('toggle-sidebar')
        })
    }
})()

$(document)
    .ready(function() {
        $('.form-select').select2();
        $(".form-select-tags").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            promotion: false,
            plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            mobile: {
                plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons'
            },
            menu: {
                tc: {
                    title: 'Comments',
                    items: 'addcomment showcomments deleteallconversations'
                }
            },
            menubar: 'file edit view insert format tools table tc help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
            autosave_ask_before_unload: true,
            templates: [
                { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
            ],
            skin: 'oxide-dark',
            content_css: 'dark',
            height: 600,
        });
    })
    .on('click', '.delete', function (e) {
        e.preventDefault();
        let _this = $(this),
            type = $(_this).attr('data-type');

        Swal.fire({
            text: 'Are you sure you want to delete ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then(result => {
            if (result?.value) {
                _this.parent('form').submit();
            }
        })
    })
    .on('click', '.remove_image', function (e) {
        e.preventDefault();
        let _this = $(this),
            url = $(_this).attr('data-url');

        Swal.fire({
            text: 'Are you sure you want to delete ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then(result => {
            if (result?.value) {
                    $.ajax({
                        url:url,
                        method: 'POST',
                        cache : false,
                        contentType: false,
                        processData: false
                    }).done(response => {

                  $('.item_image_parent').remove();

                    }).fail(error => {

                    });

            }
        })
    })
    .on('change','.active-checkbox',function (e){
        e.preventDefault();
        let _this=$(this)


        $.ajax({
            url:_this.data('url'),
            method: 'POST',
            cache : false,
            data:{active:_this.val()}
        }).done(response => {
            if (_this.val()=='1'){
                _this.val(0)
            }else{
                _this.val(1)
            }
            Swal.fire({
                position: 'center',
                type: response.type,
                title: response.item+' has been changed',
                showConfirmButton: false,
                timer: 1500
            })
        }).fail(error => {

        });

    }).on('click','.item-orders',function (e){
    e.preventDefault();
        let _this = $(this);
    $.ajax({
        url:_this.data('url'),
        method: 'POST',
        cache : false,
    }).done(response => {
        $('#items-modal-content').html(response);
        $('#itemModal').modal('show');

    }).fail(error => {

    });
}).on('click','#modal-close-items',function (e){
    e.preventDefault;
    $('#itemModal').modal('hide');
}).on('keyup','#product-name',function (e){
    e.preventDefault;
    let category= $('#parentCategory').find('option:selected').val()
    let product=$(this).val()

    var url = $(this).data("url");
    var append = url.indexOf("?") == -1 ? "?" : "&";
    var finalURL = url + append + 'product_name='+ product+ '&'+'category='+category;
    window.history.pushState({}, null, finalURL.slice(0,-1));
    $.ajax({
        url: $(this).data('url'),
        method: 'GET',
        cache : false,
        data:{product_name:$(this).val(),category:category}
    }).done(response => {
        $("#data-list").html(response.view);
    }).fail(error => {

    });
}).on('change','#parentCategory',function (e){
    e.preventDefault;
    let category= $(this).find('option:selected').val()
    let product= $('#product-name').val()
    var url = $(this).data("url");
    var append = url.indexOf("?") == -1 ? "?" : "&";
    var finalURL = url + append + 'product_name='+ product +'&'+'category='+ category;
    window.history.pushState({}, null, finalURL.slice(0,-1));

    $.ajax({
        url: $(this).data('url'),
        method: 'GET',
        cache : false,
        data:{product_name:product,category:category}
    }).done(response => {
        $("#data-list").html(response.view);
    }).fail(error => {

    });
})
$(function() {
    $(document).on("click",".orders_pagination .pagination .page-item a",function(event){
        event.preventDefault();
        var url = $(this).attr("href");
        var append = url.indexOf("?") == -1 ? "?" : "&";
        var finalURL = url + append + 'range='+ $("#range").val();
        window.history.pushState({}, null, finalURL.slice(0,-1));
        $.get(finalURL, function(data) {
            $("#data-list").html(data.view);
            window.scrollTo(0,0);
        });
        return false;
    });

    $(document).on("click",".products_pagination .pagination .page-item a",function(event){
        event.preventDefault();
        let category= $('#parentCategory').find('option:selected').val()
        let product= $('#product-name').val()
        var url = $(this).attr("href");
        var append = url.indexOf("?") == -1 ? "?" : "&";
        var finalURL = url + append + 'product_name='+ product+'&'+'category='+ category;
        window.history.pushState({}, null, finalURL.slice(0,-1));
        $.get(finalURL, function(data) {
            $("#data-list").html(data.view);
            window.scrollTo(0,0);
        });
        return false;
    })

    $(document).on("click",".categories_pagination .pagination .page-item a",function(event){
        event.preventDefault();
        let category= $('#parentCategory').find('option:selected').val()
        let product= $('#product-name').val()
        var url = $(this).attr("href");
        var append = url.indexOf("?") == -1 ? "?" : "&";
        var finalURL = url + append + 'product_name='+ product+'&'+'category='+ category;
        window.history.pushState({}, null, finalURL.slice(0,-1));
        $.get(finalURL, function(data) {
            $("#data-list").html(data.view);
            window.scrollTo(0,0);
        });
        return false;
    })
});
$(function() {

    var start =moment().subtract(30, 'years');
    var end = moment();

    function cb(start, end) {
        $('#range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#range').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'All Time': [moment().subtract(30, 'years'), moment()],
        }
    },function(start, end, label) {
        let data={
            start:start.format('YYYY-MM-DD'),
            end: end.format('YYYY-MM-DD')
        }
        $.ajax({
            url: $('#range').data('url'),
            method: 'post',
            cache : false,
            data:data
        }).done(response => {
            $("#data-list").html(response.view);
        }).fail(error => {

        });
    });


});

