<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet">

    <title>موقع هلال الرحمة</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/font-awesome.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/css/templatemo-klassy-cafe.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/css/owl-carousel.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/fontawesome-free-6.4.0-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/Administration.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/datatable.css') }}">
    <style type="text/css" id="operaUserStyle"></style>


</head>

<body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky pb-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="{{ URL::asset('assets/images/logo.png') }}" width="110" height="110">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">الرئيسية</a></li>
                            <li class="scroll-to-section"><a href="#about">من نحن</a></li>


                            <li class="scroll-to-section"><a href="#menu">المزودين</a></li>
                            <li class="scroll-to-section"><a href="#chefs">طلبية</a></li>

                            @if (Auth::check())
                                <li class="submenu">
                                    <a href="javascript:;">{{ Auth::user()->name }}<i class="fa fa-user"></i></a>
                                    <ul>
                                        @if (Auth::user()->type_user == 1)
                                            <li><a href="{{ route('admin.index') }}">تقرير الواردات</a></li>
                                            <li><a href="{{ route('admin.users') }}">ادارة المستخدمين</a></li>
                                            <li><a href="{{ route('admin.control_users') }}">قبول المستخدمين</a></li>
                                            <li><a href="{{ route('admin.confirmOrder') }}">قبول الطلبات</a></li>
                                        @elseif(Auth::user()->type_user == 2)
                                            <li><a href="{{ route('donors.ManageMeals') }}">ادارة التبرعات</a></li>
                                        @elseif(Auth::user()->type_user == 3)
                                            <li><a href="{{ route('beneficiary.restrant') }}">قائمة المتبرعين</a></li>
                                        @elseif(Auth::user()->type_user == 4)
                                            <li><a href="{{ route('admin.confirmOrder') }}">قبول الطلبات</a></li>
                                        @elseif(Auth::user()->type_user == 5)
                                            <li><a href="{{ route('admin.users') }}">ادارة المستخدمين</a></li>
                                            <li><a href="{{ route('admin.control_users') }}">قبول المستخدمين</a></li>
                                            <li><a href="{{ route('admin.confirmOrder') }}">قبول الطلبات</a></li>
                                        @endif

                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                                خروج
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @if (Auth::user()->type_user == 3)
                                    <button type="button" class="btn btn-danger mx-3 not" style="position: relative">
                                        <span class="badge badge-warning text-white"
                                            style="position: absolute;top:-5px;left:0px" id="count_noti">0</span>
                                        <i class="fa-solid fa-bell"></i>

                                    </button>
                                @endif
                            @else
                                <li class="scroll-to-section"><a href="{{ route('login') }}">تسجيل الدخول</a></li>
                            @endif

                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->
    <div id="app">
        <main class=" mt-3">
            @yield('content')
        </main>
    </div>
    <footer>
        <div class="container pl-5">
            <div class="row">
                <div class="col-sm-4 col-xs-12 mt-5">
                    <div class="right-text-content text-center">
                        <ul class="social-icons">
                            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin"></i></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 text-center mt-4">
                    <div class="logo">
                        <a href="index.html"><img src="{{ URL::asset('assets/images/logo_invert.PNG') }}"
                                width="120" height="120" alt="" style="border-radius: 100%;"></a>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 mt-4">
                    <div class=" text-white text-center">
                        <p>©delevpoment by : desert tochnology team
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="notfcition_Modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header x">
                        <h5 class="modal-title text-white" id="exampleModalLabel">احدث الاشعارات</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <th>تاريخ الطلبية</th>
                                <th>عدد الوجبات</th>
                                <th>عدد افراد الاسرة</th>
                                <th>اسم المستخدم</th>
                                <th><i class="fa-solid fa-user"></i></th>
                            </thead>
                            <tbody id="data_noti">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer x">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ URL::asset('assets/js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ URL::asset('assets/js/popper.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ URL::asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ URL::asset('assets/js/accordions.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ URL::asset('assets/js/scrollreveal.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/imgfix.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/slick.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lightbox.js') }}"></script>
    <script src="{{ URL::asset('assets/js/isotope.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
    <!-- Global Init -->

    <script src="{{ URL::asset('assets/js/datatable.js') }}"></script>

    <script src="{{ URL::asset('assets/js/custom.js') }}"></script>
    <script src="{{ URL::asset('js/moment.js') }}"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="{{ URL::asset('assets/js/axois.js') }}"></script>
    @yield('scripts')
    <script>
        $(function() {
            $(".nice").niceScroll();
        });
    </script>
    <script>
        $(function() {
            let table = new DataTable('.dataTable', {
                responsive: true
            });
            var selectedClass = "";
            $("p").click(function() {
                selectedClass = $(this).attr("data-rel");
                $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("." + selectedClass).fadeOut();
                setTimeout(function() {
                    $("." + selectedClass).fadeIn();
                    $("#portfolio").fadeTo(50, 1);
                }, 500);

            });

            function check_notiaction() {
                axios.get("{{ route('check_noti') }}").then((res) => {
                    // console.log(res)
                    var count = res.data.count;
                    var data = res.data.data;
                    var html = ``;

                    for (let x of data) {
                        html += `
                        <tr>

                        <td>${moment(x.created_at).format("YYYY-MM-DD")}</td>
                        <td>${x.qauntity}</td>
                        <td>${x.count_family}</td>
                        <td>${x.name}</td>
                        <td><span class='badge badge-success'>تمت الموافقة</span></td>
                        </tr>`
                    }

                    $("#data_noti").html(html)
                    $("#count_noti").text(count)
                }).catch(() => {
                    location.reload()
                })
            }


            setTimeout(function() {
                check_notiaction()
            }, 1000);

            $(".not").click(function() {
                axios.get("remove_noti").then(() => {
                    check_notiaction()
                    $("#notfcition_Modal").modal("show")
                })
            })
        });
    </script>
</body>

</html>
