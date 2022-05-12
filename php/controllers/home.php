<?php
namespace controller\home;

use db\TopicQuery;

function get() {

  $topics = TopicQuery::fetchByTopicId();

  if(count($topics) > 0) {
    \view\home\index($topics);
  } else {
    echo '<div class="info">投稿がありません。</div>';
  }
}
