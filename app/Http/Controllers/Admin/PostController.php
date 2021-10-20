<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        $post = new Post();
        return view("admin.posts.create", compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //todo VALIDAZIONE viene fatta qui per in create
        $request->validate([
            // unique verifica se ci sono altri titoli uguali
            'title' => ['required', 'string', 'unique:posts', 'min:2', 'max:255'],
            'content' => ['required', 'string', 'min:2', 'max:1000'],
            'image' => ['required', 'string', 'min:2', 'max:500'],
        ], [
            'required' => "il campo del :attribute è obbligatorio",
            'title.unique' => "il post $request->title esiste già"

        ]);
        //todo ----------------------------

        $data = $request->all();

        $post = new Post();
        $post->fill($data);
        $post->slug = Str::slug($post->title, '-');

        
        $post->save();

        return redirect()->route('admin.posts.show', compact('post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //todo VALIDAZIONE viene fatta qui per l'edit
        $request->validate([
            // unique verifica se ci sono altri titoli uguali

            // quando si modifica un campo in edit e si salva, laravel non riconosce il titolo dicendo che è gia presente e non ti da il lascito alla nuova creazione del post. per questo si aggiunge il metodo Rule (con questa dicitura in basso: Rule::unique('posts')->ignore($post->id)) sia in update e sia in 'use' (con questa dicitura in alto: use Illuminate\Validation\Rule;)

            'title' => ['required', 'string', Rule::unique('posts')->ignore($post->id), 'min:2', 'max:255'],
            'content' => ['required', 'string', 'min:2', 'max:1000'],
            'image' => ['required', 'string', 'min:2', 'max:500'],
        ], [
            'required' => "il campo del :attribute è obbligatorio",
            'title.unique' => "il post $request->title esiste già"

        ]);
        //todo ----------------------------

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');
        $post->update($data);

        return redirect()->route('admin.posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post-> delete();
        // puoi agiungere il with se vuoi far uscire l'alert dell'avvenuta cancellazione (dopo di che lo inserisci nell'index.blade.php)
        return redirect()->route('admin.posts.index')->with('alert-message', 'Post eliminato')->with('alert-type', 'danger');
    }
}
