@extends('layouts.admin')

@section('content')
{!! Form::open(['action' => 'Admin\OmemberController@store', 'method' => 'POST', 'id' => 'form-project', 'class' => 'row']) !!}
	{{ method_field('POST') }}
    @include('admin.other.form')
{!! Form::close() !!}
@endsection
