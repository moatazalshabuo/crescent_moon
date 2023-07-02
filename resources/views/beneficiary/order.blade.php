@extends('layouts.layouts')

@section('content')
    <div class="container px-4 mt-5">
        <div class="row">
            <div class="col-sm-3 border  mb-3 pt-4">
                <div class="rest-info text-center">
                    <h5 class="d-inline-block">{{ $user->name }}</h5>
                    <hr>
                    <h6 class="mt-2">{{ $user->phone }}</h6>
                </div>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-8 mb-2 border p-3">
                <form>
                    <input type="text" class="text-right w-50 mt-2 p-2" onkeyup="myFunction()" id="myInput"
                        id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="بحث عن صنف محدد للمطعم">
                    <input type="number" min="1" class="text-right w-25 mt-2 ml-5 p-2" id="qauntity" placeholder="ادخل الكمية">
                    @csrf
                    <button type="button" class="btn btn-primary w-100 mt-3 add-order"><i class="fa-solid fa-cart-arrow-down"></i>
                        طلب الاصناف</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="back-bg-color mt-2 table_order nice">
                    <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">الصنف</th>
                                <th scope="col">الكمية المتوفرة</th>
                                <th scope="col">وصف الوجبة</th>
                                <th scope="col">تحديد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meals as $item)
                                <tr>
                                    <th scope="row">{{ $item->name }}</th>
                                    <td>{{ $item->qauntity }}</td>
                                    <td>{{ $item->descripe }}</td>
                                    <td><input type="checkbox" class="select-order" value="{{ $item->id }}"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function(){
            $(".add-order").click(function() {
                const selectedItem = $(".select-order:checked").map(function() {
                    return $(this).val()
                }).get()
                if (selectedItem.length > 0 && $("#qauntity").val() != undefined && $("#qauntity").val() !=
                    "" && $("#qauntity").val() > 0) {
                    axios.post("{{route('beneficiary.add_order')}}", {
                        _token: $("input[name=_token]").val(),
                        qauntity: $("#qauntity").val(),
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
@endsection
