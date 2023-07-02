@extends('layouts.layouts')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4 ">
            <div class="col-sm-4 mx-4 border text-center pt-4 pb-4">
                <h3>تفضل بزيارة صفحات المتبرعين التالية</h3>
            </div>
            <div class=" col-sm-6 border text-center mx-3 p-3 mt-3">
                <h5>ابحث عن اسم المتبرع الذي ترغب به</h5><br>

                <select id="select-restrant" class="form-control">
                    <option value="">اختر المتبرع </option>
                    @foreach ($donors as $item)
                        <option value="{{$item->id}}"> {{ $item->name }} </option>
                    @endforeach
                </select>

            </div>
        </div>

        <!-- ***** Menu Area Starts ***** -->
        <section class="section" id="menu">
            <div class="menu-item-carousel">
                <div class="col-lg-12">
                    <div class="owl-menu-item owl-carousel">
                        @foreach ($donors as $item)
                        <div class="item">
                            <div class='card card1'>
                                <div class='info'>
                                    <h1 class='title'>{{ $item->name }}</h1>
                                    <p class='description'>العنوان</p>
                                    <hr>
                                    <p class="mb-5 p-4 text-white">{{ $item->phone }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endsection
    @section('scripts')
    <script>
        $(function(){
            $("#select-restrant").select2()
            $("#select-restrant").change(function(){
                location.replace(`/beneficiary/order/${$(this).val()}`)
            })
        })
    </script>
    @endsection
