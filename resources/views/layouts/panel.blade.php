<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل وبلاگ - {{ $title  ?? "Panel" }}</title>
    <link rel="stylesheet" href="{{asset('blog/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/responsive_991.css') }}" media="(max-width:991px)">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/responsive_768.css') }}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/font.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    {{ $styles ?? '' }}
</head>
<body>
<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://webamooz.net"></a>
    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img src="{{ asset('images/profile/'.auth()->user()->profile_img) }}"
                                      class="avatar___img">
            <input type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
    </div>
    <div class="profile_meta">
        <span class="profile__name">کاربر : {{ auth()->user()->name }}</span>
        <span class="profile__name">نقش کاربری : {{ auth()->user()->getPersianRole() }}</span>
    </div>

    @include('_partials.panel.sidebar')

</div>
<div class="content">
    <div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
        <div class="header__right d-flex flex-grow-1 item-center">
            <span class="bars"></span>
            <a class="header__logo" href="https://webamooz.net"></a>
        </div>
        <div class="header__left d-flex flex-end item-center margin-top-2">
            <a href="{{ route('logout') }}" class="logout" title="خروج"
               onclick=" document.getElementById('logout-form').submit();return false;"></a>
            <form action="{{ route('logout') }}" method="post" id="logout-form">
                @csrf
            </form>
        </div>
    </div>
    {{ $slot }}
</div>
<script src="{{ asset('blog/panel/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{ asset('blog/panel/js/js.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{--CKeditor--}}
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        'language': 'fa',
        filebrowserUploadUrl: '{{ route("editor.upload",["_token"=> @csrf_token() ]) }}',
        filebrowserUploadMethod: 'form',

    });
</script>
{{ $scripts ?? '' }}
<script src="{{ asset('blog/panel/js/custom.js')}}"></script>

{{--Show Alert--}}
@include('_partials.session')

</body>

</html>
