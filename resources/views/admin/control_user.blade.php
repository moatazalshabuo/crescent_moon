@extends('layouts.layouts')

@section('content')
    <div class="pl-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 border p-3 mr-5">
                    <h2 class="text-right">قائمة المتبرعين</h2>
                    <hr class="line-color">
                    <form action="" class="">
                        <div class="row">
                            <div class="col-sm-6 mt-4">
                                <button type="submit" class="btn btn-primary w-100"><i
                                        class="fa-solid fa-magnifying-glass"></i> بحث</button>
                            </div>
                            <div class="col-sm-6 pl-5 mb-2">
                                <label>الحالة</label><br>
                                <select name="" id="" class="w-50">
                                    <option value="">الكل</option>
                                    <option value="">متبرع</option>
                                    <option value="">غير متبرع</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="back-bg-color mt-2 table_order nice">
                        <table class="table table-hover r">
                            <form action="" method="post">
                                <thead>
                                    <tr>
                                        <th scope="col">اسم المتبرع</th>
                                        <th scope="col">حالة التبرع</th>
                                        <th scope="col">تحديد</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donors as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-success">مفعل</span>
                                                @elseif($item->status == 0)
                                                    <span class="badge badge-danger">غير مفعل</span>
                                                @endif
                                            </td>
                                            <td><input type="checkbox" class="delete_selected_donors" name="donors[]"
                                                    value="{{ $item->id }}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 button-group">
                            <button class="btn btn-success active_donors" type="button" >تفعيل</button>
                            <button type="button" class="btn btn-primary mr-1" data-toggle="modal"
                                data-target="#resturant_Modal"><i class="fa-solid fa-plus"></i> اضافة متبرع</button>
                            <button type="button" class="btn btn-danger delete_donors"><i
                                    class="fa-solid fa-delete-left"></i> حذف
                                متبرع</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-5 border p-3 mt-4 mr-5">
                    <h2 class="text-right">قائمة المستفيدين</h2>
                    <hr class="line-color">
                    <div class="row">
                        <div class="col-sm">
                            <div class="back-bg-color mt-2 user-table nice">
                                <table class="table table-hover r">
                                    <form action="" method="post">
                                        <thead>
                                            <tr>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">عدد افراد الاسرة</th>
                                                <th scope="col">الحالة</th>
                                                <th scope="col">تحديد</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($beneficiaries as $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->count_family }}</td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <span class="badge badge-success">مفعل</span>
                                                        @elseif($item->status == 0)
                                                            <span class="badge badge-danger">غير مفعل</span>
                                                        @endif
                                                    </td>
                                                    <td><input type="checkbox" class="delete_selected_beneficiaries"
                                                            name="beneficiaries[]" value="{{ $item->id }}"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12 mt-3 button-group">
                            <button class="btn btn-success active_beneficiaries" type="button">تفعيل</button>
                            <button type="button" class="btn btn-primary mr-1" data-toggle="modal"
                                data-target="#costomer_Modal"><i class="fa-solid fa-plus"></i> اضافة مستفيد</button>
                            <button type="button" class="btn btn-danger delete_beneficiaries"><i
                                    class="fa-solid fa-delete-left"></i> حذف
                                مستفيد</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-------------------modals user----------------------->
    <div class="modal fade" id="costomer_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header x">
                    <h5 class="modal-title text-white" id="exampleModalLabel">اضافة مستفيد</h5>

                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-danger" id="beneficiaries-error"></div>
                    <form id="form-beneficiaries">
                        @csrf
                        <div class="form-group">
                            <label for="" class="float-right">الاسم </label>
                            <input type="text" name="name" class="form-control">

                            <label for="" class="float-right">الايميل</label>
                            <input type="email" name="email" class="form-control">

                            <label for="" class="float-right">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control">

                            <label for="" class="float-right">الرقم الوطني</label>
                            <input type="text" name="Nati_Id" class="form-control">

                            <label for="" class="float-right">العنوان</label>
                            <input type="text" name="address" class="form-control">

                            <input type="hidden" name="type_user" value="3">

                            <label for="" class="float-right">عدد افراد الاسرة</label>
                            <input type="number" min="0" name="count_family" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="float-right">اسم المستخدم</label>
                            <input type="text" name="username" class="form-control">

                            <label for="" class="float-right">كلمة المرور</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <button type="button" class="btn btn-primary save-beneficiaries"><i
                                class="fa-solid fa-floppy-disk"></i> حفظ</button>
                    </form>
                </div>
                <div class="modal-footer x">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal"><i class="fa-solid fa-x"></i>
                        اغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-------------------modals user----------------------->

    <!-------------------modals user----------------------->
    <div class="modal fade" id="resturant_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header x">
                    <h5 class="modal-title text-white" id="exampleModalLabel">اضافة متبرع</h5>

                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-danger" id="donors-error"></div>
                    <form id="form-donors">
                        @csrf
                        <div class="form-group">
                            <label for="" class="float-right">الاسم </label>
                            <input type="text" name="name" class="form-control">

                            <label for="" class="float-right">الايميل</label>
                            <input type="email" name="email" class="form-control">

                            <label for="" class="float-right">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control">
                            <label for="" class="float-right">العنوان</label>
                            <input type="text" name="address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="float-right">اسم المستخدم</label>
                            <input type="text" name="username" class="form-control">
                            <input type="hidden" name="type_user" value="2">
                            <label for="" class="float-right">كلمة المرور</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <button type="button" class="btn btn-primary save-user"><i class="fa-solid fa-floppy-disk"></i>
                            حفظ</button>
                    </form>
                </div>
                <div class="modal-footer x">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-x"></i>
                        اغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-------------------modals user----------------------->



    <!-------------------modals notfcition----------------------->
    <div class="modal fade" id="notfcition_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header x">
                    <h5 class="modal-title text-white" id="exampleModalLabel">احدث الاشعارات</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-2">تاريخ الطلبية</div>
                        <div class="col-2">عدد الوجبات</div>
                        <div class="col-3">عدد افراد الاسرة</div>
                        <div class="col-3">اسم المستخدم</div>
                        <div class="col-2"><i class="fa-solid fa-user"></i></div>
                    </div>
                </div>
                <div class="modal-footer x">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <!-------------------modals notfcition----------------------->
@endsection
@section('scripts')
    <script>
        $(function() {
            $('.save-user').click(function() {
                $("#donors-error").text("")
                axios.post("{{route('admin.store')}}", $("#form-donors").serialize())
                    .then((res) => {
                        $(".modal").modal("hide");
                        Swal.fire("تم الادخال بنجاح", "", "success").then(() => {
                            location.reload()
                        })

                    })
                    .catch((res) => {
                        data = res.response.data.errors
                        for (const [key, value] of Object.entries(data)) {
                            value.forEach(element => {
                                $("#donors-error").append(`${ element } - `)
                            });
                        }


                    })
            })

            $(".save-beneficiaries").click(function() {
                $("#beneficiaries-error").text("")
                axios.post("{{route('admin.store')}}", $("#form-beneficiaries").serialize())
                    .then((res) => {
                        $(".modal").modal("hide");
                        Swal.fire("تم الادخال بنجاح", "", "success").then(() => {
                            location.reload()
                        })
                    })
                    .catch((res) => {
                        data = res.response.data.errors
                        for (const [key, value] of Object.entries(data)) {
                            value.forEach(element => {
                                $("#beneficiaries-error").append(`${ element } - `)
                            });
                        }
                    })
            })

            $(".delete_donors").click(function() {
                const selected = $(".delete_selected_donors:checked").map(function() {
                    return $(this).val();
                }).get();
                Swal.fire({
                    title: 'هل تريد حذف العناصر?',
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: 'حذف',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.delete("{{route('admin.delete')}}", {
                            data: {
                                ids: selected
                            }
                        }).then((res) => {
                            Swal.fire('تم الحذف!', '', 'success').then(() => {
                                location.reload()
                            })
                        })
                    }
                })

            })

            $(".delete_beneficiaries").click(function() {
                const selected = $(".delete_selected_beneficiaries:checked").map(function() {
                    return $(this).val();
                }).get();
                Swal.fire({
                    title: 'هل تريد حذف العناصر?',
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: 'حذف',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.delete("{{route('admin.delete')}}", {
                            data: {
                                ids: selected
                            }
                        }).then((res) => {
                            Swal.fire('تم الحذف!', '', 'success').then(() => {
                                location.reload()
                            })
                        })
                    }
                })

            })

            $(".active_beneficiaries").click(function() {
                const selected = $(".delete_selected_beneficiaries:checked").map(function() {
                    return $(this).val();
                }).get();
                Swal.fire({
                    title: 'هل تريد تفعيل العناصر?',
                    showCancelButton: true,
                    confirmButtonColor: "success",
                    confirmButtonText: 'تفعيل',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post("{{ route('admin.active_user') }}", {'ids': selected,"_token":"{{ csrf_token() }}"}).then((res) => {
                            Swal.fire('تم التفعيل!', '', 'success').then(() => {
                                location.reload()
                            })
                        })
                    }
                })

            })

            $(".active_donors").click(function() {
                const selected = $(".delete_selected_donors:checked").map(function() {
                    return $(this).val();
                }).get();
                Swal.fire({
                    title: 'هل تريد تفعيل العناصر?',
                    showCancelButton: true,
                    confirmButtonColor: "success",
                    confirmButtonText: 'تفعيل',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        axios.post("{{ route('admin.active_user') }}", {'ids': selected,"_token":"{{ csrf_token() }}"}).then((res) => {
                            Swal.fire('تم التفعيل!', '', 'success').then(() => {
                                location.reload()
                            })
                        })
                    }
                })

            })
        })
    </script>
@endsection
