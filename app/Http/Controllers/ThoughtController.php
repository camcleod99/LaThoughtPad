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
          'thoughts' => Thought::with('user:id,name')->where('status','Posted')->latest()->get(),
          'page' => 'thoughts'
        ]);
    }

    public function drafts()
    {
      return Inertia::render('Thoughts/Index', [
          'thoughts' => Thought::with('user:id,name')->where('status','Draft')->latest()->get(),
          'page' => 'drafts'
        ]);
    }

    public function deleted()
    {
      return Inertia::render('Thoughts/Index', [
          'thoughts' => Thought::with('user:id,name')->where('status','Deleted')->latest()->get(),
          'page' => 'deleted'
        ]);
    }

    /** Show the form for creating a new resource. **/
    public function create()
    {
        //
    }

    /** Store a newly created resource in storage. **/
    public function store(Request $request): RedirectResponse
    {
      $validated = $request->validate([
        'message' => 'required|string|max:255',
      ]);

      $request->user()->thoughts()->create($validated);

      return redirect(route('thoughts.index'));
    }

    /** Display the specified resource. **/
    public function show(Thought $thought)
    {
        //
    }

    /** Show the form for editing the specified resource. **/
    public function edit(Thought $thought)
    {
        //
    }

    /** Update the specified resource in storage. **/
    public function update(Request $request, Thought $thought): RedirectResponse
    {
      $this->authorize('update', $thought);

      $validated = $request->validate([
        'message' => 'required|string|max:255',
      ]);

      $thought->update($validated);

      return redirect(route('thoughts.index'));
    }

    public function updateStatus(Request $request): RedirectResponse
    {

      $validated = $request->validate([
        'id' => 'required|integer|exists:thoughts,id',
        'source' => 'required|string|in:thoughts,drafts,deleted',
        'status' => 'required|string|in:Posted,Draft,Deleted',
      ]);

      $thought = Thought::find(request('id'));
      $this->authorize('update', $thought);

      if (request('status') == 'Deleted') {
        $thought->deleted_at = now();
      } else {
        $thought->deleted_at = null;
      }

      $thought->status = request('status');
      $thought->save();

      if (request('source') == 'thoughts') {
        return redirect(route('thoughts.index'));
      } elseif (request('source') == 'drafts') {
        return redirect(route('thoughts.drafts'));
      } elseif (request('source') == 'deleted') {
        return redirect(route('thoughts.deleted'));
      }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thought $thought): RedirectResponse
    {
      $this->authorize('delete', $thought);

      $thought->delete();

      return redirect(route('thoughts.index'));
    }
}
