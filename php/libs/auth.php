<?php 
namespace lib;

use db\TopicQuery;
use db\UserQuery;
use model\UserModel;
use Throwable;


class Auth {
  public static function login($id, $pwd) {
    try {
      if(!(UserModel::validateId($id) * UserModel::validatePwd($pwd))) {
        return false;
      }
      $is_success = false;
      $user = UserQuery::fetchById($id);
  
      if(!empty($user) && $user->del_flg !== 1) {
        if(password_verify($pwd, $user->pwd)) {
          $is_success = true;
          UserModel::setSession($user);
        } else {
          Message::push(Message::ERROR, 'ユーザー名とパスワードの組み合わせが正しくありません。');
        }
      } else {
        Message::push(Message::ERROR, 'ユーザーが見つかりません。');
      }

    } catch (Throwable $e) {
      $is_success = false;
      Message::push(Message::ERROR, 'ログイン処理でエラーが発生しました。少し時間を置いてから再度お試しください。');
    }

    return $is_success;
  }

  public static function register($user) {

    try {
      if(!($user->isValidId() * $user->isValidPwd() * $user->isValidNickname())) {
        return false;
      }

      $is_success = false;
      $catch_user = UserQuery::fetchById($user->id);
      var_dump($catch_user);
      if(!empty($catch_user)) {
        Message::push(Message::ERROR, '既に登録されているユーザー名です。');

        return false;
      }
  
      $is_success = UserQuery::insert($user);
      if($is_success) {
        UserModel::setSession($user);
      }

    } catch (Throwable $e) {
      $is_success = false;
      Message::push(Message::DEBUG, $e->getMessage());
      Message::push(Message::ERROR, '新規作成処理でエラーが発生しました。少し時間を置いてから再度お試しください。');
    }

    return $is_success;
  }

  public static function isLogin() {
    try {
      $user = UserModel::getSession();
    } catch (Throwable $e) {
      UserModel::clearSession();
      Message::push(Message::ERROR, 'エラーが発生しました。再度ログインを行ってください。');
      return false;
    }

    if(isset($user)) {
      return true;
    } else {
      return false;
    }
  }

  public static function logout() {
    try {
      UserModel::clearSession();
    } catch (Throwable $e) {
      Message::push(Message::DEBUG, $e->getMessage());
      return false;
    }

    return true;
  }

  public static function requireLogin() {
    if(!static::isLogin()) {
      Message::push(Message::ERROR, 'ログインしてください。');
      redirect('login');
    }
  }

  public static function hasPermission($topic_id, $user) {
    return TopicQuery::isUserTopics($topic_id, $user);
  }

  public static function requirePermission($topic_id, $user) {
    if(!static::hasPermission($topic_id, $user)) {
      Message::push(Message::ERROR, "編集権限がありません。ログイン後、再度お試しください。");
      redirect("login");
    }
  }
}