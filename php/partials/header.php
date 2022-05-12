<?php 
namespace partials;

use lib\Auth;
use lib\Message;

function header() {
?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/datumou/css/style.css">
    <title>脱毛口コミサイト</title>
  </head>
  <body>
  <div id="container">
  <header>
    <a href="<?php the_url(''); ?>" class="title">脱毛クチコミサイト</a>
    <div class="header-nav">
      <?php if(Auth::isLogin()) : ?>
        <a href="<?php the_url('topic/create'); ?>">投稿する</a>
        <a href="<?php the_url('topic/archive'); ?>">過去の投稿</a>
        <a href="<?php the_url('logout'); ?>">ログアウト</a>
      <?php else : ?>
        <a href="<?php the_url('register'); ?>">新規作成</a>
        <a href="<?php the_url('login'); ?>">ログイン</a>
      <?php endif ; ?>
    </div>
  </header>
<?php 
Message::display();
}