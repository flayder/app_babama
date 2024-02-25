<?php

declare(strict_types=1);
/**
 * Exception for 413 Request Entity Too Large responses.
 */

/**
 * Exception for 413 Request Entity Too Large responses.
 */
class Requests_Exception_HTTP_413 extends Requests_Exception_HTTP
{
    /**
     * HTTP status code.
     *
     * @var int
     */
    protected $code = 413;

    /**
     * Reason phrase.
     *
     * @var string
     */
    protected $reason = 'Request Entity Too Large';
}
