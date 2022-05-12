<?php 
namespace controller\topic\edit;

use db\TopicQuery;
use lib\Auth;
use lib\Message;
use model\TopicModel;
use model\UserModel;
use Throwable;

function get() {
  Auth::requireLogin();

  $topic = new TopicModel;
  $topic->id = get_param('topic_id', null, false);

  $user = UserModel::getSession();
  Auth::requirePermission($topic->id, $user);

  $fetchUserTopic = TopicQuery::fetchById($topic);

  \view\topic\edit\index($fetchUserTopic, true);
}

function post() {
  Auth::requireLogin();

  $topic = new TopicModel;
  $topic->id = get_param('topic_id', null);
  $topic->title = get_param('title', null);
  $topic->public = get_param('public', null);

  $user = UserModel::getSession();
  Auth::requirePermission($topic->id, $user);

  try {
    $is_success = TopicQuery::update($topic);
  } catch(Throwable $e) {
    $is_success = false;
  }

  if($is_success) {
    Message::push(Message::INFO, "内容を更新しました。");
    redirect("topic/archive");
  } else {
    Message::push(Message::ERROR, "内容の更新に失敗しました。");
    redirect("GO_REFERER");
  }
}