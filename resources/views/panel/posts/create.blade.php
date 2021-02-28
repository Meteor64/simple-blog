<x-panel-layout>
    <x-slot name="title">
        ایجاد مقاله جدید
    </x-slot>

    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('posts.index') }}" class="is-active"> مقالات</a></li>
            <li><a href="{{ route('posts.create') }}" class="is-active">ایجاد مقاله جدید</a></li>
        </ul>
    </div>

    <div class="main-content padding-0">
        <p class="box__title">ایجاد مقاله جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                @include('errors')
                <form action="{{ route('posts.store') }}" class="padding-30" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <input name="title" type="text" class="text" placeholder="عنوان مقاله">
                    <input name="slug" type="text" class="text text-left " placeholder="نام انگلیسی مقاله">
                    <label> دسته بندی
                        <select name="categories[]" class="tags" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود بنر دوره</span>
                            <input type="file" class="file-upload" id="files" accept="image/*" name="banner"/>
                        </div>
                        <span class="filesize"></span>
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    </div>
                    <textarea placeholder="متن مقاله" id="editor" class="text" name="body"></textarea>
                    <button class="btn btn-webamooz_net">ایجاد مقاله</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{ asset('blog/panel/js/tagsInput.js') }}"></script>

    </x-slot>
</x-panel-layout>
