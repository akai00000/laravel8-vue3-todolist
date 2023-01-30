<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Rabel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //  topページ表示
    public function top()
    {
        return view('top');
    }


    public function topAxios()
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $todos_sts_1 = Todo::where('user_id', $user_id)->where('status', 1)->get();
        return $todos_sts_1;
    }

    public function contentAxios()
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $todos_sts_2 = Todo::where('user_id', $user_id)->where('status', 1)->get();
        return $todos_sts_2;
    }

    public function create()
    {
        $user = Auth::user();
        $user_id = $user['id'];
        return view('create');
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $data = $request->all();
        unset($data['_token']);
        $exist_rabel = Rabel::where('user_id', $user_id)->where('rabel_content', $data['rabel'])->first();
        if(empty($exist_rabel) )
        {
            //↓リクエストされたラベルを挿入し、挿入時に生成されたrabelsのIDを受け取る。
            // そのため、上記のfill()はなくてもいける。
            $rabel_id = Rabel::insertGetId(['rabel_content' => $data['rabel'], 'user_id' => $user_id, 'status' => $data['status']]);
        } else {
            $rabel_id = $exist_rabel['rabel_id'];
        }
        $list = new Todo;
        $list->fill([
            'user_id' => $user_id, 
            'title' => $data['title'], 
            'rabel' => $data['rabel'], 
            'rabel_id' => $rabel_id, 
            'priority' => $data['priority'], 
            'status' => $data['status'], 
            'deadline' => $data['deadline'], 
            'content' => $data['content'], 
            ])->save();
        return redirect()->route('index')->with('success', 'タスクを追加しました。');
    }


    public function edit(Request $request)
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $list_id = $request->id;
        $list_id_def = ToDo::where('user_id', $user_id)->where('status', 1)->get();
        $rabels = Rabel::where('user_id', $user_id)->where('rabel_content')->get();
        $list = Todo::find($list_id);
        $titles = Todo::where('user_id', $user_id)->where('title')->get();
        // dd($list);
        return view('edit', compact('user_id', 'rabels', 'titles', 'list', 'list_id', 'list_id_def'));
    }

    public function update(Request $request)
    {
        // 入力した情報を格納
        $updateList = $request->all();
        unset($updateList['_token']);
        Log::debug($request->id);
        // ↓クエリビルダから取得したlistのidを用いて、モデル（テーブル）から一致するレコードを取得し、変数に格納
        $list = Todo::find($updateList['list_id']);
        // ↓入力した内容を取得してきたレコードに対して上書き保存
        $list->fill($updateList)->save();

        return redirect('/top');
    }

public function done(Request $request)
{
    // //ここでは、①特定のレコードをクエリビルダに記述されたidを用いてDBのテーブルからレコードを取得
    // //②そして、取得した情報をdelのviewに渡して表示させる。
    // //③必要なことはテーブルからタイトル名、ラベル名、優先度、内容、締切を持ってきて表示させること
    $user = Auth::user();
    $user_id = $user['id'];
    // ↓rabelsはラベル一覧のブロックに表示するために使用する。
    $rabels = Rabel::where('user_id', $user_id)->get();
    // ↓クエリビルダより、検索したいlistのidを取得する。
    $list_id = $request->id;
    // DBからクエリビルダに記述したidに対応するlistのレコードを取得してくる。
    $list_query_select = Todo::where('user_id', $user_id)->where('id', $list_id)->first();
    // dd($list_query_select);
    return view('done', compact('user_id', 'rabels', 'list_id', 'list_query_select'));
}

public function remove(Request $request)
{
    /* ↓ 消去するlistに対応するラベルのうち、他と同じものがあるかを確認する。
    （重複があれば、ラベルはまだ消してはいけないため、一部の処理をパスするようにする）
    */
    $user = Auth::user();
    $user_id = $user['id'];
    // ↓inputに記載された情報をrequestallで取得する。
    $list_data = $request->all();
    unset($list_data['_token']);
    // ↓リストモデルのなかで、delから取得したレコードと一致するものを検索し、ステータスを2にすることで、論理削除する。
    Todo::where('user_id', $user_id)->where('id', $list_data['list_id'])->update(['status' => 2]);

    /* ↓rabelsテーブルのrabel_idを消して良いかの判定
        ユーザーが入力したidに対応するレコードのラベルが他にもあるか確認。 → カウントしてrabel_id_countに格納。
    */
    $rabel_id_counts = Todo::where('user_id', $user_id)->where('rabel_id', '=', $list_data['rabel_id'])->where('status', 1)->count();
    // ↓クエリビルダのidと一致するrabelはいくつあるかカウントする。
    if($rabel_id_counts == 0)
    {
        Rabel::where('rabel_id', $list_data['rabel_id'])->update(['status' => 2]);
    }
    return redirect('/top');
}

// vueにDBのデータを渡すためのメソッド
public function vueDataGet(){
    $user = Auth::user();
    $user_id = $user['id'];
    $list_contents= Todo::select('content')->where('user_id', $user_id)->where('status', 1)->get();
    $user = DB::select('select id from Todos where rabel = "test_rabel"');
    return view('/top2', compact('user', 'list_contents'));
}

}
