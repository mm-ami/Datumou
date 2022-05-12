<?php 
namespace controller\topic\archive;

use db\TopicQuery;
use lib\Auth;
use model\UserModel;
use lib\Message;

function get() {
  Auth::requireLogin();

  $user = UserModel::getSession();

  $topics = TopicQuery::fetchByUserId($user);

  if($topics === false) {
    Message::push(Message::ERROR, 'ログインしてください。');
    redirect('login');
  }

  if(count($topics) > 0) {
    \view\topic\archive\index($topics);
  } else {
    echo '<div class="info">投稿がありません。</div>';
  }
}