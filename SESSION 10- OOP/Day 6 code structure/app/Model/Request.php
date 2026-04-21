<?php

class Request
{
    // Type Hinting for properties
    public int $id;
    public string $title;
    public string $description;
    public string $status;
    public string $createdAt;

    public function __construct(int $id, string $title, string $description, string $status)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->createdAt = date('Y-m-d H:i:s');
    }
}