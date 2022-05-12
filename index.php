<?php

require_once 'config.php';

// library
require_once PHP_BASE . 'libs/auth.php';
require_once PHP_BASE . 'libs/helper.php';
require_once PHP_BASE . 'libs/router.php';
// model
require_once PHP_BASE . 'model/abstract.model.php';
require_once PHP_BASE . 'model/user.model.php';
require_once PHP_BASE . 'model/topic.model.php';
require_once PHP_BASE . 'model/comment.model.php';

require_once PHP_BASE . 'libs/message.php';
// db
require_once PHP_BASE . 'db/datasource.php';
require_once PHP_BASE . 'db/user.query.php';
require_once PHP_BASE . 'db/topic.query.php';
require_once PHP_BASE . 'db/comment.query.php';
// partials
require_once PHP_BASE . 'partials/topic-home-item.php';
require_once PHP_BASE . 'partials/topic-list-item.php';
require_once PHP_BASE . 'partials/header.php';
require_once PHP_BASE . 'partials/footer.php';
// view
require_once PHP_BASE . 'views/home.php';
require_once PHP_BASE . 'views/login.php';
require_once PHP_BASE . 'views/register.php';
require_once PHP_BASE . 'views/topic/archive.php';
require_once PHP_BASE . 'views/topic/detail.php';
require_once PHP_BASE . 'views/topic/edit.php';

use function lib\route;

session_start();

\partials\header();

$url = parse_url($_SERVER['REQUEST_URI']);

$rpath = str_replace('/datumou/', '', $url['path']);
$method = strtolower($_SERVER["REQUEST_METHOD"]);

route($rpath, $method);
\partials\footer();