<?php
class FeedbackController extends BaseController
{

    public function feedback_page()
    {
        $feedbackRepo = $this->getRepo('feedback');
        $feedback = $feedbackRepo->getData("");
        $shopRepo = $this->getRepo('shop');
        $shop = $shopRepo->getData("");
        $this->renderView(
            'feedback', [
                'shop' => $shop,
                'feedback' => $feedback,
            ]
        );
    }

    public function sendFeedback()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'content' => $_POST['fbContent'],
                'rating' => $_POST['rating'],
                'time' => $_POST['time'],
                'ctmId' => $_POST['ctmId'],
            ];
            $feedbackRepo = $this->getRepo('feedback');
            if ($feedbackRepo->saveData($data)) {
                $_SESSION['msg_send_feedback'] = "Đánh giá thành công.";
                $_SESSION['check_send_feedback'] = true;
            } else {
                $_SESSION['msg_send_feedback'] = "Đánh giá không thành công.";
                $_SESSION['check_send_feedback'] = false;
            }
            $this->redirect('feedback', 'feedback_page');
        }
    }

}
