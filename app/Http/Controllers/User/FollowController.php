<?php

namespace App\Http\Controllers\User;

use App\Models\Follow;
use App\Models\User;
use App\Repositories\Contracts\FollowRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class FollowController extends Controller
{
    protected $follow;

    public function __construct(FollowRepository $follow)
    {
        $this->follow = $follow;
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
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $data['user_id'] = $user->name;
        $data['users'] = $request->id;

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

        $pusher->trigger('FollowEvent', 'follow', $data);

        $follow = $this->follow->store([
            'follow_id' => $request->id,
            'follow_type' => $request->type,
            'user_id' => $request->user_id,
            'type' => 1,
        ]);
        return response()->json([
            'error' => false,
            'message' => __('message.success'),
            'data' => $follow,
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
        $follow = $this->follow->delete($id);

        return response()->json([
            'error' => false,
            'message' => __('message.delete_success'),
            'data' => $follow,
        ]);
    }

    public function destroyUser($id)
    {
        $follow = $this->follow->deleteUserFollow($id);

        return response()->json([
            'error' => false,
            'message' => __('message.delete_success'),
            'data' => $follow,
        ]);
    }
}
