<?php

require_once 'Request.php';

class RequestRepository
{
    private array $data = [];

    public function __construct()
    {
        // fake data
        $this->data[] = new Request(1, 'Broken chair', 'Chair in room A1 is broken');
    }

    public function all(): array
    {
        return $this->data;
    }

    public function findById(int $id): ?Request
    {
        foreach ($this->data as $request) {
            if ($request->id === $id) {
                return $request;
            }
        }
        return null;
    }

    public function save(array $data): void
    {
        $id = count($this->data) + 1;
        $this->data[] = new Request($id, $data['title'], $data['description']);
    }

    public function updateStatus(int $id, string $status): void
    {
        foreach ($this->data as $request) {
            if ($request->id === $id) {
                $request->status = $status;
            }
        }
    }
}