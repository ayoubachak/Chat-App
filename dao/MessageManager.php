<?php
class MessageManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(Message $message) {
        $query = "INSERT INTO messages (owner_id, content, timestamp) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $message->getOwnerId(),
            $message->getContent(),
            $message->getTimestamp()
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
}
