<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = DB::table('categorias')
        ->get();

        return view('forum.forum_index', compact('categorias'));
    }

    /**
     * Show list of posts within a category
     */
    public function list(string $id) {

        $categoria = DB::table('categorias')
        ->select('nome', 'id')
        ->where('id', $id)
        ->first();
        // acessar posts da categoria pelo id
        $query = Post::where('categoria_id', $id)
        ->where(function (Builder $query) {
            $query->where('post_type_id', '2')
                ->orWhere('post_type_id', '3');
        })
        ->orderBy('created_at', 'desc')
        /* ->get() */;

        $posts = $query->paginate(15);


        return view('forum.forum_list', compact('posts', 'categoria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $allTags = Tag::all();
        return view('forum.forum_create', compact('id', 'allTags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'texto' => 'required|string',
            'categoria_id' => 'required | exists:categorias,id',
            'post_type_id' => 'required | exists:tipo_post,id',
        ]);

        if($request->tags){
            $request->validate([
                'tags.*' => 'exists:tags,id'
            ]);
        }

        $post = Post::create([
            'user_id' => Auth::id(),
            'categoria_id' => $request->categoria_id,
            'post_type_id' => $request->post_type_id,
            'titulo' => $request->titulo,
            'texto' => $request->texto,
        ]);

        if ($request->post_type_id == 2) {
            DB::table('users')->
            where('id', Auth::id())->
            increment('saldo_pontos', 2);
        }

        if($request->tags){
            foreach ($request->tags as $tag) {
                $post->tags()->attach(Tag::where('id', $tag)->pluck('id'));
            };
        }


        return redirect()->route('forum.list', $request->categoria_id);
    }

    /**
     * Store a newly created comment in storage.
     */
    public function comment(Request $request)
    {
        $request->validate([
            'texto' => 'required|string',
            'parent_id' => 'required|exists:posts,id',
            'categoria_id' => 'required | exists:categorias,id'
        ]);


        Post::create([
            'user_id' => Auth::id(),
            'categoria_id' => $request->categoria_id,
            'post_type_id' => 4,
            'texto' => $request->texto,
            'parent_id' => $request->parent_id
        ]);

        if ($request->parent_type_id == 2) {
            DB::table('users')->
            where('id', Auth::id())->
            increment('saldo_pontos', 2);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //acessar dados do post pelo id
        $post = Post::where('id', $id)->first();
        $comentarios = Post::where('parent_id', $id)->get();

        return view('forum.forum_post', compact('post', 'comentarios'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::where('id', $id)->first();
        $allTags = Tag::all();
        return view('forum.forum_edit', compact('post', 'allTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        /* dd($request); */
        $request->validate([
            'titulo' => 'required | string',
            'post_type_id' => 'required | int | between:2,3',
            'texto' => 'required | string',
            'id' => 'required | exists:posts,id',
        ]);

        if($request->tags){
            $request->validate([
                'tags.*' => 'exists:tags,id'
            ]);
        }

        Post::where('id', $request->id)->update([
            'titulo' => $request->titulo,
            'post_type_id' => $request->post_type_id,
            'texto' => $request->texto,
        ]);

        DB::table('post_tag')->where('post_id', $request->id)->delete();

        if($request->tags){
            $post = Post::where('id', $request->id)->first();
            foreach ($request->tags as $tag) {
                $post->tags()->attach(Tag::where('id', $tag)->pluck('id'));
            };
        }

        return redirect()->route('forum.list', $request->categoria_id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        Post::where('id', $id)->delete();
        return redirect()->route('forum.list', $post->categoria->id);
    }
}
