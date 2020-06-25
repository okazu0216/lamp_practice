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
$page = get_get('page');
if($page === ''){
  $page = 1;
}
$offset = ROWS_PER_PAGE * ($page - 1);
$items = sort_items($db, $sort, $offset);
$count_pages = get_record_count_pages($db);
$rec_count = get_record_count($db, true);
$start = ($page - 1) * ROWS_PER_PAGE + 1;
$end = $start + ROWS_PER_PAGE -1;
if ($page == $count_pages){
  $end = $rec_count;
}
include_once VIEW_PATH . 'index_view.php';