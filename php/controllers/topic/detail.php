<?php 

namespace controller\topic\detail;

use Throwable;
use db\TopicQuery;
use db\CommentQuery;
use db\DataSource;
use lib\Message;
use lib\Auth;
use model\TopicModel;
use model\CommentModel;
use model\UserModel;

function get() {
  $topic = new TopicModel;
  $topic->id = get_param('topic_id', null, false);

  TopicQuery::IncrementViewCount($topic);

  $topic = TopicQuery::fetchById($topic);
  $comments = CommentQuery::fetchByCommentId($topic);

  if(empty($topic) || !$topic->public) {
    Message::push(Message::ERROR, '詳細を表示できません。');
    redirect('404');
  }

  \view\topic\detail\index($topic, $comments);
}

function post() {
  Auth::requireLogin();

  $comment = new CommentModel;
  $comment->topic_id = get_param('topic_id', null);
  $comment->agree = get_param('agree', null);
  $comment->body = get_param('body', null);

  $user = UserModel::getSession();
  $comment->user_id = $user->id;
  
  try {
    $db = new DataSource;

    $db->begin();

    $is_success = TopicQuery::effect($comment);
    
    if($is_success) {
      $is_success = CommentQuery::insert($comment);
    }
  } catch(Throwable $e) {
    $is_success = false;
  } finally {
    if($is_success) {
      $db->commit();
      Message::push(Message::INFO, "クチコミが登録されました。");
    } else {
      $db->rollback();
      Message::push(Message::ERROR, "クチコミの登録に失敗しました。");
    }
  }

  redirect('topic/detail?topic_id=' . $comment->topic_id);
}