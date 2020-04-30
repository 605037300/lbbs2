<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;
use Auth;
use App\Handlers\UploadImageHandler;


class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request)
	{
		// $topics=$topic->withOrder($request->order)->with('user','category')->paginate(20);

		$topics = Topic::withOrder($request->order)->with('user','category')->paginate();
		//分页之后$topics对象会携带分页参数
		// dd($topics);
		return view('topics.index', compact('topics'));
	}

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
		$category=Category::all();

		return view('topics.create_and_edit', compact('topic','category'));
	}

	public function store(TopicRequest $request,Topic $topic)
	{
		 $topic->fill($request->all());
		 $topic->user_id=Auth::id();
		 $topic->save();

		return redirect()->route('topics.show', $topic->id)->with('message', '帖子创建成功');
	}

	public function uploadImage(Request $request,UploadImageHandler $upimghandler){
		$data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => '123'
		];
		
		if($file=$request->upload_file){
			$result=$upimghandler->save($file,'topics',\Auth::id(),1024);
			if($result){
				$data['success']=true;
				$data['msg']="上传成功";
				$data['file_path']=$result['path'];
			}
		}
		dd($data);
		return $data;
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		return view('topics.create_and_edit', compact('topic'));
	}


	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
	}
}