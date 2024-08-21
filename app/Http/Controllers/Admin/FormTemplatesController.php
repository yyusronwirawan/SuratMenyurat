<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormTemplates;
use App\Models\FormType;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FormTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $formTemplates = FormTemplates::orderBy('status')
            ->orderBy('type_id')
            ->orderBy('sort_order')
            ->orderBy('template_name')->get();
        $formType = FormType::where('status', 'Active')
            ->orderBy('name')
            ->get();
        return view('admin.sipa.jenisborang.index')
            ->with(compact('formType'))
            ->with(compact('formTemplates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'upload_file' => ['required', 'mimes:pdf,xlsx,xls,docx,doc'],
            'template_name' => ['required', 'regex:/^[^\/\*\|:"\'<>?\$%]+$/'],
            'type_id' => 'required',
        ]);
        try {
            $data = $request->all();
            [$url, $size] = FileUploadService::uploadTemplates($request, null);
            $data['url_file'] = $url;
            $data['size_file'] = $size;
            $data['status'] = 'Active';
            $data['created_by'] = auth()->user()->id;
            FormTemplates::create($data);

            return redirect()->route('jenis-borang.index')->with('success', 'Jenis Form created successfully.');
        } catch (Exception $e) {
            return redirect()->route('jenis-borang.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormTemplates  $formTemplates
     * @return \Illuminate\Http\Response
     */
    public function show(FormTemplates $formTemplates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormTemplates  $formTemplates
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $formTemplate = FormTemplates::find($id);
        $formTemplates = FormTemplates::orderBy('status')
            ->orderBy('type_id')
            ->orderBy('sort_order')
            ->orderBy('template_name')->get();
        $formType = FormType::where('status', 'Active')
            ->orderBy('name')
            ->get();
        return view('admin.sipa.jenisborang.index')
            ->with(compact('formType'))
            ->with(compact('formTemplate'))
            ->with(compact('formTemplates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormTemplates  $formTemplates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'upload_file' => 'mimes:pdf,xlsx,xls,docx,doc',
            'template_name' =>  ['required', 'regex:/^[^\/\*\|:"\'<>?\$%]+$/'],
            'type_id' => 'required',
        ]);
        try {
            $formTemplate = FormTemplates::find($id);
            $data = $request->all();
            [$url, $size] = FileUploadService::uploadTemplates($request, $formTemplate->url_file);
            if ($url != null) {
                $data['url_file'] = $url;
                $data['size_file'] = $size;
            }
            $data['status'] = 'Active';
            $data['updated_by'] = auth()->user()->id;
            $formTemplate->update($data);

            return redirect()->route('jenis-borang.index')->with('success', 'Jenis From updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('jenis-borang.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormTemplates  $formTemplates
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        FormTemplates::find($id)->update([
            'status' => 'InActive',
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('jenis-borang.index')->with('success', 'Jenis form InActive successfully.');
    }
}
