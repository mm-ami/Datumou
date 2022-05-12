<?php 
namespace view\home;
use lib\Auth;

function index($topics) {
?>
  <main>
    <div id="main-title">
      <h2>脱毛の効果ありなしが一目でわかるクチコミサイト</h2>
      <?php if(Auth::isLogin()) : ?>
        <h3>気になる商品や、サロン名を投稿してみんなに聞いてみよう!</h3>
        <a href="<?php the_url('topic/create'); ?>">投稿する</a>
      <?php else : ?>
        <h3>ログインをすると、気になる商品やサロン名を投稿できます!</h3>
        <a href="<?php the_url('login'); ?>">ログインをする</a>
      <?php endif ; ?>
    </div>
    <div class="card">
      <ul class="card-inner">
        <?php 
        foreach($topics as $topic) {
          $url = get_url('topic/detail?topic_id=' . $topic->id);
          \partials\topic_home_item($topic, $url);
        }
        ?>
      </ul>
    </div>
  </main>
<?php
}
