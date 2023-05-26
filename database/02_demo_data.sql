-- admin
insert into admin (ad_id, ad_username, ad_password, ad_role, ad_status, is_delete)
            values (default,'adminQL','12345678',1,1,false),
                   (default,'adminBH01','12345678',3,1,false),
                   (default,'adminBH02','12345678',3,0,false),
                   (default,'adminTT01','1',2,0,false),
                   (default,'adminTT02','12345678',2,1,false),
                   (default,'adminBH03','12345678',3,1,false);
-- select * from admin;
-- customer
insert into customer (ctm_id, ctm_name, ctm_phone, ctm_email, ctm_address, ctm_password, ctm_gender, ctm_active,ctm_can_feedback)
            values (1,'Nguyễn Thị Hằng','0383094429',null,null,null,1, false, false),
                   (2,'Trần Lê Hoàng Sơn','0383092427','son262965@huce.edu.vn','Trại Cá, Trương Định, Hoàng Mai, Hà Nội','262965',1, true, true),
                   (3,'Nguyễn Quang Đạt','0987654321','dat262965@gmail.com','Lê Trọng Tấn, Thanh Xuân, Hà Nội','123456',1, true, true),
                   (4,'Đoàn Mạnh An','0423423784','haha@gmail.com','Đọi Tam, Duy Tiên, Hà Nam','12345678',0, true, true),
                   (5,'Nguyễn Hải Dương','0356575674','duong@gmail.com','36 Trường Chinh, Thanh Xuân, Hà Nội ','123456',1, true, true),
                   (6,'Lê Kiên Cường','0987654978',null,null,null,0, false, false),
                   (7,'Trần Lê Minh','0987123478',null,null,null,1, false, false),
                   (8,'Lê Minh Thảo','0987122345','minhthao.19@gmail.com','100 Lê Thanh Nghị, Đồng Tâm, Hai Bà Trưng, Hà Nội','minhthao123',0, true, false),
                   (9,'Tạ Thị Tú Linh','0973456428','tulinh02@gmail.com','Trần Đại Nghĩa, Bách Khoa, Hà Nội','tulinh1234',0, true, false),
                   (10,'Nguyễn Hằng Nga','0787121568','hangngakt@gmail.com','24 Kim Đồng, Hoàng Mai, Hà Nội','1234.nga',0, true, false),
                   (11,'Bùi Lê Hoa','0987123569','hoahoa@gmail.com','109 Bạch Mai, Hai Bà Trưng','BuiHoa.02',0, true, false),
                   (12,'Hoàng Quốc Việt','0987126859','vitvang2000@gmail.com','Nguyễn Hiền, Hai Bà Trưng, Hà Nội','viet.2000',1, true, false);

-- select * from customer;
update admin set ad_password = 'c4ca4238a0b923820dcc509a6f75849b' where 1=1;
update customer set ctm_password = 'c4ca4238a0b923820dcc509a6f75849b' where ctm_active = 1;

-- discount
insert into discount (dc_id, dc_code, dc_description, dc_condition, dc_value, dc_value_percent, dc_start_time, dc_end_time, dc_quantity, dc_active, is_delete)
            values (1, 'HAPPYPET','Mã giảm giá ngày khai trương',default,50000,default,'2023/03/15','2023/03/22',null,1,default),
                   (2, 'DOCLAP75','Mã giảm giá sự kiện 30/4 - 1/5',300000,0 ,5,'2023/04/29','2023/05/01',50,1,default),
                   (3, 'TET88','Mã giảm giá cho sự kiện tết nguyên đán',200000,50000,10,'2023/12/01','2024/2/01',null,0,default),
                   (4, 'HAPPYPET66','Mã giảm giá HAPPYPET66 nhân giày 6/6',200000,50000,default,'2023/05/01','2023/06/01',null,1,default),
                   (5, 'HAPPYPET88','Mã giảm giá HAPPYPET88 nhân giày 8/8',500000,100000,default,'2023/05/15','2023/05/22',10,1,default),
                   (6, 'HAPPY99','Mã giảm giá HAPPY99 nhân giày 9/9',default,default,10,'2023/04/15','2023/04/22',null,1,default),
                   (7, 'FUN88','Mã giảm giá FUN88 tài trợ bởi nhà cái FUN88',200000,default,10,'2023/9/01','2024/10/01',null,0,default),
                   (8, 'FUN99','Mã giảm giá FUN99 tài trợ bởi nhà cái FUN99',default,default,50,'2023/5/01','2024/6/01',5,0,default);
-- select * from discount;
-- pet
insert into pet (pet_id, pet_name, pet_type, pet_species, pet_gender, pet_note, ctm_id)
            values (1,'Bun',1,'Ngáo',1,'Chân ngắn, màu lông trắng, 10kg',1),
                   (2,'Tun',1,'Corgy',1,'chân ngắn, lông vàng, 3kg',2),
                   (3,'Mun',0,'Anh lông ngắn',0,'Lông vàng, tai cụp, 2kg',3),
                   (4,'Tí',0,'Tam thể',0,'2kg, 6 tháng',4),
                   (5,'Mập',0,'Anh lông dài',1,'2.5kg, 6 tháng',4),
                   (6,'Mập',0,'Anh lông dài',1,'2.5kg, 6 tháng',5),
                   (7,'Bun',1,'Corgy',1,'Chân ngắn, lông vàng, 3kg',6),
                   (8,'Đen',1,'Corgy',0,'Chân ngắn, lông vàng, 3kg',7),
                   (9,'Mỹ Diệu',0,'Tam thể',0,'2kg, 12 tháng',7),
                   (10,'Tun',1,'Ngáo',1,'Chân ngắn, màu lông trắng, 10kg',8);
-- select * from pet;
-- category_news
insert into category_news (cn_id, cn_name, is_delete)
            values (1,'Tin tức về CarePET',default),
                   (2,'Y tế',default ),
                   (3,'Dinh dưỡng',default ),
                   (4,'Thẩm mỹ',default),
                   (5,'Giải trí',default),
                   (6,'Thời sự',default);
-- select * from category_news;
-- news
insert into news (news_id, news_title, news_description, news_content, news_img, news_date_release, news_active, ad_id, cn_id, is_delete)
            values (default,'Bật Mí Cách Nuôi Chó Corgi Hiệu Quả Cho Người Chưa Có Kinh Nghiệm P1',
                    'Thức ăn cho chó Corgi Để cún cưng Corgi có thể phát triển khỏe mạnh, Siêu Pet khuyên bạn nên chú ý đến chế độ dinh dưỡng cùng khẩu phần hợp lý mỗi ngày. Vì thức ăn đóng vai trò quan trọng trong sự phát triển toàn diện của cảnh khuyển.',
                    'Chế độ dinh dưỡng của Corgi Sở hữu thân hình nhỏ bé nhưng khá tinh nghịch, Corgi đòi hỏi bạn phải cung cấp đầy đủ các chất dinh dưỡng. Theo đó, các chất bắt buộc phải có trong khẩu phần ăn của cún là: Protein: Có trong các loại thịt, nhiều nhất là thịt bò, sau đó là đến thịt gà, thịt lợn, trứng vịt lộn,… Chất béo: Thường đã có sẵn trong các loại thịt chứa protein, bạn không cần cần bổ sung thêm vì dễ khiến Corgi bị béo phì. Chất xơ: Trong các loại rau củ quả, trong đó tốt nhất vẫn là cà rốt. Chất xơ cực kì tốt cho hệ tiêu hóa và bộ lông của Corgi. Vitamin, khoáng chất: Các loại vitamin thường có nhiều trong thực phẩm tươi như: Cà rốt, tôm, ngao, ốc,… Tinh bột: Có nhiều trong cơm, cháo, khoai tây, khoai lang, sắn,… Khẩu phần ăn của Corgi theo độ tuổi Corgi từ 1-2 tháng tuổi: Giai đoạn này hê tiêu hóa của cún còn rất kém. Bạn nên chú ý cho chúng dùng thức ăn mềm như: Cháo loãng, sữa, thức ăn khô ngâm mềm, khoai tây nghiền,… Đồng thời, bạn nên cho Corgi ăn thành nhiều bữa: Khoảng 4-5 bữa + 200ml sữa ấm một ngày. Corgi từ 3-6 tháng tuổi: Corgi tuổi này đã bắt đầu ăn được thịt, tôm, cá, rau,… Nhưng thức ăn cũng phải được cắt nhỏ và làm mềm, đề phòng Corgi bị hóc. Bạn có thể giảm xuống còn 3-4 bữa một ngày, sữa thì nên uống 200-300ml. Corgi trên 6 tháng tuổi: Cún Corgi lúc này đang vào độ tuổi phát triển mạnh nhất. Bạn nên cho chúng ăn đa dạng các loại thức ăn từ thịt, tôm, cá đến khoai, mì,… để cung cấp đầy đủ các chất. Ở giai đoạn này, bạn chỉ cần cho cún ăn 2-3 bữa một ngày, sữa có thể uống có thể không. Nếu muốn bộ lông của Corgi bóng mượt thì bạn có thể cho ăn 2-3 quả trứng vịt lộn mỗi tuần.',
                    'view/upload/admin/news/nuoi-cho-corgi1.jpg','2023/03/15',1,4,3,false),
                    (default,'Hướng dẫn cách nuôi mèo Anh lông ngắn chi tiết cho người mới',
                    'Mèo Anh lông ngắn luôn nằm trong top những giống mèo đẹp nhất trên thế giới. Giống mèo này rất được ưa chuộng để lựa chọn làm thú cưng nhờ thân hình mũm mĩm, lông ngắn, khuôn mặt bầu bĩnh và tính cách thân thiện. Tuy nhiên, để chăm sóc cho chúng khỏe mạnh, ngoan ngoãn thì không phải ai cũng biết cách.' ,
                    'Các vấn đề, bệnh lý thường gặp Giống mèo Anh lông ngắn thường gặp những chứng bệnh đặc biệt, vì thế bạn cần tìm hiểu kỹ càng nguyên nhân để tìm ra phương pháp chữa trị đúng cách. Các loại bệnh mà mèo Anh lông ngắn thường hay mắc phải như: Bệnh tiểu đường Bệnh viêm nướu răng Bệnh Feline Leukemia Virus Bệnh dại Bệnh nhiễm trùng đường hô hấp Bệnh Chlamydia Bệnh ký sinh trùng Bệnh Hypertrophic Cardiomyopathy',
                    'view/upload/admin/news/meo-anh-long-ngan-de-thuong.jpg','2023/03/25',1,4,2, false),
                    (default,'Bật Mí Cách Nuôi Chó Corgi Hiệu Quả Cho Người Chưa Có Kinh Nghiệm P2',
                    'Corgi là giống cảnh khuyển xứ lạnh nên chúng khó có thể phát triển toàn diện tại khí hậu nắng nóng của Việt Nam. Trong quá trình nuôi dưỡng cún, bạn cần lưu ý đến cách chăm sóc và vệ sinh để Corgi có thể phòng tránh một số bệnh không đáng có.',
                    'Sở hữu bộ lông dày 2 lớp với tác dụng giữ nhiệt nên khi du nhập vào Việt Nam, công dụng này không còn phù hợp với cún. Để Corgi có thể thoải mái phát triển, Siêu Pet nhắc bạn nên chú ý cắt tỉa lông khoảng 2-3 tháng một lần. Ngoài việc cắt tỉa, bạn cũng nên tắm cho cún thường xuyên. Đồng thời, dùng lược chải lông cho Corgi mỗi ngày để loại bỏ phần lông chết. Nếu lông Corgi ẩm ướt, bạn nên dùng máy sấy sấy khô, tránh để vi khuẩn có cơ hội phát triển. Nếu không có thời gian chăm sóc lông cho Corgi, bạn có thể đưa chúng đến các Spa thú cưng.',
                    'view/upload/admin/news/nuoi-cho-corgi2.jpg','2023/03/15',1,4,4,false),
                    (default,'Bật Mí Cách Nuôi Chó Corgi Hiệu Quả Cho Người Chưa Có Kinh Nghiệm P3',
                    'Corgi thuộc vào nhóm những giống cảnh khuyển có tuổi thọ khá cao: Khoảng 12-15 năm. Để cún cưng được khỏe mạnh với số tuổi lâu hơn, bạn nên thực hiện tiêm phòng cho chúng định kỳ.',
                    'Vaccine dành cho Corgi thường có 3 loại là: 3 in 1, 5 in 1 và 7 in 1. Trong đó, loại 3 trong 1 bây giờ ít khi được sử dụng do có hiệu quả không cao. Các phòng khám thú y thường khuyên bạn dùng 2 loại 5 trong 1 và 7 trong 1. Các loại vaccine đó có thể phòng ngừa một số bệnh như: Care, Pravo, gan truyền nhiễm, cúm,… Theo kinh nghiệm của Siêu Pet, bạn nên bắt đầu tiêm phòng cho Corgi từ khi còn nhỏ, khoảng 3 tuần tuổi là bắt đầu mũi thứ nhất. Sau đó, liệu trình sẽ kéo dài đến khi chúng khoảng 3 tháng tuổi là kết thúc mũi cuối. Giá vaccine cũng không đắt, chỉ từ 120k – 250k một mũi, tùy từng loại thuốc. Khi cảnh khuyên chân ngắn Corgi được 8 tháng tuổi thì nên được tiêm phòng dại. Khi tiêm phòng thì bạn cũng nên hỏi các bác sĩ cho cún uống thuốc tẩy giun sán đều đặn.',
                    'view/upload/admin/news/nuoi-cho-corgi3.jpg','2023/03/15',1,4,2,false),
                    (default,'Mèo mẹ nhờ cô chủ trông hộ con',
                    'Cô chủ than: ''Đêm nào nó cũng tha con nó vào cho tui coi để nó đi chơi''.' ,
                    'Mèo mẹ nhờ cô chủ trông hộ con. Đêm nào nó cũng tha con nó vào cho cô chủ coi để nó đi chơi ',
                    'view/upload/admin/news/meo-nho-trong-con.jpg','2023/03/25',1,5,5, false),
                    (default,'10 biện pháp ''kịch độc'' đối phó chó thả rông',
                    'Để đối phó với nạn chó thả rông, bạn đọc đề nghị: Chỉ được phép nuôi các loại chó có trọng lượng... dưới 1kg! Nếu không thì phải là loại chó... không răng nhé!',
                    'Khi các biện pháp không giải quyết được chó thả rông, có lẽ đành phải trông vào... thế lực siêu nhiên thôi: trước khi ra đường cứ bói một quẻ hung cát cho chắc, để xem hướng nào có chó dữ thì tránh đi - bạn NGUYỄN NGỌC A (Phú Yên) đề xuất.',
                    'view/upload/admin/news/cho-tha-rong.jpg','2023/04/1',1,5,6,false),
                    (default,'CarePet - Cùng bạn mang yêu thương chăm sóc thú cưng.',
                    'Chúng tôi luôn đồng hành, thấu hiểu những nổi lo lắng của bạn trong quá trình chăm lo, nuôi nấng thúcưng của bạn. Pet care ra đời với sứ mệnh người bạn-  người đồng hành luôn sát cánh cùng bạn nuôi dưỡng và  mang lại dịch vụ tốt nhất làm hài lòng khách hàng và thú cưng.về cửa hàng CarePet chúng tôi cung cấp dịch vụ chăm sóc, khám bệnh cho thú cưng.',
                    'Bất kì một doanh ngiệp nào ra đời cũng muốn xây dựng, phát triển thành một thương hiệu vững mạnh, có chỗ đứng trong lòng người tiêu dùng. CAREPET cũng vậy, chúng tôi luôn nổ lực hết mình trong việc cung cấp những sản phẩm, dịch vụ chất lượng nhất đến với khách hàng của mình, với tiêu chí ‘ khách hàng là trên hết’. Chúng tôi coi sự hài lòng của khách hàng là một trong những mục tiêu quan trọng hàng đầu của việc kinh doanh. Chúng tôi tin tưởng rằng trong một ngày nào không xa chúng tôi sẻ trở thành một thương hiệu hiệu lớn và co mặt trong mỗi một gia đình ',
                    'view/upload/admin/news/carepet.jpg','2023/04/1',1,5,1,false),
                    (default,'[ HÉ LỘ ] Cách trị chó bị viêm da #Hiệu quả #Chính xác',
                    'Bạn đang đau đầu khi không biết liệu có cách trị chó bị viêm da? Tuy bệnh viêm da không làm ảnh hưởng quá nghiêm trọng tới sức khỏe của cún cưng nhưng sẽ khiến chó con rất khó chịu, gây ngứa ngáy và đặc biệt là sẽ có mùi rất hôi hám. Và chắc chắn bạn sẽ không muốn ôm một chú chó như thế đúng không nào? Trong bài viết này, Kimi Pet sẽ cùng bạn tìm hiểu cách chữa trị cũng như cách phòng ngừa khi cún cưng bị bệnh viêm da nhé!',
                    '1. Nguyên nhân chó bị viêm da
                    Bệnh viêm da ở chó là tình trạng da bị viêm, ngứa. Chó cưng của bạn sẽ cảm thấy khó rất khó chịu khi mắc phải chứng bệnh này. Trong quá trình vận động hàng ngày, việc chú chó hay gãi, liếm và cắn liên tục sẽ khiến da đỏ, đau đớn và dễ bị nhiễm trùng. Bệnh này thường xuất hiện ở vùng bàn chân, bụng hoặc nách của chó.
                    Có rất nhiều nguyên nhân gây ra bệnh viêm da nhưng chủ yếu là do:
                    Do ký sinh trùng gây ra như bọ chét, ve,…
                    Do bị nhiễm trùng bởi các loại vi khuẩn hoặc nấm,…
                    Do bị dị ứng với Môi trường hoặc từ thức ăn.',
                    'view/upload/admin/news/cho-viem-da.png','2023/05/10',1,5,2,false),
                    (default,'TOP 6+ Nguyên nhân chó bị rụng lông | Nhất định phải biết',
                    'Bạn có biết tại sao chó bị rụng lông chưa? Việc lông cún cưng rơi khắp nhà khiến bạn vô cùng đau đầu? Cùng CarePet tìm hiểu 6+ nguyên nhân tại sao và cách giải quyết khi chó rụng lông quá nhiều trong bài viết dưới đây nhé.',
                    'Đa số các giống chó thay lông 2 lần trong 1 năm.
                    Lần đầu là cuối đông, khi nhiệt độ bắt đầu ấm dần, chó rụng bớt lớp lông dày để hạ nhiệt.
                    Lần thứ hai là cuối thu, trời chuyển lạnh, chó cần thay lớp lông mới để giữ ấm. Thông thường là tháng 3-5 và tháng 9-11.
                    Ở các giống chó lông dài, tình trạng rụng lông càng nghiêm trọng. Có đôi khi chỉ cần vuốt dọc sống lưng là chó rụng lông một búi. Về mùa hè, lông chó thường tơi xốp, ngắn và mềm hơn, giúp giảm bớt nhiệt lượng. Bộ lông còn có tác dụng bảo vệ làn da, tránh tổn thương do tia tử ngoại từ ánh nắng mặt trời.
                    Mùa đông lớp lông cần dày và nặng để giữ nhiệt độ bên trong cơ thể. Bộ lông mùa đông thường thô cứng bên ngoài và mềm ở bên trong. Giúp chó không bị hạ nhiệt, cảm lạnh. Đồng thời bảo vệ chó khỏi những tia bức xạ có hại từ ánh nắng mặt trời.',
                    'view/upload/admin/news/cho-rung-long.jpg','2023/05/12',1,5,4,false),
                    (default,'[MÁCH BẠN] Chó Poodle có mấy size #Chi Tiết và #CHUẨN Nhất #2023',
                    'Chó Poodle có mấy loại chắc hẳn không phải ai cũng biết. Mặc dù đây là giống chó rất được ưa thích và phổ biến ở Việt Nam. Care Pet sẽ giúp bạn trả lời câu hỏi chó poodle có bao nhiêu loại ở bài viết dưới.',
                    'Theo một số tài liệu ghi chép thì Poodle là giống chó xuất xứ từ vùng Trung Á. Mặc dù vậy, vẫn có nhiều nơi trên thế giới có sự xuất hiện của loài chó này như Pháp, Nga và Hungary.
                    “Poodle” ở mỗi quốc gia sẽ có một ý nghĩa khác nhau. Poodle ở tiếng đức có nghĩa là Pudel, có nghĩa là thợ lặn. Ở Pháp, chúng được gọi với cái tên khác là Caniche, có nghĩa là chó săn vịt.',
                    'view/upload/admin/news/poodle-size.png','2023/05/15',1,5,6,false),
                    (default,'[GIẢI ĐÁP] Chó Poodle mang thai mấy tháng thì đẻ #Mới nhất #2023',
                    'Không phải ai cũng biết chó poodle mang thai bao lâu thì đẻ, mặc dù giống chó Poodle được rất nhiều người ưa thích và nhiều hộ gia đình cũng nuôi loài chó này. Với bài viết dưới Care Pet sẽ có những giải đáp các vấn đề xung quanh việc chó poodle mang thai bao nhiêu ngày thì đẻ.',
                    'Câu trả lời là dao động khoảng từ 58-68 ngày. Điều này sẽ tùy thuộc vào cơ địa của chó poodle nhà bạn.
                    Chó poodle giống cái thường động dục ở độ tuổi từ 6-8 tháng. Ở giai đoạn này, bộ phận sinh dục của chó sẽ nở ra và có phần nhô ra ngoài, tiếp đó là chảy máu đi kèm với dịch nhầy. Bạn hãy lưu ý cho các bé phối giống vào thời điểm thích hợp.
                    Nếu phối giống thành công, thể hiện qua các dấu hiệu và siêu âm, poodle sẽ mang thai.
                    Cách chăm sóc chó mang thai giai đoạn thai kỳ là một vấn đề phức tạp. Bạn không chỉ cần đầu tư công sức, thời gian, chi phí mà còn phải thật sự yêu thương và quan tâm chúng.',
                    'view/upload/admin/news/poodle-mang-thai.jpeg','2023/05/18',1,5,6,false),
                    (default,'[CHIA SẺ] Top 9 cách tìm mèo đi lạc đơn giản hiệu quả tốt nhất',
                    'Tìm hiểu các cách tìm mèo lạc giúp đưa mèo cưng của bạn về nhà một cách nhanh chóng. Hãy cùng Care Pet tìm hiểu cách tìm lại mèo đi lạc chi tiết trong bài viết này nhé.',
                    'Các bạn có thể thử áp dụng cách gọi mèo lạc về tâm linh. Lưu ý, đây chỉ là cách làm theo dân gian, không đảm bảo thành công 100%. Bạn có thể thực hiện các bước như sau:
                    Bước 1: Lấy một bát nước sạch để lên trên mặt bếp hoặc đặt ở giữa 2 vòng lửa của bếp ga, trên bát để một cái kéo. Nếu bạn không có bếp thì để bát ở trên bàn gần nơi có lỗ thông gió hoặc cửa ra vào.
                    Bước 2: Hãy mở kéo ra và để mũi kéo hướng về phía cửa nhà hoặc cửa sổ, sau đó gọi to tên mèo của bạn.
                    Bước 3: Nếu mèo về nhà được thì phải cầm 4 chân mèo rồi đi quanh bàn hoặc bếp 3 vòng để bày tỏ lòng cảm ơn.
                    Lưu ý, trong trường hợp mèo chưa về thì không được dịch chuyển bát và kéo, bởi mỗi lần dịch chuyển sẽ làm mất hết hiệu quả và phải chờ lại từ đầu.',
                    'view/upload/admin/news/meodilac.jpg','2023/05/20',1,5,6,false);
-- select * from news;
-- category_service
insert into category_service (cs_id, cs_name, is_delete)
            values (1,'Tiêm phòng', default),
                   (2,'Tư vấn dinh dưỡng',default),
                   (3,'Vệ sinh, thẩm mỹ',default),
                   (4,'Huấn luyện',default),
                   (5,'Khám bệnh, điều trị',default);
-- select * from category_service;
-- service
insert into service (sv_id, sv_name, sv_img, sv_price, sv_description, sv_pet, sv_status, is_delete, cs_id)
            values (1,'Tiêm phòng dại cho chó','view/upload/admin/service/tiem-dai-cho.jpg',50000,'Tiêm phòng dại cho cún trên 1 năm tuổi. CarePet chỉ sử dụng vacxin của Pháp và  Mỹ nhập khẩu trực tiếp, đảm bảo chất lượng.',1,1,default,1),
                   (2,'Tiêm phòng bệnh do Herpervirus cho mèo','view/upload/admin/service/tiem-herper-meo.jpg',500000,'Tiêm phòng bệnh Herper cho mèo',0,1,default,1),
                   (3,'Cắt tỉa lông dưới 3kg','view/upload/admin/service/cat-tia-long.jpeg',200000,'Chúng tôi luôn cố gắng làm sao để quyền lợi khách luôn được đảm bảo tốt nhất. Chi phí của dịch vụ cắt tỉa lông chó mèo tại Care Pet luôn đảm bảo hợp lý và cạnh tranh nhất hiện nay.',2,1,default,3),
                   (4,'Khám tổng quát chó','view/upload/admin/service/kham-tong-quat-cho.jpg',3000000,'Khám tổng quát chó',1,1,default,5),
                   (5,'Khám tổng quát mèo','view/upload/admin/service/kham-tong-quat-meo.jpg',2500000,'Khám tổng quát mèo',0,0,default,5),
                   (6,'Điều trị mổ viêm tai giữa chó','view/upload/admin/service/viem-tai-cho.jpg',0,'Dịch vụ bao gồm: tư vấn, điều trị mổ viêm tai giữa chó. Giá sẽ được thỏa thuận trong khoảng từ 700.000đ đến 2.000.000đ tùy theo mức độ bệnh.',1,0,default,5),
                   (7,'Huấn luyện theo yêu cầu','view/upload/admin/service/huan-luyen.jpg',0,'Huấn luyện theo yêu cầu. Giá cả sẽ được thỏa thuận trung bình 100.000đ/ngày.',2,0,default,4),
                   (8,'Tư vấn dinh dưỡng','view/upload/admin/service/tu-van-dinh-duong.jpg',0,'Dịch vụ tư vấn dinh dưỡng sẽ được thỏa thuận giá cả dao động 100.000đ - 300.000đ/lần',2,0,default,2),
                   (9,'Điều trị nấm mèo','view/upload/admin/service/nam-meo.jpg',0,'Tư vấn, điều trị nấm mèo. Tùy theo mức độ bệnh, giá cả sẽ được thỏa thuận dao động 200.000đ - 500.000đ',0,0,default,5),
                   (10,'Điều trị FIP mèo','view/upload/admin/service/fip-meo.jpg',0,'Tư vấn, điều trị FIP mèo. Tùy theo mức độ bệnh, giá cả sẽ được thỏa thuận dao động 200.000đ - 500.000đ',0,0,default,5),
                   (11,'Điều trị viêm đường hô hấp mèo','view/upload/admin/service/viem-duong-ho-hap-meo.jpg',0,'Tư vấn, điều trị viêm đường hô hấp mèo với giá thỏa thuận dao động từ 150.000đ - 500.000đ/lần',0,0,default,5),
                   (12,'Điều trị viêm đường hô hấp chó','view/upload/admin/service/viem-duong-ho-hap-cho.jpg',0,'Tư vấn, điều trị viêm đường hô hấp chó với giá thỏa thuận dao động từ 150.000đ - 500.000đ/lần',1,0,default,5),
                   (13, 'Tắm cho chó mèo dưới 2 kg, lông dài','view/upload/admin/service/tam-cho-meo.png',100000,'Tắm cho chó mèo dưới 2 kg, lông dài',2,0,default,3),
                   (14, 'Tắm cho chó mèo dưới 2 kg, lông ngắn','view/upload/admin/service/tam-cho-meo.png',80000,'Tắm cho chó mèo dưới 2 kg, lông ngắn',2,0,default,3),
                   (15, 'Tắm cho chó mèo từ 2 kg đến < 5 kg, lông dài','view/upload/admin/service/tam-cho-meo.png',130000,'Tắm cho chó mèo từ 2 kg đến < 5 kg, lông dài. Dịch vụ bao gồm: vệ sinh chân, móng, tai. Cạo gọn lông hậu môn, bụng. Chải lông trước khi tắm. Vắt tuyến hôi. Tắm 2 lần khử mùi và thơm. Sấy khô lông, chải lông. Thoa tinh dầu dưỡng lông, nước hoa.',2,0,default,3),
                   (16, 'Tắm cho chó mèo từ 2 kg đến < 5 kg, lông ngắn','view/upload/admin/service/tam-cho-meo.png',90000,'Tắm cho chó mèo từ 2 kg đến < 5 kg, lông ngắn. Dịch vụ bao gồm: vệ sinh chân, móng, tai. Cạo gọn lông hậu môn, bụng. Chải lông trước khi tắm. Vắt tuyến hôi. Tắm 2 lần khử mùi và thơm. Sấy khô lông, chải lông. Thoa tinh dầu dưỡng lông, nước hoa.',2,0,default,3),
                   (17, 'Tắm cho chó mèo từ 5 kg đếna < 7 kg, lông dài','view/upload/admin/service/tam-cho-meo.png',180000,'Tắm cho chó mèo từ 5 kg đến < 7 kg, lông dài. Dịch vụ bao gồm: vệ sinh chân, móng, tai. Cạo gọn lông hậu môn, bụng. Chải lông trước khi tắm. Vắt tuyến hôi. Tắm 2 lần khử mùi và thơm. Sấy khô lông, chải lông. Thoa tinh dầu dưỡng lông, nước hoa.',2,0,default,3),
                   (18, 'Tắm cho chó mèo từ 5 kg đến < 7 kg, lông ngắn','view/upload/admin/service/tam-cho-meo.png',140000,'Tắm cho chó mèo từ 5 kg đến < 7 kg, lông ngắn. Dịch vụ bao gồm: vệ sinh chân, móng, tai. Cạo gọn lông hậu môn, bụng. Chải lông trước khi tắm. Vắt tuyến hôi. Tắm 2 lần khử mùi và thơm. Sấy khô lông, chải lông. Thoa tinh dầu dưỡng lông, nước hoa.',2,0,default,3),
                   (19, 'Tắm cho chó mèo từ 7 kg đến < 10 kg, lông dài','view/upload/admin/service/tam-cho-meo.png',240000,'Tắm cho chó mèo từ 7 kg đến < 10 kg, lông dài. Dịch vụ bao gồm: vệ sinh chân, móng, tai. Cạo gọn lông hậu môn, bụng. Chải lông trước khi tắm. Vắt tuyến hôi. Tắm 2 lần khử mùi và thơm. Sấy khô lông, chải lông. Thoa tinh dầu dưỡng lông, nước hoa.',2,0,default,3),
                   (20, 'Tắm cho chó mèo từ 7 kg đến < 10 kg, lông ngắn','view/upload/admin/service/tam-cho-meo.png',190000,'Tắm cho chó mèo từ 7 kg đến < 10 kg, lông ngắn. Dịch vụ bao gồm: vệ sinh chân, móng, tai. Cạo gọn lông hậu môn, bụng. Chải lông trước khi tắm. Vắt tuyến hôi. Tắm 2 lần khử mùi và thơm. Sấy khô lông, chải lông. Thoa tinh dầu dưỡng lông, nước hoa.',2,0,default,3),
                   (21, 'Tắm cho chó mèo từ 10 kg đến < 15 kg, lông dài','view/upload/admin/service/tam-cho-meo.png',290000,'Tắm cho chó mèo từ 10 kg đến < 15 kg, lông dài. Dịch vụ bao gồm: vệ sinh chân, móng, tai. Cạo gọn lông hậu môn, bụng. Chải lông trước khi tắm. Vắt tuyến hôi. Tắm 2 lần khử mùi và thơm. Sấy khô lông, chải lông. Thoa tinh dầu dưỡng lông, nước hoa.',2,0,default,3),
                   (22, 'Tắm cho chó mèo từ 10 kg đến < 15 kg, lông ngắn','view/upload/admin/service/tam-cho-meo.png',250000,'Tắm cho chó mèo từ 10 kg đến < 15 kg, lông ngắn. Dịch vụ bao gồm: vệ sinh chân, móng, tai. Cạo gọn lông hậu môn, bụng. Chải lông trước khi tắm. Vắt tuyến hôi. Tắm 2 lần khử mùi và thơm. Sấy khô lông, chải lông. Thoa tinh dầu dưỡng lông, nước hoa.',2,1,default,3),
                   (23, 'Tắm cho chó mèo từ 15 kg đến < 20 kg, lông dài','view/upload/admin/service/tam-cho-meo.png',360000,'Tắm cho chó mèo từ 15 kg đến < 20 kg, lông dài. Dịch vụ bao gồm: vệ sinh chân, móng, tai. Cạo gọn lông hậu môn, bụng. Chải lông trước khi tắm. Vắt tuyến hôi. Tắm 2 lần khử mùi và thơm. Sấy khô lông, chải lông. Thoa tinh dầu dưỡng lông, nước hoa.',2,0,default,3),
                   (24,'Cắt tỉa lông từ 3 kg đến 5kg','view/upload/admin/service/cat-tia-long.jpeg',350000,'Chúng tôi luôn cố gắng làm sao để quyền lợi khách luôn được đảm bảo tốt nhất. Chi phí của dịch vụ cắt tỉa lông chó mèo tại Care Pet luôn đảm bảo hợp lý và cạnh tranh nhất hiện nay.',2,1,default,3),
                   (25,'Cắt tỉa lông từ 5 kg đến 10kg','view/upload/admin/service/cat-tia-long.jpeg',450000,'Chúng tôi luôn cố gắng làm sao để quyền lợi khách luôn được đảm bảo tốt nhất. Chi phí của dịch vụ cắt tỉa lông chó mèo tại Care Pet luôn đảm bảo hợp lý và cạnh tranh nhất hiện nay.',2,1,default,3),
                   (26,'Cắt tỉa lông từ 10 kg đến 15kg','view/upload/admin/service/cat-tia-long.jpeg',550000,'Chúng tôi luôn cố gắng làm sao để quyền lợi khách luôn được đảm bảo tốt nhất. Chi phí của dịch vụ cắt tỉa lông chó mèo tại Care Pet luôn đảm bảo hợp lý và cạnh tranh nhất hiện nay.',2,1,default,3),
                   (27,'Cắt tỉa lông từ 15 kg đến 20kg','view/upload/admin/service/cat-tia-long.jpeg',650000,'Chúng tôi luôn cố gắng làm sao để quyền lợi khách luôn được đảm bảo tốt nhất. Chi phí của dịch vụ cắt tỉa lông chó mèo tại Care Pet luôn đảm bảo hợp lý và cạnh tranh nhất hiện nay.',2,1,default,3),
                   (28,'Nhuộm lông 2 tai','view/upload/admin/service/nhuom-2-tai.jpg',200000,'Phí nhuộm lông trên không bao gồm tắm, cắt, vệ sinh cơ bản',2,1,default,3),
                   (29,'Nhuộm lông 4 chân','view/upload/admin/service/nhuom-4-chan.png',200000,'Phí nhuộm lông trên không bao gồm tắm, cắt, vệ sinh cơ bản',2,1,default,3),
                   (30,'Nhuộm lông 1 đuôi, lông ít','view/upload/admin/service/nhuom-duoi-long-it.jpg',100000,'Phí nhuộm lông trên không bao gồm tắm, cắt, vệ sinh cơ bản',2,1,default,3),
                   (31,'Nhuộm lông 1 đuôi, lông nhiều','view/upload/admin/service/nhuom-duoi-long-nhieu.jpeg',150000,'Phí nhuộm lông trên không bao gồm tắm, cắt, vệ sinh cơ bản',2,1,default,3),
                   (32,'Nhuộm lông 2 tai, 1 đuôi','view/upload/admin/service/nhuom-2-tai-1-duoi.jpg',260000,'Phí nhuộm lông trên không bao gồm tắm, cắt, vệ sinh cơ bản',2,1,default,3),
                   (33,'Nhuộm lông 2 tai, 4 chân','view/upload/admin/service/nhuom-2-tai-4-chan.jpg',350000,'Phí nhuộm lông trên không bao gồm tắm, cắt, vệ sinh cơ bản',2,1,default,3),
                   (34,'Nhuộm lông họa tiết với thú cưng < 5 kg','view/upload/admin/service/nhuom-hoa-tiet-nho.png',100000,'Phí nhuộm lông trên không bao gồm tắm, cắt, vệ sinh cơ bản',2,1,default,3),
                   (35,'Nhuộm lông họa tiết với thú cưng > 5 kg','view/upload/admin/service/nhuom-hoa-tiet-lon.jpg',150000,'Phí nhuộm lông trên không bao gồm tắm, cắt, vệ sinh cơ bản',2,1,default,3),
                   (36,'Vắt tuyến hôi','view/upload/admin/service/vat-tuyen-hoi.jpg',50000,'Phí vắt tuyến hôi trên không bao gồm tắm hay các dịch vụ khác',2,1,default,3),
                   (37,'Vệ sinh tai','view/upload/admin/service/ve-sinh-tai.jpg',100000,'Phí vệ sinh tai trên không bao gồm tắm hay các dịch vụ khác',2,1,default,3),
                   (38,'Cắt, mài móng','view/upload/admin/service/cat-mai-mong.jpg',100000,'Phí cắt móng trên không bao gồm tắm, vệ sinh cơ bản hay các dịch vụ khác',2,1,default,3),
                   (39,'Lấy cao răng','view/upload/admin/service/lay-cao-rang.jpg',600000,'Dịch vụ có sử dụng thuốc mê để gây mê',2,1,default,3),
                   (40,'Triệt sản cho mèo, dưới 3kg','view/upload/admin/service/triet-san-meo.jpg',500000,'Dịch vụ triệt sản có sử dụng thuốc mê, thuốc tê.',0,1,default,5),
                   (41,'Triệt sản cho mèo, trên 3kg','view/upload/admin/service/triet-san-meo.jpg',0,'Dịch vụ triệt sản có sử dụng thuốc mê, thuốc tê. Giá dao động 600.000đ - 1.000.000đ tùy giống loại',0,1,default,5),
                   (42,'Triệt sản cho chó, dưới 3kg','view/upload/admin/service/triet-san-cho.jpg',1000000,'Dịch vụ triệt sản có sử dụng thuốc mê, thuốc tê.',1,1,default,5),
                   (43,'Triệt sản cho chó, từ 3kg - 7 kg','view/upload/admin/service/triet-san-cho.jpg',1300000,'Dịch vụ triệt sản có sử dụng thuốc mê, thuốc tê.',1,1,default,5),
                   (44,'Triệt sản cho chó, trên 7kg','view/upload/admin/service/triet-san-cho.jpg',0,'Dịch vụ triệt sản có sử dụng thuốc mê, thuốc tê. Giá dao động 1.600.000đ - 2.000.000đ tùy giống loại',1,1,default,5),
                   (45,'Thiến cho mèo, dưới 3kg','view/upload/admin/service/thien-meo.jpg',400000,'Dịch vụ thiến có sử dụng thuốc mê, thuốc tê.',0,1,default,5),
                   (46,'Thiến cho mèo, trên 3kg','view/upload/admin/service/thien-meo.jpg',0,'Dịch vụ thiến có sử dụng thuốc mê, thuốc tê. Giá dao động 450.000đ - 600.000đ tùy giống loại',0,1,default,5),
                   (47,'Thiến cho chó, dưới 3kg','view/upload/admin/service/thien-cho.jpg',600000,'Dịch vụ thiến có sử dụng thuốc mê, thuốc tê.',1,1,default,5),
                   (48,'Thiến cho chó, từ 3kg - 7 kg','view/upload/admin/service/thien-cho.jpg',850000,'Dịch vụ thiến có sử dụng thuốc mê, thuốc tê.',1,1,default,5),
                   (49,'Thiến cho chó, trên 7kg','view/upload/admin/service/thien-cho.jpg',0,'Dịch vụ thiến có sử dụng thuốc mê, thuốc tê. Giá dao động 1.200.000đ - 2.000.000đ tùy giống loại',1,1,default,5);

insert into service (sv_id, sv_name, sv_img, sv_price, sv_description, sv_pet, sv_status, is_delete, cs_id)
            values (50,'Tam cho cho meo goi VIP','view/upload/admin/service/tam-cho-meo.png',5000000,'Tam cho ca cho va meo vo cung sach se thom tho VIP.',2,1,default,3);



-- select * from service;
-- appointment
 insert into appointment (apm_id, apm_date, apm_time, apm_booking_at, apm_cancel_at, apm_status, ctm_id, cs_id, is_delete)
            values (1,'2023/04/16','9:30:00','2023/04/16 7:30:00','2023/04/16 8:30:00',2,2,1,false), -- kh2 đặt onl-> hủy
                   (2,'2023/03/10','9:30:00','2023/03/10 9:28:00',null,3,1,3,false), -- kh1 đặt trực tiếp -> đã hoàn thành
                   (3,'2023/04/16','10:30:00','2023/04/16 7:30:00',null,3,3,2,false), -- kh3 đặt onl -> đã hoàn thành
                   (4,'2023/04/18','14:45:00','2023/04/18 14:40:00',null,1,3,2,false), -- kh3 đặt onl -> đã xác nhận
                   (5,'2023/04/01','14:30:00','2023/04/1 8:30:10',null,3,1,3,false),
                   (6,'2023/04/06','9:45:00','2023/04/6 7:30:30',null,3,2,3,false),
                   (7,'2023/04/08','9:45:00','2023/04/7 7:30:00','2023/04/8 7:30:28',2,4,3,false),
                   (8,'2023/04/08','15:45:00','2023/04/8 9:56:00',null,3,4,3,false),
                   (9,'2023/04/10','15:00:00','2023/04/10 10:35:30',null,3,5,5,false),
                   (10,'2023/05/01','10:15:00','2023/04/28 7:30:00','2023/04/30 7:46:30',2,5,3,false),
                   (11,'2023/05/01','14:15:00','2023/05/1 9:30:12',null,3,5,3,false),
                   (12,'2023/05/09','16:00:00','2023/05/2 7:12:20',null,1,6,5,false),
                   (13,'2023/05/08','15:45:00','2023/05/6 9:30:59',null,3,7,5,false),
                   (14,'2023/05/08','16:45:00','2023/05/7 7:33:00',null,3,7,5,false),
                   (15,'2023/05/15','13:35:00','2023/05/15 9:29:24',null,0,8,2,false),
                   (16,'2023/05/18','15:45:00','2023/05/16 8:39:00',null,0,3,3,false);
-- select * from appointment;
-- bill
insert into bill (bill_id, bill_date_release, bill_status, is_delete, ctm_id, ad_id, dc_id, sub_total, value_reduced, total_value)
            values (1,'2023/03/16',1,default,1,3,1,550000,50000,500000), -- kh1, giảm 50k vs đơn tối thiểu 0đ
                   (2,'2023/04/10',1,default,3,2,null,500000,0,500000), -- kh3 ko đc giảm giá
                   (3,'2023/04/01',1,default,1,2,null,250000,0,250000),
                   (4,'2023/04/06',1,default,2,3,null,130000,0,130000),
                   (5,'2023/04/08',1,default,4,2,null,330000,0,330000),
                   (6,'2023/04/10',1,default,5,3,null,2500000,0,2500000),
                   (7,'2023/05/01',1,default,5,6,4,200000,50000,150000),
                   (8,'2023/05/08',1,default,7,2,8,3000000,1500000,1500000),
                   (9,'2023/05/08',1,default,7,6,null,300000,0,300000),
                   (10,'2023/04/18',0,default,3,2,6,500000,50000,450000),
                   (11,'2023/05/09',0,default,6,6,null,10000000,0,10000000);

-- select * from bill;
-- detail_bill
insert into detail_bill (detail_id, bill_id, sv_id, quantity, sv_price, pet_id, is_delete)
            values (1,1,3,1,550000,1,default), -- kh1 cắt tỉa lông cho chó
                   (2,2,2,1,500000,3,default), -- kh3 tiêm phòng cho mèo lông ngắn
                   (3,3,22,1,250000,1,default),
                   (4,4,15,1,130000,2,default),
                   (5,5,15,1,130000,4,default),
                   (6,5,3,1,200000,5,default),
                   (7,6,5,1,2500000,6,default),
                   (8,7,3,1,200000,6,default),
                   (9,8,4,1,3000000,9,default),
                   (10,9,12,1,300000,8,default),
                   (11,10,2,1,500000,3,default),
                   (12,11,6,1,10000000,7,default);
-- select * from detail_bill;
-- feedback
insert into feedback (fb_id, fb_content, fb_rating, fb_time, is_delete, ctm_id)
            values (default,'Nhân viên nhiệt tình, thân thiện. Dịch vụ rất tốt.',5,'2023/04/06 12:00:00',default,2),
                   (default,'Cắt tỉa lông đẹp lắm.',4,'2023/04/08 20:00:00',default,4),
                   (default,'Dịch vụ tốt, sức khoẻ bé nhà mình tốt lắm.',5,'2023/04/10 16:30:19',default,3),
                   (default,'Dịch vụ tốt, sức khoẻ bé nhà mình tốt lắm.',5,'2023/04/10 20:00:00',default,5),
                   (default,'Lần thứ 2 sử dụng dịch vụ, mình thấy cả 2 lần đều rất tốt. Cảm ơn CarePet nhiềuuuu',5,'2023/04/20 20:00:00',default,5);
-- select * from feedback;
-- select * from customer where ctm_can_feedback = 1
-- shop_info
insert into shop_info (shop_name, shop_address, shop_phone, shop_description, shop_facebook, shop_mail)
            value ('CarePET','55 Giải Phóng, Đồng Tâm, Hai Bà Trưng, Hà Nội','+84 987 654 321','Hệ thống chăm sóc thú cưng số 1 HUCE, đem đến cho bạn sự yên tâm, tin tưởng, mang niềm vui tới cho thú cưng của bạn. Hệ thống chuyên cung cấp các dịch vụ thẩm mỹ, sức khoẻ, y tế, tinh thần cho thú cưng (chó, mèo). Với chất lượng dịch vụ tốt nhất luôn được khách hàng tin tưởng sẽ là điểm đến lý tưởng và tuyệt vời dành cho vật nuôi.',
                   'https://www.facebook.com/carepet.nhom2','carepet@huce.com');
-- select * from shop_info;

# update shop_info set shop_description = 'Hệ thống chăm sóc thú cưng số 1 HUCE, đem đến cho bạn sự yên tâm, tin tưởng, mang niềm vui tới cho thú cưng của bạn. Hệ thống chuyên cung cấp các dịch vụ thẩm mỹ, sức khoẻ, y tế, tinh thần cho thú cưng (chó, mèo). Với chất lượng dịch vụ tốt nhất luôn được khách hàng tin tưởng sẽ là điểm đến lý tưởng và tuyệt vời dành cho vật nuôi.' where 1=1

