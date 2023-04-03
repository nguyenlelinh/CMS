var global = {};
var bangDuLieu = {};
var timeoutController;
var unixTime = new Date().getTime();
(function ($) {
    "use strict";
    global.url = window.location.href;
    global.bodauTiengViet = function (str) {
        str = str.toLowerCase()
            .replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a")
            .replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e")
            .replace(/ì|í|ị|ỉ|ĩ/g, "i")
            .replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o")
            .replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u")
            .replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y")
            .replace(/đ/g, "d")
            .replace(/\s/g, '-')
            // .replace(/\.|\/|\||\:|\%|\\|\(|\)|\]|\[|!|\?|\'|\"|\{|\}|,|–|®|™|\@|\#|\$|\^|\&|\*|\<|\>|\+|\=|\~|\_|\`/g, '')
            .replace(/[^a-z0-9]+/g,'-')//Chưa test
            .replace(/\--+/g, '-');
        str = '@' + str + '@';
        str = str.replace(/\@\-|\-\@|\@/gi, '');
        return str;
    }
    global.guiDuLieu = function (data, link = global.url) {
        $('button').prop('disabled', true);
        return new Promise((resolve, reject) =>
            $.ajax({
                url: link,
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (data, textStatus, jqXHR) {
                    resolve(data);
                    $('button').prop('disabled', false);
                    if (data.mess) global.thongBao(data);
                },
                error: function (jqXHR, textStatus, errorThrown) { console.log(errorThrown) }
            }));
    }
    global.gui = function (data, link = global.url) {
        $('button').prop('disabled', true);
        return new Promise((resolve, reject) =>
            $.post(link, data, (dt, textStatus, xhr) => {
                resolve(dt);
                $('button').prop('disabled', false);
                if (dt.mess) global.thongBao(dt);
            }));
    }
    global.thongBao = function (data) {
        clearTimeout(timeoutController);
        $(".thongBao").hide();
        $(".thongBao").html('').fadeIn();
        if (data.status) data.title = "";
        else data.title = "Lỗi";
        $("#thongBao").tmpl(data).appendTo(".thongBao");
        if (data.status) $(".thongBao .alert").removeClass('alert-danger');
        else $(".thongBao .alert").addClass('alert-danger');
        if (typeof data.url !== 'undefined') {
            switch (data.url) {
                case 'back':
                    setTimeout(function () {
                        window.history.back();
                    }, 1000);
                    break;
                case 'reload':
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                    break;
                case 'close':
                    setTimeout(function () {
                        close();
                        window.close();
                    }, 1000);
                    break;
                case 'redraw':
                    bangDuLieu.clear().draw();
                    break;
                default:
                    setTimeout(function () {
                        window.location.href = data.url;
                    }, 1000);
                    break;
            }
        }
        timeoutController = setTimeout(() => {
            $(".thongBao").fadeOut()
        }, 5000);
    }
    global.xoa = async function (link) {
        if(confirm('Bạn muốn xoá bản ghi này có phải không?')){
            let returnData = await global.gui({_token:$("input[name=_token]").val()}, link);
            if(returnData.status)
                bangDuLieu.clear().draw();
        }
    }
    global.huy = async function (link) {
        if(confirm('Bạn có muốn xoá vĩnh viễn bản ghi này hay không?')){
            let returnData = await global.gui({_token:$("input[name=_token]").val()}, link);
            if(returnData.status)
                bangDuLieu.clear().draw();
        }
    }
    global.khoiPhuc = async function (link) {
        if(confirm('Bạn muốn khôi phục bản ghi này có phải không?')){
            let returnData = await global.gui({_token:$("input[name=_token]").val()}, link);
            if(returnData.status)
                bangDuLieu.clear().draw();
        }
    }
    global.kiemTraTrung = function(array) {
        return (new Set(array)).size !== array.length;
    }
    global.select2KhoiTao = function(select){
        select.map((i,e)=>{
            $(e).select2({
                theme: 'bootstrap4',
                width: $(e).data('width') ? $(e).data('width') : $(e).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(e).data('placeholder'),
                allowClear: Boolean($(e).data('allow-clear')),
                closeOnSelect: !$(e).attr('multiple'),
                tags: Boolean($(e).data('tags')),
            });
        })
    }
    global.summernoteKhoiTao = function(textarea) {
        textarea.map((i,e)=>{
            $(e).summernote({
                placeholder: $(e).data('placeholder')?$(e).data('placeholder'):'Nhập nội dung....',
                tabsize: 2,
                height: 200,
                minHeight: 100,
                focus: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    table: [
                        ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                        ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                    ],
                    air: [
                        ['color', ['color']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['para', ['ul', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture']]
                    ]
                },
                codemirror: {
                    theme: 'monokai'
                },
                callbacks: {
                    onImageUpload: function(files) {
                        files.map((k)=>{
                            sendFile(files[k],this);
                        })
                        //sendFile(files,this);
                    },
                    onPaste: function (e) {
                        let bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text/html');
                        if(bufferText=="") bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text');
                        e.preventDefault();
                        let div = $('<div />');
                        div.append(bufferText);
                        setTimeout(function () {
                            document.execCommand('insertHtml', false, div.html());
                        }, 10);
                    },
                }
            });
        })
        
    }
})(jQuery);

function getImageInSummernote(imgs, imgList) {
    $('.summernote').each(function(index, el) {
        let nd = $(el).val();
        let matches = nd.match(/<img\s(?:.+?)>/g);
        if(matches){
            let data = matches.map(elem=>{
                let img = $.parseHTML(elem);
                const pattern = /\/upload\/summernote/;
                const pattern2 = /\/upload\/[a-z]+\//;
                if(pattern.test($(img).attr('src')))
                    imgs.push($(img).attr('src'));
                else if(pattern2.test($(img).attr('src'))){
                    let src = $(img).attr('src');
                    //imgList.push(src.split("/").pop());
                    imgList.push(src.slice(1));
                }
            });
        }
    });
    return {imgs: imgs, imgList: imgList};
}
function sendFile(file, elem, uploadAPI="/cms/ajax/summernoteUpload"){
    let data = new FormData();
    data.append("file", file);
    data.append("time", unixTime);
    $.ajax({
      data: data,
      type: "POST",
      url: uploadAPI,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data) {
        if(data.status){
          let img = document.createElement('IMG');
          img.src = data.mess;
          $(elem).summernote('insertNode', img);
        }else{
          global.thongBao(data)
        }
      }
    });
}