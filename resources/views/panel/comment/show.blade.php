<x-panel-layout>
    <x-slot name="title">
        نمایش نظرات
    </x-slot>

    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('comments.index') }}" class=""> نظرات</a></li>
            <li><a href="{{ route('comments.show',$comment) }}" class="is-active"> مشاهده نظر</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="show-comment">
            <div class="ct__header">
                <div class="comment-info">
                    <a class="back" href="comments.html"></a>
                    <div>
                        <p class="comment-name"><a href="">{{ $comment->post->title }}</a></p>
                    </div>
                </div>
            </div>
            <div class="transition-comment">
                <div class="transition-comment-header">
                       <span>
                            <img src="img/profile.jpg" class="logo-pic">
                       </span>
                    <span class="nav-comment-status">
                            <p class="username">
                                {{ $comment->user->getPersianRole() }} : {{ $comment->user->name }}
                            </p>
                            <p class="comment-date">
                                {{ \App\Utility\Utility::vertaDifference($comment->created_at)  }}
                            </p>
                    </span>
                    <div>

                    </div>
                </div>
                <div class="transition-comment-body">
                    <pre>{{ $comment->content }}</pre>
                    <div>
                    </div>
                </div>
            </div>
            @if(isset($comment->replies))
                @foreach($comment->replies as $answer)
                    <div class="transition-comment is-answer">
                        <div class="transition-comment-header">
                       <span>
                                         <img src="img/profile.jpg" class="logo-pic">
                       </span>
                            <span class="nav-comment-status">
                            <p class="username"> {{ $answer->user->getPersianRole() }} : {{ $answer->user->name }}</p>
                            <p class="comment-date">
                                {{ \App\Utility\Utility::vertaDifference($answer->created_at)  }}
                            </p>
                    </span>
                            <div>

                            </div>
                        </div>
                        <div class="transition-comment-body">
                            <pre>{{ $answer->content }}</pre>
                            <div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="answer-comment">
            <p class="p-answer-comment">ارسال پاسخ</p>
            @include('errors')
            <form action="{{ route('comments.store') }}" method="post">
                @csrf
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <input type="hidden" name="post_id" value="{{ $comment->post->id }}">
                <textarea name="content" class="textarea" placeholder="متن پاسخ نظر"></textarea>
                <button class="btn btn-webamooz_net">ارسال پاسخ</button>
            </form>
        </div>
    </div>

</x-panel-layout>
