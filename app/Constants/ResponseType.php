<?php

namespace App\Constants;

class ResponseType
{
    const SUCCESS = [
        "code" => "200",
        "rc" => "00",
        "status" => true,
        "message" => "Success",
    ];

    const CREATED = [
        "code" => "201",
        "rc" => "00",
        "status" => true,
        "message" => "Data has been created successfully",
    ];

    const UPDATED = [
        "code" => "200",
        "rc" => "00",
        "status" => true,
        "message" => "Data has been updated successfully",
    ];

    const DELETED = [
        "code" => "200",
        "rc" => "00",
        "status" => true,
        "message" => "Data has been deleted successfully",
    ];

    const FAILED = [
        "code" => "500",
        "rc" => "99",
        "status" => false,
        "message" => "Failed",
    ];

    const FAILED_CREATE = [
        "code" => "400",
        "rc" => "99",
        "status" => false,
        "message" => "Failed to create data",
    ];

    const FAILED_UPDATE = [
        "code" => "400",
        "rc" => "99",
        "status" => false,
        "message" => "Failed to update data",
    ];

    const FAILED_DELETE = [
        "code" => "400",
        "rc" => "99",
        "status" => false,
        "message" => "Failed to delete data",
    ];

    const BAD_REQUEST = [
        "code" => "400",
        "rc" => "99",
        "status" => false,
        "message" => "Bad Request",
    ];

    const UNAUTHORIZED = [
        "code" => "401",
        "rc" => "99",
        "status" => false,
        "message" => "Unauthorized",
    ];

    const FORBIDDEN = [
        "code" => "403",
        "rc" => "99",
        "status" => false,
        "message" => "Forbidden",
    ];

    const NOT_FOUND = [
        "code" => "404",
        "rc" => "99",
        "status" => false,
        "message" => "Not Found",
    ];

    const VALIDATION_ERROR = [
        "code" => "422",
        "rc" => "99",
        "status" => false,
        "message" => "Form Validation Error",
    ];

    const DATABASE_ERROR = [
        "code" => "500",
        "rc" => "99",
        "status" => false,
        "message" => "Error connecting to database",
    ];

    const DATABASE_VALIDATION_ERROR = [
        "code" => "400",
        "rc" => "99",
        "status" => false,
        "message" => "Database Validation Error",
    ];

    const CHIPER_KEY_INVALID = [
        "code" => "400",
        "rc" => "03",
        "status" => false,
        "message" => "Cipher key is invalid",
    ];

    const INVALID_SLIK = [
        "code" => "400",
        "rc" => "99",
        "status" => false,
        "message" => "No matching data found",
    ];
}
