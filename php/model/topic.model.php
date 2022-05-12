<?php

namespace model;

use lib\Message;

class TopicModel extends AbstractModel{
  public int $id;
  public string $title;
  public int $public;
  public int $views;
  public int $effective;
  public int $noeffective;
  public string $user_id;
  public int $del_flg;
  protected static $SESSION_NAME = '_topic';

  public function isValidId(){
    return static::validateId($this->id);
  }

  public static function validateId($val) {
    $res = true;

    if (empty($val) || !is_numeric($val)) {
      Message::push(Message::ERROR, 'パラメータが不正です。');
        $res = false;
    }

    return $res;
  }

  public function isValidTitle(){
    return static::validateTitle($this->title);
  }

  public static function validateTitle($val) {
    $res = true;

    if (empty($val)) {
      Message::push(Message::ERROR, 'タイトルを入力してください。');
      $res = false;
    } else {

      if (mb_strlen($val) > 40) {
        Message::push(Message::ERROR, 'タイトルは40文字以内で入力してください。');
        $res = false;
      }
    }

    return $res;
  }
}
