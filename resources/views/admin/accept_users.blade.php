@extends('layouts.layouts')

@section('content')
    <div class="pl-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 border p-3 mr-5">
                    <h3 class="text-right">تقرير بتسجيلات الدخول للمتبرعين</h3>
                    <hr class="line-color">
                    <form action="" class="">
                        <div class="row">
                            <div class="col-sm-4 text-right px-sm-0">
                                <label for="">الى تاريخ</label><br>
                                <input type="date">
                            </div>
                            <div class="col-sm-4 text-right px-sm-0">
                                <label for="">من تاريخ</label><br>
                                <input type="date">
                            </div>
                            <div class="col-sm-4 mt-4 pl-5">
                                <button type="submit" class="btn btn-primary w-100"><i
                                        class="fa-solid fa-magnifying-glass"></i> بحث</button>
                            </div>
                        </div>
                    </form>
                    <div class="back-bg-color mt-2 table_order nice">
                        <table class="table table-hover">
                            <form action="">
                                <thead>
                                    <tr>
                                        <th scope="col">اسم المزود</th>
                                        <th scope="col">رقم الهاتف</th>
                                        <th scope="col">تاريخ التسجيل</th>
                                        <th scope="col">تحديد</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donors as $item)
                                        <tr >
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->phne }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td><input type="checkbox" name="selectedDonors[]" class="selected_donors" value="{{ $item->id }}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-5 mr-sm-5 mb-3">
                            <button type="button" class="btn btn-success w-100 p-2 active_donors"><i class="fa-solid fa-check"></i>
                                موافقة على التسجيل</button>
                        </div>
                        <div class="col-sm-5">
                            <button type="button" class="btn btn-danger w-100 p-2 unactive_donors"><i class="fa-solid fa-x"></i> رفض
                                التسجيل</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 border p-3 mt-4 mr-5">
                    <h3 class="text-right">تقرير تسجيلات الدخول للمستفيدين</h3>
                    <hr class="line-color">
                    <form action="" class="">
                        <div class="row">
                            <div class="col-sm-3 text-right px-sm-0">
                                <label for="">الى تاريخ</label><br>
                                <input type="date">
                            </div>
                            <div class="col-sm-3 text-right px-sm-0">
                                <label for="">من تاريخ</label><br>
                                <input type="date">
                            </div>
                            <div class="col-sm-5 mt-4 pl-5">
                                <button type="submit" class="btn btn-primary w-100"><i
                                        class="fa-solid fa-magnifying-glass"></i> بحث</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm">
                            <div class="back-bg-color mt-2 table_order nice">
                                <table class="table table-hover">
                                    <form action="">
                                        <thead>
                                            <tr>
                                                <th scope="col">اسم المستفيد</th>
                                                <th scope="col">عدد افراد الاسرة</th>
                                                <th scope="col">السكن</th>
                                                <th scope="col">تاريخ التسجيل</th>
                                                <th scope="col">تحديد</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($beneficiaries as $key => $item)
                                                <tr>
                                                    <th scope="row">{{ $item->name  }}</th>
                                                    <td colspan="2">{{ $item->count_family }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td><input type="checkbox" name="delectdBeneficiaries[]" class="selected_beneficiaries" value="{{ $item->id }}"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-5 mr-sm-5 mb-3">
                            <button type="button" class="btn btn-success w-100 p-2 active_beneficiaries"><i class="fa-solid fa-check"></i>
                                موافقة على التسجيل</button>
                        </div>
                        <div class="col-sm-5">
                            <button type="button" class="btn btn-danger w-100 p-2 unactive_beneficiaries"><i class="fa-solid fa-x"></i> رفض
                                التسجيل</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $("#type_user").change(function() {
                console.log($(this).val());
                if ($(this).val() == 3) {
                    $("#count_family").removeClass("d-none")
                } else {
                    $("#count_family").addClass("d-none")
                }
            })

            $(".active_beneficiaries").click(function() {
                const selected = $(".selected_beneficiaries:checked").map(function() {
                    return $(this).val();
                }).get();
                Swal.fire({
                    title: 'هل تريد تفعيل العناصر?',
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: 'تاكيد',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.get("/admin/users/active", {
                            params: {
                                ids: selected
                            }
                        }).then((res) => {
                            Swal.fire('تم التفعيل!', '', 'success').then(()=>{
                                location.reload()
                            })
                        })
                    }
                })
            })

            $(".unactive_beneficiaries").click(function() {
                const selected = $(".selected_beneficiaries:checked").map(function() {
                    return $(this).val();
                }).get();
                Swal.fire({
                    title: 'هل تريد الغاء العناصر?',
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: 'تاكيد',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.delete("/admin/users", {
                            data: {
                                ids: selected
                            }
                        }).then((res) => {
                            Swal.fire('تم الالغاء!', '', 'success').then(()=>{
                                location.reload()
                            })
                        })
                    }
                })
            })



            $(".active_donors").click(function() {
                const selected = $(".selected_donors:checked").map(function() {
                    return $(this).val();
                }).get();
                Swal.fire({
                    title: 'هل تريد تفعيل العناصر?',
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: 'تاكيد',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.get("/admin/users/active", {
                            params: {
                                ids: selected
                            }
                        }).then((res) => {
                            Swal.fire('تم التفعيل!', '', 'success').then(()=>{
                                location.reload()
                            })
                        })
                    }
                })
            })

            $(".unactive_donors").click(function() {
                const selected = $(".selected_donors:checked").map(function() {
                    return $(this).val();
                }).get();
                Swal.fire({
                    title: 'هل تريد الغاء العناصر?',
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: 'تاكيد',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.delete("/admin/users", {
                            data: {
                                ids: selected
                            }
                        }).then((res) => {
                            Swal.fire('تم الالغاء!', '', 'success').then(()=>{
                                location.reload()
                            })
                        })
                    }
                })
            })
        })
    </script>
@endsection
