@extends('Admin.master')

@section('title')
    {{ trans('title_page.products') }}
@endsection

@section('mian_title')
{{ trans('content.products') }}
@endsection

@section('breadcrumb_title1')
{{ trans('content.Home') }}
@endsection

@section('breadcrumb_title2')
{{ trans('content.products') }}
@endsection


@section('content')
    <div class="card-header">
        <a href="{{ route('products.create') }}" class="btn btn-primary">{{ trans('category_trans.Create') }}</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('product_trans.Name') }}</th>
                    <th>{{ trans('product_trans.category') }}</th>
                    <th>{{ trans('product_trans.Image') }}</th>
                    <th>{{ trans('product_trans.is_showing') }}</th>
                    <th>{{ trans('product_trans.is_populer') }}</th>
                    <th>{{ trans('product_trans.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($products as $product)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category_id }}</td>
                    <td style="text-align: center"><img src="{{ asset('uploads/' . $product->image) }}" alt="" style=" max-width: 70px; max-height: 70px;"></td>
                    <td >
                        @if ($product->status == 1)
                        <span class="badge badge-success">{{ trans('product_trans.showing') }}</span>
                        @else
                        <span class="badge badge-danger">{{ trans('product_trans.hidden') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($product->trend == 1)
                        <span class="badge badge-success">{{ trans('product_trans.popular') }}</span>
                        @else
                        <span class="badge badge-danger">{{ trans('product_trans.no_popular') }}</span>
                        @endif
                    </td>
                    <td>
                        <a href=" {{ route('products.show',$product->id) }}" class="btn btn-outline-warning">{{ trans('product_trans.show') }}</a>
                        <a href=" {{ route('products.edit',$product->id) }}" class="btn btn-outline-primary">{{ trans('product_trans.Edit') }}</a>
                        @include('Admin.inc.delete_model',['type'=>'product','data'=>$product,'routes'=>'products.destroy'])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
@endsection
@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('assets/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::asset('assets/dist/js/demo.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection

@section('style')
@endsection
