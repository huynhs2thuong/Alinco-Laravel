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
        @lang('admin.object.porfolio')
    </h1>
    <div class="clearfix"></div>
    <div class="table-actions"></div>
        {{-- <button type="button" class="btn waves-effect waves-light cyan">Filter</button> --}}
    </div>
    <div class="clearfix"></div>
    <div class="col s12">
        <table class="bordered highlight posts datatable responsive-table display" cellspacing="0">
            <thead class="cyan white-text">
                <th class="no-sort"></th>
                <th class="no-sort">@lang('admin.field.title')</th>
                <th class="no-sort">@lang('admin.field.draft')</th>
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
                    url: '{{ action('Admin\PorfolioController@index') }}',
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
             $('.module-filter').change(function(event) {

                var value = $(this).val();

                table.ajax.reload();

                //ajax show category
                $.ajax({
                    url: "{{ action('Admin\PostController@getCategory') }}",
                    type: 'get',
                    dataType: 'html',
                    data: {
                        mId: value
                    }
                }).done(function(data) {
                    data = JSON.parse(data);
                    $('[name="category"] option').hide();
                    $.each( data, function( key, value ) {
                        $('[name="category"] option[value="'+key+'"]').show();
                    });
                });
            });

        });
    </script>
@endpush
