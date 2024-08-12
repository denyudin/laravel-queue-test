<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class ModelSaveException extends Exception
{
    public function __construct($message = "Failed to save the model", $code = 500)
    {
        parent::__construct($message, $code);
    }
}
