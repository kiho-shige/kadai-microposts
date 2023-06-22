<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;                    
use App\Models\User;

class UsersController extends Controller
{
    public function index()                     
    {                                                   
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10); 

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [                    
            'users' => $users,                              
        ]);                                                 
    }                                                       
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザーの投稿一覧を作成日時の降順で取得
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }
     public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'bio' => 'max:255',
            'loc' => 'max:255',
        ]);
        
        // idの値でメッセージを検索して取得
        $user = User::findOrFail($id);
        // メッセージを更新
        //$user->fill($request->all())->save();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->loc = $request->loc;
        $user->save(); 

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $user = User::findOrFail($id);
        
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は編集
        if (\Auth::id() === $user->id) {
            return view('profile.profile_edit', [
            'user' => $user,
            /*'name' => $name,
            'email' => $email,
            'bio' => $bio,
            'loc' => $loc*/
        ]);
        } 

        // 前のURLへリダイレクトさせる
        return redirect('/')
            ->with('Edit Failed'); 
    }
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    /**
     * ユーザのお気に入りページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function favorites($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのお気に入り一覧を取得
        $favorites = $user->favorites()->paginate(10);

        // お気に入り一覧ビューでそれらを表示
        return view('users.favorites', [
            'user' => $user,
            'microposts' => $favorites,
        ]);
    }
}
