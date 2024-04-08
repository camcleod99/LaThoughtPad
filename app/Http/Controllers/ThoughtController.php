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
        session()->forget('results');
        return Inertia::render('Thoughts/Index', [
          'thoughts' => Thought::with('user:id,name')->where('status','Posted')->latest()->get(),
          'page' => 'thoughts',
          'pageTitle' => 'Thoughts',
          'postMessage' => session('message')
        ]);
    }

    /** Display a listing of the resource that has the "Draft" status. **/
    public function drafts()
    {
      session()->forget('results');
      return Inertia::render('Thoughts/Index', [
          'thoughts' => Thought::with('user:id,name')->where('status','Draft')->latest()->get(),
          'page' => 'drafts',
          'pageTitle' => 'Drafts',
          'postMessage' => session('message')
        ]);
    }

    /** Display a listing of the resource that has the "Draft" status. **/
    public function deleted()
    {
      session()->forget('results');
      return Inertia::render('Thoughts/Index', [
          'thoughts' => Thought::with('user:id,name')->where('status','Deleted')->latest()->get(),
          'page' => 'deleted',
          'pageTitle' => 'Deleted',
          'postMessage' => session('message')
        ]);
    }

    /** Find a set of posts from all users based on a search term */
    public function search(request $request)
    {
      // Search Term is ether $request->input('searchTerm') or 'null'
      $searchTerm = $request->input('searchTerm') ?? 'null';

      $results = null;

      $results = Thought::with('user:id,name')
        ->where('message', 'like', '%'.$searchTerm.'%')
        ->get();

      // Pass the results to the session if not null
      if ($results->count() > 0) {
        session(['results' => $results]);
      }

      // Pass the results to the Inertia page as props
      $response = Inertia::render('Search/Results', [
          'term' => $searchTerm,
          'results' => $results,
      ]);

      return $response;
    }


    /** Store a newly created resource in storage. **/
    public function store(Request $request): RedirectResponse
    {
      $validated = $request->validate([
        'message' => 'required|string|max:255',
      ]);

      //  Manage Tags **
      $tags = $this->sortTags([$request->tag_1, $request->tag_2, $request->tag_3]);
      foreach ($tags as $key => $tag) {
          $validated['tag_' . ($key + 1)] = $tag;
      }

      // Push the thought to the database
      $request->user()->thoughts()->create($validated);

      // That all done, redirect to the thoughts.index page
      return redirect(route('thoughts.index'))->with('message', 'Your thought has been added to drafts. It is ready to be published.');
    }

    /** Update the specified resource in storage. **/
    public function update(Request $request, Thought $thought): RedirectResponse
    {
      $this->authorize('update', $thought);

      $validated = $request->validate([
        'message' => 'required|string|max:255',
      ]);

      $tags = $this->sortTags([$request->tag_1, $request->tag_2, $request->tag_3]);

      foreach ($tags as $key => $tag) {
          $validated['tag_' . ($key + 1)] = $tag;
      }

      $thought->update($validated);

      if ($request->input('page') === 'thoughts') {
        $redirect = 'thoughts.index';
      } else {
        $redirect = 'thoughts.'.$request->input('page');
      }

      return redirect(route($redirect))->with('message', "Your thought has been successfully edited.");
    }

    /** Update the status of the specified resource in storage. **/
    public function updateStatus(Request $request): RedirectResponse
    {
      //  Check the post exists, the source exists and the status is one of the allowed values
      $validated = $request->validate([
        'id' => 'required|integer|exists:thoughts,id',
        'source' => 'required|string|in:thoughts,drafts,deleted',
        'status' => 'required|string|in:Posted,Draft,Deleted',
      ]);

      //  Load up the thought by finding it via eloquent. Then check the user can do the thing
      $thought = Thought::find(request('id'));
      $this->authorize('update', $thought);

      //  Set the status value in the post to the value passed in via request and then save
      $thought->status = request('status');
      $thought->save();

      if (request('source') === 'thoughts') {
        $redirect = 'thoughts.index';
      } else {
        $redirect = 'thoughts.'.request('source');
      }

      return redirect(route($redirect))->with('message', "Your thought's status has been changed to ".$thought->status." successfully.");
    }

    /** Remove the specified resource from storage. */
    public function destroy(Thought $thought): RedirectResponse
    {
      $this->authorize('delete', $thought);
      $thought->delete();
      return redirect(route('thoughts.index'))->with('message', 'Your thought has been permanently deleted.');
    }

    /** DRY Methods **/
    /** Tag Sorting **/
    private function sortTags($tags)
    {
      foreach ($tags as $key => $tag) {
          $tag = preg_replace('/[^A-Za-z0-9]/', '', $tag);
          if (empty($tag)) {
            $tags[$key] = null;
          } else {
            $tags[$key] = $tag;
          }
      }

      // Move tags that are not null to the front of the array and then sort the array
      $tags = array_values(array_filter($tags));
      sort($tags);

      return $tags;
    }



    /** DEFAULT METHODS **/
    /** Show the form for creating a new resource. **/
    public function create()
    {
        //
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
}
