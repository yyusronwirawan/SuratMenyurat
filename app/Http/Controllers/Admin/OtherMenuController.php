<?php

namespace App\Http\Controllers\Admin;

use App\Models\OtherMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class OtherMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $otherMenus = OtherMenu::orderBy('status')->orderBy('sort_order')->get();
        return view('admin.sipa.menu.index', compact('otherMenus'));
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
        //
        $request->validate([
            'menu_name' => 'required',
            'url' => 'required',
            'sort_order' => 'required',
        ]);
        try {
            $data = $request->all();
            $data['status'] = 'Active';
            $data['created_by'] = auth()->user()->id;
            OtherMenu::create($data);
            return redirect()->route('menu-lain.index')->with('success', 'Other Menu created successfully.');
        } catch (Exception $e) {
            return redirect()->route('menu-lain.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OtherMenu  $otherMenu
     * @return \Illuminate\Http\Response
     */
    public function show(OtherMenu $otherMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OtherMenu  $otherMenu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $otherMenu = OtherMenu::find($id);
        $otherMenus = OtherMenu::orderBy('status')->orderBy('sort_order')->get();
        return view('admin.sipa.menu.index')
            ->with(compact('otherMenu'))
            ->with(compact('otherMenus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OtherMenu  $otherMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'menu_name' => 'required',
            'url' => 'required',
            'sort_order' => 'required',
        ]);
        try {
            $formTemplate = OtherMenu::find($id);
            $data = $request->all();
            $data['status'] = 'Active';
            $data['updated_by'] = auth()->user()->id;
            $formTemplate->update($data);

            return redirect()->route('menu-lain.index')->with('success', 'Other menu updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('menu-lain.index')->with('error', $e->errorInfo[2]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OtherMenu  $otherMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        OtherMenu::find($id)->update([
            'status' => 'InActive',
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('menu-lain.index')->with('success', 'Other Menu InActive successfully.');
    }
}
