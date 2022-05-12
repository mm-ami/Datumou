<?php 
namespace controller\topic\create;

use db\TopicQuery;
use lib\Auth;
use lib\Message;
use model\TopicModel;
use model\UserModel;
use Throwable;

function get() {
  Auth::requireLogin();

  $topic = new TopicModel;
  $topic->id = -1;
  $topic->title = '';
  $topic->public = 1;

  \view\topic\edit\index($topic, false);
}

function post() {
  Auth::requireLogin();

  $topic = new TopicModel;
  $topic->id = get_param('topic_id', null);
  $topic->title = get_param('title', null);
  $topic->public = get_param('public', null);

  $user = UserModel::getSession();

  try {
    $is_success = TopicQuery::insert($topic, $user);
  } catch(Throwable $e) {
    $is_success = false;
  }

  if($is_success) {
    Message::push(Message::INFO, "投稿内容が登録されました。");
    redirect("home");
  } else {
    Message::push(Message::ERROR, "投稿に失敗しました。");
    redirect("GO_REFERER");
  }
}