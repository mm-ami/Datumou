<?php 
namespace view\topic\edit;

function index($topic, $edit) {
  $main_title = $edit ? '編集' : '投稿内容';
?>
  <div id="edit-form">
    <div class="edit-form-inner">
      <h2><?php echo $main_title ?></h2>
      <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
        <input type="hidden" name="topic_id" value="<?php echo $topic->id ?>">
        <div class="inner">
          <label for="title">店舗名・商品名など</label>
          <input id="title" type="text" name="title" value="<?php echo $topic->title; ?>">
        </div>
        <div class="inner">
          <label for="public">公開・非公開設定</label>
          <select name="public" id="public">
            <option value="1" <?php if($topic->public === 1) echo 'selected' ; ?>>公開</option>
            <option value="0" <?php if($topic->public === 0) echo 'selected' ; ?>>非公開</option>
          </select>
        </div>
        <div class="form-btn">
          <input type="submit" value="送信">
        </div>
      </form>
    </div>
  </div>
<?php 
}