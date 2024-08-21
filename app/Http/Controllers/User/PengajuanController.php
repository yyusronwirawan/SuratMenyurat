<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FormTemplates;
use App\Models\StudyProgram;
use App\Models\FormSubmission;
use App\Models\User;
use App\Services\FileUploadService;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;


class PengajuanController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $departments = Department::where('status', 'Active')
            ->orderBy('department_name')
            ->get();
        $programStudi = StudyProgram::where('status', 'Active')
            ->orderBy('study_program_name')
            ->get();
        $formTemplates = FormTemplates::where('status', 'Active')
            ->orderBy('template_name')
            ->get();
        return view('user.sipa.pengajuan.index')
            ->with(compact('user'))
            ->with(compact('departments'))
            ->with(compact('programStudi'))
            ->with(compact('formTemplates'));
    }

    public function getProgramStudi($departmentId)
    {
        $programStudi = StudyProgram::where('department_id', $departmentId)
            ->where('status', 'Active')
            ->orderBy('study_program_name')
            ->get();
        return response()->json($programStudi);
    }

    public function store(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate([
            'upload_file' => ['required', 'mimes:pdf', 'max:3000'],
            'form_template_id' => 'required',
        ]);
        $formTemplate = FormTemplates::find($request->form_template_id);
        try {
            $dateNow = new DateTime();
            $data = $request->all();
            if ($request->action == 'Sent') {
                $data['submission_date'] = $dateNow;
                $today = Carbon::today();
                $totalSurat = FormSubmission::where('user_id', $user->id)
                    ->whereDate('submission_date', $today->toDateString())->count();
                if ($totalSurat >= 3) {
                    return redirect()->route('pengajuan.riwayat')->with('error', 'Anda sudah mencapai limit pengajuan (3 kali sehari)');
                }
            }
            [$url, $size] = FileUploadService::uploadPengajuan($request, $user, $formTemplate, $dateNow, null);
            if ($url != null) {
                $data['url_file'] = $url;
                $data['size_file'] = $size;
            }
            $data['user_id'] = $user->id;
            $data['form_status'] = $request->action;
            $data['created_by'] = $user->id;
            $data['department_id'] = $user->department_id;
            $data['study_program_id'] = $user->study_program_id;
            FormSubmission::create($data);

            return redirect()->route('pengajuan.riwayat')->with('success', 'Pengajuan created successfully.');
        } catch (Exception $e) {
            return redirect()->route('pengajuan.riwayat')->with('error', $e->errorInfo[2]);
        }
    }

    public function riwayat()
    {
        $user = User::find(auth()->user()->id);
        $formSubmission = FormSubmission::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.sipa.pengajuan.riwayat')
            ->with(compact('formSubmission'));
    }

    public function preview($id)
    {
        $user = User::find(auth()->user()->id);
        $formSubmission = FormSubmission::find($id);
        return view('user.sipa.pengajuan.preview')
            ->with(compact('formSubmission'));
    }

    public function edit($id)
    {
        $user = User::find(auth()->user()->id);
        $departments = Department::where('status', 'Active')
            ->orderBy('department_name')
            ->get();
        $programStudi = StudyProgram::where('status', 'Active')
            ->orderBy('study_program_name')
            ->get();
        $formTemplates = FormTemplates::where('status', 'Active')
            ->orderBy('template_name')
            ->get();
        $formSubmission = FormSubmission::find($id);
        return view('user.sipa.pengajuan.index')
            ->with(compact('user'))
            ->with(compact('departments'))
            ->with(compact('programStudi'))
            ->with(compact('formTemplates'))
            ->with(compact('formSubmission'));
    }
    public function update(Request $request, $id)
    {
        $formSubmission = FormSubmission::find($id);
        if ($formSubmission->form_status != 'Draft' &&  $formSubmission->form_status != 'Revisi') {
            return redirect()->route('pengajuan.riwayat')->with('error', 'Pengajuan ' . $formSubmission->form_status . ' tidak dapat diedit!');
        }
        $user = User::find(auth()->user()->id);
        $request->validate([
            'upload_file' => 'mimes:pdf|max:3000', // max size in kilobytes (3 MB = 3000 KB)
            'form_template_id' => 'required',
        ]);
        $formTemplate = FormTemplates::find($request->form_template_id);
        try {
            $dateNow = new DateTime();
            $data = $request->all();
            if ($request->action == 'Sent') {
                $data['submission_date'] = $dateNow;
                $today = Carbon::today();
                $totalSurat = FormSubmission::where('user_id', $user->id)
                    ->whereDate('submission_date', $today->toDateString())->count();
                if ($totalSurat >= 3) {
                    return redirect()->route('pengajuan.riwayat')->with('error', 'Anda sudah mencapai limit pengajuan (3 kali sehari)');
                }
            } else if ($request->action == 'Draft') {
                $data['submission_date'] = null;
            }
            [$url, $size] = FileUploadService::uploadPengajuan($request, $user, $formTemplate, $dateNow, $formSubmission->url_file);
            if ($url != null) {
                $data['url_file'] = $url;
                $data['size_file'] = $size;
            }
            $data['user_id'] = $user->id;
            $data['department_id'] = $user->department_id;
            $data['study_program_id'] = $user->study_program_id;
            $data['form_status'] = $request->action;
            $data['updated_by'] = auth()->user()->id;
            $formSubmission->update($data);

            return redirect()->route('pengajuan.riwayat')->with('success', 'Pengajuan updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('pengajuan.riwayat')->with('error', $e->errorInfo[2]);
        }
    }
    public function sent($id)
    {
        $user = User::find(auth()->user()->id);
        $formSubmission = FormSubmission::find($id);
        if ($formSubmission->form_status != 'Draft') {
            return redirect()->route('pengajuan.riwayat')->with('error', 'Pengajuan ' . $formSubmission->form_status . ' tidak dapat diedit!');
        }
        $today = Carbon::today();
        $totalSurat = FormSubmission::where('user_id', $user->id)
            ->whereDate('submission_date', $today->toDateString())->count();
        if ($totalSurat >= 3) {
            return redirect()->route('pengajuan.riwayat')->with('error', 'Anda sudah mencapai limit pengajuan (3 kali sehari)');
        }
        $data['submission_date'] = new DateTime();
        $data['form_status'] = "Sent";
        $data['updated_by'] = auth()->user()->id;
        $formSubmission->update($data);
        return redirect()->route('pengajuan.riwayat')->with('success', 'Kirim pengajuan successfully.');
    }
    public function cancel($id)
    {
        $formSubmission = FormSubmission::find($id);
        if ($formSubmission->form_status != 'Draft') {
            return redirect()->route('pengajuan.riwayat')->with('error', 'Pengajuan ' . $formSubmission->form_status . ' tidak dapat diedit!');
        }
        $data['form_status'] = "Cancel";
        $data['updated_by'] = auth()->user()->id;
        $formSubmission->update($data);
        return redirect()->route('pengajuan.riwayat')->with('success', 'Cancel pengajuan successfully.');
    }

    public function templateSurat($id)
    {
        if ($id == 'akademik') {
            $titleForm = "Form Akademik";
            $formTemplates = FormTemplates::where('status', 'Active')
                ->where('type_id', "=", 'FT01')
                ->orderBy('type_id')
                ->orderBy('sort_order')
                ->orderBy('template_name')
                ->get();
            return view('user.sipa.pengajuan.template-akademik')
                ->with(compact('titleForm'))
                ->with(compact('formTemplates'));
        } else {
            $titleForm = "Form Pendaftaran Skripsi/Tesis dan Promosi";
            $formTemplates = FormTemplates::where('status', 'Active')
                ->where('type_id', "!=", 'FT01')
                ->orderBy('type_id')
                ->orderBy('sort_order')
                ->orderBy('template_name')
                ->get();
            return view('user.sipa.pengajuan.template-akademik')
                ->with(compact('titleForm'))
                ->with(compact('formTemplates'));
        }
    }
}
