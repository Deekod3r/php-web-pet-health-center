drop trigger if exists trigger_update_Bill;
create trigger trigger_update_Bill
    after update
    on bill
    for each row
    begin
        if(NEW.bill_status = 1) then
            update customer
                set ctm_can_feedback = true
            where ctm_id = NEW.ctm_id and ctm_email is not null;
        end if;
        if(NEW.dc_id is not null ) then
            if(NEW.dc_id != OLD.dc_id) then
                update discount
                    set dc_quantity = dc_quantity + 1
                where dc_id = OLD.dc_id;
                update discount
                    set dc_quantity = dc_quantity - 1
                where dc_id = NEW.dc_id;
            end if;
        end if;
    end;

drop trigger if exists trigger_insert_Bill;
create trigger trigger_insert_Bill
    after insert
    on bill
    for each row
    begin
        if(NEW.bill_status = 1) then
            update customer
                set ctm_can_feedback = true
            where ctm_id = NEW.ctm_id and ctm_email is not null;
        end if;
        if(NEW.dc_id is not null ) then
                update discount
                    set dc_quantity = dc_quantity + 1
                where dc_id = NEW.dc_id;
        end if;
    end;

# test
# select * from bill;
# select * from customer;
#
# update bill
# set bill_status = true
# where bill_id = ...;
#
# select * from bill;
# select * from customer;

drop trigger if exists trigger_insert_feedback;
create trigger trigger_insert_feedback
    after insert
    on feedback
    for each row
    begin
        declare $CanFb boolean;
        select ctm_can_feedback into $CanFb from customer where customer.ctm_id = NEW.ctm_id;
        if($CanFb = true) then
            begin
                update customer
                    set ctm_can_feedback = false
                where ctm_id = NEW.ctm_id;
            end;
        else
            begin
                delete from NEW where fb_id = NEW.fb_id;
            end;
        end if;
    end;

drop trigger if exists trigger_insert_DetailBill;
create trigger trigger_insert_DetailBill
    after insert
    on detail_bill
    for each row
    begin
#         declare $discountValuePercent double; declare $discountValue double; declare $dcId int;
#         select dc_id into $dcId from bill where bill.bill_id = NEW.bill_id;
        update bill
        set sub_total = sub_total + NEW.value
        where bill_id = NEW.bill_id;
#         if($dcId is null) then
#             update bill
#             set
#                 value_reduced = 0
#             where bill.bill_id = NEW.bill_id;
#         else
#         begin
#             select dc_value_percent into $discountValuePercent from discount
#                 where discount.dc_id = $dcId;
#             select dc_value into $discountValue  from discount
#                   where discount.dc_id = $dcId;
#             update bill
#             set
#                 value_reduced = (sub_total * $discountValuePercent/100)+ $discountValue
#             where bill.bill_id = NEW.bill_id;
#         end;
#         end if;
#         update bill
#         set
#             total_value = sub_total - value_reduced
#         where bill.bill_id = NEW.bill_id;
    end;

# test - pass
# select * from bill;
# select * from detail_bill;
#
# insert into detail_bill (detail_id, bill_id, sv_id, quantity, sv_price, pet_id)
# values (default,2,5,1,2500000,3);
# insert into detail_bill (detail_id, bill_id, sv_id, quantity, sv_price, pet_id)
# values (default,1,4,1,3000000,1);
# select * from bill;
# select * from detail_bill;


drop trigger if exists trigger_updateBefore_DetailBill;
create trigger trigger_updateBefore_DetailBill
    before update
    on detail_bill
    for each row
    begin
        set NEW.value = NEW.sv_price * NEW.quantity;
    end;

drop trigger if exists trigger_updateAfter_DetailBill;
create trigger trigger_updateAfter_DetailBill
    after update
    on detail_bill
    for each row
    begin
#         declare $discountValuePercent double; declare $discountValue double; declare $dcId int;
#         select dc_id into $dcId from bill where bill.bill_id = NEW.bill_id;
        update bill
        set sub_total = sub_total + (NEW.quantity - OLD.quantity) * NEW.sv_price
        where bill_id = NEW.bill_id;
#         if($dcId is null) then
#             update bill
#             set
#                 value_reduced = 0
#             where bill.bill_id = NEW.bill_id;
#         else
#         begin
#             select dc_value_percent into $discountValuePercent from discount
#                 where discount.dc_id = $dcId;
#             select dc_value into $discountValue  from discount
#                   where discount.dc_id = $dcId;
#             update bill
#             set
#                 value_reduced = (sub_total * $discountValuePercent/100)+ $discountValue
#             where bill.bill_id = NEW.bill_id;
#         end;
#         end if;
#         update bill
#         set
#             total_value = sub_total - value_reduced
#         where bill.bill_id = NEW.bill_id;
    end;

# test - pass
-- update detail_bill
-- set quantity = 2
-- where bill_id = 2 and sv_id = 2;
-- update detail_bill
-- set quantity = 2
-- where bill_id = 1 and sv_id = 3;
-- select * from bill;
-- select * from detail_bill;

drop trigger if exists trigger_delete_DetailBill;
create trigger trigger_delete_DetailBill
    after delete
    on detail_bill
    for each row
    begin
#         declare $discountValuePercent double; declare $discountValue double; declare $dcId int;
#         select dc_id into $dcId from bill where bill.bill_id = OLD.bill_id;
        update bill
        set sub_total = sub_total - OLD.value
        where bill_id = OLD.bill_id;
#         if($dcId is null) then
#             update bill
#             set
#                 value_reduced = 0
#             where bill.bill_id = OLD.bill_id;
#         else
#         begin
#             select dc_value_percent into $discountValuePercent from discount
#                 where discount.dc_id = $dcId;
#             select dc_value into $discountValue  from discount
#                   where discount.dc_id = $dcId;
#             update bill
#             set
#                 value_reduced = (sub_total * $discountValuePercent/100)+ $discountValue
#             where bill.bill_id = OLD.bill_id;
#         end;
#         end if;
#         update bill
#         set
#             total_value = sub_total - value_reduced
#         where bill.bill_id = OLD.bill_id;
    end;

#  test - pass
# delete from detail_bill
# where detail_id = 9;
# select * from bill;
# select * from detail_bill;
