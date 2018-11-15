<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ReportController extends Controller
{
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
    public function store(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $users = User::findOrFail($request->user_id);

        $data['post_id'] = $post->title;
        $data['user_id'] = $users->name;
        $data['users'] = $post->user_id;

        $options = [
            'cluster' => 'ap1',
            'encrypted' => true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('ReportEvent', 'report-post', $data);

        $reports = Report::create([
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'type' => 1,
        ]);

        return response()->json([
            'error' => false,
            'message' => __('message.like_success'),
            'data' => $reports,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $report = Report::where('post_id', $id)->where('user_id', Auth::id())->first();
        $report->delete();

        return response()->json([
            'error' => false,
            'message' => __('message.delete_success'),
            'data' => $report,
        ]);
    }
}
