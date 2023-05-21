<?php 
enum ResponseCode {

    public const FAIL = "00";
    public const SUCCESS = "01";
    public const INPUT_EMPTY = "02";
    public const INPUT_INVALID_TYPE = "03";
    public const DATA_EMPTY = "04";
    public const OBJECT_EXISTS = "05";
    public const OBJECT_DOES_NOT_EXIST = "06";
    public const DATA_DOES_NOT_MATCH = "07";
    public const ACCESS_DENIED = "08";
    public const TOKEN_INVALID = "09";
    public const REQUEST_INVALID = "98";
    public const UNKNOWN_ERROR = "99";
}