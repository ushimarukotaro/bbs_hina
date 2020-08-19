<?php
require_once(__DIR__ . '/header.php');
$adminUser = new Bbs\Model\User();
$users = $adminUser->adminUsers();

?>

<h1 class="page__ttl">ユーザーテーブル管理画面</h1>
<?php if ($_SESSION['me']->authority != 99) : ?>
  <p class="err">このページを表示する権限がありません</p>
  <a href="<?= SITE_URL; ?>/thread_all.php" class="btn btn-primary new-btn">戻る</a>
<?php else : ?>
  <a href="create-user.php" class="btn btn-primary new-btn">新規登録へ</a>
  <p>更新または削除を行うユーザーを選択してください</p>
  <form method="post" class="form users_table">
    <table class="admin_table">
      <tr class="users_tr">
        <th></th>
        <th>id</th>
        <th>ユーザー名</th>
        <th>メールアドレス</th>
        <th>ユーザー画像</th>
        <th>権限</th>
        <th>削除フラグ</th>
      </tr>
      <?php foreach ($users as $user) : ?>
        <tr class="users_row">
          <td><input type="radio" id="<?= $user['id']; ?>" name="id" value="<?= h($user['id']); ?>" required></td>
          <td><label for="<?= $user['id']; ?>" class="border_line"><?= h($user['id']); ?></label></td>
          <td><input type="text" name="username<?= $user['id']; ?>" value="<?= h($user['username']); ?>"></td>
          <td><input type="text" name="email<?= $user['id']; ?>" value="<?= h($user['email']); ?>"></td>
          <td><input type="text" name="image<?= $user['id']; ?>" value="<?= h($user['image']); ?>"></td>
          <td><input type="text" name="authority<?= $user['id']; ?>" value="<?= h($user['authority']); ?>"></td>
          <td><input type="text" name="delflag<?= $user['id']; ?>" value="<?= h($user['delflag']); ?>"></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <input type="submit" formaction="users_edit_confirm.php" name="edit" class="btn btn-primary new-btn" value="更新">
    <input type="submit" formaction="admin_user_delete_confirm.php" name="delete" class="btn btn-primary new-btn" value="削除">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>

<?php endif; ?>
<?php

require_once(__DIR__ . '/footer.php');
