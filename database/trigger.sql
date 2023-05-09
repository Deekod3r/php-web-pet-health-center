drop trigger if exists trigger_insert_DetailBill;
create trigger trigger_insert_DetailBill
    after insert
    on detail_bill
    for each row
    begin
        update bill
        set value_temp = value_temp + NEW.value
        where bill_id = NEW.bill_id;
    end;

# test - pass
# select * from bill;
# select * from detail_bill;
#
# insert into detail_bill (detail_id, bill_id, sv_id, quantity, sv_price, pet_id,value)
# values (default,2,5,1,2500000,3,2500000);
# insert into detail_bill (detail_id, bill_id, sv_id, quantity, sv_price, pet_id,value)
# values (default,1,4,1,3000000,1,3000000);
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
        update bill
        set value_temp = value_temp + (NEW.quantity - OLD.quantity) * NEW.sv_price
        where bill_id = NEW.bill_id;
    end;

# test - pass
# update detail_bill
# set quantity = 2
# where bill_id = 2 and sv_id = 2;
# update detail_bill
# set quantity = 2
# where bill_id = 1 and sv_id = 3;
# select * from bill;
# select * from detail_bill;

drop trigger if exists trigger_delete_DetailBill;
create trigger trigger_delete_DetailBill
    after delete
    on detail_bill
    for each row
    begin
        update bill
        set value_temp = value_temp - OLD.value
        where bill_id = OLD.bill_id;
    end;

#  test - pass
# delete from detail_bill
# where detail_id = 4;
# select * from bill;
# select * from detail_bill;

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

