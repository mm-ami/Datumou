<?php 
namespace partials;

function topic_list_item($topic, $title_url) {
  $public_label = $topic->public ? '公開' : '非公開';
  $public_class = $topic->public ? 'span-red' : 'span-blue';
?>
  <li class="card-item">
    <span class="<?php echo $public_class; ?> public"><?php echo $public_label; ?></span>
    <a href="<?php echo $title_url; ?>" class="card-title"><?php echo $topic->title; ?></a>
    <div class="card-view">
      <span>閲覧数</span>
      <span><?php echo $topic->views; ?></span>
    </div>
    <canvas id="chart" class="home-canvas" width="10" height="10" data-effective="<?php echo $topic->effective ?>" data-noeffective="<?php echo $topic->noeffective ?>"></canvas>
    <?php if($topic->effective == 0 && $topic->noeffective == 0) : ?>
    <?php else : ?>
    <div class="card-number">
      <p><?php echo $topic->effective; ?></p>
      <p><?php echo $topic->noeffective; ?></p>
    </div>
    <?php endif ; ?>
  </li>
<?php
}
