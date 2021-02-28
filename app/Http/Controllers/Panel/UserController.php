<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\CreateUserRequest;
use App\Http\Requests\Panel\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(10);
        return view('panel.users.index', compact('users'));
    }


    public function create()
    {
        return view('panel.users.create');
    }


    public function store(CreateUserRequest $request)
    {

        $data = $request->validated();
        $data['password'] = Hash::make('password');
        User::create($data);
        $request->session()->flash('success','کاربر جدید با موفقیت ایجاد شد.');
        return redirect()->route('users.index');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        return view('panel.users.edit', compact('user'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {

        $user->update($request->validated());
//        $request->session()->flash('success','کاربر جدید با موفقیت ایجاد شد.');
        return redirect()->route('users.index')->with('success','کاربر با موفقیت بروزرسانی شد.');

    }


    public function destroy(User $user)
    {
        try {
            $user->delete();
            return back()->with('success','کاربر مورد نظر با موفقیت حذف شد.');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
