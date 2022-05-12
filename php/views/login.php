<?php 
namespace view\login;

function index() { ?>
  <div id="form-main">
    <div class="form-inner">
      <h2>ログイン</h2>
      <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
        <div class="inner">
          <label for="id">ユーザーID</label>
          <input id="id" type="text" name="id">
        </div>
        <div class="inner">
          <label for="pwd">パスワード</label>
          <input id="pwd" type="password" name="pwd">
        </div>
        <div class="form-btn">
          <a href="<?php the_url('register'); ?>">新規作成</a>
          <input type="submit" value="ログイン">
        </div>
      </form>
    </div>
  </div>
<?php 
}



