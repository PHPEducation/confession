<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $posts = Post::with('topic')->where([
            ['user_id', '=', $user],
            ['type', '=', 1],
        ])->get();

        return view('user.profile.index', compact('posts'));
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
        //
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
        $user = User::findOrFail($id);

        return response()->json([
            'error' => false,
            'user' => $user,
        ]);
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
        $data = $request->all();

        DB::beginTransaction();

        User::where('id', '=', $id)->update([
            'name' => $request->name,
            'nick_name' => $request->nick_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ]);

        DB::commit();

        return response()->json([
            'error' => false,
            'message' => trans('message.success'),
        ]);
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

    public function uploadImage(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $image = $request->file('image_user');
        $img = $this->saveImage($image);
        $user->images = $img;
        $user->save();

        return back()->with('success', trans('message.success'));
    }

    public function saveImage($image)
    {
//        save in storage
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();

        $newName = $filename . '_' . time() . '.' . $extension;
        $path = $image->move(config('common.image_paths.user'), $newName);

        return $newName;
    }
}
