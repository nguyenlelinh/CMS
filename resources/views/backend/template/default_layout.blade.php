<?php $ver = 0; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    @stack('meta')
    <title>CMS quản lý hiện vật</title>
    <link rel="icon" type="image/x-icon" href="{{ asset(BACKEND_IMAGE.'favicon.png?ver='.$ver) }}" />
    @stack('css')
    <link rel="stylesheet" href="{{ asset(PLUGIN_ASSETS_FOLDER.'fontawesome/all.min.css?ver='.$ver) }}">
    <link rel="stylesheet" href="{{ asset(BACKEND_CSS.'theme.css?ver='.$ver) }}"/>
    <link rel="stylesheet" href="{{ asset(BACKEND_CSS.'custom.css?ver='.$ver) }}"/>
    @stack('pageCss')
</head>
<body class="nav-fixed">
    @include(TPL_VIEW_FOLDER.'_topbar')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include(TPL_VIEW_FOLDER.'_sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                @include(TPL_VIEW_FOLDER.'_header')
                @yield('content')
            </main>
            @include(TPL_VIEW_FOLDER.'_footer')
        </div>
    </div>
    @yield('jsTemplate')
    <div class="thongBao"></div>
    <script id="thongBao" type='text/x-jquery-tmpl'>
        <div class="alert alert-success alert-icon" role="alert">
            <button class="btn btn-lg btn-close" type="button" data-dismiss="alert" aria-label="Close"><i class="far fa-bell"></i></button>
            <div class="alert-icon-content">
                <h6 class="alert-heading">${title}</h6>
                <span class="thongBaoText">@{{html mess}}</span>
            </div>
        </div>
    </script>
    <script>
        const csrf_token = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset(PLUGIN_ASSETS_FOLDER.'jquery/jquery-3.5.1.min.js?ver='.$ver) }}"></script>
    <script src="{{ asset(PLUGIN_ASSETS_FOLDER.'bootstrap/bootstrap.bundle.min.js?ver='.$ver) }}"></script>
    <script src="{{ asset(PLUGIN_ASSETS_FOLDER.'feathericons/feather.min.js?ver='.$ver) }}"></script>
    <script src="{{ asset(PLUGIN_ASSETS_FOLDER.'jquery-templates/jquery.templates.min.js?ver='.$ver) }}"></script>
    <script src="{{asset(GLOBAL_JS.'build_in_function.js?ver='.$ver)}}"></script>
    @stack('js')
    <script src="{{asset(BACKEND_JS.'scripts.js?ver='.$ver)}}"></script>
    @stack('pageJs')
</body>
</html>