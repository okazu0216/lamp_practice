<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_history($db,$user_id = null)
{
  $params = [];
    $sql = "
      SELECT
        histories.order_id,
        histories.user_id,
        histories.created,
        SUM(price*amount) AS total
      FROM
        histories
      JOIN
        details
      ON
        histories.order_id = details.order_id
      ";
      if($user_id !== null){
        $sql .= " WHERE user_id = ?";
        $params[] = $user_id;
      }
      $sql .= "
      GROUP BY
        histories.order_id
    ";
    return fetch_all_query($db, $sql,$params);
}
