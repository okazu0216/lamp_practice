<?php
require_once '../conf/const.php';
require_once '../model/functions.php';
require_once '../model/user.php';
require_once '../model/item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$sort = get_sort();
//a要素からのデータを受け取り
$page = get_get('page');
//初期画面の際のif文
if($page === ''){
  $page = 1;
}
$offset = ROWS_PER_PAGE * ($page - 1);
$items = sort_items($db, $sort, $offset);
var_dump($db, $sort, $offset, $page);
include_once VIEW_PATH . 'index_view.php';