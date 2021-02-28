<div class="comments__list">
    <div id="comment-{{ $comment->id }}">
        <div class="comments__box">
            <div class="comments__inner">
                <div class="comments__header">
                    <div class="comments__row">
                        <div class="d-flex flex-grow-1">
                            <div class="comments__avatar">
                                <img src="{{ $comment->user->getProfileUrl() }}" height="50">
                            </div>
                            <div class="comments__details">
                                <h5 class="comments__author"><span
                                        class="comments__author-name">{{ $comment->user->name }}</span>
                                </h5>
                                <span class="comments_date">{{ $comment->created_at->diffForHumans() }} </span>
                            </div>
                        </div>
                        <a href="#comments" class="btn btn--blue btn--shadow-blue btn--comments-reply"
                           onclick="replyComment({{ $comment->id }})">ارسال
                            پاسخ</a>
                    </div>
                </div>
                <p class="comments__body">
                    {{ $comment->content }}

                </p>
            </div>
            @if($comment->approvedReplies->count() > 0)
                <div class="comments__subset">
                    @foreach($comment->approvedReplies as $replay)
                        @include('comments.comment',['comment'=>$replay])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
