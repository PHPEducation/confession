<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\TopicFormRequest;
use App\Models\Topic;
use App\Repositories\Contracts\TopicRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{

    protected $topic;

    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = $this->topic->getAll();
        $testModel = new Topic();
        $fillableColumns = $testModel->getFillable();
        foreach ($fillableColumns as $key => $value) {
            $testColumns[$value] = $value;
        }

        return view('admin.topic.index', compact('topics', 'testColumns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.topic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicFormRequest $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $request->merge(['user_id' => $userId]);
            $image = $request->file('image_topic');
            $img = $this->saveImage($image);
            $request->merge(['images' => $img]);

            //handle select time
            if ($request->input('set_time') == 0) {
                $selectTime = null;
            } elseif ($request->input('set_time') == 1) {
                $selectTime = $request->input('select_time');
            }
            $request->merge(['select_time' => $selectTime]);
            $this->topic->store($request->all());

            return back()->with('success', trans('message.success'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = $this->topic->show($id);

        return view('admin.topic.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = $this->topic->find($id);

        return view('admin.topic.edit', compact('topic'));
    }

    public function updateAll(TopicFormRequest $request, $id)
    {
        $topic = $this->topic->find($id);
        $image = $request->file('image_topic');
        $img = $this->saveImage($image);
        $request->merge(['images' => $img]);
        $topic->update($request->all());

        return back()->with('success', trans('message.success'));
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
        $test = Topic::findOrFail($id);
        $columnName = Input::get('name');
        $columnValue = Input::get('value');
        if (Input::has('name')) {
            $test = Topic::select()
                ->where('id', '=', $id)
                ->update([$columnName => $columnValue]);

            return response()->json(['code' => 200], 200);
        }

        return response()->json(['error' => 400, 'message' => trans('message.not_enought_params')], 400);
    }

    public function bulkUpdate(Request $request)
    {
        if (Input::has('ids_to_edit') && Input::has('bulk_name') && Input::has('bulk_value')) {
            $ids = Input::get('ids_to_edit');
            $bulkName = Input::get('bulk_name');
            $bulkValue = Input::get('bulk_value');
            foreach ($ids as $id) {
                $test = Test::select()->where('id', '=', $id)->update([$bulkName => $bulkValue]);
            }
            $message = trans('message.done');
        } else {
            $message = trans('message.error');

            return Redirect::back()->withErrors(['message' => $message])->withInput();
        }

        return Redirect::back()->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->topic->delete($id);

        return back()->with('sucess', __('message.sucess'));
    }

    public function saveImage($image)
    {
//        save in storage
        $filenameWithExt = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();

        $newName = $filename . '_' . time() . '.' . $extension;
        $path = $image->move(config('common.topics'), $newName);

        return $newName;
    }
}
