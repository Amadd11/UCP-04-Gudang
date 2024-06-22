<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuans = Satuan::withCount('todo')->where('user_id', auth()->user()->id)->get();
        return view('satuan.index', compact('satuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);
        Satuan::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title
        ]);

        return redirect()->route('satuan.index')->with('success', 'Satuan created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satuan $satuan)
    {
        if (auth()->user()->id == $satuan->user_id) {
            return view('satuan.edit', compact('satuan'));
        } else {
            return redirect()->route('satuan.index')->with('danger', 'You are not authorized to edit this category!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Satuan $satuan)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // Practical
        // $todo->title = $request->title;
        // $todo->save();

        // Eloquent Way - Readable
        $satuan->update([
            'title' => ucfirst($request->title),
        ]);
        return redirect()->route('satuan.index')->with('success', 'Todo category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Satuan $satuan)
    {
        if (auth()->user()->id == $satuan->user_id) {
            $satuan->delete();
            return redirect()->route('satuan.index')->with('success', 'Satuan deleted successfully!');
        } else {
            return redirect()->route('satuan.index')->with('danger', 'You are not authorized to delete this category!');
        }
    }
}
