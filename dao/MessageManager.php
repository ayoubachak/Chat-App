<?php
class MessageManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(Message $message) {
        $timestamp = new DateTime();
        $formattedTimestamp = $timestamp->format('Y-m-d H:i:s');
        $query = "INSERT INTO messages (owner_id, content, timestamp) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $message->getOwnerId(),
            $message->getContent(),
            $formattedTimestamp
        ]);
        $message->setId($this->db->lastInsertId());
    }

    public function read($id) {
        $query = "SELECT * FROM messages WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row) {
            return new Message($row['id'], $row['owner_id'], $row['content'], $row['timestamp']);
        }
        return null;
    }

    public function update(Message $message) {
        $query = "UPDATE messages SET owner_id = ?, content = ?, timestamp = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $message->getOwnerId(),
            $message->getContent(),
            $message->getTimestamp(),
            $message->getId()
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM messages WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }
    public function getAll() {
        $query = $this->db->prepare('SELECT m.*, u.username, u.profile_image FROM messages m INNER JOIN users u ON m.owner_id = u.id');
        $query->execute();
        $rows = $query->fetchAll();
        
        $messages = [];
        foreach ($rows as $row) {
          $message = [];
          $message['id'] = $row['id'];
          $message['owner_id'] = $row['owner_id'];
          $message['timestamp'] = $row['timestamp'];
          $message['content'] = $row['content'];
          $message['username'] = $row['username'];
          $message['profile_image'] = $row['profile_image'];
          $messages[] = $message;
        }
        
        return $messages;
    }
}
