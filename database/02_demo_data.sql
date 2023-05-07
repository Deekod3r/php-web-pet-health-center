-- admin
insert into admin (ad_id, ad_username, ad_password, ad_role, ad_status, is_delete)
            values (default,'admin1','13434345678',1,1,false),
                   (default,'admin2','765434343421',3,1,false),
                   (default,'admin3','765434343421',3,0,false),
                   (default,'admin','1',2,1,false);
-- select * from admin;
-- customer
insert into customer (ctm_id, ctm_name, ctm_phone, ctm_email, ctm_address, ctm_password, ctm_gender, ctm_can_feedback, ctm_active)
            values (default,'Hằng','0383094429',null,null,null,1,default, true),
                   (default,'Sơn','0383092427','son262965@huce.edu.vn','Trại Cá','262965',1,default, true),
                   (default,'Đạt','0987654321','dat262965@gmail.com','Thanh Xuan ','123456',1,false, true);

insert into customer (ctm_id, ctm_name, ctm_phone, ctm_email, ctm_address, ctm_password, ctm_gender, ctm_can_feedback, ctm_active)
            values (default,'An','0423423784','haha@gmail.com','Hà Nam','12345678',0,false, true),
                   (default,'Bình','0383242347','binh@huce.edu.vn','Vĩnh Phúc','123456',1,false, true),
                   (default,'Dương','0356575674','duong@gmail.com','Thanh Xuân ','123456',1,1, true);
-- select * from customer;
-- discount
insert into discount (dc_code, dc_description, dc_condition, dc_value, dc_value_percent, dc_start_time, dc_end_time, dc_quantity, dc_active, is_delete)
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
insert into category_news (cn_id, cn_name, is_delete)
            values (default,'Y tế',default ),
                   (default,'Dinh dưỡng',default ),
                   (default,'Thẩm mỹ',default),
                   (default,'Tin tức về CarePET',default),
                   (default,'Giải trí',default),
                   (default,'Thời sự',default);
-- select * from category_news;
-- news
insert into news (news_id, news_title, news_description, news_content, news_img, news_date_release, news_active, ad_id, cn_id, is_delete)
            values (default,'Cách chăm sóc corgi','Chăm sóc corgi,tắm, lượng thức ăn hằng ngày,...','Chó Corgi năng động, dồi dào năng lượng. Nguồn gốc là những chú chó chăn cừu, chó Corgi có nhu cầu vận động cao, và có xu hướng tìm công việc để làm như gặm đồ, đuổi bắt… Đặc biệt, chó Corgi có tật xấu là săn đuổi và cắn gót chân, ống quần của người.','#','2023/04/15',1,4,2,false),
                   (default,'Cách chăm sóc mèo anh ','Chăm sóc mèo tắm, lượng thức ăn' ,'Tính cách nổi trội của mèo Anh lông ngắn là chúng rất dễ tính, thích sự yên tĩnh nhưng rất tình cảm và quấn chủ','#','2023/04/25',1,4,1, false);
-- select * from news;
-- category_service
insert into category_service (cs_id, cs_name, is_delete)
            values (default,'Tiêm phòng', default),
                   (default,'Tư vấn dinh dưỡng',default),
                   (default,'Thẩm mỹ',default),
                    (default,'Huấn luyện',default),
                     (default,'Khám bệnh, điều trị',default);
-- select * from category_service;
-- service
insert into service (sv_id, sv_name, sv_img, sv_price, sv_description, sv_pet, sv_status, is_delete, cs_id)
            values (default,'Tiêm phòng dại cho chó','#',500000,'Tiêm phòng dại cho cún trên 1 năm tuổi',1,1,default,1),
                   (default,'Tiêm phòng bệnh do Herpervirus cho mèo','#',500000,'Tiêm phòng bệnh Herper cho mèo',1,1,default,1),
                   (default,'Cắt tỉa lông theo yêu cầu','#',200000,'Cắt tỉa lông',2,1,default,3),
                   (default,'Khám tổng quát chó','#',3000000,'Cắt tỉa lông',1,1,default,5),
                   (default,'Khám tổng quát mèo','#',2500000,'Cắt tỉa lông',0,0,default,5),
                   (default,'Điều trị viêm gan chó','#',0,'Tư vấn dinh dưỡng',1,0,default,5),
                   (default,'Huấn luyện theo yêu cầu','#',0,'Huấn luyện theo yêu cầu',2,0,default,4),
                   (default,'Tư vấn dinh dưỡng','#',0,'Tư vấn dinh dưỡng',2,0,default,2),
                   (default,'Điều trị nấm mèo','#',0,'Tư vấn dinh dưỡng',0,0,default,5),
                   (default,'Điều trị FIP mèo','#',0,'Tư vấn dinh dưỡng',0,0,default,5),
                   (default,'Điều trị viêm đường hô hấp mèo','#',0,'Tư vấn dinh dưỡng',0,0,default,5),
                   (default,'Điều trị viêm đường hô hấp chó','#',0,'Tư vấn dinh dưỡng',1,0,default,5),
                   (default, 'Tắm cho mèo < 3kg','#',100000,'Tắm cho mèo < 3kg,',0,0,default,3);
-- select * from service;
-- material
insert into material (mtr_id, mtr_name, is_delete)
            values (default,'Vaccine',default ),
                    (default,'Sữa tắm ',default),
                    (default,'Dầu thơm',default);
-- select * from material;
-- detail_service
insert into detail_service (detail_id, sv_id, mtr_id, quantity, is_delete)
            values (default,1,1,1,default),
                   (default,2,null,1,default),
                   (default,3,2,2,default),
                   (default,3,3,1,default);
-- select * from detail_service;
-- appointment
 insert into appointment (apm_id, apm_date, apm_time, apm_note ,apm_status, ctm_id, cs_id, is_delete)
            values (default,'2023/04/16','9:30:00',default,2,2,1,false), -- kh2 đặt onl-> hủy
                   (default,'2023/03/16','9:30:00',default,3,1,3,false), -- kh1 đặt trực tiếp -> đã hoàn thành
                   (default,'2023/04/16','10:30:00',default,3,3,1,false), -- kh3 đặt onl -> đã hoàn thành
                   (default,'2023/04/18','2:45:00','Có thể sẽ đến muộn 15p',1,3,2,false); -- kh3 đặt onl -> đã xác nhận
-- select * from appointment;
-- bill
insert into bill (bill_id, bill_date_release, bill_status, is_delete, ctm_id, ad_id, dc_code, value_temp,value_reduced,total_value)
            values (default,'2023/03/16',default,default,1,3,'HAPPYPET',200000,50000,150000), -- kh1, giảm 50k vs đơn tối thiểu 0đ
                    (default,'2023/04/16',default,default,3,2,null,300000,0,300000); -- kh2 ko đc giảm giá
-- select * from bill;
-- detail_bill
insert into detail_bill (detail_id, bill_id, sv_id, quantity, sv_price, pet_id, is_delete,value)
            values (default,1,2,1,200000,1,default,200000), -- kh1 cắt tỉa lông cho chó
                    (default,2,1,1,100000,3,default,100000); -- kh3 tiêm phòng cho mèo lông ngắn
-- select * from detail_bill;
-- feedback
insert into feedback (fb_id, fb_content, fb_rating, fb_time, is_delete, ctm_id)
            values (default,'Nhân viên nhiệt tình, thân thiện. Dịch vụ rất tốt.',5,'2023/04/16 13:00:00',default,2),
            (default,'Cắt tỉa lông đẹp lắm.',4,'2023/04/05 01:00:00',default,4),
            (default,'Dịch vụ tốt, sức khoẻ bé nhà mình tốt lắm.',5,'2023/04/20 20:00:00',default,5);
-- select * from feedback;
-- select * from customer
-- shop_info
insert into shop_info (shop_name, shop_address, shop_phone, shop_description, shop_facebook, shop_website, shop_banner, shop_logo, shop_mail)
            value ('CarePET','55 Giải Phóng, Đồng Tâm, Hai Bà Trưng, Hà Nội','+84 987 654 321','Cửa hàng chăm sóc thú cưng CarePET','https://www.facebook.com/carepet.nhom2','https://carepet.com','#','#','carepet@huce.com');
-- select * from shop_info;

update shop_info set shop_description = 'Hệ thống chăm sóc thú cưng số 1 HUCE, đem đến cho bạn sự yên tâm, tin tưởng, mang niềm vui tới cho thú cưng của bạn. Hệ thống chuyên cung cấp các dịch vụ thẩm mỹ, sức khoẻ, y tế, tinh thần cho thú cưng (chó, mèo). Với chất lượng dịch vụ tốt nhất luôn được khách hàng tin tưởng sẽ là điểm đến lý tưởng và tuyệt vời dành cho vật nuôi.' where 1=1

