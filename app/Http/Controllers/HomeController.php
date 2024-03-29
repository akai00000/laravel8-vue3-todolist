<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Rabel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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

    // top2税込表示サンプル
    public function top2()
    {
        return view('top2');
    }

    // rabel一覧表示
    public function byRabel(Request $request)
    {
        $req_rabel_id = $request->id;
        return view('byRabel', compact('req_rabel_id'));
    }

    // rabel一覧表示
    public function axiosByRabel(Request $request)
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $req_rabel_id = $request->id;
        // rabel_idがクエリビルだのrabel_idと一致するテーブルのタイトルを取得する。
        $title_filer_rabel = Todo::select('title')
            ->where('user_id', $user_id)
            ->where('rabel_id', $req_rabel_id)
            ->where('status', 1)
            ->orderBy('deadline', 'asc')
            ->first();
        // rabel_idがクエリビルダのrabel_idと一致するテーブルの全カラムを取得する。
        $todos_filer_rabel = Todo::where('user_id', $user_id)
            ->where('rabel_id', $req_rabel_id)
            ->where('status', 1)
            ->get();
            dd($todos_filer_rabel);
        return [$title_filer_rabel, $todos_filer_rabel];
    }

    public function axiosGetTodos(Request $request)
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $rabel_id_axios = $request->id;
        $todos_sts_1 = Todo::where('user_id', $user_id)->where('status', 1)->get();
        $todos_sts_1_fit = Todo::where('user_id', $user_id)->where('status', 1)->where('rabel_id', $rabel_id_axios)->get();
        $todos_sts_1_dead = Todo::where('user_id', $user_id)->where('status', 1)->orderBy('deadline', 'asc')->first();
        $todos_sts_1_fit_dead = Todo::where('user_id', $user_id)->where('status', 1)->where('id', $rabel_id_axios)->orderBy('deadline', 'asc')->first();
        return [$todos_sts_1, $todos_sts_1_fit, $todos_sts_1_dead, $todos_sts_1_fit_dead]; //, $todos_sts_1_title, $todos_sts_1_rabel
    }
    
    public function axiosGetRabels()
    {
        $user = Auth::user();

        $user_id = $user['id'];
        $rabels_sts_1 = Rabel::where('user_id', $user_id)->where('status', 1)->get();
        return $rabels_sts_1;
    }

    public function axiosGetIdRabels()
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $rabels_id_1 = Rabel::select('rabel_id')->where('user_id', $user_id)->where('status', 1)->get();
        return $rabels_id_1;
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
        return redirect()->route('top')->with('success', 'タスクを追加しました。');
    }


    public function edit(Request $request)
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $todos_id = $request->id;
        $todo = Todo::where('user_id', $user_id)->where('id', $todos_id)->where('status', 1)->first();
        $rabels = Rabel::select('rabel_content')->where('user_id', $user_id)->where('status', 1)->get();
        $titles = Todo::select('title')->where('user_id', $user_id)->where('status', 1)->get();
        return view('edit', compact('todos_id','todo', 'rabels', 'titles'));
    }
    // blade用update
    // public function update(Request $request)
    // {
    //     $id = $request->id;
    //     $user = Auth::user();
    //     $user_id = $user['id'];
    //     dd($request);
    //     $todo = Todo::find($id)->where('user_id', $user_id)->first();
    //     $rabel = Rabel::where('rabel_content', $request->rabel)->first();
    //     $rabel_model = new Rabel;
    //     $todo_update_post_data = $request->all(); //id, title, rabel, content, priority, deadline, (token).
    //     unset($todo_update_post_data['_token']);
    //     $todo->fill($todo_update_post_data)->save();
    //     if(!$rabel){
    //         $rabel_model->fill([
    //             'user_id' => $user_id, 
    //             'rabel_content' => $request->rabel, 
    //             'status' => 1, 
    //             ])->save();
    //     }
    //     return redirect('/top');
    // }
    
    // vue用update
    public function update(Request $request)
    {
        $id = $request->id;
        $user = Auth::user();
        $user_id = $user['id'];
        
        $todo = Todo::find($id)->where('user_id', $user_id)->first(); //edited todo.
        $todo_eq_post_rabel_count = Todo::where('rabel', $request->rabel)->where('user_id', $user_id)->count(); //equal post-rabel-num.
        $todo_update_post_data = $request->all(); //post(id, title, rabel, content, priority, deadline, (token)).
        unset($todo_update_post_data['_token']);
        
        $rabel_eq_post_rabel = Rabel::where('rabel_content', $request->rabel)->get();// check if exists post-rabel in rabels-table.
        if($rabel_eq_post_rabel->count() > 0 && $todo_eq_post_rabel_count == 1){
            $rabel_eq_post_rabel->fill(['status' => 2])->save();
            $new_rabel_id = Rabel::insertGetId([
                'rabel_content' => $request->rabel, 
                'user_id' => $user_id, 
                'status' => 1,
            ]);
            $todo->fill($todo_update_post_data)->save();
            $todo->fill(['rabel_id' => $new_rabel_id])->save();
        } elseif($rabel_eq_post_rabel->count() > 0 && $todo_eq_post_rabel_count > 1) {
            dd($rabel_eq_post_rabel);
            $todo->fill($todo_update_post_data)->save();
            $todo->fill(['rabel_id' => $rabel_eq_post_rabel['rabel_id']])->save();
            }else {
                $new_rabel_id = Rabel::insertGetId([
                    'rabel_content' => $request->rabel, 
                    'user_id' => $user_id, 
                    'status' => 1,
                ]);
                $todo->fill($todo_update_post_data)->save();
                $todo->fill(['rabel_id' => $new_rabel_id])->save();
            }
        return redirect('/top');
    }
    // 完了ページ
    public function done()
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $todos = Todo::where('user_id', $user_id)->where('status', 2)->get();
        return view('done', compact('todos'));
    }
    public function done_axios()
    {
        $user = Auth::user();
        $user_id = $user['id'];
        $cols = Schema::getColumnListing('todos');
        $cols = array_diff($cols, array('user_id', 'rabel_id', 'status', 'updated_at'));
        $cols = array_values($cols);
        $todos = new Todo;
        $todos = Todo::where('user_id', $user_id)->where('status', 2)->get();
        // Carbon::createFromFormat('Y-m-d H:i:s', $todos->created_at)->format('Y-m-d');
        foreach($todos as $todo) {
            unset($todo['user_id'],$todo['rabel_id'],$todo['status'],$todo['updated_at']);
        }
        return [$cols, $todos];
    }
    
    public function done_axios_post(Request $request)
    {
        $user = Auth::user();
        $user_id = $user['id'];
        dd($request->id);
        $todos = Todo::find($request->input('id'));
        $todos->stauts = $request->input('status');
        return redirect('/top');
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

}
