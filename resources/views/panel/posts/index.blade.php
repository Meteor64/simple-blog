<x-panel-layout>
    <x-slot name="title">
        مدیریت مقالات
    </x-slot>

    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('posts.index') }}" class="is-active"> مقالات</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('posts.index') }}">لیست مقالات</a>
                <a class="tab__item " href="{{ route('posts.create') }}">ایجاد مقاله جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="{{ route('posts.index') }}">
                    <div class="t-header-searchbox font-size-13">
                        <div type="text" class="text search-input__box font-size-13">جستجوی مقاله
                            <div class="t-header-search-content ">
                                <input type="text" class="text" placeholder="نام مقاله" name="search"
                                       value="{{ request()->get('search') ?request()->get('search') : '' }}">
                                <input type="submit" value="جستجو" class="btn btn-webamooz_net"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>عنوان</th>
                    <th>نویسنده</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr role="row" class="">
                        <td><a href="">{{ $post->id }}</a></td>
                        <td><a href="">{{ $post->title }}</a></td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ \App\Utility\Utility::jalaliDate($post->created_at) }}</td>
                        <td>
                            <a href="" class="item-delete mlg-15" title="حذف"
                               onclick="destroyItem(event,{{ $post->id }})">
                            </a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="{{ route('posts.edit',$post) }}" class="item-edit" title="ویرایش"></a>
                        </td>
                    </tr>
                    <form action="{{ route('posts.destroy',$post) }}" method="post"
                          id="destroy-{{ $post->id }}">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $posts->appends(request()->query())->links() }}

    </div>

</x-panel-layout>
