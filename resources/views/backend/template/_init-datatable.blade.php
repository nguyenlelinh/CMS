<script>
(function ($) {
    if($("#datatable").length>0){
        bangDuLieu = $("#datatable").DataTable({
            paging: true,
            info: true,
            bFilter: true,
            autoWidth: !1,
            responsive: !0,
            processing: true,
            serverSide: true,
            ajax: {
                url: window.location.href,
                type: "POST",
                data: function (data) {
                    @stack('customField')
                    data._token = $("input[name=_token]").val();
                }
            },
            dom: "<'row'<'col-sm-12 col-md-6 mt-3'l><'col-sm-12 col-md-6 mt-3'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
            autoFill: false,
            order: [[ 0, "DESC" ]],
            columns: config.columns,
            language: {
                'decimal' : '',
                'emptyTable' : 'Không có dữ liệu.',
                'info' : `Đang hiển thị từ ${config.target_text} thứ _START_ đến _END_ trong _TOTAL_ ${config.target_text}`,
                'infoEmpty' : `Hiển thị 0 đến 0 của 0 ${config.target_text}`,
                'infoFiltered' : `(Lọc từ tổng số _MAX_ ${config.target_text})`,
                'infoPostFix' : '',
                'thousands' : ',',
                'lengthMenu' : `Hiển thị _MENU_ ${config.target_text}`,
                'loadingRecords' : 'Đang tải dữ liệu ...',
                'processing' : 'Đang xử lý dữ liệu...',
                'search' : 'Tìm kiếm:',
                'searchPlaceholder' : 'Enter để tìm ...',
                'zeroRecords' : `Không tìm thấy ${config.target_text} phù hợp.`,
                'paginate' : {
                    'first' : 'Đầu tiên',
                    'last' : 'Cuối cùng',
                    'next' : 'Tiếp',
                    'previous' : 'Trở lại'
                },
                'aria' : {
                    'sortAscending' : ' : Sắp xếp cột tăng dần',
                    'sortDescending' : ' : Sắp xếp cột giảm dần'
                }
            }
        });
    }
    $('.btn-datatable-filter').click(function (e) { 
        e.preventDefault();
        bangDuLieu.draw();
    });
    $('#datatableFilter').change(function (e) { 
        e.preventDefault();
        bangDuLieu.draw();
    });
})(jQuery);
</script>

