<?php 
enum ResponseMessage {

    public const SELECT_MESSAGE = "Tải dữ liệu %s %s. ";
    public const INSERT_MESSAGE = "Thêm dữ liệu %s %s. ";
    public const UPDATE_MESSAGE = "Cập nhật dữ liệu %s %s. ";
    public const DELETE_MESSAGE = "Xoá dữ liệu %s %s. ";
    public const SUCCESS_MESSAGE = "Thành công. ";  
    public const FAIL_MESSAGE = "Lỗi thực thi %s. ";
    public const INPUT_EMPTY_MESSAGE = "Vui lòng nhập đầy đủ thông tin %s. ";
    public const INPUT_INVALID_TYPE_MESSAGE = "Thông tin %s sai định dạng. ";
    public const DATA_EMPTY_MESSAGE = "Dữ liệu %s trống. ";
    public const DATA_DOES_NOT_MATCH_MESSAGE = "Dữ liệu %s không khớp. ";
    public const OBJECT_EXISTS_MESSAGE = "%s đã tồn tại. ";
    public const OBJECT_DOES_NOT_EXIST_MESSAGE = "%s không tồn tại. ";
    public const UNKNOWN_ERROR_MESSAGE = "Lỗi không xác định. Chi tiết lỗi: %s. ";
    public const REQUEST_INVALID_MESSAGE = "Yêu cầu không hợp lệ. ";
    public const ACCESS_DENIED_MESSAGE = "Quyền truy cập bị hạn chế. ";

}