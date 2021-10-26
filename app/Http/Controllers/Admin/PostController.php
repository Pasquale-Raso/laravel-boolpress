<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Model\Category;
use App\Http\Controllers\Controller;
use App\Models\Tag;
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
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags', 'post', 'categories'));
        
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
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'

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

        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

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
        
        $tags = Tag::all();
        $categories = Category::all();
        $tagIds= $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('tags', 'post', 'tagIds', 'categories'));

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
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'

        ], [
            'required' => "il campo del :attribute è obbligatorio",
            'title.unique' => "il post $request->title esiste già"

        ]);
        //todo ----------------------------

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');

        if(!array_key_exists('tags', $data)) $post->tags()->detach();
        else $post->tags()->sync($data['tags']);

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
