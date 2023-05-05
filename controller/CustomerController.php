<?php 
class CustomerController extends BaseController{

    public function customer_info(){
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $customerRepo = $this->getRepo('customer');
        $customer = $customerRepo->getById($_SESSION['id']);
        $petRepo = $this->getRepo('pet');
        $pet = $petRepo->getByCustomer($_SESSION['id']);
        $billRepo = $this->getRepo('bill');
        $bill = $billRepo->getByCustomer($_SESSION['id']);
        $appointmentRepo = $this->getRepo('appointment');
        $appointment = $appointmentRepo->getByCustomer($_SESSION['id']," and ( apm_status in (".Enum::STATUS_APPOINTMENT_CONFIRMED_YES ." ,".Enum::STATUS_APPOINTMENT_CONFIRMED_NO.")) ORDER BY apm_date,apm_time");
        $this->renderView(
            'customer_info',[
                'shop' => $shop,
                'customer' => $customer,
                'pet' => $pet,
                'bill' => $bill,
                'appointment' => $appointment
            ]
        );
    }

}