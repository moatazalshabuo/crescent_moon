@extends('layouts.layouts')
@section('content')
    <div class="container-fluid px-4 mt-4">
    <div class="row">
        <div class="col-sm-4 mr-4 border p-3 mb-4">
            <h2 class="text-center mt-2">تقرير الطلبيات</h2>
        </div>
        <div class="col-sm-7 border p-3">
            <form action="" class="">
                <div class="row">
                    <div class="col-sm-3 text-right">
                        <label for="">الى تاريخ</label><br>
                        <input type="date" class="w-100">
                    </div>
                    <div class="col-sm-3 text-right">
                        <label for="">من تاريخ</label><br>
                        <input type="date" class="w-100">
                    </div>
                    <div class="col-sm-4 text-right">
                        <label>بحث بالاسم</label><br>
                        <input type="text" class="w-100 text-right" id="myInput" placeholder="اسم المستفيد"
                            onkeyup="myFunction()">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="mt-4 btn btn-primary w-100"><i
                                class="fa-solid fa-magnifying-glass"></i> بحث</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-sm-7 border p-3 mb-3">
            <div class="back-bg-color mt-2 table_order nice">
                <table class="table table-hover" id="myTable">
                    <form action="" method="post">
                        <thead>
                            <tr>
                                <th scope="col">اسم المستفيد</th>
                                <th scope="col">عدد افراد الاسرة</th>
                                <th scope="col">الوجبة</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">تحديد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                            <tr>
                                <th scope="row">{{ $item->uname }}</th>
                                <td>{{ $item->count_family }}</td>
                                <td>{{ $item->mname }}</td>
                                <td>{{ $item->qauntity }}</td>
                                <td><input type="checkbox" class="selectorder" value="{{ $item->id }}"></td>
                            </tr>
                            @endforeach

                        </tbody>
                </table>
            </div>
        </div>
        <div class="ml-sm-4 col-sm-4 border text-center pt-2">
            <h2>تأكيد الطلب</h2>
            <hr>
            <p>يرجى تحديد مستفيد او اكثر ثم تحديد قبول الطلب او رفضه</p>
            <hr>
            <button type="button" class="btn btn-success w-100 p-3 mt-4 accept-order"><i class="fa-solid fa-check"></i> موافقة على
                الطلبية</button>
            <button type="button" class="btn btn-danger w-100 p-3 mt-3 mb-3 cancel-order"><i class="fa-solid fa-x"></i> رفض
                الطلبية</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
<script>
     $(function(){
            $(".accept-order").click(function() {
                const selectedItem = $(".selectorder:checked").map(function() {
                    return $(this).val()
                }).get()
                if (selectedItem.length > 0 ) {
                    axios.post("{{route('admin.accept.order')}}", {
                        _token: $("input[name=_token]").val(),
                        ids: selectedItem
                    }).then((res) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم اضافة الطلب بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload()
                        });
                    })
                }
            })

            $(".cancel-order").click(function() {
                const selectedItem = $(".selectorder:checked").map(function() {
                    return $(this).val()
                }).get()
                if (selectedItem.length > 0 ) {
                    axios.post("{{route('admin.unaccept.order')}}", {
                        _token: $("input[name=_token]").val(),
                        ids: selectedItem
                    }).then((res) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'تم الغاء الطلب بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload()
                        });
                    })
                }
            })

        })
</script>
@endsection
