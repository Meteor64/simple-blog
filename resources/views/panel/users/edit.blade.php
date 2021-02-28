<x-panel-layout>
    <x-slot name="title">
        - ویرایش کاربر
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{ route('users.index') }}" class="">کاربران</a></li>
            <li><a href="{{ route('users.edit',1) }}" class="is-active">ویرایش کاربران </a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters  bg-white">
            <div class="col-12">
                <p class="box__title">ویرایش کاربر</p>
                @include('errors')
                <form action="{{ route('users.update',$user) }}" class="padding-30" method="post">
                    @csrf
                    @method('put')

                    <input name="name" type="text" class="text" value="{{ $user->name }}"
                           placeholder="نام و نام خانوادگی">
                    <input name="email" type="text" class="text" value="{{ $user->email }}" placeholder="ایمیل">
                    <input name="mobile" type="text" class="text" value="{{ $user->mobile }}"
                           placeholder="شماره موبایل">
                    <select name="role" class="select">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : ''  }}>کاربر عادی</option>
                        <option value="author" {{ $user->role == 'author' ? 'selected' : ''  }}>نویسنده</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : ''  }}>مدیر</option>
                    </select>
                    <button class="btn btn-webamooz_net">ویرایش</button>
                </form>

            </div>
        </div>
    </div>

</x-panel-layout>
