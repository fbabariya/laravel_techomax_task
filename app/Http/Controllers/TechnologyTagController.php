<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TechnologyTag;

class TechnologyTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = TechnologyTag::all();
        return view('index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:technology_tags,name'
        ]);
    
        TechnologyTag::create($request->all());
    
        return redirect()->route('technology-tags.index')
                         ->with('success', 'Technology Tag created successfully.');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = TechnologyTag::findOrFail($id);
        return view('edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:technology_tags,name,' . $id
        ]);
    
        $tag = TechnologyTag::findOrFail($id);
        $tag->update($request->all());
    
        return redirect()->route('technology-tags.index')
                         ->with('success', 'Technology Tag updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = TechnologyTag::findOrFail($id);
    $tag->delete();

    return redirect()->route('technology-tags.index')
                     ->with('success', 'Technology Tag deleted successfully.');
    }
}
