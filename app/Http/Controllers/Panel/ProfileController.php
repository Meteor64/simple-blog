<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\ProfileUpdateRequest;
use App\Models\User;
use App\Utility\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        return view('panel.users.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if ($request->get('password') != null) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        if ($request->has('profile_img')) {
            $file_name = UploadImage::upload($request->profile_img, $user->profile_img);
            $data['profile_img'] = $file_name;
        }
        try {
            $user->update($data);
            return back()->with('success', 'اطلاعات پروفایل با موفقیت بروزرسانی شد.');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
