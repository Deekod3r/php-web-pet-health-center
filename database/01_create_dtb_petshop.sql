# create database web_shop_pet;
# use web_shop_pet;

create table admin
(
    ad_id int primary key auto_increment, -- mã admin - default
    ad_username varchar(100) not null, -- họ tên
    ad_password varchar(32) not null, -- mật khẩu
    ad_role tinyint(1) not null, -- chức vụ: 1-quản lý, 2-NV tin tức, 3-NV QL bán hàng
    ad_status boolean default true not null, -- trạng thái: 1-đang làm, 0-nghỉ việc, -- linh hoạt
    is_delete boolean default false not null, -- xoá mềm -- default
    constraint unique_account unique(ad_username, is_delete)
);


create table customer
(
    ctm_id int primary key auto_increment, -- mã khách hàng --default
    ctm_name varchar(100) not null, -- họ tên
    ctm_phone varchar(13) not null unique, -- số điện thoại
    ctm_email varchar(255) unique, -- email
    ctm_address varchar(255), -- địa chỉ
    ctm_password varchar(32), -- mật khẩu
    ctm_gender boolean, -- giới tính: 1-nam, 0-nữ
    ctm_can_feedback boolean default false not null, -- khả năng đánh giá: 1-có, 0-không --default
    ctm_active boolean default true not null, -- 1: có, 0: không
    is_delete boolean not null default false,
    constraint check_ctm_password check (length(ctm_password) >= 8 or length(ctm_password) <= 32),
    constraint check_ctm_name check(length(ctm_name) >= 2)
);
create table discount
(
    dc_id int auto_increment primary key,
    dc_code varchar(50) not null, -- mã giảm giá
    dc_description varchar(500) not null, -- mô tả
    dc_condition double not null default 0, -- điều kiện (VD: điều kiện tối thiểu 500.000 -> value = 500.000)
    dc_value double not null default 0, -- giá trị giảm trực tiếp (VD: giảm 10.000 -> value = 10.000)
    dc_value_percent double not null default 0, -- giá trị giảm theo phần trăm  (VD: giảm 10% -> value_percent = 10)
    dc_start_time date not null, -- thời gian bắt đầu
    dc_end_time date not null, -- thời gian kết thúc
    dc_quantity int, -- số lượng mã giảm (có thể null nếu không giới hạn số lượng mã)
    dc_active boolean not null default false, -- trạng thái: 1-công khai, 0-bí mật -- linh hoạt
    is_delete boolean not null default false, -- xoá mềm: 1-xoá, 0-không -- default
    constraint check_discount_time check(dc_start_time < dc_end_time),
    constraint check_discount_percent check(dc_value_percent >= 0 and dc_value_percent <= 100),
    constraint check_discount_value check(dc_value >= 0),
    constraint check_discount_quantity check(dc_quantity > 0)
);


create table pet
(
    pet_id int primary key auto_increment, -- mã thú cưng --default
    pet_name varchar(100) not null, -- tên
    pet_type boolean not null,-- loại thú cưng: 1-chó, 0-mèo
    pet_species varchar(100) not null, -- chủng loại thú cưng (chó:becgie, ngao,...; mèo: anh ngắn, anh dài,...)
    pet_gender boolean not null, -- giới tính: 1-đực, 0-cái
    pet_note text, -- mô tả đặc điểm
    ctm_id int, -- mã khách hàng
    is_delete boolean not null default false,
    constraint fk_pet_customer foreign key (ctm_id) references customer(ctm_id)
);

create table category_news
(
    cn_id int primary key auto_increment, -- mã danh mục tin tức --default
    cn_name varchar(100) not null, -- tên
    is_delete boolean default false not null -- xoá mềm: 1-xoá, 0-không -- default,
    -- constraint unique_cn unique(cn_name,is_delete)
);

create table news
(
   news_id int primary key auto_increment, -- mã tin tức --default
   news_title varchar(100) not null, -- tiêu đề
   news_description varchar(500) not null, -- mô tả
   news_content text not null, -- nội dung
   news_img varchar(500) not null, -- ảnh
   news_date_release datetime not null default now(), -- ngày phát hành
   news_active boolean default true not null, -- trạng thái: 1-công khai, 0-ẩn với khách hàng
   is_delete boolean default false not null,
   ad_id int, -- mã admin
   cn_id int, -- mã danh mục tin tức
   constraint fk_news_admin foreign key (ad_id) references admin(ad_id),
   constraint fk_news_category foreign key (cn_id) references category_news(cn_id)
);


create table category_service
(
    cs_id int primary key auto_increment, -- mã danh mục dịch vụ --default
    cs_name varchar(100) not null, -- tên
    is_delete boolean default false not null -- xoá mềm: 1-xoá, 0-không -- default
);


create table service
(
    sv_id int primary key auto_increment, -- mã dịch vụ --default
    sv_name varchar(255) not null, -- tên
    sv_img varchar(500) not null, -- ảnh
    sv_price double not null, -- giá
    sv_description varchar(500) not null, -- mô tả
    sv_pet tinyint(1) not null, -- loại thú cưng: 1-chó, 0-mèo, 2-cả 2
    sv_status boolean default true not null, -- trạng thái: 1-hoạt động, 0-dừng kinh doanh
    is_delete boolean default false not null, -- xoá mềm - default
    cs_id int, -- mã danh mục dịch vụ
    constraint fk_service_category foreign key (cs_id) references category_service(cs_id),
    constraint check_service_price check(sv_price >= 0)
);

create table appointment
(
    apm_id int primary key auto_increment, -- mã lịch hẹn -- default
    apm_date date not null, -- ngày hẹn
    apm_time time not null, -- thời gian hẹn
    apm_booking_at datetime not null default now(), -- thời gian đặt
    apm_cancel_at datetime, -- thời gian hủy (nếu có)
    apm_status tinyint(1) default 3 not null, -- trạng thái:0-huỷ, 1-đã hoàn thành, 2- đã xác nhận, 3-chờ xác nhận
    apm_note varchar(500) default ' ',
    ctm_id int, -- mã khách hàng
    cs_id int, -- mã nhóm dịch vụ
    is_delete boolean default false,
    constraint fk_appointment_customer foreign key (ctm_id) references customer(ctm_id),
    constraint fk_appointment_category_service foreign key (cs_id) references category_service(cs_id)
);

create table bill
(
    bill_id int primary key auto_increment, -- mã hóa đơn -- default
    bill_date_release datetime not null default current_timestamp, -- ngày thanh toán -- linh hoạt
    is_delete boolean default false not null, -- -- default
    bill_status tinyint(1) default 0 not null, -- 2: huỷ, 1: đã thanh toán, 0: chờ thanh toán
    ctm_id int, -- mã khách hàng
    ad_id int, -- mã admin
    dc_id int, -- mã giảm giá
    sub_total float not null default 0, --
    value_reduced float default 0 not null, -- giá trị được giảm
    total_value float not null default (sub_total - value_reduced),
    constraint fk_bill_customer foreign key (ctm_id) references customer(ctm_id),
    constraint fk_bill_admin foreign key (ad_id) references admin(ad_id),
    constraint fk_bill_discount foreign key (dc_id) references discount(dc_id),
    constraint check_value_reduced check(value_reduced >= 0),
    constraint check_total_value check(total_value >= 0),
    constraint check_sub_total check(sub_total >= 0)
);

create table detail_bill
(
    detail_id int primary key auto_increment, -- mã chi tiết hóa đơn -- default
    bill_id int, -- mã hóa đơn
    sv_id int, -- mã dịch vụ
    quantity int not null, -- số lượng dịch vụ
    sv_price double not null, -- giá dịch vụ
    is_delete boolean default false not null, -- default
    value float not null default (sv_price * quantity), --
    constraint fk_do_service foreign key (sv_id) references service (sv_id),
    constraint fk_do_bill  foreign key (bill_id) references bill (bill_id),
    constraint check_value check(value >= 0)
);

create table feedback
(
    fb_id int primary key auto_increment, -- mã đánh giá --default
    fb_content text not null, -- nội dung
    fb_rating tinyint(1) not null, -- đánh giá range(1-5)
    fb_time datetime not null default now(), -- thời gian đánh giá -- linh hoạt
    is_delete boolean default false not null, -- default
    ctm_id int, -- mã khách hàng
    constraint fk_feedback_ctm foreign key (ctm_id) references customer(ctm_id),
    constraint check_feedback_rating check(fb_rating >= 0 and fb_rating <=5)
);

alter table feedback add column fb_status boolean default true not null;

create table shop_info
(
    shop_id int primary key default 1,
    shop_name varchar(150), -- Tên shop
    shop_address varchar(150) not null, -- địa chỉ
    shop_phone char(20) not null, -- số điện thoại
    shop_mail varchar(30) not null, -- số điện thoại
    shop_description text, -- mô tả
    shop_facebook varchar(255) not null, -- địa chỉ facebook
    is_delete boolean not null default false
)



