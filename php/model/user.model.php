<?php 
namespace model;

use lib\Message;

class UserModel extends AbstractModel {
  public string $id;
  public string $pwd;
  public string $nickname;
  public int $del_flg;

  protected static $SESSION_NAME = '_user';

  public static function validateId($val) {
    $res = true;

    if(empty($val)) {
      Message::push(Message::ERROR, 'ユーザーIDを入力してください。');
      $res = false;
    } else {

      if(strlen($val) > 10) {
        Message::push(Message::ERROR, 'ユーザーIDは10桁以下で入力してください。');
        $res = false;
      }

      if(!is_regex($val))  {
        Message::push(Message::ERROR, 'ユーザーIDは半角英数字で入力してください。');
        $res = false;
      }
    }

    return $res;
  }

  public function isValidId() {
    return static::validateId($this->id);
  }

  public static function validatePwd($val) {
    $res = true;
    if (empty($val)) {
      Message::push(Message::ERROR, 'パスワードを入力してください。');
      $res = false;
    } else {

      if(strlen($val) < 4) {
        Message::push(Message::ERROR, 'パスワードは４桁以上で入力してください。');
        $res = false;
      } 
      
      if(!is_regex($val)) {
        Message::push(Message::ERROR, 'パスワードは半角英数字で入力してください。');
        $res = false;
      }
    }

    return $res;
  }

  public function isValidPwd() {
    return static::validatePwd($this->pwd);
  }

  public static function validateNickname($val) {
    $res = true;

    if (empty($val)) {
      Message::push(Message::ERROR, 'ニックネームを入力してください。');
      $res = false;
    } else {

      if(mb_strlen($val) > 10) {
        Message::push(Message::ERROR, 'ニックネームは１０桁以下で入力してください。');
        $res = false;
      } 
    }
    
    return $res;
  }

  public function isValidNickname() {
    return static::validateNickname($this->nickname);
  }
}

