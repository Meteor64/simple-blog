<x-app-layout>
    <x-slot name="title">
        - صفحه اصلی
    </x-slot>
    <main>
        <article class="container article">
            <div class="articles">
                @forelse($posts as $post)
                    <div class="articles__item">
                        <a href="{{ route('post.show',$post->slug) }}" class="articles__link">
                            <div class="articles__img">
                                <img src="{{ $post->getBannerUrl() }}" class="articles__img-src">
                            </div>
                            <div class="articles__title">
                                <h2>{{ $post->title }} </h2>
                            </div>
                            <div class="articles__desc">
                                {!!  mb_substr($post->body,0,100,"UTF-8")."..." !!}
                            </div>
                            <div class="articles__details">
                                <div class="articles__author">نویسنده : {{ $post->user->name }}</div>
                                <div
                                    class="articles__date">{{ \App\Utility\Utility::jalaliDate($post->created_at) }}</div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>آیتمی جهت نمایش وجود ندارد!</p>
                @endforelse
            </div>
        </article>
        <div class="pagination">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    </main>
</x-app-layout>

