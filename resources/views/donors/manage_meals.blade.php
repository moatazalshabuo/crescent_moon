@extends('layouts.layouts')

@section('content')
    <div class="container mt-5">
        <div class="row">

            <div class="col-sm-12 border p-3">
                <form action="" class="">
                    <div class="row">
                        <div class="col-sm-4 text-right">
                            <label>بحث بالاسم</label><br>
                            <input type="text" class="w-100 text-right" placeholder="اسم الوجبة" onkeyup="myFunction()"
                                id="myInput">
                        </div>
                        <div class="col-sm-4 text-right">
                            <label for="">الكمية</label><br>
                            <input type="number" min="1" id="qauntity" class="w-100">
                            @csrf
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="mt-4 btn btn-primary w-100 add-qauntity"><i
                                    class="fa-solid fa-plus"></i>
                                اضافة</button>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="mt-4 btn btn-danger w-100 min-qauntity"><i
                                    class="fa-solid fa-minus"></i>
                                الغاء</button>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class=" col-sm-12 border">
                <h5 class="text-center m-2">الاصناف المتوفرة لديك</h5>
                <hr>
                <div class="back-bg-color mt-2 table_avilbls nice">
                    <table class="table table-hover" id="">
                        <thead>
                            <tr>
                                <td></td>
                                <th scope="col">اسم الوجبة</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">تاريخ الاضافة</th>
                                <th scope="col">وصف المكونات</th>
                                <th scope="col">تحديد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meals as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->qauntity }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->descripe }}</td>
                                    <td><input type="checkbox" class="item-meals" value="{{ $item->id }}"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="m-3">
                    <button type="button" class="btn btn-danger mx-3 delete-meals" ><i class="fa-solid fa-x"></i> حذف وجبة</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                            class="fa-solid fa-cart-plus"></i> اضافة وجبة جديدة</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-------------------modals add----------------------->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header x">
                    <h5 class="modal-title text-white" id="exampleModalLabel">وجبة جديدة</h5>
                </div>
                <div class="modal-body">
                    <div class="text-danger" id="meals-error"></div>
                    <form id="form-meals">
                        @csrf
                        <div class="form-group">
                            <label for="" class="float-right">اسم الوجبة</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="float-right">الكمية</label>
                            <input type="number" name="qauntity" min="0" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="float-right">وصف المكونات</label>
                            <input type="text" name="descripe" class="form-control">
                        </div>
                        <button type="button" class="btn btn-primary save-meals"><i class="fa-solid fa-floppy-disk"></i>
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
    <!-------------------modals add----------------------->




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
            $("#type_user").change(function() {
                console.log($(this).val());
                if ($(this).val() == 3) {
                    $("#count_family").removeClass("d-none")
                } else {
                    $("#count_family").addClass("d-none")
                }
            })

            $('.save-meals').click(function() {
                $("#meals-error").text("")
                axios.post("{{route('meals.store')}}", $("#form-meals").serialize())
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
                                $("#meals-error").append(`${ element } - `)
                            });
                        }
                    })
            })

            $(".add-qauntity").click(function() {
                const selectedItem = $(".item-meals:checked").map(function() {
                    return $(this).val()
                }).get()
                if (selectedItem.length > 0 && $("#qauntity").val() != undefined && $("#qauntity").val() !=
                    "" && $("#qauntity").val() > 0) {
                    axios.put("{{ route('meals.update.qauntit') }}", {
                        _token: $("input[name=_token]").val(),
                        qauntity: $("#qauntity").val(),
                        ids: selectedItem
                    }).then((res) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم اضافة الكمية بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload()
                        });
                    })
                }
            })
            $(".min-qauntity").click(function() {
                const selectedItem = $(".item-meals:checked").map(function() {
                    return $(this).val()
                }).get()
                if (selectedItem.length > 0 && $("#qauntity").val() != undefined && $("#qauntity").val() !=
                    "" && $("#qauntity").val() > 0) {
                    axios.put("{{ route('meals.update.qauntit.min') }}", {
                        _token: $("input[name=_token]").val(),
                        qauntity: $("#qauntity").val(),
                        ids: selectedItem
                    }).then((res) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم ازالة الكمية بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload()
                        });
                    })
                }
            })

            $(".delete-meals").click(function() {
                const selectedItem = $(".item-meals:checked").map(function() {
                    return $(this).val()
                }).get()
                if (selectedItem.length > 0) {
                    Swal.fire({
                    title: 'هل تريد حذف العناصر?',
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: 'حذف',

                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                    axios.delete("{{route('meals.delete')}}", {
                        data: {
                            ids: selectedItem
                        }
                    }).then((res) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم ازالة الصنف بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload()
                        });

                    })
                }
            })
        }
            })

        })

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <!--تصفية الجدول-->
@endsection
