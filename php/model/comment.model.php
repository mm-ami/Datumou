<?php

namespace model;

use lib\Message;

class CommentModel extends AbstractModel{

  public int $id;
  public int $topic_id;
  public string $user_id;
  public int $del_flg;
  public string $body;
  public string $agree;
  public string $nickname;

  public function isValidTopicId() {
    return TopicModel::validateId($this->topic_id);
  }
}
