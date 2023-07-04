drop trigger if exists trigger_update_Bill;
DELIMITER $$
create trigger trigger_update_Bill
    after update
    on bill
    for each row
    begin
        if(NEW.bill_status = 1) then
            update customer set ctm_can_feedback = true where ctm_id = NEW.ctm_id and ctm_active = 1;
            if(NEW.dc_id is not null ) then
                begin
                    update discount set dc_quantity = dc_quantity - 1 where dc_id = NEW.dc_id and dc_quantity is not null and dc_quantity > 0;
                end;
            end if;
        end if;
    end;
$$
DELIMITER ;

drop trigger if exists trigger_insert_feedback;
DELIMITER $$
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
$$
DELIMITER ;

drop trigger if exists trigger_insert_DetailBill;
DELIMITER $$
create trigger trigger_insert_DetailBill
    after insert
    on detail_bill
    for each row
    begin
        update bill
        set sub_total = sub_total + NEW.value
        where bill_id = NEW.bill_id;
    end;
$$
DELIMITER ;

drop trigger if exists trigger_updateAfter_DetailBill;
DELIMITER $$
create trigger trigger_updateAfter_DetailBill
    after update
    on detail_bill
    for each row
    begin
        update bill
        set sub_total = sub_total + (NEW.quantity - OLD.quantity) * NEW.sv_price
        where bill_id = NEW.bill_id;
    end;
$$
DELIMITER ;

drop trigger if exists trigger_delete_DetailBill;
DELIMITER $$
create trigger trigger_delete_DetailBill
    after delete
    on detail_bill
    for each row
    begin
        update bill
        set sub_total = sub_total - OLD.value
        where bill_id = OLD.bill_id;
    end;
$$
DELIMITER ;
