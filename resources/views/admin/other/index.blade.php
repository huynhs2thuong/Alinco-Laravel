@extends('layouts.admin')

@push('styles')
    <style type="text/css">
        td > .post-category {
            display: block;
        }
    </style>
@endpush

@section('content')
<div class="row">
    <h1 class="col s12 head-2">
        @lang('admin.object.slide')
        <a href="{{ action('Admin\OmemberController@create') }}" class="page-title-action btn waves-effect waves-light cyan">@lang('admin.title.create raw')</a>
    </h1>
    <div class="clearfix"></div>
    <div class="table-actions"></div>
        <div class="col s2">
            
        </div>
        {{-- <button type="button" class="btn waves-effect waves-light cyan">Filter</button> --}}
    </div>
    <div class="clearfix"></div>
    <div class="col s12">
        <table class="bordered highlight posts datatable responsive-table display" cellspacing="0">
            <thead class="cyan white-text">
                <th class="no-sort"></th>
                <th class="no-sort">@lang('admin.field.title')</th>
                <th class="no-sort">@lang('admin.field.order')</th>     
                <th class="no-sort">@lang('admin.field.author')</th>
                <th class="no-sort">@lang('admin.field.date')</th>
                <th class="no-sort"></th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: '{{ action('Admin\OmemberController@index') }}',
                    data: function(d) {
                        d.category = $('.category-filter').val();
                    }
                },
                "columnDefs": [
                    { orderable: false, targets: 'no-sort' },
                    { className: 'select-checkbox', targets: 0 }
                ],
            });
            $('.category-filter').change(function(event) {
                table.ajax.reload();
            });
            $('#sortPost').click(function(){
                var arrayValue = [];
                var arrayId = [];
                $('.order-input').each(function(){
                    var value = $(this).children('input.inputvalue').val();
                    var id = $(this).children('input.postid').data('value');
                    arrayValue.push(value);
                    arrayId.push(id);
                });
                $.ajax({
                    url: "{{ action('Admin\ProjectController@sortProject') }}",
                    type: 'get',
                    dataType: 'html',
                    data: {
                        values: arrayValue,
                        ids: arrayId
                    }
                }).done(function(data) {
                    location.reload();
                });
            })
        } );
    </script>
@endpush
