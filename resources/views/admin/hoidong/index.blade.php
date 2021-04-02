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
        @lang('admin.object.post')
        <a href="{{ action('Admin\HoidongController@create') }}" class="page-title-action btn waves-effect waves-light cyan">@lang('admin.title.create raw')</a>
    </h1>
    <div class="clearfix"></div>
    <div class="table-actions"></div>
        <div class="col s3">
            <div class="select-wrapper">

            </div>
        </div>
        <div class="col s3">
            <div class="select-wrapper">

            </div>
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
                <th class="no-sort">@lang('admin.field.chucvu')</th>
                <th class="no-sort">@lang('admin.field.author')</th>
                <th>@lang('admin.field.date')</th>
                <th class="no-sort"></th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="download_file_section" style="display:none;"></div>
@endsection

@push('scripts')
   
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: '{{ action('Admin\HoidongController@index') }}',
                    data: function(d) {
                        d.category = $('.category-filter').val();
                        d.module = $('.module-filter').val();
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
                    url: "{{ action('Admin\PostController@sortPost') }}",
                    type: 'get',
                    dataType: 'html',
                    data: {
                        values: arrayValue,
                        ids: arrayId
                    }
                }).done(function(data) {
                    location.reload();
                });
            });


            $('#btn_export').bind('click',function(){
                var url = '{{ action('Admin\HoidongController@ajaxExport') }}';
                console.log(url);
                $.post(url,function(data){
                    
                    console.log(data);

                    
                },'JSON');
            });

        } );
    </script>
@endpush