<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'history.php';
require_once MODEL_PATH . 'detail.php';


session_start();

if(is_logined() === false){
    redirect_to(LOGIN_URL);
  }

$db = get_db_connect();

$order_id = get_post_order_id();

$user = get_login_user($db);

if(is_admin($user) === false){
  $details = get_detail($db,$order_id,$user['user_id']);
}else{
  $details = get_detail($db, $order_id);
}

include_once VIEW_PATH . 'detail_view.php';