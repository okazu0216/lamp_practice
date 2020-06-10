<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>購入履歴</title>
    <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'history.css'); ?>">
</head>

<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>カート</h1>
    <div class="container">

        <?php include VIEW_PATH . 'templates/messages.php'; ?>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>注文番号</th>
                    <th>購入日時</th>
                    <th>該当の注文の合計金額</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($histories as $history) { ?>
                    <tr>
                        <td><?php print h($history['order_id']); ?></td>
                        <td><?php print h($history['created']); ?></td>
                        <td>
                            <p class="text-right">合計金額: <?php print h(number_format($history['total'])); ?>円</p>
                        </td>
                        <td>
                            <form method="post" action="detail.php">
                                <input type="submit" value="購入明細">
                                <input type="hidden" name="order_id" value="<?php print h($history['order_id']);?>">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>