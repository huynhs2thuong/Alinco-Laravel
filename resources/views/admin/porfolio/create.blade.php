@extends('layouts.admin')

@section('content')
{!! Form::open(['action' => 'Admin\PorfolioController@store', 'method' => 'POST', 'id' => 'form-post', 'class' => 'row','novalidate' => 'novalidate','files' => true]) !!}
	{{ method_field('POST') }}
    @include('admin.porfolio.form')
{!! Form::close() !!}
@endsection
