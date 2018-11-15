<?php

namespace App\Http\Controllers\User;

use App\Models\Like;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use App\Models\Image;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if (Auth::check()) {
            $posts = $this->post->store([
                'title' => $request->get('title'),
                'slug' => Str::slug($request->get('title'), '-'),
                'body' => $request->get('body'),
                'user_id' => Auth::user()->id,
                'topic_id' => $request->get('topic'),
                'type' => $request->get('type'),
            ]);
            if ($request->hasFile('filename')) {
                $images = $request->file('filename');
                foreach ($images as $image) {
                    $filenameWithExt = $image->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $image->getClientOriginalExtension();

                    $newname = $filename . '_' . time() . '.' . $extension;
                    $path = $image->move(config('common.image_paths.post'), $newname);

                    $image = new Image([
                        'post_id' => $posts->id,
                        'filename' => $newname,
                    ]);
                    $image->save();
                }
            } else {
                $image = new Image([
                    'post_id' => $posts->id,
                    'filename' => 0,
                ]);
                $image->save();
            }
        } else {
            $posts = $this->post->store([
                'title' => $request->get('title'),
                'slug' => Str::slug($request->get('title'), '-'),
                'body' => $request->get('body'),
                'user_id' => null,
                'topic_id' => null,
                'type' => 0,
            ]);
            $post = Post::orderBy('id', 'desc')->first();
            Like::create([
                'post_id' => $post->id,
                'type' => 0,
            ]);
            Report::create([
                'post_id' => $post->id,
                'type' => 0,
            ]);
            if ($request->hasFile('filename')) {
                $images = $request->file('filename');
                foreach ($images as $image) {
                    $filenameWithExt = $image->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $image->getClientOriginalExtension();

                    $newname = $filename . '_' . time() . '.' . $extension;
                    $image->move(config('common.image_paths.post'), $newname);

                    $image = new Image([
                        'post_id' => $posts->id,
                        'filename' => $newname,
                    ]);

                    $image->save();
                }
            } else {
                $image = new Image([
                    'filename' => 0,
                    'post_id' => $posts->id,
                ]);
                $image->save();
            }
        }

        return redirect()->route('cfs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = $this->post->show($id);

        return view('user.post.detail', compact($posts));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
