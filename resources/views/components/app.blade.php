<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Azfa's Inventory Management System">
    <meta name="author" content="Muhammad Azfa Asykarulloh">
    <meta name="keywords" content="My Inventory">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>My Inventory</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('datatables/dataTables.bootstrap5.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- DataTables JS -->
    <script src="{{ asset('datatables/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap5.js') }}"></script>

    <!-- CKEditor -->
    <link rel="stylesheet" href="{{ asset('ckeditor/ckeditor5.css') }}">
    <script src="{{ asset('ckeditor/ckeditor5.umd.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('datatables/fixedColumns.dataTables.min.css') }}">
    <script src="{{ asset('datatables/dataTables.fixedColumns.min.js') }}"></script>

    <!-- Swal -->
    <link rel="stylesheet" href="{{ asset('swal/sweetalert2.min.css') }}">
    <script src="{{ asset('swal/sweetalert2.js') }}"></script>

    <!-- Dropzone -->
    <link rel="stylesheet" href="{{ asset('dropzone/dropzone.min.css') }}">
    <script src="{{ asset('dropzone/dropzone.min.js') }}"></script>
</head>

<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                    hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        4 New Messages
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="{{ asset('img/avatars/avatar-5.jpg') }}"
                                                    class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Vanessa Tucker</div>
                                                <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis
                                                    arcu tortor.</div>
                                                <div class="text-muted small mt-1">15m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="{{ asset('img/avatars/avatar-2.jpg') }}"
                                                    class="avatar img-fluid rounded-circle" alt="William Harris">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">William Harris</div>
                                                <div class="text-muted small mt-1">Curabitur ligula sapien euismod
                                                    vitae.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="{{ asset('img/avatars/avatar-4.jpg') }}"
                                                    class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Christina Mason</div>
                                                <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.
                                                </div>
                                                <div class="text-muted small mt-1">4h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="{{ asset('img/avatars/avatar-3.jpg') }}"
                                                    class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Sharon Lessman</div>
                                                <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
                                                    posuere ac, mattis non.
                                                </div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset('img/avatars/azfa.jpg') }}" height="50"
                                    class="avatar img-fluid rounded me-1" alt="M Azfa Asykarulloh" /> <span
                                    class="text-dark">M Azfa Asykarulloh</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                        data-feather="user"></i>
                                    Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="pie-chart"></i>
                                    Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html"><i class="align-middle me-1"
                                        data-feather="settings"></i>
                                    Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="help-circle"></i> Help
                                    Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    {{ $slot }}
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/"
                                    target="_blank"><strong>Inventory</strong></a> - <a class="text-muted"
                                    href="https://adminkit.io/" target="_blank"><strong>Muhammad Azfa Asykarulloh
                                    </strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                {{-- <li class="list-inline-item">
                  <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                </li>
                <li class="list-inline-item">
                  <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                </li>
                <li class="list-inline-item">
                  <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                </li>
                <li class="list-inline-item">
                  <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a> --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('sweetalert::alert')

    <script src="{{ asset('js/app.js') }}"></script>

    {{ $scripts ?? '' }}

    <script>
        // const {
        //     ClassicEditor,
        //     Essentials,
        //     Bold,
        //     Italic,
        //     Font,
        //     Paragraph
        // } = window.CKEDITOR;
        // ClassicEditor
        //     .create(document.querySelector('.ckeditor'), {
        //         licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NjkxMjYzOTksImp0aSI6ImU5M2Y5ZjA2LWE2ZWUtNDE4ZS04ZGY5LTMxYzM3ZTIwZTRlOCIsImxpY2Vuc2VkSG9zdHMiOlsiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImxpY2Vuc2VUeXBlIjoiZGV2ZWxvcG1lbnQiLCJmZWF0dXJlcyI6WyJEUlVQIl0sInZjIjoiYzcyZDM3OTIifQ.gKMqZx3TFSUQH92gOX8eOTupb3FiZlhHDz53w2WetuC-QXKd7baDjq0wfTGhPR-dFF6co5GIA2zptV0Uq3qQgg',
        //         plugins: [Essentials, Bold, Italic, Font, Paragraph],
        //         toolbar: [
        //             'undo', 'redo', '|', 'bold', 'italic', '|',
        //             'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
        //         ],
        //     })
        //     .catch(error => {
        //         console.error(error);
        //     });

        function formatPrice(value) {
            if (!value) return '';
            return new Intl.NumberFormat('id-ID').format(value);
        }

        function bindPriceFormatter(selector) {
            $(document).on('input', selector, function() {
                let value = $(this).val().replace(/\D/g, '');;

                $(this).val(formatPrice(value));
            });
        }

        bindPriceFormatter('.price');
    </script>
</body>

</html>
