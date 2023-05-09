<?php 
enum Enum {


    // GENDER
    public const GENDER_MALE = 1;
    public const GENDER_FEMALE = 0;
    public const GENDER_OTHER = 2;

    // ROLE ADMIN
    public const ROLE_MANAGER = 1;
    public const ROLE_NEWS = 2;
    public const ROLE_SALE = 3;

    // STATUS ADMIN 
    public const ADMIN_STATUS_ACTIVE = 1;
    public const ADMIN_STATUS_RETIRED = 0;

    // CAN FEEDBACK
    public  const CAN_FEEDBACK_NO = 0;
    public  const CAN_FEEDBACK_YES = 1;

    // DISCOUNT 
    public const DISCOUNT_PUBLIC = 1;
    public const DISCOUNT_PRIVATE = 0;

    //SERVICE TYPE
    public  const SERVICE_CAT = 0;
    public  const SERVICE_DOG = 1;
    public const SERVICE_BOTH = 2;

    //TYPE PET
    public  const TYPE_DOG = 1;
    public  const TYPE_CAT = 0;
    public  const TYPE_BOTH = 2;

    //STATUS APPOINTMENT
    public const STATUS_APPOINTMENT_CONFIRMED_NO = 0;
    public const STATUS_APPOINTMENT_CONFIRMED_YES = 1;
    public const STATUS_APPOINTMENT_CANCEL = 2;
    public const STATUS_APPOINTMENT_COMPLETED = 3;

}