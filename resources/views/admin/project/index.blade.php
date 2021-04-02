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
        @lang('admin.object.project')
        <a href="{{ action('Admin\ProjectController@create') }}" class="page-title-action btn waves-effect waves-light cyan">@lang('admin.title.create raw')</a>
    </h1>
    <div class="clearfix"></div>
    <div class="table-actions"></div>
        <div class="col s2" style="display: none;">
            <div class="select-wrapper">
                {{ Form::select('category', $categories, Request::get('category', NULL), ['class' => 'category-filter browser-default', 'placeholder' => trans('admin.title.index', ['object' => trans('admin.object.category')])]) }}
            </div>
        </div>
        {{-- <button type="button" class="btn waves-effect waves-light cyan">Filter</button> --}}
    </div>
    <div class="clearfix"></div>
    <div class="col s12">
        <table class="bordered highlight posts datatable responsive-table display" cellspacing="0">
            <thead class="cyan white-text">
                <th class="no-sort select-checkbox"></th>
                <th class="no-sort">@lang('admin.field.title')</th>    
                <th class="no-sort">@lang('admin.field.author')</th>
                <th>@lang('admin.field.created_at')</th>
                {{-- <th>@lang('admin.field.updated_at')</th> --}}
                <th class="no-sort"></th>
            </thead>
            <tbody>
            @foreach ($posts as $item)
                <tr class="odd">
                <td class="select-checkbox"></td>
                <td><a href="{{action('Admin\ProjectController@edit', $item->id)}}"> {{$item->title}} </a></td>
                <td>{{ $item->user->name or '' }}</td>
                <td>{!! $item->created_at !!}</td>
                {{-- <td>{!! $item->updated_at !!}</td> --}}
                <td class="center" > <a href="{{action('Admin\ProjectController@edit', $item->id)}}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa">@lang('admin.button.edit')</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('table').DataTable({
                "responsive": true,
            });
        });
    </script>
@endpush
