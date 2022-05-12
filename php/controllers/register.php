<?php 
namespace controller\register;

use lib\Auth;
use lib\Message;
use model\UserModel;

function get() {
  \register\index();
}

function post() {
  $user = new UserModel;
  $user->id = get_param('id', '');
  $user->pwd = get_param('pwd', '');
  $user->nickname = get_param('nickname', '');

  if (Auth::register($user)) {
    Message::push(Message::INFO, "{$user->nickname}さん、ようこそ。");
    redirect("GO_HOME");
  } else {
    redirect("GO_REFERER");
  }
}