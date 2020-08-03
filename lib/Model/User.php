<?php
namespace Bbs\Model;
class User extends \Bbs\Model {
  public function create($values) {
    $stmt = $this->db->prepare("INSERT INTO users (username,email,password,created,modified) VALUES (:username,:email,:password,now(),now())");
    $res = $stmt->execute([
      ':username' => $values['username'],
      ':email' => $values['email'],
      // パスワードのハッシュ化
      ':password' => password_hash($values['password'],PASSWORD_DEFAULT)
    ]);
    //　メールアドレスがユニークでなければfalseを返す
    if ($res === false) {
      // print_r($stmt->errorInfo());
      // exit;
      throw new \Bbs\Exception\DuplicateEmail();
    }
  }
  public function login($values) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email;");
    $stmt->execute([
      ':email' => $values['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();
    if (empty($user)) {
      throw new \Bbs\Exception\UnmatchEmailOrPassword();
    }
    if (!password_verify($values['password'], $user->password)) {
      throw new \Bbs\Exception\UnmatchEmailOrPassword();
    }
    //　自分で書いた課題の所
    if ($user->delflag == 1) { 
      throw new \Bbs\Exception\DeleteUser();
    }
    return $user;
  }

  public function find($id) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id;");
    $stmt->bindValue('id',$id);
    $stmt->execute();
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    $user = $stmt->fetch();
    return $user;
  }

  public function update($values) {
    $stmt = $this->db->prepare("UPDATE users SET username = :username,email = :email, image = :image, modified = now() where id = :id");
    $res = $stmt->execute([
      ':username' => $values['username'],
      ':email' => $values['email'],
      'image' => $values['userimg'],
      ':id' => $_SESSION['me']->id,
    ]);
    if ($res === false) {
      throw new \Bbs\Exception\DuplicateEmail();
    }
  }

  public function delete() {
    $stmt = $this->db->prepare("UPDATE users SET delflag = :delflag,modified = now() where id = :id");
    $stmt->execute([
      ':delflag' => 1,
      ':id' => $_SESSION['me']->id,
    ]);
  }

  //追加課題
  public function adminUsers() {
    $stmt = $this->db->query("SELECT id,username,email,image,authority,delflag FROM users");
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

}


