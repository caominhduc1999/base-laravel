<?php

namespace App\Exceptions;

use Dingo\Api\Routing\Helpers;
use Exception;
use Illuminate\Http\Response;

class CustomException extends Exception
{
    protected $messageId;
    protected $message;
    protected $statusCode;

    public function __construct(
        string $messageId = 'E500',
        string $message = 'Internal server error',
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ) {
        parent::__construct($message);
        $this->messageId = $messageId;
        $this->message = $message;
        $this->statusCode = $statusCode;
    }
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        return false;
    }

    public function getMessageId()
    {
        return $this->messageId;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
