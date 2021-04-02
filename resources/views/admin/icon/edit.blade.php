@extends('layouts.admin')

@section('content')
{!! Form::open(['action' => ['Admin\IconController@update', $post->id], 'method' => 'PUT', 'id' => 'form-post', 'class' => 'row']) !!}
    @include('admin.icon.form')
{!! Form::close() !!}
@endsection

@push('scripts')
	<script type="text/javascript">
		var form = $('#form-post');
		$('.btn-delete').click(function(event) {
			if (!confirm('{{ trans('admin.message.confirm') }}')) return;
			form.children('input[name="_method"]').val('DELETE');
			form.submit();
		});
	</script>
@endpush
