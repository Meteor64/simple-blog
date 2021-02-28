<?php


namespace App\Utility;


class UploadImage
{
    public static function upload($image,$oldImage = null): string
    {
//        $base_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $ext = $image->getClientOriginalExtension();
        $file_name = uniqid() . '.' . $ext;
        if ($oldImage != null){
            (new UploadImage)->deleteOldImage($oldImage);
        }
        $image->storeAs('images/profile', $file_name, 'public_files');
        return $file_name;
    }

    private function deleteOldImage($ImageName)
    {
        $oldImage = public_path('images/profile/' . $ImageName);
        if (file_exists($oldImage)) {
            unlink($oldImage);
        }
    }
}
