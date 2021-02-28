<x-panel-layout>
    <x-slot name="title">
        مدیریت نظرات
    </x-slot>

    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('comments.index') }}" class="is-active"> نظرات</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item  @if(!isset($_GET['status']))  is-active @endif"
                   href="{{ route('comments.index') }}">
                    همه نظرات</a>
                <a class="tab__item @if(isset($_GET['status']) and $_GET['status'] == 0)  is-active @endif"
                   href="{{ route('comments.index',['status'=>0]) }}">نظرات تاییده نشده</a>
                <a class="tab__item  @if(isset($_GET['status']) and $_GET['status'] == 1)  is-active @endif"
                   href="{{ route('comments.index',['status'=>1]) }}">نظرات تاییده شده</a>
            </div>
        </div>


        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>ارسال کننده</th>
                    <th>برای</th>
                    <th>دیدگاه</th>
                    <th>تاریخ</th>
                    <th>تعداد پاسخ ها</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr role="row">
                        <td><a href="">{{ $comment->id }}</a></td>
                        <td><a href="">{{ $comment->user->name }}</a></td>
                        <td><a href=""> {{ $comment->post->title }}</a></td>
                        <td>{{ mb_substr( $comment->content,0,50)  }}</td>
                        <td>{{ \App\Utility\Utility::jalaliDate($comment->created_at) }}</td>
                        <td>{{ $comment->replies_count }}</td>
                        <td class="{{ $comment->is_approved ? 'text-success' : 'text-error' }}">
                            {{ $comment->getStringApproved() }}</td>
                        <form action="{{ route('comments.update',$comment) }}" method="post">
                            @csrf
                            @method('PUT')
                            <td>

                                <a href="" class="item-delete mlg-15" title="حذف"
                                   onclick="destroyItem(event,{{ $comment->id }})"></a>
                                <a href="{{ route('comments.show',$comment) }}" target="_blank" class="item-eye mlg-15"
                                   title="مشاهده"></a>

                                @if($comment->is_approved)
                                    <button class="item-reject mlg-15 cursor-pointer bg-white"
                                            title="رد"></button>
                                @else
                                    <button class="item-confirm mlg-15 cursor-pointer bg-white"
                                            title="تایید"></button>
                                @endif


                            </td>
                        </form>
                    </tr>
                    <form action="{{ route('comments.destroy',$comment) }}" method="post"
                          id="destroy-{{ $comment->id }}">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach

                </tbody>
            </table>
        </div>
        {{ $comments->appends(request()->query())->links() }}
    </div>

</x-panel-layout>
