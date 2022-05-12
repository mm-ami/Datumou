<?php 
namespace view\topic\detail;

use lib\Auth;

function index($topic, $comments) {
?>
  <section id="detail">
    <div class="detail-main">
      <div class="left">
        <h2><?php echo $topic->title; ?></h2>
        <div class="sub-detail">
          <span><?php echo $topic->nickname; ?></span>
          <span>&bull;</span>
          <span><?php echo $topic->views; ?> views</span>
        </div>
        <div class="existence">
          <div class="effective">
            <div><?php echo $topic->effective ?></div>
            <div>効果あり</div>
          </div>
          <div class="noeffective">
            <div><?php echo $topic->noeffective ?></div>
            <div>効果なし</div>
          </div>
        </div>
        <?php if(Auth::isLogin()) : ?>
        <form class="detail-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
          <div class="form-check-inline">
            <input class="form-check-input" type="radio" id="agree" name="agree" value="1" required checked>
            <label for="agree" class="form-check-label">効果あり</label>
          </div>
          <div class="form-check-inline">
            <input class="form-check-input" type="radio" id="disagree" name="agree" value="0" required>
            <label for="disagree" class="form-check-label">効果なし</label>
          </div>
          <p>口コミを記入せず、効果あり・効果なしだけでも送信できます。</p>
          <input type="hidden" name="topic_id" value="<?php echo $topic->id; ?>">
          <div class="form-group">
            <textarea name="body" id="body" maxlength="300"></textarea>
          </div>
          <input class="detail-input" type="submit" value="送信する">
        </form>
        <?php else : ?>
          <div class="login-prompt">
            <div>ログインをして口コミを投稿しよう!</div>
            <a href="<?php the_url('login'); ?>">ログイン画面へ</a>
          </div>
        <?php endif ; ?>
      </div>
      <div class="right">
        <canvas id="chart" width="450" height="450" data-effective="<?php echo $topic->effective ?>" data-noeffective="<?php echo $topic->noeffective ?>"></canvas>
      </div>
    </div>
    <div id="detail-comments">
      <ul>
        <?php foreach($comments as $comment) : ?>
          <?php 
            $agree_label = $comment->agree ? '効果あり' : '効果なし';
            $agree_class = $comment->agree ? 'comment-effective' : 'comment-noeffective';
          ?>
        <li class="comments-list">
          <div class="comments-title">
            <h2>
              <span class="<?php echo $agree_class; ?>"><?php echo $agree_label; ?></span>
              <span href="">@<?php echo $comment->nickname; ?></span>
            </h2>
          </div>
          <div class="comments-body"><?php echo $comment->body; ?></div>
        </li>
        <?php endforeach ; ?>
      </ul>
    </div>
  </section>
<?php 
}