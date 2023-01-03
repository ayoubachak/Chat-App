<?php
class UserManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(User $user) {
        $query = "INSERT INTO users (username, password, profile_image, last_login, date_of_birth) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $user->getUsername(),
            $user->getPassword(),
            $user->getProfileImage(),
            $user->getLastLogin(),
            $user->getDateOfBirth()
        ]);
        $user->setId($this->db->lastInsertId());
    }

    public function read($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row) {
            return new User($row['id'], $row['username'], $row['password'], $row['profile_image'], $row['last_login'], $row['date_of_birth']);
        }
        return null;
    }

    public function update(User $user) {
        $query = "UPDATE users SET username = ?, password = ?, profile_image = ?, last_login = ?, date_of_birth = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $user->getUsername(),
            $user->getPassword(),
            $user->getProfileImage(),
            $user->getLastLogin(),
            $user->getDateOfBirth(),
            $user->getId()
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }

    public function getByUsernameAndPassword($username, $password)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
        $query->bindValue(':username', $username);
        $query->bindValue(':password', md5($password));
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $user = new User(
                $row['id'],
                $row['username'],
                $row['password'],
                $row['profile_image'],
                $row['last_login'],
                $row['date_of_birth']
            );
            return $user;
        }
        return null;
    }

    public function getByUsername($username)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $query->bindValue(':username', $username);
        $query->execute();

        $user = $query->fetchObject('User');
        return $user;
    }
}
