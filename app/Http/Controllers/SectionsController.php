<?php

namespace App\Http\Controllers;

use App\Models\section;
use Exception;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = section::all();
        return view('sections.index', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'section_name' => 'required|min:2',
            'description' => 'nullable',
        ]);
        section::create([
            'section_name' => $validator['section_name'],
            'description' => $validator['description'],
            'created_by' => $request['created_by'],
        ]);
        return redirect('section');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(section $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $section = section::findOrFail($request->id);
        $validator = $request->validate([
            'section_name' => 'required|min:2',
            'description' => 'nullable',
        ]);
        try {
            $section->update([
                'section_name' => $validator['section_name'],
                'description' => $validator['description'],
            ]);
            $section->save();
            return redirect('section');
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            $section = section::find($id);
            $section->delete();
            return redirect('section');
        } catch (Exception $e) {
            return $e;
        }
    }
}
