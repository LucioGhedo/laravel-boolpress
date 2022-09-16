<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewPostAdminEmail;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(6);

        $now = Carbon::now();

        $data = [
            'posts' => $posts,
            'now' => $now
        ];
        
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidatedPost());

        $form_data = $request->all();

        if(isset($form_data['image'])) {
            $img_path = Storage::put('post-covers', $form_data['image']);
            $form_data['cover'] = $img_path;
        }

        $new_post = new Post();
        $new_post->fill($form_data);
        
        $new_post->slug = $this->getSlugFromTitle($new_post->title);

        $new_post->save();

        if(isset($form_data['tags'])) {
            $new_post->tags()->sync($form_data['tags']);
        }

        // mail del nuovo post
        Mail::to('admin@boolpress.it')->send(new NewPostAdminEmail($new_post));

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $now = Carbon::now();
        $diff = $post->created_at->diffForHumans($now);
        $diff_hours = $post->created_at->diffInHours($now);

        $data = [
            'post' => $post,
            'diff' => $diff,
            'diff_hours' => $diff_hours
        ];

        return view('admin.posts.show', compact('post', 'diff', 'diff_hours'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::all();

        $categories = Category::all();
        
        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->getValidatedPost());
        $form_data = $request->all();

        $post_to_update = Post::findOrFail($id);

        // se l'utente vuole cambiare img
        if($form_data['image']) {
            // e il post ha già un'immagine
            if($post_to_update->cover) {
                // cancello vecchia img
                Storage::delete($post_to_update->cover);
            }
            // salvo l'immagine in post-covers
            $img_path = Storage::put('post-covers', $form_data['image']);
            // popolo colonna cover con il path immagine
            $form_data['cover'] = $img_path;
        }
        
        if($form_data['title'] !== $post_to_update->title) {
            $form_data['slug'] = $this->getSlugFromTitle($form_data['title']);
        } else {
            $form_data['slug'] = $post_to_update->slug;
        }

        $post_to_update->update($form_data);

        if(isset($form_data['tags'])) {
            $post_to_update->tags()->sync($form_data['tags']);
        } else {
            $post_to_update->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::findOrFail($id);

        if($post_to_delete->cover) {
            Storage::delete($post_to_delete->cover);
        }

        $post_to_delete->tags()->sync([]);

        $post_to_delete->delete();

        return redirect()->route('admin.posts.index');
    }

    protected function getSlugFromTitle($title) {
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;
        $existing_slug = Post::where('slug', '=', $slug_to_save)->first();

        $counter = 1;
        while($existing_slug) {
            $slug_to_save = $slug_base . '-' . $counter;

            $existing_slug = Post::where('slug', '=', $slug_to_save)->first();
            $counter++;
        }
        return $slug_to_save;
    }

    protected function getValidatedPost() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'image' => 'nullable|file|max:500000'
        ];
    }
}
