@extends('layouts.layouts')

@section('content')
    <div class="pl-5 mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 border p-3 mr-5">
                    <h2 class="text-right">تقرير الواردات</h2>
                    <hr class="line-color">

                    <div class="back-bg-color mt-2 table_order nice">
                        <table class="table table-hover dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">المتبرع</th>
                                    <th scope="col">الوجبة</th>
                                    <th scope="col">الكمية</th>
                                    <th scope="col">تاريخ التبرع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $item)
                                    <tr>
                                        <th scope="row">{{ $item->uname }}</th>
                                        <td>{{ $item->mname }}</td>
                                        <td>{{ $item->qauntity }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        {{-- <td><input type="checkbox" class="selectorder" value="{{ $item->id }}"></td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-5 border p-3 mt-4 mr-5">
                    <h2 class="text-right">الموظفين</h2>
                    <hr class="line-color">
                    <div class="row">
                        <div class="col-sm">
                            <div class="back-bg-color mt-2 user-table nice">
                                <table class="table table-hover dataTable" >
                                    <form action="" method="post">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">الصلاحية</th>
                                                <th scope="col">تحديد</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $key => $item)
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>{{ $item->name }}</td>
                                                    <td>ادمن</td>
                                                    <td><input type="checkbox" class="selected_user"
                                                            value="{{ $item->id }}"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-7 mt-3">
                            <button type="button" class="btn btn-primary mr-2" data-toggle="modal"
                                data-target="#employe_Modal"><i class="fa-solid fa-plus"></i> اضافة موظف</button>
                            <button type="button" class="btn btn-danger delete_user"><i class="fa-solid fa-delete-left"></i> حذف
                                موظف</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-------------------modals----------------------->

    {{-- <div class="modal fade" id="employe_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header x">
                    <h5 class="modal-title text-white" id="exampleModalLabel">اضافة موظف</h5>

                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="" class="float-right">الاسم الاول</label>
                            <input type="text" class="form-control">

                            <label for="" class="float-right">الاسم الاخير</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="float-right">اسم المستخدم</label>
                            <input type="text" class="form-control">

                            <label for="" class="float-right">كلمة المرور</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="float-right">الصلاحية</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>موظف ادخال</option>
                                <option>المسؤول</option>
                                <option>الادارة</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                            حفظ</button>
                    </form>
                </div>
                <div class="modal-footer x">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-x"></i>
                        اغلاق</button>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="modal fade" id="employe_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <div class="form-group">
                            <label for="" class="float-right">الصلاحية</label>
                            <select class="form-control" name="type_user" id="exampleFormControlSelect1">
                                <option value="">نوع المستخدم</option>
                                <option value="4">موظف ادخال</option>
                                <option value="1">المسؤول</option>
                                <option value="5">الادارة</option>
                            </select>
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
    <!-------------------modals----------------------->

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
                axios.post("/admin/store-user/", $("#form-donors").serialize())
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

            $(".delete_user").click(function() {
                const selected = $(".selected_user:checked").map(function() {
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
                        axios.delete("/admin/users", {
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
        })
    </script>
@endsection
