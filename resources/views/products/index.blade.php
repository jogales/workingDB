@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card p-5">
            <h2 class="mb-1">Products</h2>
            <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
                <table id="table-products" class="table table-striped table-bordered table-hover display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        {{--<th>Categories</th>--}}
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        {{--<th>Categories</th>--}}
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('footer-scripts')
    <script>
        $(document).ready(function () {
            $('#table-products').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    },
                    "url": "{{url('/productsTable')}}",
                    "type": "POST",
                    "datatype": "json",
                },
                "columns": [
                    {"data": "name", class: 'text-truncate'},
                    {"data": "price", class: 'text-center'},
                ],

            })
        })
    </script>
@endsection