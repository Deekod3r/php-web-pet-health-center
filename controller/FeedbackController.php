<?php
class FeedbackController extends BaseController
{

    public function feedback_page()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->renderView(
                'feedback'
            );
        } else include('view/error/error-400.php');
    }

    public function data_feedback()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $feedbackRepo = $this->getRepo('feedback');
            $feedback = $feedbackRepo->getData("");
            $result = [
                "statusCode" => "1",
                "message" => "OK",
                "data" => [
                    'feedback' => $feedback
                ]
            ];
            echo json_encode($result);
        } else $this->redirect('home', 'index');
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
