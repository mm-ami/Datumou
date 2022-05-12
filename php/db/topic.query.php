<?php 
namespace db;

use db\DataSource;
use model\TopicModel;

class TopicQuery {
  public static function fetchByUserId($user) {

    if(!$user->isValidId()) {
      return false;
    }

    $db = new DataSource;
    $sql = 'SELECT * from topics WHERE user_id = :id and del_flg != 1 order by id desc;';
    
    return $db->select($sql, [':id' => $user->id], DataSource::CLS, TopicModel::class);
  }

  public static function fetchByTopicId() {

    $db = new DataSource;
    $sql = 'SELECT * from topics WHERE public != 0 and del_flg != 1 order by id desc;';
    
    return $db->select($sql, [], DataSource::CLS, TopicModel::class);
  }

  public static function fetchById($topic) {

    if(!$topic->isValidId()) {
      return false;
    }

    $db = new DataSource;
    $sql = '
    select 
        topics.*, users.nickname 
    from topics  
    inner join users
        on topics.user_id = users.id 
    where 
        topics.id = :id
        and topics.del_flg != 1
        and users.del_flg != 1
    order by topics.id desc;
    ';
    
    return $db->selectOne($sql, [
      ':id' => $topic->id
    ], DataSource::CLS, TopicModel::class);
  }

  public static function IncrementViewCount($topic) {
    if(!$topic->isValidId()) {
      return false;
    }

    $db = new DataSource;
    $sql = 'update topics set views = views + 1 where id = :id';

    return $db->execute($sql, [':id' => $topic->id]);
  }

  public static function isUserTopics($topic_id, $user) {

    if(!(TopicModel::validateId($topic_id) && $user->isValidId())) {
      return false;
    }

    $db = new DataSource;
    $sql = '
      select count(1) as count from topics where topics.id = :topic_id
      and topics.user_id = :user_id
      and topics.del_flg != 1
    ';
    
    $result = $db->selectOne($sql, [
      ':topic_id' => $topic_id,
      ':user_id' => $user->id
    ]);

    return isset($result) && $result['count'] != 0;
  }

  public static function update($topic) {

    if(!($topic->isValidId() * $topic->isValidTitle())) {
      return false;
    }

    $db = new DataSource;
    $sql = 'update topics set public = :public, title = :title where id = :id';

    return $db->execute($sql, [
      ':public' => $topic->public,
      ':title' => $topic->title,
      ':id' => $topic->id
    ]); 
  }

  public static function insert($topic, $user) {
    if(!$topic->isValidTitle()) {
      return false;
    }

    $db = new DataSource;
    $sql = 'insert into topics(title, public, user_id) values (:title, :public, :user_id)';

    return $db->execute($sql, [
      ':title' => $topic->title,
      ':public' => $topic->public,
      ':user_id' => $user->id
    ]);  
  }

  public static function effect($comment) {
    if(!$comment->isValidTopicId()) {
      return false;
    }

    $db = new DataSource;

    if($comment->agree) {
      $sql = 'update topics set effective = effective + 1 where id = :topic_id';
    } else {
      $sql = 'update topics set noeffective = noeffective + 1 where id = :topic_id';
    }
    return $db->execute($sql, [
      ':topic_id' => $comment->topic_id
    ]);
  }
}