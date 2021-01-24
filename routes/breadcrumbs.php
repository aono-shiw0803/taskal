<?php

// トップ
Breadcrumbs::for('posts', function ($trail) {
    $trail->push('TOP', url('posts'));
});
// トップ > 完了タスク一覧
Breadcrumbs::for('conclusions', function ($trail) {
    $trail->parent('posts');
    $trail->push('完了タスク一覧', url('conclusions'));
});
// トップ > タスク詳細
Breadcrumbs::for('posts-show', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('タスク詳細', url('posts/' . $post->id));
});
// トップ > 新規登録
Breadcrumbs::for('posts-create', function ($trail) {
    $trail->parent('posts');
    $trail->push('タスク追加', url('tasks/create'));
});
// トップ > タスク詳細 > 編集
Breadcrumbs::for('posts-edit', function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('タスク詳細', url('posts/' . $post->id));
    $trail->push('編集', action('PostController@edit', $post));
});


// トップ > 案件一覧
Breadcrumbs::for('matters', function ($trail) {
    $trail->parent('posts');
    $trail->push('案件一覧', url('matters'));
});
// トップ > 案件一覧 > タイトル
Breadcrumbs::for('matters-show', function ($trail, $matter) {
    $trail->parent('posts');
    $trail->push('案件一覧', url('matters'));
    $trail->push($matter->name, url('matters, $matter->id'));
});
// トップ > 案件一覧 > 新規登録
Breadcrumbs::for('matters-create', function ($trail) {
    $trail->parent('posts');
    $trail->push('案件一覧', url('matters'));
    $trail->push('案件追加', url('matters/create'));
});
// トップ > 案件一覧 > タイトル > 編集
Breadcrumbs::for('matters-edit', function ($trail, $matter) {
    $trail->parent('posts');
    $trail->push('案件一覧', url('matters'));
    $trail->push($matter->name, url('matters/' . $matter->id));
    $trail->push('編集', action('MatterController@edit', $matter));
});


// トップ > メンバー一覧
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('posts');
    $trail->push('メンバー一覧', url('users'));
});
// トップ > メンバー一覧 > 名前
Breadcrumbs::for('users-show', function ($trail, $user) {
    $trail->parent('posts');
    $trail->push('メンバー一覧', url('users'));
    $trail->push($user->name, url('users, $user->id'));
});
// トップ > メンバー一覧 > 名前 > 編集
Breadcrumbs::for('users-edit', function ($trail, $user) {
    $trail->parent('posts');
    $trail->push('メンバー一覧', url('users'));
    $trail->push($user->name, url('users/' . $user->id));
    $trail->push('編集', action('UserController@edit', $user));
});


// トップ > ファイル一覧
Breadcrumbs::for('files', function ($trail) {
    $trail->parent('posts');
    $trail->push('ファイル一覧', url('files'));
});
// トップ > ファイル一覧 > 新規ファイルアップロード
Breadcrumbs::for('files-create', function ($trail) {
    $trail->parent('posts');
    $trail->push('ファイル一覧', url('files'));
    $trail->push('新規ファイルアップロード', url('files/create'));
});
