<?php

namespace AccSync\Pohoda\Enum;

/**
 * Class EResponseErrorCodes
 *
 * @package AccSync\Pohoda\Enum
 * @author  miroslav.soukup2@gmail.com
 */
class EResponseErrorCodes
{
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const REQUEST_TIMEOUT = 408;
    const INTERNAL_SERVER_ERROR = 500;
    const BAD_GATEWAY = 502;
    const SERVICE_UNAVAILABLE = 503;
    const GATEWAY_TIMEOUT = 504;
    const HTTP_VERSION_NOT_SUPPORTED = 505;

    const BAD_REQUEST_TEXT = 'Syntactical error in request';
    const UNAUTHORIZED_TEXT = 'Access denied. Please authorize';
    const FORBIDDEN_TEXT = 'Correct request, but insufficient access rights for this user';
    const NOT_FOUND_TEXT = 'Requested document not found';
    const METHOD_NOT_ALLOWED_TEXT = 'Request with incorrect method (POST, GET..)';
    const REQUEST_TIMEOUT_TEXT = 'Time limit for request expired';
    const INTERNAL_SERVER_ERROR_TEXT = 'Internal server error';
    const BAD_GATEWAY_TEXT = 'Gateway or proxy server received incorrect response';
    const SERVICE_UNAVAILABLE_TEXT = 'Service is temporarily unavailable';
    const GATEWAY_TIMEOUT_TEXT = 'Gateway or proxy server did not receive response in time';
    const HTTP_VERSION_NOT_SUPPORTED_TEXT = 'Specified HTTP version is not supported';

    public static $errorCodes = [
        self::BAD_REQUEST,
        self::UNAUTHORIZED,
        self::FORBIDDEN,
        self::NOT_FOUND,
        self::METHOD_NOT_ALLOWED,
        self::REQUEST_TIMEOUT,
        self::INTERNAL_SERVER_ERROR,
        self::BAD_GATEWAY,
        self::SERVICE_UNAVAILABLE,
        self::GATEWAY_TIMEOUT,
        self::HTTP_VERSION_NOT_SUPPORTED,
    ];

    public static $errorCodesToString = [
        self::BAD_REQUEST => self::BAD_REQUEST_TEXT,
        self::UNAUTHORIZED => self::UNAUTHORIZED_TEXT,
        self::FORBIDDEN => self::FORBIDDEN_TEXT,
        self::NOT_FOUND => self::NOT_FOUND_TEXT,
        self::METHOD_NOT_ALLOWED => self::METHOD_NOT_ALLOWED_TEXT,
        self::REQUEST_TIMEOUT => self::REQUEST_TIMEOUT_TEXT,
        self::INTERNAL_SERVER_ERROR => self::INTERNAL_SERVER_ERROR_TEXT,
        self::BAD_GATEWAY => self::BAD_GATEWAY_TEXT,
        self::SERVICE_UNAVAILABLE => self::SERVICE_UNAVAILABLE_TEXT,
        self::GATEWAY_TIMEOUT => self::GATEWAY_TIMEOUT_TEXT,
        self::HTTP_VERSION_NOT_SUPPORTED => self::HTTP_VERSION_NOT_SUPPORTED_TEXT,
    ];
}