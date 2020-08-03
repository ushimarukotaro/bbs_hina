<?php
require_once(__DIR__ . '/header.php');
$adminUser = new Bbs\Model\User();
$users = $adminUser->adminUsers();
//var_dump($users);
?>

<h1 class="page__ttl">ユーザーテーブル管理画面</h1>
<?php if ($_SESSION['me']->authority != 99) : ?>
  <p class="err">このページを表示する権限がありません</p>
<?php else : ?>
  <a href="create-user.php" class="btn btn-primary new-btn">新規登録へ</a>
  <p>更新または削除を行うユーザーを選択してください</p>
  <form method="post" action="users_edit_confirm.php" class="form users_table">
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
          <td><input type="radio" id="<?= $user['id']; ?>" name="id" value="<?= h($user['id']); ?>"></td>
          <td><label for="<?= $user['id']; ?>" class="border_line"><?= h($user['id']); ?></label></td>
          <td><input type="text" name="username<?= $user->id; ?>" value="<?= h($user['username']); ?>"></td>
          <td><input type="text" name="email<?= $user->id;?>" value="<?= h($user['email']); ?>"></td>
          <td><input type="text" name="image<?= $user->id; ?>" value="<?= h($user['image']); ?>"></td>
          <td><input type="text" name="authority<?= $user->id; ?>" value="<?= h($user['authority']); ?>"></td>
          <td><input type="text" name="delflag<?= $user->id; ?>" value="<?= h($user['delflag']); ?>"></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <input type="submit" class="btn btn-primary new-btn" value="更新">
    <input type="button" class="btn btn-primary new-btn" value="削除">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
<?php endif; ?>
<?php
require_once(__DIR__ . '/footer.php');
