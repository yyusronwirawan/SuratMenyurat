<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormType;
use Illuminate\Http\Request;

class FormTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $formTypes = FormType::orderBy('status')->orderBy('name')->get();
        return view('admin.sipa.tipeborang.index', compact('formTypes'));
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
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = 'Active';
        $data['created_by'] = auth()->user()->id;
        FormType::create($data);

        return redirect()->route('tipe-borang.index')->with('success', 'Tipe form created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormType  $formType
     * @return \Illuminate\Http\Response
     */
    public function show(FormType $formType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormType  $formType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $formType = FormType::find($id);

        $formTypes = FormType::orderBy('status')->orderBy('name')->get();
        return view('admin.sipa.tipeborang.index')->with(compact('formType'))->with(compact('formTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormType  $formType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['status'] = 'Active';
        $data['updated_by'] = auth()->user()->id;
        FormType::find($id)->update($data);

        return redirect()->route('tipe-borang.index')->with('success', 'Tipe form updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormType  $formType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        FormType::find($id)->update([
            'status' => 'InActive',
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('tipe-borang.index')->with('success', 'Tipe form InActive successfully.');
    }
}
