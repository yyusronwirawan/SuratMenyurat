<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileUploadService
{
    public static function uploadProfile($request, $user)
    {
        if ($file = $request->file('upload_file')) {
            $publicPath = "file/avatars";
            $title = str_replace(' ', '-', $user->first_name);
            $fileName = $title . '-' . time() . '.' . $file->extension();
            $file->move($publicPath, $fileName);
            if ($user->img_url) {
                File::delete($user->img_url);
            }
            return $publicPath . "/" . $fileName;
        }
        return null;
    }
    public static function uploadFileBerita($request, $imgUrl)
    {
        if ($file = $request->file('upload_file')) {
            $publicPath = "file/berita-dashboard";
            $title = Str::uuid();
            $fileName = $title . '-' . time() . '.' . $file->extension();
            $file->move($publicPath, $fileName);
            if ($imgUrl) {
                File::delete($imgUrl);
            }
            return $publicPath . "/" . $fileName;
        }
        return null;
    }

    public static function uploadTemplates($request, $imgUrl)
    {
        if ($file = $request->file('upload_file')) {
            $publicPath = "file/template-surat";
            $template_name = str_replace(' ', '-', $request->template_name);
            $fileName = $template_name . '-' . time() . '.' . $file->extension();
            $url = $publicPath . "/" . $fileName;
            $size = $file->getSize();

            $file->move($publicPath, $fileName);
            if ($imgUrl) {
                File::delete($imgUrl);
            }
            return [$url, $size];
        }
        return [null, null];
    }

    public static function uploadPengajuan($request, $user, $formTemplate, $dateNow, $imgUrl)
    {
        $formattedDate = $dateNow->format('Ym');
        $publicPath = "file/pengajuan-surat/" . $formattedDate . "/" . $user->id;
        if ($file = $request->file('upload_file')) {
            $concatName = ($user->first_name . '-' . $user->last_name . '-' . $formTemplate->template_name);
            $template_name = str_replace(' ', '-', $concatName);
            $fileName = $template_name . '-' . time() . '.' . $file->extension();
            $url = $publicPath . "/" . $fileName;
            $size = $file->getSize();
            $file->move($publicPath, $fileName);
            if ($imgUrl) {
                File::delete($imgUrl);
            }
            return [$url, $size];
        }
        return [null, null];
    }
    public static function uploadPengajuanApprove($request, $formSubmission, $dateNow)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $dateNow);
        $formattedDate = $date->format('Ym');
        if ($file = $request->file('upload_file')) {
            $path = $formSubmission->url_file;
            if ($path) {
                $publicPath = dirname($path);
                $filenameWithoutExtension = pathinfo($path, PATHINFO_FILENAME);
                $fileName = $filenameWithoutExtension . '-Approve.' . $file->extension();
                $url = $publicPath . "/" . $fileName;
            } else {
                $publicPath = "file/pengajuan-surat/" . $formattedDate . "/"  . $formSubmission->user()->id;
                $concatName = ($formSubmission->user()->first_name . '-' . $formSubmission->user()->last_name . '-' . $formSubmission->formTemplate()->template_name);
                $template_name = str_replace(' ', '-', $concatName);
                $fileName = $template_name . '-' . $date->timestamp . '-Approve.' . $file->extension();
                $url = $publicPath . "/" . $fileName;
            }
            $size = $file->getSize();
            $file->move($publicPath, $fileName);
            return [$url, $size];
        }
        return [null, null];
    }
}
