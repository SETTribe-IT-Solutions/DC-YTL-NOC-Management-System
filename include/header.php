<style>
    .header-container {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
        /* border-radius: 20px; */
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        padding: 11px 40px;
        width: 100%;
        max-width: 1200px;
        /* border: 3px solid #ff6b35; */
        position: relative;
        overflow: hidden;
    }

    .header-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        /* background: linear-gradient(90deg, #ff6b35, #f7931e, #138808, #ff6b35); */
        background: linear-gradient(90deg, #0f5132, #20c997);
        background-size: 400% 100%;
        animation: gradientShift 3s ease-in-out infinite;
    }

    @keyframes gradientShift {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    .logo-left,
    .logo-right {
        flex-shrink: 0;
    }

    .government-logo {
        width: 100px;
        height: 100px;
        object-fit: contain;
        /* filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2)); */
        animation: pulse 3s ease-in-out infinite;
        transition: transform 0.3s ease;
    }

    .government-logo:hover {
        transform: scale(1.05);
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.9;
        }
    }

    .text-section {
        text-align: center;
        flex: 1;
    }

    .main-title {
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        letter-spacing: 1px;
        background: linear-gradient(135deg, #2c3e50, #34495e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .sub-title {
        font-size: 20px;
        font-weight: 600;
        /* color: #e74c3c; */
        color: #198754;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        letter-spacing: 0.5px;
    }

    .decorative-line {
        width: 150px;
        height: 4px;
        /* background: linear-gradient(90deg, #ff6b35, #f7931e); */
        background: linear-gradient(45deg, #0f5132, #198754);
        margin: 5px auto;
        border-radius: 2px;
        box-shadow: 0 2px 4px rgba(255, 107, 53, 0.3);
    }



    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .background-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.03;
        background-image: repeating-linear-gradient(45deg,
                transparent,
                transparent 10px,
                #ff6b35 10px,
                #ff6b35 20px);
        pointer-events: none;
    }

    .header-container {
        max-width: 100%
    }

    .app-sidebar {
        top: 24% !important
    }

    .app-main>div {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
    }


    .app-default {
        background-color: rgba(16, 185, 129, 0.06);
    }

    .app-sidebar {
        background-color: unset !important;
    }

    .app-toolbar {
        border-top-right-radius: 12px;
        border-top-left-radius: 12px;
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }

        .logo-left,
        .logo-right {
            order: 0;
        }

        .text-section {
            order: 1;
        }

        .main-title {
            font-size: 22px;
        }

        .sub-title {
            font-size: 18px;
        }

        .government-logo {
            width: 80px;
            height: 80px;
        }
    }
</style>




<div id="kt_app_header" class="app-header d-flex flex-column flex-stack">

    <!--begin::Header main-->
    <div class="d-flex align-items-center flex-stack flex-grow-1">
        <!--begin::Navbar-->
        <div class="app-navbar flex-grow-1 justify-content-end" id="kt_app_header_navbar">
            <div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1 me-2 me-lg-0">


                <div class="header-container">



                    <div class="header-content">
                        <div class="logo-left">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Emblem_of_India.svg/512px-Emblem_of_India.svg.png"
                                alt="Emblem of India" class="government-logo">
                        </div>

                        <div class="text-section">
                            <div class="main-title">ना हरकत प्रमाणपत्र व्यवस्थापन प्रणाली</div>
                            <!-- <div class="decorative-line"></div> -->
                            <div class="sub-title">जिल्हाधिकारी कार्यालय, यवतमाळ</div>
                        </div>

                        <div class="logo-right">
                            <img src="https://dev.settribeitsolutions.com/Dev/DC_YTL_NOC_MS/assets/media/logos/Seal_of_Maharashtra.png"
                                alt="Seal of Maharashtra" class="government-logo">
                        </div>


                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
                <!--begin::Action-->

                <!--end::Action-->
                <!--begin::Header menu toggle-->
                <div class="app-navbar-item ms-3 ms-lg-4 ms-n2 me-3 d-flex d-lg-none">
                    <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
                        id="kt_app_aside_mobile_toggle">
                        <i class="ki-duotone ki-burger-menu-2 fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                    </div>

                </div>
            </div>


        </div>

        <!--end::Header menu toggle-->

    </div>
    <!--end::Header menu toggle-->
</div>
<!--end::Navbar-->
</div>

<!--begin::User menu-->
<div class="app-navbar-item ms-3 ms-lg-4 me-lg-2" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-30px symbol-lg-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <img src="assets/media/avatars/300-2.jpg" alt="user" />
    </div>
    <!--begin::User account menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
        data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px me-5">
                    <img alt="Logo" src="assets/media/avatars/300-2.jpg" />
                </div>
                <!--end::Avatar-->
                <!--begin::Username-->
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5">Jane Cooper
                    </div>
                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">jane@kt.com</a>
                </div>
                <!--end::Username-->
            </div>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="../dist/account/overview.html" class="menu-link px-5">My Profile</a>
        </div>
        <!--end::Menu item-->
    </div>
    <!--end::Menu-->
</div>
<!--end::Menu item-->
<!--begin::Menu item-->
<div class="menu-item px-5">
    <a href="logout.php" class="menu-link px-5">Sign
        Out</a>
</div>
<!--end::Menu item-->
<!--end::Header main-->
<!--begin::Separator-->
<!-- <div class="app-header-separator"></div> -->
<!--end::Separator-->
</div><!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if (document.documentElement) { if (document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if (localStorage.getItem("data-bs-theme") !== null) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>