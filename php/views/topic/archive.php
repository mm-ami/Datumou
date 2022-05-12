<?php 
namespace view\topic\archive;

function index($topics) {
?>
  <h2 class="archive-title">過去の投稿</h2>
    <ul class="card-inner">
      <?php foreach($topics as $topic) {
        $url = get_url('topic/edit?topic_id=' . $topic->id);
        \partials\topic_list_item($topic, $url);
      } ?>
    </ul>
<?php
}