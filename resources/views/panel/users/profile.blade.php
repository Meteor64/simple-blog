<x-panel-layout>
    <x-slot name="title">
        اطلاعات کاربری
    </x-slot>

    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('profile.edit') }}" class="is-active">اطلاعات کاربری</a></li>

        </ul>
    </div>

    <div class="main-content  ">
        <div class="user-info bg-white padding-30 font-size-13">
            @include('errors')
            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="profile__info border cursor-pointer text-center">
                    <div class="avatar__img"><img src="{{ asset('images/profile/'.auth()->user()->profile_img) }}"
                                                  class="avatar___img">
                        <input type="file" name="profile_img" accept="image/*" class="hidden avatar-img__input">
                        <div class="v-dialog__container" style="display: block;"></div>
                        <div class="box__camera default__avatar"></div>
                    </div>
                    <span class="profile__name">کاربر : {{ auth()->user()->name }}</span>
                </div>
                <input class="text" name="name" placeholder="نام کاربری" value="{{ auth()->user()->name }}"
                       style="margin-top: 70px">
                <input type="tel" name="mobile" class="text text-left" placeholder="موبایل"
                       value="{{ auth()->user()->mobile }}" maxlength="11" minlength="11">
                <input type="email" name="email" class="text text-left" placeholder="ایمیل"
                       value="{{ auth()->user()->email }}">
                <input type="password" name="password" class="text text-left" placeholder="رمز عبور">
                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&*()</strong> باشد.</p>
                <br>
                <br>
                <button class="btn btn-webamooz_net">ذخیره تغییرات</button>
            </form>
        </div>

    </div>
</x-panel-layout>
