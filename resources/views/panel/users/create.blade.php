<x-panel-layout>
    <x-slot name="title">
        - ایجاد کاربر
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{ route('users.index') }}" class="">کاربران</a></li>
            <li><a href="{{ route('users.create') }}" class="is-active">ایجاد کاربر جدید</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters  bg-white">
            <div class="col-12">
                <p class="box__title">ایجاد کاربر</p>
                @include('errors')
                <form action="{{ route('users.store') }}" class="padding-30" method="post">
                    @csrf
                    <input name="name" type="text" class="text" placeholder="نام و نام خانوادگی">
                    <input name="email" type="text" class="text" placeholder="ایمیل">
                    <input name="mobile" type="text" class="text" placeholder="شماره موبایل">
                    <select name="role" class="select">
                        <option value="user" selected>کاربر عادی</option>
                        <option value="author">نویسنده</option>
                        <option value="admin">مدیر</option>
                    </select>
                    <button class="btn btn-webamooz_net">ایجاد</button>
                </form>

            </div>
        </div>
    </div>
</x-panel-layout>
