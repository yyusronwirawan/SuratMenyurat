<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FormSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class AdminController extends Controller
{
    public function adminHome()
    {
        $departments = Department::where('status', 'Active')->orderBy('department_name')->get();
        $user = auth()->user();
        return view('admin.sipa.index')
            ->with(compact('departments'))
            ->with(compact('user'));
    }


    public function getDataHome(Request $request, $departmentId)
    {
        $dataHome = new \stdClass();
        if ($departmentId == 0) {
            $dataHome->totalSubmission = FormSubmission::count();
            $dataHome->sent = FormSubmission::where('form_status', 'Sent')->count();
            $dataHome->reviewed = FormSubmission::where('form_status', 'Reviewed')->count();
            $dataHome->reject = FormSubmission::where('form_status', 'Reject')->count();
            $dataHome->finished = FormSubmission::where('form_status', 'Finished')->count();

            $urlFile = FormSubmission::whereNotNull('url_file')->count();
            $urlSignedFile = FormSubmission::whereNotNull('signed_file')->count();
            $dataHome->totalFile = $urlFile + $urlSignedFile;

            $sizeFile = FormSubmission::whereNotNull('size_file')->sum('size_file');
            $sizeSignedFile = FormSubmission::whereNotNull('signed_size_file')->sum('signed_size_file');
            $dataHome->totalSizeFile = $this->bytesToMB($sizeFile + $sizeSignedFile);
            $dataHome->totalSizeFileGb = $this->bytesToGB($sizeFile + $sizeSignedFile);
            $dataHome->totalUser = User::count();
        } else {
            $dataHome->totalSubmission = FormSubmission::where('department_id', $departmentId)->count();
            $dataHome->sent = FormSubmission::where('form_status', 'Sent')->where('department_id', $departmentId)->count();
            $dataHome->reviewed = FormSubmission::where('form_status', 'Reviewed')->where('department_id', $departmentId)->count();
            $dataHome->reject = FormSubmission::where('form_status', 'Reject')->where('department_id', $departmentId)->count();
            $dataHome->finished = FormSubmission::where('form_status', 'Finished')->where('department_id', $departmentId)->count();

            $urlFile = FormSubmission::whereNotNull('url_file')->where('department_id', $departmentId)->count();
            $urlSignedFile = FormSubmission::whereNotNull('signed_file')->where('department_id', $departmentId)->count();
            $dataHome->totalFile = $urlFile + $urlSignedFile;

            $sizeFile = FormSubmission::whereNotNull('size_file')->where('department_id', $departmentId)->sum('size_file');
            $sizeSignedFile = FormSubmission::whereNotNull('signed_size_file')->where('department_id', $departmentId)->sum('signed_size_file');
            $dataHome->totalSizeFile = $this->bytesToMB($sizeFile + $sizeSignedFile);
            $dataHome->totalSizeFileGb = $this->bytesToGB($sizeFile + $sizeSignedFile);
            $dataHome->totalUser = User::where('department_id', $departmentId)->count();
        }

        return response()->json($dataHome);
    }

    function bytesToMB($bytes, $decimals = 0)
    {
        return number_format($bytes / (1024 * 1024), $decimals) . ' MB';
    }

    function bytesToGB($bytes, $decimals = 2)
    {
        return number_format($bytes / (1024 * 1024 * 1024), $decimals) . ' GB';
    }
}
