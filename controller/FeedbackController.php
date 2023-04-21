<?php 
class FeedbackController extends BaseController{

    public function feedback_page(){
        $this->renderView(
            'feedback',[]
        );
    }

}