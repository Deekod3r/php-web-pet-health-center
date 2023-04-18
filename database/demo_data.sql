-- admin
insert into admin (ad_id, ad_name, ad_phone, ad_person_id, ad_gender, ad_birthday, ad_password, ad_role, ad_status)
            values (default,'Test','0396432023','026304002516',0,'2002/11/19','13434345678',1,1),
                   (default,'Thuận','0383092429','125904887',1,'2002/04/29','765434343421',3,1),
                   (default,'Hải','0383092123','125904457',1,'2002/04/29','765434343421',3,0),
                   (default,'Dũng','0965744590','987654322',1,'2002/02/02','123323232457',2,1);
-- select * from admin;
-- customer
insert into customer (ctm_id, ctm_name, ctm_phone, ctm_email, ctm_address, ctm_password, ctm_gender, ctm_can_feedback)
            values (default,'Hằng','0383094429',null,null,null,1,default),
                   (default,'Sơn','0383092427','son262965@huce.edu.vn','Trại Cá','262965',1,default),
                   (default,'Đạt','0383092324','dat262965@gmail.com','Thanh Xuan ','789987',1,1);
-- select * from customer;
-- discount
insert into discount (dc_code, dc_description, dc_condition, dc_value, dc_value_percent, dc_start_time, dc_end_time, dc_quantity, dc_active, dc_is_delete)
            values ('HAPPYPET','Mã giảm giá ngày khai trương',default,50000,default,'2023/03/15','2023/03/22',null,1,default),
                   ('DOCLAP75','Mã giảm giá sự kiện 30/4 - 1/5',300000,0 ,5,'2023/04/29','2023/05/01',50,1,default),
                   ('TET88','Mã giảm giá cho sự kiện tết nguyên đán',200000,50000,10,'2023/12/01','2024/2/01',null,0,default); -- test
-- select * from discount;
-- pet
insert into pet (pet_id, pet_name, pet_type, pet_species, pet_gender, pet_note, ctm_id)
            values (default,'Bun',1,'Ngáo',1,'chân ngắn, màu lông trắng, 10kg',1),
                   (default,'Tun',1,'Corgy',1,'chân ngắn, lông vàng, 3kg',2),
                   (default,'Mun',0,'Anh lông ngắn',0,'Lông vàng, tai cụp, 2kg',3);
-- select * from pet;
-- category_news
insert into category_news (cn_id, cn_name, cn_is_delete)
            values (default,'Chăm sóc mèo',default ),
                   (default,'Chăm sóc chó',default),
                   (default,'Tin tức về CarePET',default),
                   (default,'Cuộc thi về chó mèo',default);
-- select * from category_news;
-- news
insert into news (news_id, news_title, news_description, news_content, news_img, news_date_release, news_active, ad_id, cn_id)
            values (default,'Cách chăm sóc corgi','Chăm sóc corgi,tắm, lượng thức ăn hằng ngày,...','Chó Corgi năng động, dồi dào năng lượng. Nguồn gốc là những chú chó chăn cừu, chó Corgi có nhu cầu vận động cao, và có xu hướng tìm công việc để làm như gặm đồ, đuổi bắt… Đặc biệt, chó Corgi có tật xấu là săn đuổi và cắn gót chân, ống quần của người.','#','2023/04/15',1,4,2),
                   (default,'Cách chăm sóc mèo anh ','Chăm sóc mèo tắm, lượng thức ăn' ,'Tính cách nổi trội của mèo Anh lông ngắn là chúng rất dễ tính, thích sự yên tĩnh nhưng rất tình cảm và quấn chủ','#','2023/04/25',1,4,1);
-- select * from news;
-- category_service
insert into category_service (cs_id, cs_name, cs_is_delete)
            values (default,'Y tế', default),
                   (default,'Vệ sinh',default),
                   (default,'Làm đẹp',default);
-- select * from category_service;
-- service
insert into service (sv_id, sv_name, sv_img, sv_price, sv_description, sv_pet, sv_status, sv_is_delete, cs_id)
            values (default,'Tiêm phòng dại','#',500000,'Tiêm phòng dại cho cún trên 1 năm tuổi',1,1,default,1),
                   (default,'Cắt tỉa lông','#',200000,'Cắt tỉa lông sư tử ',1,1,default,3),
                   (default, 'Tắm cho mèo < 3kg','#',100000,'Tắm cho mèo < 3kg, lông ngắn,',0,0,default,2);
-- select * from service;
-- material
insert into material (mtr_id, mtr_name, mtr_quantity, mtr_is_delete)
            values (default,'Vaccine',30,default ),
                    (default,'Sữa tắm ',40,default),
                    (default,'Dầu thơm',10,default);
-- select * from material;
-- detail_service
insert into detail_service (detail_id, sv_id, mtr_id, quantity, detail_is_delete)
            values (default,1,1,1,default),
                   (default,2,null,1,default),
                   (default,3,2,2,default),
                   (default,3,3,1,default);
-- select * from detail_service;
-- appointment
 insert into appointment (apm_id, apm_date, apm_time, apm_status, ctm_id, cs_id)
            values (default,'2023/04/16','9:30:00',2,2,1), -- kh2 đặt onl-> hủy
                   (default,'2023/03/16','9:30:00',3,1,3), -- kh1 đặt trực tiếp -> đã hoàn thành
                   (default,'2023/04/16','10:30:00',3,3,1), -- kh3 đặt onl -> đã hoàn thành
                   (default,'2023/04/18','2:45:00',1,3,2); -- kh3 đặt onl -> đã xác nhận
-- select * from appointment;
-- bill
insert into bill (bill_id, bill_date_release, bill_status, bill_is_delete, ctm_id, ad_id, dc_code)
            values (default,'2023/03/16',default,default,1,3,'HAPPYPET'), -- kh1, giảm 50k vs đơn tối thiểu 0đ
                    (default,'2023/04/16',default,default,3,2,null); -- kh2 ko đc giảm giá
-- select * from bill;
-- detail_bill
insert into detail_bill (detail_id, bill_id, sv_id, quantity, sv_price, pet_id, detail_is_delete)
            values (default,1,2,1,200000,1,default), -- kh1 cắt tỉa lông cho chó
                    (default,2,1,1,100000,3,default); -- kh3 tiêm phòng cho mèo lông ngắn
-- select * from detail_bill;
-- feedback
insert into feedback (fb_id, fb_content, fb_rating, fb_time, fb_is_delete, ctm_id)
            values (default,'Nhân viên nhiệt tình, thân thiện. Dịch vụ rất tốt.',5,'2023/04/16 13:00:00',default,3);
-- select * from feedback;
-- shop_info
insert into shop_info (shop_name, shop_address, shop_phone, shop_description, shop_facebook, shop_website, shop_banner, shop_logo)
            value ('CarePET','55 Giải Phóng','0933434343','Cửa hàng chăm sóc thú cưng CarePET','https://www.facebook.com/carepet.nhom2','https://carepet.com','#','#');
-- select * from shop_info;

