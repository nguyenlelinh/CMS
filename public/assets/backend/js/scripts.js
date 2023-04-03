(function ($) {
    //! THEME SCRIPT */
    $('[data-toggle="tooltip"]').tooltip();

    // Enable Bootstrap popovers via data-attributes globally
    $('[data-toggle="popover"]').popover();

    $(".popover-dismiss").popover({
        trigger: "focus"
    });

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sidenav a.nav-link").each(function () {
        if (this.href === path) {
            $(this).addClass("active");
            $(this).closest('div.nav-item').find('a').trigger('click');
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("sidenav-toggled");
    });

    // Activate Feather icons
    feather.replace();

    // Activate Bootstrap scrollspy for the sticky nav component
    $("body").scrollspy({
        target: "#stickyNav",
        offset: 82
    });

    // Scrolls to an offset anchor when a sticky nav link is clicked

    // Click to collapse responsive sidebar
    $("#layoutSidenav_content").click(function () {
        const BOOTSTRAP_LG_WIDTH = 992;
        if (window.innerWidth >= 992) {
            return;
        }
        if ($("body").hasClass("sidenav-toggled")) {
            $("body").toggleClass("sidenav-toggled");
        }
    });

    // Init sidebar
    let activatedPath = window.location.pathname.match(/([\w-]+\.html)/, '$1');

    if (activatedPath) {
        activatedPath = activatedPath[0];
    } else {
        activatedPath = 'index.html';
    }

    let targetAnchor = $('[href="' + activatedPath + '"]');
    let collapseAncestors = targetAnchor.parents('.collapse');

    targetAnchor.addClass('active');

    collapseAncestors.each(function () {
        $(this).addClass('show');
        $('[data-target="#' + this.id + '"]').removeClass('collapsed');

    });
    //!END THEME SCRIPT */

    
    //!CUSTOM SCRIPT*/
    $(`#datatable thead input[type='checkbox']`).click(function (event) {
        $(`#datatable tbody input[type='checkbox']`).prop('checked', this.checked);
    });

    $(document.body).on('click', '#datatable tbody input[type="checkbox"]', function (event) {
        let checkboxs = $('#datatable tbody input[type="checkbox"]');
        let checkedItems = checkboxs.map(function (index, elem) {
            if (elem.checked) {
                return elem;
            }
        });
        if (checkedItems.length == checkboxs.length) {
            $(`#datatable thead input[type='checkbox']`).prop('checked', true);
        } else {
            $(`#datatable thead input[type='checkbox']`).prop('checked', false);
        }
    });
    if($('.select2').length > 0){
        global.select2KhoiTao($('.select2'));
    }
    if($('.summernote').length > 0){
        global.summernoteKhoiTao($('.summernote'));
    }
    $(document.body).on('click', '.js-collap', async function (e) {
        e.stopPropagation();
        $(this).find('.fa-angle-up,.fa-angle-down').toggleClass('fa-angle-up').toggleClass('fa-angle-down');
        let parent = $(this).data('parent');
        let target = $(this).data('target');
        let changeBtn = $(this).data('changeBtn');
        if (typeof parent !== 'undefined') $(this).closest(parent).find(target).toggle(300);
        else $(target).toggle(300);
        if (typeof changeBtn !== 'undefined') $(this).closest('.d-flex-row').find('.btn-del-block-data ,.btn-add-block-data').toggleClass("btn-lg btn-sm");
        
    });
    $('.form-group .input-group .input-group-prepend.js-collap-box').click(function(e){
        e.stopPropagation();
        let parent = $(this).closest('.form-group')[0];
        let collapBtn = parent.querySelector('.js-collap');
        if(collapBtn){
            $(collapBtn).find('.fa-angle-up,.fa-angle-down').toggleClass('fa-angle-up').toggleClass('fa-angle-down');
            let parent = $(collapBtn).data('parent');
            let target = $(collapBtn).data('target');
            if (typeof parent !== 'undefined') $(collapBtn).closest(parent).find(target).toggle(300);
            else $(target).toggle(300);
        }
    });
    $('.js-Logout').click(async function (event) {
        await global.gui({_token: csrf_token}, '/cms/quan-tri/logout.vsp');
        localStorage.removeItem('_login');
    });
    $(document.body).on('keyup', 'input.slug-base', function () {
        $('input.slug').val(global.bodauTiengViet($(this).val().trim()));
    });
    //!END CUSTOM SCRIPT */
})(jQuery);