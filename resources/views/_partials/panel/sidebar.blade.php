<ul>
    <li class="item-li i-dashboard @if(request()->is('dashboard')) is-active @endif">
        <a href="{{ route('dashboard') }}">پیشخوان</a>
    </li>
    @if(\App\Models\User::isAdmin())
        <li class="item-li i-users
@if(request()->is('panel/users') || request()->is('panel/users/*')) is-active @endif">
            <a href="{{ route('users.index') }}"> کاربران</a>
        </li>
        <li class="item-li i-categories  @if(request()->is('panel/categories')
 || request()->is('panel/categories/*')) is-active @endif">
            <a href="{{ route('categories.index') }}">دسته بندی ها</a>
        </li>
    @endif
    @if(\App\Models\User::isAdmin() || \App\Models\User::isAuthor() )
        <li class="item-li i-articles   @if(request()->is('panel/posts')
 || request()->is('panel/posts/*')) is-active @endif">
            <a href="{{ route('posts.index') }}">مقالات</a>
        </li>
    @endif
    @if(\App\Models\User::isAdmin())
        <li class="item-li i-comments  @if(request()->is('panel/comments')) is-active @endif">
            <a href="{{ route('comments.index') }}"> نظرات</a>
        </li>
    @endif
    <li class="item-li i-user__inforamtion  @if(request()->is('profile')) is-active @endif">
        <a href="{{ route('profile.edit') }}">اطلاعات کاربری</a>
    </li>
</ul>
