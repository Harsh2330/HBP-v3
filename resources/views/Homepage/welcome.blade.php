<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PALLIATIVE CARE</title> 
    <!-- Page Icon -->
    <link rel="shortcut icon" href="image/logodf.png" type="image/x-icon">   
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <!-- Custom Css File Link -->
    <link rel="stylesheet" href="/css/home.css">
    <style>
        .box:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        .scroll-animation {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .scroll-animation.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>      
    <!-- Header Section Starts -->
    <div class="header">
        <a href="#" class="logo"><i class="fas fa-heartbeat"></i> Sankul  Deepak Foundation</a>
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#services">services</a>
            <a href="#about">about</a>
            <a href="#doctors">doctors</a>
            <a href="{{ route('login') }}">login</a>
            <a href="{{ route('register') }}">register</a> 
        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </div>
    <!-- Header Section End -->

    <!-- Home Section starts -->
    <section class="home scroll-animation" id="home">
        <div class="image">
            <img src="/image/IMG_1961.jpg" alt="team.jpg.jpg">
        </div>
        <div class="content">
            <h3>HOME BASED PALLIATIVE</h3>

            <section class="services scroll-animation bounce-animation" id="services">
                <div class="box-container">
                    <div class="box">
                        <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
                        <p class="max-w-2xl h-auto md:h-[500px] mx-auto text-lg leading-relaxed text-left p-4 bg-transparent rounded-lg overflow-y-auto">
                            Home-based palliative care is a specialized medical service providing comprehensive support to individuals with serious, life-limiting illnesses at home, focusing on enhancing quality of life by addressing physical, emotional, social, and spiritual needs through a multidisciplinary team delivering personalized care.<br>
                            <br>
                            <br>
                            ઘરઆધારિત પેલિયેટિવ કેર એ આરોગ્યસેવાની એવી સેવા છે જે ગંભીર, દીર્ઘકાળિન અથવા અંતિમ ચરણની બિમારીઓ ધરાવતા દર્દીઓને તેમના ઘરની આરામદાયક પરિસ્થિતિમાં પૂરી પાડવામાં આવે છે. તેનું મુખ્ય ઉદ્દેશ્ય દર્દીઓ અને તેમના પરિવારજનોની શારીરિક, ભાવનાત્મક, સામાજિક અને આધ્યાત્મિક જરૂરિયાતોને ધ્યાનમાં રાખીને તેમની જીવનની ગુણવત્તામાં સુધારો લાવવાનો છે.
                        </p>
                    </div>
                </div>
            </section>

            
            <!-- <a href="#" class="btn">contact us <span class="fas fa-chevron-right"></span> </a> -->
        </div>
    </section>
    <div class="box">
        
    </div>
    
    <!-- Home Section End -->

    <!-- Service section Starts  -->
    <section class="services scroll-animation" id="services">
        <div class="Container2">
        <h1 class="heading">our <span>services</span></h1>
        <div class="box-container">
            
            <div class="box">
                <i class="fas fa-spa"></i>
                <h3>therapy</h3>
                <p>Relaxing and therapeutic massage services.</p>
            </div>
            <div class="box">
                <i class="fas fa-heart"></i>
                <h3>cardiology</h3>
                <p>Expert care for heart-related conditions.</p>
            </div>
            <div class="box">
                <i class="fas fa-stethoscope"></i>
                <h3>diagnosis</h3>
                <p>Accurate and timely medical diagnosis.</p>
            </div>
            <div class="box">
                <i class="fas fa-ambulance"></i>
                <h3>ambulance service</h3>
                <p>Emergency medical transportation services.</p>
            </div>
            <div class="box">
                    <i class="fas fa-user-md"></i>
                    <h3>140+</h3>
                    <p>doctors at work</p>
                </div>
                <div class="box">
                    <i class="fas fa-users"></i>
                    <h3>1040+</</h3>
                    <p>satisfied patients</p>
                </div>
                <div class="box">
                    <i class="fas fa-procedures"></i>
                    <h3>500+</</h3>
                    <p>bed facility</p>
                </div>
                <div class="box">
                    <i class="fas fa-hospital"></i>
                    <h3>80+</</h3>
                    <p>available hospitals</p>
                </div>
        </div>
        </div>
    </section>
    <!-- Service section End  -->

    <!-- icons section starts  -->

    <!-- About section Starts  -->
    <section class="about scroll-animation" id="about">
        <h1 class="heading"><span>about</span> us</h1>
        <div class="row">
            <div class="content">
                <h3>we take care of your healthy life</h3>
                <p class="max-w-2xl h-auto md:h-[500px] mx-auto text-lg leading-relaxed text-left p-4 bg-transparent rounded-lg overflow-y-auto">
                Introduction Every patient has the fundamental right to receive a good quality of care at the place where he/she lives. A home is a place of memories, familiarity and safety, a place where we remain comfortable, relaxed and confident and the best place for freedom of choice and autonomy. It is possible to manage patients with advanced diseases at home..<br>
                    <br>
                    <br>
                    દરેક દર્દીને તે રહે છે ત્યાં સારી ગુણવત્તાની સંભાળ પ્રાપ્ત કરવાનો મૂળભૂત હક છે. ઘર એ યાદો, પરિચિત વાતાવરણ અને સુરક્ષાનું સ્થાન છે, જ્યાં આપણે આરામદાયક, નિડર અને વિશ્વાસપૂર્વક રહી શકીએ છીએ. તે સ્વતંત્રતા અને આત્મનિર્ભરતાનું શ્રેષ્ઠ સ્થાન છે. ઉન્નત રોગોથી પીડાતા દર્દીઓની સંભાળ ઘરે રાખવી સંભવ છે..
                </p>
                <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
            </div>
            <div class="image">
                <img src="./image/IMG_1979.JPG" alt="">
            </div>
        </div>
    </section>
    <!-- About section End  -->

    <!-- Doctors section Starts  -->
    <section class="doctors scroll-animation" id="doctors">
        <div class="Container2">
        <h1  class="heading">our <span>doctors</span></h1>
        <div class="box-container">
            <div class="box">
                <img src="/image/people_13997611.png" alt="">
                <h3>Dr. Dhruv </h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
            <div class="box">
            <img src="/image/surgeon_13297756.png" alt="">
            <h3>Dr. Tarun</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
            <div class="box">
            <img src="/image/doctor_12712374.png" alt="">
            <h3> Dr. Darshna</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
            <div class="box">
            <img src="/image/b43ec4bf-37d0-45a2-8780-c7fd0c809e00_removalai_preview.png" alt="">
            <h3>Dr. Aditya</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
            <div class="box">
            <img src="/image/d70b67e7-0b4c-4ffc-9847-92ab1ae58aed_removalai_preview.png" alt="">
            <h3>Dr. Sakshi</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
            <div class="box">
            <img src="/image/doctor_1021566.png" alt="">
            <h3>Dr. Waghmare</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Doctors section Ends  -->

    <!-- Book section Starts  -->

     <!-- Review section End  -->

    <!-- Footer section Starts  -->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>quick links</h3>
                <a href="#"> <i class="fas fa-chevron-right"></i> home</a>
                <a href="#"> <i class="fas fa-chevron-right"></i> services</a>
                <a href="#"> <i class="fas fa-chevron-right"></i> about</a>
                <a href="#"> <i class="fas fa-chevron-right"></i> doctors</a>
                <a href="#"> <i class="fas fa-chevron-right"></i> book</a>
                <a href="#"> <i class="fas fa-chevron-right"></i> review</a>
                <a href="#"> <i class="fas fa-chevron-right"></i> blogs</a>
            </div>
            <div class="box">
                <h3>our services</h3>
                <a href="#"> <i class="fas fa-chevron-right"></i> palliative care</a>
                <a href="#"> <i class="fas fa-chevron-right"></i> message therapy</a>
                <a href="#"> <i class="fas fa-chevron-right"></i> cardioloty</a>
                <a href="#"> <i class="fas fa-chevron-right"></i> diagnosis</a>
                <a href="#"> <i class="fas fa-chevron-right"></i> ambulance service</a>
            </div>
            <div class="box">
                <h3>contact info</h3>
                <a href="#"> <i class="fas fa-phone"></i> +123-456-7859</a>
                <a href="#"> <i class="fas fa-phone"></i> +356-481-0286</a>
                <a href="#"> <i class="fas fa-envelope"></i> Deepak.info.com</a>
                <a href="#"> <i class="fas fa-envelope"></i> Sankul.info.@gmail.com</a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i>  Nizampura, Vadodara - 391240</a>
            </div>
            <div class="box">
                <h3>follow us</h3>

                <a href="#"> <i class="fab fa-facebook-f"></i> facebook</a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter</a>
                <a href="#"> <i class="fab fa-linkedin"></i> linkedin</a>
                <a href="#"> <i class="fab fa-instagram"></i> instagram</a>
                <a href="#"> <i class="fab fa-youtube"></i> youtube</a>
                <a href="#"> <i class="fab fa-pinterest"></i> pinterest</a>
            </div>
        </div>
        <div class="credit">created by <span>Deepak Foundation</span> | all right reserved</div>
    </section>
    <!-- Footer section End  -->

    <!-- custom js file link  -->
    <script src="js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollElements = document.querySelectorAll('.scroll-animation');

            const elementInView = (el, dividend = 1) => {
                const elementTop = el.getBoundingClientRect().top;
                return (
                    elementTop <= (window.innerHeight || document.documentElement.clientHeight) / dividend
                );
            };

            const displayScrollElement = (element) => {
                element.classList.add('visible');
            };

            const hideScrollElement = (element) => {
                element.classList.remove('visible');
            };

            const handleScrollAnimation = () => {
                scrollElements.forEach((el) => {
                    if (elementInView(el, 1.25)) {
                        displayScrollElement(el);
                    } else {
                        hideScrollElement(el);
                    }
                });
            };

            window.addEventListener('scroll', () => {
                handleScrollAnimation();
            });
        });
    </script>
</body>
</html>