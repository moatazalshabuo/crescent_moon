@extends('layouts.app')

@section('content')
<section class="section" id="reservation">
    <div class="container">
        <div class="row p-3 mb-2">
            <div class="col-sm-12 text-center">
                <img src="{{ URL::asset('assets/images/logo_invert.PNG')}}" style="border-radius: 100%;" width="110" height="110" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="left-text-content">
                    <div class="section-heading">
                        <h6>انشىء حساب</h6>
                        <h2 class="text-center">هنا يمكنك تسجيل الدخول و تحديد نوع احتياجك او رغبتك فالمشاركة</h2>
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
            <div class="col-lg-6">
                <div class="card p-4 contact-form">
                    <form class="contact" method="POST" action="{{ route('register-user') }}">
                        @csrf
                      <div class="row">
                        <div class="col-lg-6 col-sm-12">
                          <fieldset>
                            <input name="name" class="text-right" class="@error('name') is-invalid @enderror" value="{{ old('name') }}" type="text" id="name" placeholder="الاسم الكامل*" required="">
                          </fieldset>
                          @error("name")
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12">
                          <fieldset>
                          <input name="email" type="text" class="text-right" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" pattern="[^ @]*@[^ @]*" placeholder="البريد الالكتروني" required="">
                          @error("email")
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                        </fieldset>
                        </div>
                        <div class="col-lg-12 col-sm-12">
                            <fieldset>
                            <input name="username" type="text" class="text-right" class="@error('username') is-invalid @enderror" value="{{ old('username') }}" id="username"  placeholder="اسم المستخدم" required="">
                            @error("username")
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                          </fieldset>
                          </div>
                        <div class="col-lg-6 col-sm-12">
                          <fieldset>
                            <input name="phone" type="text" id="phone"  class="@error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="رقم الهاتف*" required="">
                          </fieldset>
                          @error("phone")
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <fieldset>
                              <input name="address" type="text" id="address"  class="@error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="العنوان*" required="">
                            </fieldset>
                            @error("address")
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                          </div>
                        <div class="col-md-6 col-sm-12">
                          <fieldset>
                            <select name="type_user" class="@error('type_user') is-invalid @enderror" value="{{ old('type_user') }}"  id="type_user">
                                <option value="">نوع التسجيل</option>
                                <option value="2">التسجيل كمتبرع</option>
                                <option value="3">التسجيل كمستفيد</option>
                            </select>
                          </fieldset>
                          @error("type_user")
                          <p class="text-danger">{{ $message }}</p>
                          @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <fieldset>
                              <input name="Nati_id" type="text" id="Nati_Id"  class="@error('Nati_Id') is-invalid @enderror d-none" value="{{ old('Nati_Id') }}" placeholder="الرقم الوطني*">
                            </fieldset>
                            @error("Nati_Id")
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                          </div>
                        <div class="col-md-12 col-sm-12">
                            <fieldset>
                              <input type="number" class="text-right inputDisabled d-none @if(old('count_family')) d-block @endif" min="0" placeholder="عدد افراد الاسرة" name="count_family" id="count_family">
                            </fieldset>
                        </div>

                        <div class="col-lg-12">
                          <fieldset>
                            <input type="text" class="text-right" name="password" placeholder="كلمة المرور">
                            <input type="text" class="text-right" name="password_confirmation" placeholder="اعادة كلمة المرور">
                          </fieldset>
                          <div>
                          @error("password")
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                          @error("password")
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <fieldset>
                            <button type="submit" onclick="validatePassword();" id="form-submit" class="main-button-icon">انشاء حساب</button>
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
@section('scripts')
    <script>
        $(function(){
            $("#type_user").change(function(){
                console.log($(this).val());
                if($(this).val() == 3){
                    $("#count_family,#Nati_Id").removeClass("d-none")
                    $("#count_family,#Nati_Id").attr("required",true)
                }else{
                    $("#count_family,#Nati_Id").addClass("d-none")
                    $("#count_family,#Nati_Id").removeAttr("required")
                }
            })
        })
    </script>
@endsection
