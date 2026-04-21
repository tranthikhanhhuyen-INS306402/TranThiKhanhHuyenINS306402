```php
<?php

class RequestController 
{
    public function index() 
    {
        // 1. Get the list of requests for this student from RequestRepository
        // 2. Return the view file: Views/requests/index.php
    }

    // Show the form to create a new request
    public function create() 
    {
        // 1. Return the form view: Views/requests/create.php
    }

    // Handle saving a new request
    public function store() 
    {
        // 1. Read title and description from POST data
        // 2. Call RequestService to save the request to the database
        // 3. Redirect to the request list page (/requests)
    }

    // Staff updates request status
    public function updateStatus($id) 
    {
        // 1. Read the new status from POST data
        // 2. Call service to change status: service.changeStatus(id, newStatus)
        // 3. Redirect to the request detail page (/requests/{id})
    }
}
```
