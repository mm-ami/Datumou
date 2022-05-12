<?php 
namespace partials;

function topic_home_item($topic, $detail_url) {
?>
  <li class="card-item">
    <a href="<?php echo $detail_url; ?>" class="card-title"><?php echo $topic->title; ?></a>
    <canvas id="chart" class="home-canvas" width="10" height="10" data-effective="<?php echo $topic->effective ?>" data-noeffective="<?php echo $topic->noeffective ?>"></canvas>
    <a href="<?php echo $detail_url; ?>"class="card-detail">詳細を見る</a>
  </li>
<?php 
}