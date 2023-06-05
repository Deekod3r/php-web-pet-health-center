<!DOCTYPE html>
<html lang="en">
<?php $title = "Đánh giá"; ?>
<?php include("layout/asset-header.php") ?>
<style>
    .heading {
        font-size: 25px;
        margin-right: 25px;
    }

    .fa {
        font-size: 25px;
    }

    .checked {
        color: orange;
    }

    /* Three column layout */
    .side {
        float: left;
        width: 15%;
        margin-top: 10px;
    }

    .middle {
        margin-top: 10px;
        float: left;
        width: 70%;
    }

    /* Place text to the right */
    .right {
        text-align: right;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* The bar container */
    .bar-container {
        width: 100%;
        background-color: #f1f1f1;
        text-align: center;
        color: white;
    }

    /* Individual bars */
    .bar-r5 {
        width: 60%;
        height: 18px;
        background-color: #04AA6D;
    }

    .bar-r4 {
        width: 30%;
        height: 18px;
        background-color: #2196F3;
    }

    .bar-r3 {
        width: 10%;
        height: 18px;
        background-color: #00bcd4;
    }

    .bar-r2 {
        width: 4%;
        height: 18px;
        background-color: #ff9800;
    }

    .bar-r1 {
        width: 15%;
        height: 18px;
        background-color: #f44336;
    }

    /* Responsive layout - make the columns stack on top of each other instead of next to each other */
    @media (max-width: 400px) {

        .side,
        .middle {
            width: 100%;
        }

        .right {
            display: none;
        }
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }


    .rating {

        grid-gap: .5rem;
        font-size: 2rem;
        color: var(--yellow);
        margin-bottom: 2rem;
    }

    .star {
        color: var(--yellow);
    }

    .rating .star {
        cursor: pointer;
    }

    .rating .star.active {
        opacity: 0;
        animation: animate .5s calc(var(--i) * .1s) ease-in-out forwards;
    }

    @keyframes animate {
        0% {
            opacity: 0;
            transform: scale(1);
        }

        50% {
            opacity: 1;
            transform: scale(1.2);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }


    .rating .star:hover {
        transform: scale(1.1);
    }

    textarea {
        width: 100%;
        background: var(--light);
        padding: 1rem;
        border-radius: .5rem;
        border: none;
        outline: none;
        resize: none;
        margin-bottom: .5rem;
    }

    .btn-group {
        display: flex;
        grid-gap: .5rem;
        align-items: center;
    }

    .btn-group .btn {
        padding: .75rem 1rem;
        border-radius: .5rem;
        border: none;
        outline: none;
        cursor: pointer;
        font-size: .875rem;
        font-weight: 500;
    }

    .btn-group .btn.submit {
        background: var(--blue);
        color: var(--white);
    }

    .btn-group .btn.submit:hover {
        background: var(--blue-d-1);
    }

    .btn-group .btn.cancel {
        background: var(--white);
        color: var(--blue);
    }

    .btn-group .btn.cancel:hover {
        background: var(--light);
    }

    :root {
        --yellow: #FFBD13;

    }

    .ratingBar {
        height: 30px;
    }

    #ratingBar1 {
        background-color: #ff6f31;
    }

    #ratingBar2 {
        background-color: #ff9f02;
    }

    #ratingBar3 {
        background-color: #ffcf02;
    }

    #ratingBar4 {
        background-color: #88b131;
    }

    #ratingBar5 {
        background-color: #99cc00;
    }

    .star {
        font-size: 25px;
        cursor: pointer;
    }
</style>

<body>
    <?php include("layout/header.php") ?>
    <div class="container py-5 main">
        <h3 class="mb-4" id="countFeedback"></h3>
        <div class="row m-3 mb-5 w-50">
            <div class="side">
                <div>5 <i class="fa-solid fa-star"></i></div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-r5"></div>
                </div>
            </div>
            <div class="side right">
                <div id="c-r5"></div>
            </div>
            <div class="side">
                <div>4 <i class="fa-solid fa-star"></i></div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-r4"></div>
                </div>
            </div>
            <div class="side right">
                <div id="c-r4"></div>
            </div>
            <div class="side">
                <div>3 <i class="fa-solid fa-star"></i></div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-r3"></div>
                </div>
            </div>
            <div class="side right">
                <div id="c-r3"></div>
            </div>
            <div class="side">
                <div>2 <i class="fa-solid fa-star"></i></div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-r2"></div>
                </div>
            </div>
            <div class="side right">
                <div id="c-r2"></div>
            </div>
            <div class="side">
                <div>1 <i class="fa-solid fa-star"></i></div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-r1"></div>
                </div>
            </div>
            <div class="side right">
                <div id="c-r1"></div>
            </div>
        </div>
        <div class="mb-5" id="data-feedback">
        </div>
        <div class="col-lg-12" id="page">
        </div>
        <div class='alert ' role='alert' id='msg-send-feedback' style='display:none'></div>
        <div id="form" style="display: none">
            <form id="form-feedback">
                <div class='rating mb-0'>
                    <input type='number' name='rating' id='rating' hidden />
                    <i class='bx bx-star star' style='--i: 0;'></i>
                    <i class='bx bx-star star' style='--i: 1;'></i>
                    <i class='bx bx-star star' style='--i: 2;'></i>
                    <i class='bx bx-star star' style='--i: 3;'></i>
                    <i class='bx bx-star star' style='--i: 4;'></i>
                </div>
                <div class='form-group'>
                    <input type='text' class='form-control border-1' placeholder='Hãy chia sẻ trải nghiệm sử dụng dịch vụ của bạn' name='fbContent' id="fb-content" />
                </div>
                <div style='margin-top: 10px; margin-bottom: 10px'>
                    <input class='btn btn-lg btn-primary btn-block border-0' id='btn-send-feedback' type='submit' disabled>
                </div>
            </form>
        </div>
    </div>

    <?php include("layout/footer.php") ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <?php include("layout/asset-footer.php") ?>
    <script src="asset/js/feedback.js?v=<?php echo time() ?>" async></script>

</body>

</html>