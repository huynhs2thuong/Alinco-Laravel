@extends('layouts.admin')

@section('content')
{!! Form::open(['action' => 'Admin\IconController@store', 'method' => 'POST', 'id' => 'form-post', 'class' => 'row']) !!}
	{{ method_field('POST') }}
    @include('admin.icon.form')
{!! Form::close() !!}
@endsection
