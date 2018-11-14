<?php

namespace App\Http\Controllers\User;

use App\Models\Follow;
use App\Repositories\Contracts\FollowRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $follow = $this->follow->store([
            'follow_id' => $request->topic_id,
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
}
