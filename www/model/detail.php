<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_detail($db,$order_id,$user_id = null)
{
    $params = [$order_id];
    $sql = "
        SELECT
            details.order_id,
            details.item_id,
            details.price,
            details.amount,
            items.name,
            details.price*amount AS total
        FROM
            details
        JOIN
            items
        ON
            details.item_id = items.item_id
        WHERE
            details.order_id = ?
    ";
    if ($user_id !== null){
        $sql .= " AND EXISTS (SELECT * FROM histories WHERE order_id = ? AND user_id = ?)";
        $params[] = $order_id;
        $params[] = $user_id;
    }
    return fetch_all_query($db, $sql, $params);
}

