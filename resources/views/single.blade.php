<x-app-layout>
    <x-slot name="title">
        - {{ $post->title }}
    </x-slot>
    <main>
        <div class="container article">
            <article class="single-page">
                <div class="breadcrumb">
                    <ul class="breadcrumb__ul">
                        <li class="breadcrumb__item">
                            <a href="{{ route('landing') }}" class="breadcrumb__link" title="خانه">بخش مقالات</a>
                        </li>
                        <li class="breadcrumb__item"><a href="{{ route('post.show',$post->slug) }}"
                                                        class="breadcrumb__link"
                                                        title="{{ $post->title }}">{{ $post->title }}</a></li>
                    </ul>
                </div>
                <div class="single-page__title">
                    <h1 class="single-page__h1">{{ $post->title }}</h1>
                    @auth()
                        <span class="single-page__like @if($post->is_user_liked) single-page__like--is-active @endif"
                              onclick="doLike($(this))"></span>
                    @endauth
                </div>
                <div class="single-page__details">
                    <div class="single-page__author">نویسنده : {{ $post->user->name }}</div>
                    <div class="single-page__date">تاریخ
                        : {{ \App\Utility\Utility::jalaliDate($post->created_at) }}</div>
                </div>
                <div class="single-page__img">
                    <img class="single-page__img-src" src="{{ $post->getBannerUrl() }}" alt="">
                </div>
                <div class="single-page__content">
                    {!!  $post->body !!}

                    <div class="single-page__tags">
                        <ul class="single-page__tags-ul">
                            @foreach($post->categories as $postCategory)
                                <li class="single-page__tags-li">
                                    <a href="{{ route('categoryPost.show',$postCategory->slug) }}"
                                       class="single-page__tags-link">
                                        {{ $postCategory->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>


            </article>
        </div>
        <div class="container">
            <div class="comments" id="comments">
                @auth()
                    <div class="comments__send">
                        <div class="comments__title">
                            <h3 class="comments__h3"> دیدگاه خود را بنویسید </h3>
                            <span class="comments__count">  نظرات ( {{ $post->comments_count }} ) </span>
                        </div>
                        @include('errors')
                        <form action="{{ route('comment.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="comment_id" value="" id="reply_id">
                            <textarea name="content" class="comments__textarea" placeholder="بنویسید"
                                      id="comment_form"></textarea>
                            <button class="btn btn--blue btn--shadow-blue">ارسال نظر</button>
                            <button class="btn btn--red btn--shadow-red">انصراف</button>
                        </form>
                    </div>
                @else
                    <div class="alert-warning text-center padding-20 border-radius-3"><p>برای ارسال نظر باید وارد سایت
                            شوید.</p></div>
                @endauth
                @foreach($post->comments as $comment)
                    @include('comments.comment',['comment'=>$comment])
                @endforeach
            </div>
        </div>
    </main>
    <x-slot name="scripts">
        <script>
            function replyComment(id) {
                document.getElementById('reply_id').value = id;
                document.getElementById('comment_form').focus();
            }

            function doLike(tag) {

                fetch('{{ route("like.store",$post->slug) }}', {
                    method: 'post',
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }
                }).then((response) => {
                    if (response.ok) {
                        tag.toggleClass("single-page__like--is-active");
                    } else {
                        alert('تکرار بیش از حد');
                    }
                })

            }
        </script>
    </x-slot>
</x-app-layout>
