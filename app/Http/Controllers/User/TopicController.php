<?php

namespace App\Http\Controllers\User;

use App\Models\Topic;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\TopicRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    protected $topic;

    protected $user;

    protected $post;

    public function __construct(TopicRepository $topic, UserRepository $user, PostRepository $post)
    {
        $this->topic = $topic;
        $this->user = $user;
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = $this->topic->getAllEnable();

        $users = $this->user->getAllUser();

        return view('user.topic.index', compact('topics', 'users'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topics = $this->topic->show($id);

        $posts = $this->post->getAllOfTopic($id);

        $users = $this->user->getAllUser();

        return view('user.topic.show', compact('topics', 'posts', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
