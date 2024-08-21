<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DashboardNews;
use App\Models\FormSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use stdClass;

class UserController extends Controller
{
    public function userHome()
    {
        $dataHome = new stdClass();
        $user = User::find(auth()->user()->id);

        $dataHome->user = $user;
        $dataHome->countRevisi = FormSubmission::where('form_status', 'Revisi')
            ->where('user_id', "=", $user->id)
            ->count();
        $dataHome->formSubmission = FormSubmission::where('user_id', $user->id)
            ->where('form_status', "!=", 'Cancel')
            ->where('form_status', "!=", 'Draft')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $dataHome->dashboardNews = DashboardNews::where('status', 'Active')->orderBy('sort_order')->get();
        return view('user.sipa.index')
            ->with(compact('dataHome'));
    }
}
