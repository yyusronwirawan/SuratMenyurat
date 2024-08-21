<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $studyPrograms = StudyProgram::orderBy('status')->orderBy('study_program_name')->get();
        $departments = Department::where('status', 'Active')
            ->orderBy('department_name')
            ->get();
        return view('admin.sipa.programstudi.index')->with(compact('studyPrograms'))->with(compact('departments'));
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
            'study_program_code' => [
                'required',
                Rule::unique('study_programs', 'study_program_code')->ignore($request->study_program_code),
            ],
            'study_program_name' => 'required',
            'department_id' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = 'Active';
        $data['created_by'] = auth()->user()->id;
        StudyProgram::create($data);

        return redirect()->route('program-studi.index')->with('success', 'Program Studi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudyProgram  $StudyProgram
     * @return \Illuminate\Http\Response
     */
    public function show(StudyProgram $StudyProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudyProgram  $StudyProgram
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $studyProgram = StudyProgram::find($id);
        $studyPrograms = StudyProgram::orderBy('status')->orderBy('study_program_name')->get();
        $departments = Department::where('status', 'Active')->orderBy('department_name')->get();
        return view('admin.sipa.programstudi.index')
            ->with(compact('studyProgram'))
            ->with(compact('studyPrograms'))
            ->with(compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudyProgram  $StudyProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'study_program_code' => [
                'required',
                Rule::unique('study_programs', 'study_program_code')->ignore($id),
            ],
            'study_program_name' => 'required',
            'department_id' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = 'Active';
        $data['updated_by'] = auth()->user()->id;
        StudyProgram::find($id)->update($data);

        return redirect()->route('program-studi.index')->with('success', 'Program studi updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudyProgram  $StudyProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        StudyProgram::find($id)->update([
            'status' => 'InActive',
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('program-studi.index')->with('success', 'Program Studi InActive successfully.');
    }
}
