<?php
class Message {
    private $id;
    private $ownerId;
    private $content;
    private $timestamp;

    public function __construct($id, $ownerId, $content, $timestamp) {
        $this->id = $id;
        $this->ownerId = $ownerId;
        $this->content = $content;
        $this->timestamp = $timestamp;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getOwnerId() {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId) {
        $this->ownerId = $ownerId;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
}
