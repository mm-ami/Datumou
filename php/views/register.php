<?php
namespace register;
function index() { ?>
  <div id="form-main">
    <div class="form-inner">
      <h2>新規作成</h2>
      <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
        <div class="inner">
          <label>ユーザーID</label>
          <input type="text" name="id">
        </div>
        <div class="inner">
          <label>パスワード</label>
          <input type="password" name="pwd">
        </div>
        <div class="inner">
          <label for="nickname">ニックネーム</label>
          <input id="nickname" type="text" name="nickname">
        </div>
        <div class="form-btn">
          <a href="<?php the_url('login'); ?>">ログイン</a>
          <input type="submit" value="登録">
        </div>
      </form>
    </div>
  </div>
<?php 
}
