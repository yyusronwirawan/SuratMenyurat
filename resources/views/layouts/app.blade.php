<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard | Sistem Informasi Persuratan Akademik FT UMPO - SIPA</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/logo/logo-app.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">



    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/vendor/libs/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/js/config.js') }}"></script>
    <style>
        .btn-berita-dashboard {
            color: #001D5F !important;
            background-color: rgba(255, 255, 255, 0.7)
        }

        .btn-berita-dashboard:hover {
            opacity: 1;
        }

        .desktop {
            display: block;
        }

        .mobile {
            display: none;
        }

        @media only screen and (max-width: 767px) {
            .desktop {
                display: none;
            }

            .mobile {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('index') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('/img/logo/logo-app.png') }}" width="150" alt="Logo" />
                        </span>
                        {{-- <span class="app-brand-text menu-text fw-bold ms-2"
                            style="font-weight: bolder; font-size: 30px; letter-spacing: 3px;">SIPA</span> --}}
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                @if (auth()->user()->role_id == 1)
                    <ul class="menu-inner py-1">
                        <li class="menu-item {{ is_current_route('admin.sipa.home') }}">
                            <a href="{{ route('admin.sipa.home') }}" class="menu-link">
                                <i class="menu-icon bx bx-home-circle"></i>
                                <div data-i18n="Dashboards">{{ __('Dashboards') }}</div>
                            </a>
                        </li>

                        <li class="menu-item {{ is_current_route('pengajuanadmin.index') }}">
                            <a href="{{ route('pengajuanadmin.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-file"></i>
                                <div data-i18n="pengajuan-surat">{{ __('Applications') }}</div>
                            </a>
                        </li>

                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">{{ __('Master Data') }}</span>
                        </li>
                        <li class="menu-item {{ is_current_route('department.index') }}">
                            <a href="{{ route('department.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-building"></i>
                                <div data-i18n="Department">{{ __('Department') }}</div>
                            </a>
                        </li>
                        <li class="menu-item {{ is_current_route('program-studi.index') }}">
                            <a href="{{ route('program-studi.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-book-alt"></i>
                                <div data-i18n="program-studi">{{ __('Study Program') }}</div>
                            </a>
                        </li>
                        <li class="menu-item {{ is_current_route('tipe-borang.index') }}">
                            <a href="{{ route('tipe-borang.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-list-ul"></i>
                                <div data-i18n="tipe-borang">{{ __('Form Category') }}</div>
                            </a>
                        </li>
                        <li class="menu-item {{ is_current_route('jenis-borang.index') }}">
                            <a href="{{ route('jenis-borang.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-list-check"></i>
                                <div data-i18n="jenis-borang">{{ __('Form Type') }}</div>
                            </a>
                        </li>
                        <li class="menu-item {{ is_current_route('berita-dashboard.index') }}">
                            <a href="{{ route('berita-dashboard.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-news"></i>
                                <div data-i18n="file/berita-dashboard">{{ __('Dashboard News') }}</div>
                            </a>
                        </li>
                        <li class="menu-item {{ is_current_route('menu-lain.index') }}">
                            <a href="{{ route('menu-lain.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-menu"></i>
                                <div data-i18n="file/menu-lain">{{ __('Set Menu') }}</div>
                            </a>
                        </li>

                        <!-- Misc -->
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">{{ __('Administrator') }}</span>
                        </li>
                        <li class="menu-item {{ is_current_route('masteruser.index') }}">
                            <a href="{{ route('masteruser.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-user"></i>
                                <div data-i18n="Support">{{ __('Master User') }}</div>
                            </a>
                        </li>
                        <li class="menu-item {{ is_current_route('pengaturan-akun.index') }}">
                            <a href="{{ route('pengaturan-akun.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-lock"></i>
                                <div data-i18n="Support">{{ __('Account Setting') }}</div>
                            </a>
                        </li>
                        @if (auth()->user()->id == 'administrator')
                            <li class="menu-item {{ is_current_route('backup.index') }}">
                                <a href="{{ route('backup.index') }}" class="menu-link">
                                    <i class="menu-icon bx bx-box"></i>
                                    <div data-i18n="Support">{{ __('Backup') }}</div>
                                </a>
                            </li>
                        @endif
                        <!--
                        <li class="menu-item">
                            <a href="#" target="_blank" class="menu-link">
                                <i class="menu-icon bx bx-lock"></i>
                                <div data-i18n="Support">Setujui Password</div>
                            </a>
                        </li>
                    -->
                    </ul>
                @else
                    <ul class="menu-inner py-1">
                        <li class="menu-item {{ is_current_route('user.sipa.home') }}">
                            <a href="{{ route('user.sipa.home') }}" class="menu-link">
                                <i class="menu-icon bx bx-home-circle"></i>
                                <div data-i18n="Dashboards">{{ __('Dashboards') }}</div>
                            </a>
                        </li>
                        <li class="menu-item {{ is_current_route('pengajuan.index') }}">
                            <a href="{{ route('pengajuan.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-file"></i>
                                <div data-i18n="pengajuan">{{ __('Applications') }}</div>
                            </a>
                        </li>

                        <li class="menu-item {{ is_current_route('pengajuan.riwayat') }}">
                            <a href="{{ route('pengajuan.riwayat') }}" class="menu-link">
                                <i class="menu-icon bx bx-history"></i>
                                <div data-i18n="riwayat">{{ __('Application History') }}</div>
                            </a>
                        </li>
                        @php
                            $otherMenus = App\Models\OtherMenu::where('status', 'Active')->orderBy('sort_order')->get();
                        @endphp
                        @if (count($otherMenus) > 0)
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon bx bx-info-circle"></i>
                                    <div data-i18n="Misc">{{ __('Other Menu') }}</div>
                                </a>
                                <ul class="menu-sub">
                                    @foreach ($otherMenus as $menu)
                                        <li class="menu-item">
                                            <a href="{{ $menu->route }}" target="_blank" class="menu-link">
                                                <div>{{ $menu->menu_name }}</div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif


                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">{{ __('Download Form') }}</span>
                        </li>
                        <li class="menu-item {{ is_current_route('templateSurat', 'skripsi') }}">
                            <a href="{{ route('templateSurat', 'skripsi') }}" class="menu-link">
                                <i class="menu-icon bx bx-book-content"></i>
                                <div data-i18n="skripsi">{{ __('Thesis and Promotion Registration') }}</div>
                            </a>
                        </li>
                        <li class="menu-item {{ is_current_route('templateSurat', 'akademik') }}">
                            <a href="{{ route('templateSurat', 'akademik') }}" class="menu-link">
                                <i class="menu-icon bx bx-book-open"></i>
                                <div data-i18n="templateSurat">{{ __('Academics') }}</div>
                            </a>
                        </li>
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">{{ __('Account Setting') }}</span>
                        </li>
                        <li class="menu-item {{ is_current_route('pengaturan-akun.index') }}">
                            <a href="{{ route('pengaturan-akun.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-user"></i>
                                <div data-i18n="Support">{{ __('Account/Profile') }}</div>
                            </a>
                        </li>
                    </ul>
                @endif

            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i style="font-style: normal; font-weight: bold;" class="desktop">Sistem Informasi
                                    Persuratan
                                    Akademik</i>
                                <i style="font-style: normal; font-weight: bold; font-size:12px " class="mobile">
                                    <img src="{{ asset('/img/logo/logo-app.png') }}" width="60"
                                        alt="Logo" />

                                </i>
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li>
                                @include('partials/language_switcher')
                            </li>
                            <li>
                                <div
                                    style="border-right:2px dashed rgb(191, 194, 199); margin-left:10px; margin-right:10px">
                                    &nbsp;
                                </div>
                            </li>

                            <li class="nav-item lh-1 me-3 desktop">
                                <a class="github-button" href="https://teknik.umpo.ac.id">FT UMPO - Innovative, Smart, and
                                    Competitive</a>
                            </li>

                            <li class="nav-item lh-1 me-3 mobile">
                                <a class="github-button" href="https://teknik.umpo.ac.id">FT UMPO</a>
                            </li>
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ auth()->user()->imgUrl() }}" alt
                                            class="w-px-40 h-px-40 rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ auth()->user()->imgUrl() }}" alt
                                                            class="w-px-40 h-px-40 rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-medium d-block">{{ Auth::user()->first_name }}</span>
                                                    <small
                                                        class="text-muted">{{ Auth::user()->getRole()->name }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pengaturan-akun.index') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">{{ __('My Profile') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('change-password') }}">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-cog me-2"></i>
                                                <span
                                                    class="flex-grow-1 align-middle ms-1">{{ __('Change Password') }}</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">{{ __('Log Out') }}</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>

                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->

                @yield('content')

                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script> Sistem Informasi Persuratan Akademik - FT UMPO
                        </div>
                        <div class="d-none d-lg-inline-block">
                            <a href="https://themeselection.com" target="_blank"
                                class="footer-link">ThemeSelection</a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('/vendor/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/vendor/libs/toastr/toastr.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('/js/main.js') }}"></script>

    <!-- Page JS -->
    <script>
        function showNotif(status, message) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr[status](message);
        };

        @if (session('success'))
            $(document).ready(showNotif('success', '{{ session('success') }}'));
        @endif
        @if (session('error'))
            $(document).ready(showNotif('error', '{{ session('error') }}'));
        @endif


        $(function() {
            $('#datatable').DataTable({
                "order": [],
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                // "sDom": '<"clear">lfrtip',
                "oLanguage": {
                    "sEmptyTable": "{{ __('No data available in table') }}",
                    "sProcessing": "{{ __('Processing') }}...",
                    "sLengthMenu": "{{ __('Show _MENU_ entries') }}",
                    "sZeroRecords": "{{ __('No matching records found') }}",
                    "sInfo": "{{ __('Showing _START_ to _END_ of _TOTAL_ entries') }}",
                    "sInfoEmpty": "{{ __('Showing 0 to 0 of 0 entries') }}",
                    "sInfoFiltered": "{{ __('(filtered from _MAX_ total entries)') }}",
                    "sInfoPostFix": "",
                    "sSearch": "{{ __('Search') }}:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "<i class='tf-icon bx bx-chevrons-left'></i>",
                        "sPrevious": "<i class='tf-icon bx bx-chevron-left'></i>",
                        "sNext": "<i class='tf-icon bx bx-chevron-right'></i>",
                        "sLast": "<i class='tf-icon bx bx-chevrons-right'></i>"
                    }
                },
                // dom: '<"small"lfrtip>',
            });
            // $('.pagination').addClass('pagination-sm');
        });

        $('.swalSuccesInActive').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                title: ' Nonaktifkan Data!',
                text: "Apakah anda yakin ingin menonaktifkan data ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Nonaktifkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
    @yield('js')

</body>

</html>
