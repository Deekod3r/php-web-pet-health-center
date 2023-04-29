<?php 
include('entity/Feedback.php');
class FeedbackController extends BaseController{

    public function feedback_page(){
        $feedbackRepo = $this->getRepo('feedback');
        $feedback = $feedbackRepo->getData();
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData();
        $this->renderView(
            'feedback',[
            'shop' => $shop,
            'feedback' => $feedback
        ]
        );
    }

}