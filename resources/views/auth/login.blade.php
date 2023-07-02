@extends('layouts.app')

@section('content')
<section class="section" id="reservation">
    <div class="container">
        <div class="row p-3 mb-2">
            <div class="col-sm-12 text-center">
                <img src="assets/images/logo_invert.PNG" style="border-radius: 100%;" width="110" height="110" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="left-text-content">
                    <div class="section-heading">
                        <h6>تسجيل الدخول</h6>
                        <h2 class="text-center">تحتاج لتسجيل الدخول لتتمكن من استخدام مميزات الموقع الالكتروني</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="phone">
                                <i class="fa fa-phone"></i>
                                <h4>ارقام الهواتف</h4>
                                <span><a href="#">080-090-0990</a><br><a href="#">080-090-0880</a></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="message">
                                <i class="fa fa-envelope"></i>
                                <h4>البريد الالكتروني</h4>
                                <span><a href="#">hello@company.com</a><br><a href="#">info@company.com</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-5">
                <div class="contact-form">

                    <form id="contact" method="POST" action="{{ route('login-user') }}">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                        @csrf
                        <div class="row">
                        <div class="col-sm-12">
                          <fieldset>
                            <input name="username" type="text" id="name" placeholder="اسم المستخدم" required="" class="r">
                          </fieldset>
                        </div>
                        <div class="col-sm-12">
                          <fieldset>
                          <input name="password" type="password" placeholder="كلمة المرور" required="" class="r">
                        </fieldset>
                        </div>
                        <div class="col-sm-12 mt-2">
                          <fieldset>
                            <button type="submit" id="form-submit" class="main-button-icon">سجل دخولك</button>
                            @if (Route::has('password.request'))
                           <a class="btn btn-link" href="{{ route('password.request') }}">
                               هل نسيت كلمة السر
                           </a>
                            @endif
                          </fieldset>
                        </div>
                        <div class="col-sm-12 mt-3 text-center">
                           <hr class="d-inline-block w-25 mb-1"> <h6 class="d-inline-block">او ليس لديك حساب ؟</h6>  <hr class="d-inline-block w-25 mb-1">

                        </div>
                        <div class="col-sm-12 mt-4">
                            <fieldset>
                              <a href="{{ route('register') }}" id="form-submit" class="main-button-icon lin text-center">أنشىء حساب</a>
                            </fieldset>
                          </div>
                      </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
