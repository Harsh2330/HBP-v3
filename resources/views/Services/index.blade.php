<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        function scrollLeft() {
            document.querySelector('.services').scrollBy({ left: -300, behavior: 'smooth' });
        }
        function scrollRight() {
            document.querySelector('.services').scrollBy({ left: 300, behavior: 'smooth' });
        }
        function init() {
            document.querySelector('.scroll-left').addEventListener('click', scrollLeft);
            document.querySelector('.scroll-right').addEventListener('click', scrollRight);
        }
        window.onload = init;
    </script>
    <style>
        .scroll-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #CAA907;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }
        .scroll-left {
            left: 10px;
        }
        .scroll-right {
            right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Our Services</h1>
        <nav>
            <ul class="menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <section class="services">
        <button class="scroll-button scroll-left">&#9664;</button>
        <button class="scroll-button scroll-right">&#9654;</button>

        <a href="service1.html" class="service-box">
            <div class="service">
                <div class="service-image"></div>
                    <img src="./public/IMG_1311.JPEG.jpg" alt="Palliative Care Image" style="width:100%; height:auto;">
                </div>
                <p>Palliative care.</p> 
            </div>
        </a>

        <a href="service2.html" class="service-box">
            <div class="service">
                <div class="service-image"></div>
                    <img src="./public/IMG_0969.JPG" alt="Patient Checkup" style="width:100%; height:auto;">
                </div>
                <p>Partient Ckeckup .</p> 
            </div>
        </a>

        <a href="service3.html" class="service-box">
            <div class="service">
                <div class="service-image"></div>
                    <img src="./public/MEDICINE.JPG.jpg" alt="Checking patients" style="width:100%; height:auto; padding: 1px;">
                </div>
                <p>Medication .</p> 
            </div>
        </a>

        <a href="service4.html" class="service-box">
            <div class="service">
                <div class="service-image"></div>
                    <img src="./public/DOC.png" alt="Checking patients" style="width:100%; height:auto; padding: 1px;">
                </div>
                 <p>Documentation.</p>
            </div>
        </a>

        <a href="service5.html" class="service-box">
            <div class="service">
                <div class="service-image"></div>
                    <img src="./public/IMG_1308.JPEG.jpg" alt="Service Five Image" style="width:100%; height:auto;">
                </div>
                 <p>Counselling.</p>
            </div>
        </a>

    </section>
</body>
</html>
