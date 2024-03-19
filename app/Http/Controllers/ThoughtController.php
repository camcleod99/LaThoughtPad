<?php
namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThoughtController extends Controller
{
    /** Display a listing of the resource. **/
    public function index()
    {
        return Inertia::render('Thoughts/Index', [
          'thoughts' => Thought::with('user:id,name')->where('status','Posted')->latest()->get(),
          'page' => 'thoughts'
        ]);
    }

    /** Display a listing of the resource that has the "Draft" status. **/
    public function drafts()
    {
      return Inertia::render('Thoughts/Index', [
          'thoughts' => Thought::with('user:id,name')->where('status','Draft')->latest()->get(),
          'page' => 'drafts'
        ]);
    }

    /** Display a listing of the resource that has the "Draft" status. **/
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

    /** Update the status of the specified resource in storage. **/
    public function updateStatus(Request $request): RedirectResponse
    {
//    Check the post exists, the source exists and the status is one of the allowed values
      $validated = $request->validate([
        'id' => 'required|integer|exists:thoughts,id',
        'source' => 'required|string|in:thoughts,drafts,deleted',
        'status' => 'required|string|in:Posted,Draft,Deleted',
      ]);

//    Load up the thought by finding it via eloquent. Then check the user can do the thing
      $thought = Thought::find(request('id'));
      $this->authorize('update', $thought);

//    If the status is deleted then set the deleted_at field to now, otherwise set it to null
      if (request('status') == 'Deleted') {
        $thought->deleted_at = now();
      } else {
        $thought->deleted_at = null;
      }

//    Set the status value in the post to the value passed in via request and then save
      $thought->status = request('status');
      $thought->save();

//    If the 'source' is thoughts then you need to set the redirect to thoughts.index,
//    otherwise you can just use the source value as the redirect text
      if(request('source') === 'thoughts'){
        $redirect = 'thoughts.index';
//         return redirect(route('thoughts.index'));
      } else {
        $redirect = 'thoughts.'.request('source');
//         $source = request('source');
//         return redirect(route('thoughts.'.$source));
      }

//    TODO: Add a message to send to the view to say the action has been completed successfully

      return redirect(route($redirect));
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
