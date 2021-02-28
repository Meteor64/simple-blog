<x-panel-layout>
    <x-slot name="title">
        مدیریت دسته بندی ها
    </x-slot>

    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('categories.index') }}" class="is-active">دسته بندی ها</a></li>
        </ul>
    </div>
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>دسته پدر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($categories) and count($categories) > 0)
                            @foreach($categories as $category)
                                <tr role="row" class="">
                                    <td><a href="">{{ $category->id }}</a></td>
                                    <td><a href="">{{ $category->name }}</a></td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->getParentName() ?? 'ندارد' }}</td>
                                    <td>
                                        <a href="" class="item-delete mlg-15" title="حذف"
                                           onclick="destroyItem(event,{{ $category->id }})"></a>
                                        <a href="{{ route('categories.edit',$category) }}" class="item-edit "
                                           title="ویرایش"></a>
                                    </td>
                                    <form action="{{ route('categories.destroy',$category) }}" method="post"
                                          id="destroy-{{ $category->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                {{ $categories->links() }}
            </div>
            <div class="col-4 bg-white">
                <p class="box__title">
                    ایجاد دسته بندی جدید
                </p>
                @include('errors')
                <form action="{{ route('categories.store') }}" method="post" class="padding-30">
                    @csrf
                    <input name="name" type="text" placeholder="نام دسته بندی" class="text"
                           value="{{ old('name') }}">
                    <input name="slug" type="text" placeholder="نام انگلیسی دسته بندی" class="text"
                           value="{{ old('slug') }}">
                    <input name="link" type="text" placeholder="لینک دسته بندی" class="text"
                           value="{{ old('link') }}">
                    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                    <select name="parent_id" class="select">
                        <option value="" selected>ندارد</option>
                        @foreach($parentsCategory as $parent)
                            <option value="{{ $parent->id }}"
                                {{ $category->id == $parent->id ?? 'selected' }}>{{ $parent->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-webamooz_net">اضافه کردن</button>
                </form>
            </div>
        </div>
    </div>

</x-panel-layout>
