<?php

namespace App\Http\Controllers;


use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Policies\TodoPolicy;
use App\Http\Requests\AskTodoRequest;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // return Todo::orderBy('id', 'DESC')->get();
        $user = auth()->user();

        return Todo::where('user_id', '=', $user->id)->get();

        // return view('home', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $todo = new Todo();

        // return view('create', compact('todo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskTodoRequest $request, Todo $todo)
    {
        $request->user()->todos()->create($request->only('title', 'body'));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => "Your todo has been Added"
            ]);
        }

        return redirect()->route('home')->with('success', 'Your todo has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $todo = Todo::where('slug', $slug)->first();
        // return view('show', compact('todo'));

        return Todo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        if (\Gate::allows('update-todo', $todo)) {
            return view("edit", compact('todo'));
        }
        abort(403, "Access denied");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(AskTodoRequest $request, Todo $todo)
    {
        if (\Gate::denies('update-todo', $todo)) {
            abort(403, "Access Denied");
        }
        $todo->update($request->only('title', 'body'));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => "Your todo has been updated",
                'body_html' => $todo->body_html
            ]);
        }
        return redirect('/home')->with('success', 'Your todo has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if (\Gate::denies('delete-todo', $todo)) {
            abort(403, "Access Denied");
        }
        $todo->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'message' => "Your todo has been deleted"
            ]);
        }

        return redirect('/home')->with('success', 'Your todo has been deleted');
    }
}
