# admin
create or replace view view_admin
as
    select
       ad_id, ad_username, ad_role, ad_status
    from admin
    where is_delete = false;

select * from view_admin;

# customer
create or replace view view_customer
as
    select
        ctm_id, ctm_name, ctm_phone, ctm_email, ctm_address, ctm_gender, ctm_can_feedback, ctm_active
    from customer
    where is_delete = false;

select * from view_customer;

# discount
create or replace view view_discount
as
    select
        dc_id, dc_code, dc_description, dc_condition, dc_value, dc_value_percent, dc_start_time, dc_end_time, dc_quantity, dc_active
    from discount
    where is_delete = false;

select * from view_discount;

# pet_join_customer
create or replace view view_pet_join_customer
as
    select
       pet_id, pet_name, pet_type, pet_species, pet_gender, pet_note, ctm_name, ctm_phone
    from pet join customer c on c.ctm_id = pet.ctm_id
    where pet.is_delete = false;

select * from view_pet_join_customer;

# pet
create or replace view view_pet
as
    select
       pet_id, pet_name, pet_type, pet_species, pet_gender, pet_note, ctm_id
    from pet
    where is_delete = false;

select * from view_pet;

# category_news
create or replace view view_category_news
as
    select
       cn_id, cn_name
    from category_news
    where is_delete = false;

select * from view_category_news;

# news
create or replace view view_news
as
    select
        news_id, news_title, news_description, news_content, news_img, news_date_release, news_active, ad_id, cn_id
    from news
    where is_delete = false;

select * from view_news;

# news_join_category_news_and_admin
create or replace view view_news_join_category_news_and_admin
as
    select
        news_id, news_title, news_description, news_content, news_img, news_date_release, ad_username, cn_name
    from (news inner join admin a on news.ad_id = a.ad_id) inner join category_news cn on news.cn_id = cn.cn_id
    where news.is_delete = false;

select * from view_news_join_category_news_and_admin;

# category_service
create or replace view view_category_service
as
    select
       cs_id, cs_name
    from category_service
    where is_delete = false;

select * from view_category_service;

# service_join_category_service
create or replace view view_service_join_category_service
as
    select
       sv_id, sv_name, sv_img, sv_price, sv_description, sv_pet, sv_status, cs_name
    from service join category_service cs on cs.cs_id = service.cs_id
    where service.is_delete = false;

select * from view_service_join_category_service;

# material
create or replace view view_material
as
    select
       mtr_id, mtr_name
    from material
    where is_delete = false;

select * from view_material;

# detail_service
create or replace view view_detail_service
as
    select
        detail_id, sv_id, mtr_id, quantity
    from detail_service
    where is_delete = false;

select * from view_detail_service;

# appointment
create or replace view view_appointment
as
    select
        apm_id, apm_date, apm_time, apm_status, ctm_id, cs_id
    from appointment
    where is_delete = false;

select * from view_appointment;

# appointment_join_category_service
create or replace view view_appointment_join_category_service_and_customer
as
    select
        apm_id, apm_date, apm_time, apm_status, ctm_name, cs_name
    from (appointment join category_service cs on cs.cs_id = appointment.cs_id) join customer c on c.ctm_id = appointment.ctm_id
    where appointment.is_delete = false;

select * from view_appointment_join_category_service_and_customer;

# bill
create or replace view view_bill
as
    select
        bill_id, bill_date_release, bill_status, ctm_id, ad_id, dc_code, value_temp, value_reduced, total_value
    from bill
    where is_delete = false;

select * from view_bill;

# bill_join_customer_and_admin_and_discount
create or replace view view_bill_join_customer_and_admin_and_discount
as
    select
        bill_id, bill_date_release, bill_status, ctm_name, ad_username, dc_code, value_temp, value_reduced, total_value
    from (bill join customer c on c.ctm_id = bill.ctm_id) join admin a on a.ad_id = bill.ad_id
    where bill.is_delete = false;

select * from view_bill_join_customer_and_admin_and_discount;

# detail_bill
create or replace view view_detail_bill
as
    select
        detail_id, bill_id, sv_id, quantity, sv_price, pet_id, value
    from detail_bill
    where is_delete = false;

select * from view_detail_bill;

# detail_bill_join_service_and_pet
create or replace view view_detail_bill_join_service_and_pet
as
    select
        detail_id, bill_id, sv_name, quantity, detail_bill.sv_price, pet_name, value
    from (detail_bill join service s on s.sv_id = detail_bill.sv_id) join pet p on p.pet_id = detail_bill.pet_id
    where detail_bill.is_delete = false;

select * from view_detail_bill_join_service_and_pet;

# feedback
create or replace view view_feedback
as
    select
        fb_id, fb_content, fb_rating, fb_time, ctm_id
    from feedback
    where is_delete = false;

select * from view_feedback;

# feedback_join_customer
create or replace view view_feedback_join_customer
as
    select
        fb_id, fb_content, fb_rating, fb_time, ctm_name
    from feedback join customer c on c.ctm_id = feedback.ctm_id
    where feedback.is_delete = false;

select * from view_feedback_join_customer;

