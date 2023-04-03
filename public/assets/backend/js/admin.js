(function ($) {
    $('.js-btnSubmit').click(async function (e) {
        e.preventDefault();
        let formData = new FormData($('#formQuanTri')[0]);
        let returnData = await global.guiDuLieu(formData);
        console.log(returnData)
    });
    // $('.quyen-han').hide();
    // $('.quyen-han th.ten-quyen').click(async function(e){
    //     let returnData = await global.gui({},'/quantri/ajax/getAdminRole');
    //     if(returnData && returnData==1){
    //         $(`.quyen-han tr td:nth-child(${this.dataset.id}) input[type="checkbox"]`).each(function(i,e){
    //             $(e).prop('checked', !e.checked);
    //         })
    //     }
    // })
    // $('.quyen-han tr td:nth-child(1)').click(async function(e){
    //     let returnData = await global.gui({},'/quantri/ajax/getAdminRole');
    //     if(returnData && returnData==1){
    //         $(this).closest('tr').find(`input[type="checkbox"]`).each(function(i,e){
    //             $(e).prop('checked', !e.checked);
    //         })
    //     }
    // })
    // $('select[name="maChucDanh"]').change(async function(e){
    //     let id = this.value;
    //     let returnData = await global.gui({id: id},'/quantri/ajax/layThongTinChucDanh');
    //     $(`.quyen-han input[type="checkbox"]`).prop('checked',false);
    //     if(returnData){
    //         let quyen = returnData.quyenHan;
    //         for(let maChucNang in quyen){
    //             quyen[maChucNang].forEach(e=>$(`.quyen-han input#ck-${maChucNang}-${e}`).prop('checked',true));
    //         }
    //     }
    // })
    // $('.js-changeInfo').click(async function (e) {
    //     e.preventDefault();
    //     let returnData = await global.gui($('#formDoiThongTin').serialize());
    //     // console.log(returnData)
    // });
    // $('.js-DoiMatKhau').click(async function (e) {
    //     e.preventDefault();
    //     let returnData = await global.gui($('#formDoiMatKhau').serialize());
    //     // console.log(returnData)
    // });
})(jQuery);