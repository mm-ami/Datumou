<?php 
namespace lib;

use Throwable;

function route($rpath, $method) {
  try {
    if($rpath === '') {
      $rpath = 'home';
    }
    
    $targetFile = PHP_BASE . "controllers/{$rpath}.php";
    if(!file_exists($targetFile)) {
      require_once PHP_BASE . "views/404.php";
      return;
    } 
  
    require_once $targetFile;
  
    $rpath = str_replace('/', '\\', $rpath);
    $fn = "\\controller\\{$rpath}\\{$method}";
  
    $fn();

  } catch(Throwable $e) {
    redirect('404');
  }
}