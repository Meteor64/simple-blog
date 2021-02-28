<x-panel-layout>
    <x-slot name="title">
        ویرایش مقاله
    </x-slot>

    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('posts.index') }}" class="is-active"> مقالات</a></li>
            <li><a href="{{ route('posts.edit',1) }}" class="is-active">ویرایش مقاله </a></li>
        </ul>
    </div>

    <div class="main-content padding-0">
        <p class="box__title">ویرایش مقاله</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{ route('posts.update',$post) }}" class="padding-30" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="title" class="text" placeholder="عنوان مقاله"
                           value="{{ $post->title ?? '' }}">
                    <label> دسته بندی
                        <select name="categories[]" class="tags" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @foreach($post->categories as $postcats)
                                        @if($postcats->id == $category->id)
                                        selected
                                    @endif
                                    @endforeach
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود بنر دوره</span>
                            <input type="file" class="file-upload" id="files" name="banner"/>
                        </div>
                        <span class="filesize"></span>
                        @if(!isset($post->banner))
                            <span class="selectedFiles">فایلی انتخاب نشده است</span>
                        @endif
                    </div>
                    <div class="margin-bottom-12">
                        <img src="{{asset('images/banners/'.$post->banner) }}"
                             alt="{{ $post->banner }}" width="70">
                    </div>
                    <textarea name="body" placeholder="متن مقاله" id="editor"
                              class="text ">{!! htmlspecialchars($post->body) !!}</textarea>
                    <button class="btn btn-webamooz_net">ویرایش مقاله</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('blog/panel/js/tagsInput.js') }}"></script>
    </x-slot>
</x-panel-layout>
