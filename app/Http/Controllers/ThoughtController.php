<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThoughtController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return Inertia::render('Thoughts/Index', [ 
          'thoughts' => Thought::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
      $validated = $request->validate([
        'message' => 'required|string|max:255',
      ]);
    
      $request->user()->thoughts()->create($validated);

      return redirect(route('thoughts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Thought $thought)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thought $thought)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thought $thought)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thought $thought)
    {
        //
    }
}
