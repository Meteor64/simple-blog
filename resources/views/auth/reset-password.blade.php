<x-app-layout>
    <x-slot name="title">
        - تغییر رمز عبور
    </x-slot>
    <main class="bg--white">
        <div class="container">
            <div class="sign-page">
                <h1 class="sign-page__title">تغییر رمز عبور</h1>
                @include('errors')

                <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <input type="email" name="email" class="text text--left" placeholder="ایمیل"
                           value="{{ $request->email }}">

                    <input type="password" name="password" class="text text--left" placeholder="کلمه عبور جدید">

                    <input type="password" name="password_confirmation" class="text text--left" placeholder="تایید کلمه عبور">

                    <button class="btn btn--blue btn--shadow-blue width-100 ">تغییر کلمه عبور</button>
                    <div class="sign-page__footer">
                        <span>کاربر جدید هستید؟</span>
                        <a href="{{ route('register') }}" class="color--46b2f0">صفحه ثبت نام</a>

                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>

