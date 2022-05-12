<?php 
namespace controller\logout;

use lib\Auth;
use lib\Message;

function get() {
  if(Auth::logout()) {
    Message::push(Message::INFO, 'ログアウトが成功しました。');
  } else {
    Message::push(Message::ERROR, 'ログアウトが失敗しました。');
  }

  redirect('GO_HOME');
}