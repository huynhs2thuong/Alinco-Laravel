<div class="primary col s9">
    <h1 class="text-capitalize">
        @if ($post->id)
            @lang('admin.title.edit', ['object' => trans('admin.object.slide')])
            <a href="{{ action('Admin\OmemberController@create') }}" class="page-title-action btn waves-effect waves-light cyan">@lang('admin.title.create raw')</a>
        @else
            @lang('admin.title.create', ['object' => trans('admin.object.slide')])
        @endif
    </h1>
    <div class="input-field">
        @include('partials.lang_input', ['type' => 'text', 'model' => 'post', 'attr' => 'title', 'title' => trans('admin.field.title')])
    </div>
    <div class="input-field">
        @include('partials.lang_input', ['type' => 'text', 'model' => 'post', 'attr' => 'slug', 'title' => trans('admin.field.slug')])
    </div>
    
    <div class="input-field" style="display: none;">
        @include('partials.lang_input', ['type' => 'textarea', 'attr' => "excerpt", 'model' => 'post', 'class' => 'materialize-textarea', 'title' => trans('admin.field.excerpt')])
    </div>
    <div class="input-field">
        <label class="active" for="created_at">@lang('admin.field.created at')</label>
        {{ Form::text('created_at', $post->created_at, ['id' => 'created_at', 'class' => 'job-date', 'placeholder' => '']) }}
    </div>
    <div class="input-field">
        @include('partials.lang_input', ['type' => 'textarea', 'attr' => "overview", 'model' => 'post', 'class' => 'description ckeditor','title' => trans('admin.field.overview')])
    </div>
    <div class="input-field">
        <ul id="bar" class="gallery block__list block__list_tags row">
            @if ($post->id)
                @foreach ($gallery as $resource)
                    @if ($resource->type == 'page')

                        <li class="item col s4">
                            <img src="{{ $resource->thumbnail }}" class="responsive-img 33" alt=""><input type="hidden" name="img_slide[]" value="{{ $resource->id }}">
                            <button class="resource-delete" type="button">
                                <i class="mdi-navigation-close"></i>
                            </button>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>
<div class="side col s3">
    <div class="cat-top card hoverable">
        <h1 class="text-capitalize">@lang('admin.button.publish')</h1>
        <div class="divider"></div>
        <div class="status">
            <p>@lang('admin.field.status'):
                {{ Form::radio('active', 1, $post->active, ['id' => 'status-publish', 'class' => 'with-gap']) }}<label for="status-publish">@lang('admin.status.publish')</label>
                {{ Form::radio('active', 0, !$post->active, ['id' => 'status-draft', 'class' => 'with-gap']) }}<label for="status-draft">@lang('admin.status.draft')</label>
            </p>
            <p style="display: none;">@lang('admin.field.sticky'): {{ Form::checkbox('sticky', 1, $post->sticky, ['id' => 'sticky']) }}<label for="sticky"><span class="non-visib">1</span></label></p>
            <p> Số thứ tự: {{ Form::text('ordering', $post->ordering, array('class' => 'field inline-form ordering-input')) }}</p>
            @if ($post->id)
            <p>@lang('admin.field.created at'): {{ $post->created_at }}</p>
            <p>@lang('admin.field.updated at'): {{ $post->updated_at }}</p>
            @endif
        </div>
        @if ($post->id)
            <button type="button" class="btn-delete btn btn-sm left waves-light waves-effect red darken-4">@lang('admin.button.delete')</button>
            <button type="submit" class="btn btn-sm right waves-light waves-effect green accent-4">@lang('admin.button.update')</button>
        @else
            <button type="submit" class="btn btn-sm waves-light waves-effect green accent-4">@lang('admin.button.publish')</button>
        @endif
        <div class="clearfix"></div>
    </div>
    <div class="cat-middle card hoverable">
        <h1 class="text-capitalize">@lang('admin.field.category')</h1>
        <div class="divider"></div>
            @foreach ($categories as $category)
            <p>
                {{ Form::radio('mcat_id[]', $category->id, (in_array($category->id,$mcat_id)), ['id' => 'category-' . $loop->index]) }}
                <label for="category-{{ $loop->index }}">{{ $category->title }}</label>
            </p>
            @endforeach
    </div>

    <div class="cat-middle card hoverable" style="display: none;">
       <input name="cid_slide" type="text" value="2">
	</div>
    <div class="cat-bottom card hoverable">
        <h1 class="text-capitalize">@lang('admin.field.PC')</h1>
        <div class="divider"></div>
        <div class="postimagediv_1">
            <img src="{{ $post->image }}" class="responsive-img" alt="">
            <input type="hidden" name="resource_id" value="{{ $post->resource_id }}">
            <div class="clearfix"></div>
            <a class="btn waves-effect waves-light cyan {{ $post->resource_id ? 'hide' : '' }} set-image modal-trigger" href="#modal-upload1">@lang('admin.button.set image')</a>
            <a class="btn waves-effect waves-light cyan {{ $post->resource_id ? '' : 'hide' }} remove-image1">@lang('admin.button.remove image')</a>
        </div>
    </div>
    
    <div class="cat-bottom card hoverable">
        <h1 class="text-capitalize">@lang('admin.field.mobile')</h1>
        <div class="divider"></div>
        <div class="postimagediv_7">
            <img src="{{ $investImg }}" class="responsive-img" alt="">
            <input type="hidden" name="invest_id" value="{{ $post->invest_id }}">
            <div class="clearfix"></div>
            <a class="btn waves-effect waves-light cyan {{ $post->invest_id ? 'hide' : '' }} set-image modal-trigger" href="#modal-upload7">@lang('admin.button.set image')</a>
            <a class="btn waves-effect waves-light cyan {{ $post->invest_id ? '' : 'hide' }} remove-image7">@lang('admin.button.remove image')</a>
        </div>
    </div>
    <div class="cat-bottom card hoverable">
        <h2 class="text-capitalize">Hình ảnh chi tiết</h2>
        <div class="divider"></div>
        <div id="projectUpload" class="dropzone"></div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <style type="text/css">
        .select2-container{
            margin-top: 15px;
        }
    </style>
    <script src="/js/select2.min.js"></script>  
    <script type="text/javascript">

@if(isset($create))
            $('#category-0').trigger('click');
        @endif

        $(document).ready(function() {
            $('.job-date').pickadate({
                selectMonths: true,
                selectYears: 15,
                format:'dd/mm/yyyy'
            });
            var $form = $('#form-post'),
                $form_method = $form.children('input[name="_method"]'),
                form_action = $form.attr('action'),
                form_method = $form_method.val();

            $form.validate({
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
                        pattern: /^[\w\-\/]+[a-zA-Z\d]$/
                    },
                    'slug[en]': {
                        required: true,
                        minlength: 3,
                        pattern: /^[\w\-\/]+[a-zA-Z\d]$/
                    },
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
        Dropzone.options.projectUpload = {
            url: '{{ action('Admin\ResourceController@store') }}',
            paramName: 'upload',
            dictDefaultMessage: '@lang("admin.object.dropmess")<br>@lang("admin.object.size1")',
            thumbnailWidth: 150,
            thumbnailHeight: 150,
            acceptedFiles: 'image/*',
            parallelUploads: 10,
            sending: function(file, xhr, formData) {
                formData.append('type', 'page');

            },
            success: function(file, response) {
                totalsize = parseFloat((file.size / (1024*1024)).toFixed(2));
                //console.log(totalsize);
                if(totalsize <= 1 ){
                    if(file.height>=1010 && file.width>=1600){
                    $('.gallery').append('<li class="item col s4"><img src="' + response.square + '" class="responsive-img" alt=""><input type="hidden" name="img_slide[]" value="' + response.id + '"><button class="resource-delete" type="button"><i class="mdi-navigation-close"></i></button></li>');
                    }else{
                        alert('Hình tải lên kích thước không đạt 1600 x 1010 px');
                    }
                }else{
                    alert('Hình tải lên không lớn hơn 1M');
                }
                $('#modal-gallery').closeModal();
                this.removeAllFiles();
            }
        };
        Dropzone.options.videoUpload = {
            url: '{{ action('Admin\ResourceController@store') }}',
            paramName: 'upload',
            dictDefaultMessage: 'Drop video files here to upload',
            thumbnailWidth: 150,
            thumbnailHeight: 150,
            acceptedFiles: 'video/*',
            parallelUploads: 10,
            sending: function(file, xhr, formData) {
                formData.append('type', 'video');

            },
            success: function(file, response) {
                // $('.gallery').append('<li class="item col s4"><img src="' + response.square + '" class="responsive-img" alt=""><input type="hidden" name="img_slide[]" value="' + response.id + '"><button class="resource-delete" type="button"><i class="mdi-navigation-close"></i></button></li>')
                html_video = '<li class="item col s4"><video width="300" controls ><source src="' + response.full + '" id="' + response.id + '">Your browser does not support HTML5 video.</video><input type="hidden" name="img_slide[]" value="' + response.id + '"><button class="resource-delete" type="button"><i class="mdi-navigation-close"></i></button></li>';
                $('.gallery').append(html_video);
                $('#modal-gallery').closeModal();
                this.removeAllFiles();
            }
        };
       
    </script>
    <style type="text/css">
        input.ordering-input{width: auto;border: 1px solid #ddd;text-align: center;}
    </style>
@endpush