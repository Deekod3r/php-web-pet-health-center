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
# values (3,2,5,1,2500000,3,2500000);
# insert into detail_bill (detail_id, bill_id, sv_id, quantity, sv_price, pet_id,value)
# values (4,1,4,1,3000000,1,3000000);
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
