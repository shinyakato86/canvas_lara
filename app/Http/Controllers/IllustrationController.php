<?php

namespace App\Http\Controllers;

use App\Models\Illustration;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Requests\StoreIllustration;
use App\Http\Requests\AddComment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IllustrationController extends Controller
{
public function __construct()
{
    $this->middleware('auth')->except(['index', 'show']);
}

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

public function index(Request $request)
{
    //$illustrations = Illustration::get();

    $illustrations = Illustration::withCount('likes')->orderBy('id', 'desc')->paginate(12);
    $param = [
        'illustrations' => $illustrations,
    ];

    return view('index', compact('illustrations', $param));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $illustration = new Illustration;



        return view('new');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIllustration $request)
    {
        $illustration = new Illustration;
        $id = \Auth::user();

        //$image = base64_encode(file_get_contents($request->image->getRealPath()));
        //$illustration->filename = $image;

        $image = base64_encode(request('input_canvas'));

        $illustration->comment = request('comment');
        $illustration->filename = request('input_canvas');
        $illustration->user_id = $id->id;

        $illustration->save();

        return redirect()->route('illustration.detail', ['id' => $illustration->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ifrojectlist  $projectlist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $illustration = Illustration::find($id);

        $user_id = Illustration::find($id)->pluck('user_id');

        $user_name = User::where('id', $user_id)->first();

        $comments = Comment::with(['author'])->where('illustrations_id', $id)->get();

        $illustration_likes_count = Illustration::withCount('likes')->findOrFail($id)->likes_count;

        $param = [
            'illustration_likes_count' => $illustration_likes_count
        ];

        $like = Illustration::withCount('likes');

        return view('detail', compact('illustration', 'user_name', 'comments', 'illustration_likes_count', 'param'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projectlist  $projectlist
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectlist = Projectlist::find($id);
        $creators = Creators::all()->where('id',$id);

        $users = \DB::table('users')->pluck('name');

        $categories = \DB::table('categories')->pluck('category_name');

        $departments = \DB::table('departments')->pluck('department_name');

        $status = \DB::table('status')->pluck('status_name');

        $clients = \DB::table('clients')->pluck('client_name');

        return view('edit', compact('projectlist', 'creators', 'users', 'categories', 'departments', 'status', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projectlist  $Projectlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Projectlist $projectlist)
    {
        $projectlist= Projectlist::find($id);
        $projectlist->project_name = request('project_name');
        $projectlist->department_name = request('department_name');
        $projectlist->sales_name = request('sales_name');
        $projectlist->client_name = request('client_name');
        $projectlist->price = request('price');
        $projectlist->status = request('status');
        $projectlist->accounting_date = request('accounting_date');
        $projectlist->save();

        $old_creators = Creators::find($id);
        $old_creators->delete();

        $data = [];

        for ($i=0; $i < count(request('creator_name')); $i++) {

          $data[]= array ('creator_name'=>$request['creator_name'][$i],
                          'id'=>$projectlist->id,
                          'creator_price'=>$request['creator_price'][$i],
                          'creator_category'=>$request['creator_category'][$i]);

        }

        DB::table('creators')->insert($data);

        return redirect()->route('projectlist.detail', ['id' => $projectlist->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Illustration  $Illustration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $illustration = Illustration::where('id',$id)->first();
        $comment = Comment::where('illustrations_id',$id)->get();
        $like = Like::where('illustration_id',$id)->get();

        $illustration->delete();

        if (!$like->isEmpty()) {
            $like->each->delete();
        }
        
        if (!$comment->isEmpty()) {
            $comment->each->delete();
        }

        return redirect('/');
    }


    /**
     * コメント投稿
     * @param Illustration $illustration
     * @param AddComment $request
     * @return \Illuminate\Http\Response
     */
    public function addComment(AddComment $request, $id)
    {
        $comment = new Comment();
        $comment->comment = request('add_comment');
        $comment->illustrations_id = $id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        $new_comment = Comment::where('id', $comment->id)->with('author')->first();

        return redirect()->route('illustration.detail', ['id' => $comment->illustrations_id]);
    }








    public function like(Request $request)
{
    $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    $illustration_id = $request->illustration_id; //2.投稿idの取得
    $already_liked = Like::where('user_id', $user_id)->where('illustration_id', $illustration_id)->first(); //3.

    if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
        $like = new Like; //4.Likeクラスのインスタンスを作成
        $like->illustration_id = $illustration_id; //Likeインスタンスにreview_id,user_idをセット
        $like->user_id = $user_id;
        $like->save();
    } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
        Like::where('illustration_id', $illustration_id)->where('user_id', $user_id)->delete();
    }
    //5.この投稿の最新の総いいね数を取得
    $illustration_likes_count = Illustration::withCount('likes')->findOrFail($illustration_id)->likes_count;
    $param = [
        'illustration_likes_count' => $illustration_likes_count
    ];
    return response()->json($param); //6.JSONデータをjQueryに返す
}

}