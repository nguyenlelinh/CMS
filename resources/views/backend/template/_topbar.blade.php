<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <a class="navbar-brand" href="/cms">Quản trị hiện vật</a>
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i data-feather="menu"></i></button>
    <form class="form-inline mr-auto d-none d-md-block mr-3">
        <div class="input-group input-group-joined input-group-solid">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
            <div class="input-group-append">
                <div class="input-group-text"><i data-feather="search"></i></div>
            </div>
        </div>
    </form>
    <ul class="navbar-nav align-items-center ml-auto">
        <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="/assets/backend/imgs/illustrations/profiles/profile-5.png" /></a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="/assets/backend/imgs/illustrations/profiles/profile-5.png" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name"><?= $_SESSION['quantri']['taiKhoan']??null ?></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/quan-ly/thong-tin-ca-nhan">
                    <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                    Tài Khoản
                </a>
                <a class="dropdown-item" href="/quan-ly/doi-mat-khau">
                    <div class="dropdown-item-icon"><i data-feather="lock"></i></div>
                    Đổi mật khẩu
                </a>
                <a class="dropdown-item js-Logout" href="javascript:;">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Đăng Xuất
                </a>
            </div>
        </li>
    </ul>
</nav>