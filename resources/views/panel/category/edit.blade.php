<x-panel-layout>
    <x-slot name="title">
        ویرایش دسته بندی
    </x-slot>

    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('categories.index') }}" class="is-active">ویرایش دسته بندی </a></li>
        </ul>
    </div>
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">

                @include('errors')
                <form action="{{ route('categories.update',$category) }}" method="post" class="padding-30">
                    @csrf
                    @method('PUT')
                    <input name="name" type="text" placeholder="نام دسته بندی" class="text"
                           value="{{ $category->name }}">
                    <input name="link" type="text" placeholder="لینک دسته بندی" class="text"
                           value="{{ $category->link }}">
                    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                    <select name="parent_id" class="select">
                        <option value="">ندارد</option>
                        @foreach($parentsCategory as $parent)
                            <option value="{{ $parent->id }}"
                                    @if($category->parent_id == $parent->id) selected @endif>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-webamooz_net">ویرایش</button>
                </form>
            </div>
        </div>
    </div>

</x-panel-layout>
