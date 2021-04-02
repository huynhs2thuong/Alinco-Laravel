<div class="primary col s9">
	<h1 class="text-capitalize">
        @if ($module->id)
            @lang('admin.title.edit', ['object' => trans('admin.object.module')])
            
        @else
            @lang('admin.title.create', ['object' => trans('admin.object.module')])
        @endif
    </h1>
	<div class="input-field">
	    @include('partials.lang_input', ['type' => 'text', 'model' => 'module', 'attr' => 'title', 'title' => trans('admin.field.title')])
	</div>
	<div class="input-field" style="display: none;">
         @include('partials.lang_input', ['type' => 'text', 'model' => 'module', 'attr' => 'slug' ,'title' => trans('admin.field.slug')])
	</div>
    @if ($module->id == 3)
    <div class="input-field">
        @include('partials.lang_input', ['type' => 'text', 'model' => 'module', 'attr' => 'canonical', 'title' => trans('admin.field.link_trang')])
    </div>
    @else
        
    @endif
</div>
<div class="side col s3">
	<div class="cat-top card hoverable">
        <h3 class="text-capitalize">@lang('admin.button.publish')</h3>
        <div class="divider"></div>
        <div class="status">
            <p>@lang('admin.field.status'):
                {{ Form::radio('active', 1, $module->active, ['id' => 'status-publish', 'class' => 'with-gap']) }}<label for="status-publish">@lang('admin.status.publish')</label>
                {{ Form::radio('active', 0, !$module->active, ['id' => 'status-draft', 'class' => 'with-gap']) }}<label for="status-draft">@lang('admin.status.draft')</label>
            </p>
            <p>@lang('admin.field.sticky'): {{ Form::checkbox('sticky', 1, $module->sticky, ['id' => 'sticky']) }}<label for="sticky"><span class="non-visib">1</span></label></p>
            @if ($module->id)

            <p>@lang('admin.field.created at'): {{ $module->created_at }}</p>
            <p>@lang('admin.field.updated at'): {{ $module->updated_at }}</p>

            @endif
        </div>
        @if ($module->id)
        	<button type="submit" class="btn btn-sm right waves-light waves-effect green accent-4">@lang('admin.button.update')</button>
        @else
        	<button type="submit" class="btn btn-sm waves-light waves-effect green accent-4">@lang('admin.button.publish')</button>
        @endif
        <div class="clearfix"></div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#form-category").validate({
                rules: {
                    'title[vi]': {
                        required: true,
                        minlength: 3
                    },
                    'title[en]': {
                        minlength: 3
                    },
                    'slug[vi]': {
                        required: true,
                        minlength: 3,
                    },
                    'slug[en]': {
                        required: true,
                        minlength: 3,
                    },
                    type: {
                        required: true
                    }
                },
                errorElement : 'div',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) $(placement).append(error)
                    else if ($(element).attr('type') === 'checkbox') error.insertBefore(element);
                    else error.insertAfter(element);
                }
            })
        });

    </script>
@endpush
