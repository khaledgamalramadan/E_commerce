@extends('Admin.master')

@section('title')
    {{ trans('title_page.Categories') }}
@endsection

@section('mian_title')
    {{ trans('content.Categories') }}
@endsection

@section('breadcrumb_title1')
    {{ trans('content.Home') }}
@endsection

@section('breadcrumb_title2')
    {{ trans('content.Categories') }}
@endsection

@section('content')
    <div class="card-header">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">{{ trans('category_trans.Create') }}</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('category_trans.Name') }}</th>
                    <th>{{ trans('category_trans.Image') }}</th>
                    <th>{{ trans('category_trans.is_showing') }}</th>
                    <th>{{ trans('category_trans.is_populer') }}</th>
                    <th>{{ trans('category_trans.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $category->name }}</td>
                    <td style="text-align: center"><img src="{{ asset('uploads/' . $category->image) }}" alt="" style=" max-width: 70px; max-height: 70px;"></td>
                    <td >
                        @if ($category->is_showing == 1)
                        <span class="badge badge-success">{{ trans('category_trans.showing') }}</span>
                        @else
                        <span class="badge badge-danger">{{ trans('category_trans.hidden') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($category->is_populer == 1)
                        <span class="badge badge-success">{{ trans('category_trans.popular') }}</span>
                        @else
                        <span class="badge badge-danger">{{ trans('category_trans.no_popular') }}</span>
                        @endif
                    </td>
                    <td>
                        <a href=" {{ route('categories.show',$category->id) }}" class="btn btn-outline-success">{{ trans('category_trans.show') }}</a>
                        <a href=" {{ route('categories.edit',$category->id) }}" class="btn btn-outline-primary">{{ trans('category_trans.Edit') }}</a>
                        @include('Admin.inc.delete_model', ['data' => $category])
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
@endsection

@section('style')
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
