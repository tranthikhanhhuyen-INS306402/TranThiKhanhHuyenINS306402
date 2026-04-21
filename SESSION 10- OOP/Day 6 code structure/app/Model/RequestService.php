<?php

class RequestService
{
    private RequestRepository $repository;
    private RequestValidator $validator;

    public function __construct(RequestRepository $repository, RequestValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function getAll(): array
    {
        return $this->repository->all();
    }

    public function getById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): void
    {
        $this->validator->validate($data);
        $this->repository->save($data);
    }

    public function changeStatus(int $id, string $status): void
    {
        $allowed = ['Pending', 'In Progress', 'Done'];

        if (!in_array($status, $allowed)) {
            throw new Exception('Invalid status');
        }

        $this->repository->updateStatus($id, $status);
    }
}