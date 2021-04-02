@extends('layouts.admin')

@section('content')
{!! Form::open(['action' => 'Admin\EmailController@store', 'method' => 'POST', 'id' => 'form-post', 'class' => 'row']) !!}
	{{ method_field('POST') }}
    @include('admin.email.form')
{!! Form::close() !!}
@endsection
