<?php 
namespace db;

use db\DataSource;
use model\CommentModel;

class CommentQuery {

  public static function fetchByCommentId($topic) {

    if(!$topic->isValidId()) {
      return false;
    }

    $db = new DataSource;
    $sql = '
    select comments.*, users.nickname 
    from comments
    inner join users
        on comments.user_id = users.id 
    where comments.topic_id = :id
        and comments.body != ""
        and comments.del_flg != 1
        and users.del_flg != 1
    order by comments.id desc;
    ';
    
    return $db->select($sql, [
      ':id' => $topic->id
    ], DataSource::CLS, CommentModel::class);
  }

  public static function insert($comment) {
    $db = new DataSource;
    $sql = 'insert into comments (topic_id, user_id, agree, body) values (:topic_id, :user_id, :agree, :body)';

    return $db->execute($sql, [
      ':topic_id' => $comment->topic_id,
      ':user_id' => $comment->user_id,
      ':agree' => $comment->agree,
      ':body' => $comment->body
    ]);  
  }
}