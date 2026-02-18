<?php include 'config/constants.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include 'meta.php'?>
    <title><?php echo $thename?> | Best Online Education Platform in Nigeria</title>
    <meta name="keywords" content="<?php echo $thename?>, Best Online Education Platform in nigeria, Best Online Education Platform in lagos, Online tutorials, Online Education Platform, Dynamic Video Learning, Expert Crafted Lessons, Personalized Academic Guidance, Smarter Learning Journey, Effective Learning Experience, Academic Potential Unlocking, Innovative Learning App, Captivating Educational Content, Engaging Learning Environment, Academic Success Path, Knowledge Unfolding, Cutting-edge Learning Technology, Education Innovation, Academic Empowerment" />
    <meta name="description" content="Welcome to Leaders Tutors – where education meets innovation! Our cutting-edge application redefines the learning experience with a dynamic Education Video Learning system."/>
    
    <meta property="og:title" content="<?php echo $thename?> | Best Online Education Platform in Nigeria" />
    <meta property="og:image" content="<?php echo $website_url?>/all-images/plugin-pix/leaders-tutors.jpg"/>
    <meta property="og:description" content="Welcome to Leaders Tutors – where education meets innovation! Our cutting-edge application redefines the learning experience with a dynamic Education Video Learning system."/>
    
    <meta name="twitter:title" content="<?php echo $thename?> | Best Online Education Platform in Nigeria"/> 
    <meta name="twitter:card" content="<?php echo $thename?>"/> 
    <meta name="twitter:image"  content="<?php echo $website_url?>/all-images/plugin-pix/leaders-tutors.jpg"/> 
    <meta name="twitter:description" content="Welcome to Leaders Tutors – where education meets innovation! Our cutting-edge application redefines the learning experience with a dynamic Education Video Learning system."/>
</head>

<body>
    <section class="header-section">
	         <?php  include 'header.php'?>
    </section>
    
    
    <section class="slide-section">
        <div class="slide-div">
            <div class="content-back-div">
                <div class="text-content-div animated fadeInRight">
                    <h1>A good <span>#education</span> is always a base of <br/><span class="type-text" id="page-title"></span></h1>
                    <p>Welcome to Leaders Tutors – where education meets innovation! Our cutting-edge application redefines the learning experience with a dynamic Education Video Learning system.</p>
                   
                    <div class="btn-div">
                        <a href="<?php echo $website_url?>/account/login" title="Start as a student">
                        <button class="sign-up" title="Start as a student">Start as a student <i class="bi-chevron-right"></i></button></a>
                        <a href="#" title="Start as a student">
                        <button class="sign-up right-btn" title="Download the App">Download the App <span>It's Free!</span></button></a>
                    </div>                   
                </div>

                <div class="image-content-div animated fadeInLeft">
                    
                    <div class="cg-carousel">
                        <div class="cg-carousel__container full" id="js-carousel_1">
                            <div class="cg-carousel__track js-carousel__track full">

                                <div class="cg-carousel__slide js-carousel__slide full">
                                    <img src="<?php echo $website_url?>/all-images/body-pix/slide-img.png" alt="Slide Image"/>
                                </div>

                                <div class="cg-carousel__slide js-carousel__slide full">
                                    <img src="<?php echo $website_url?>/all-images/body-pix/slide-img.png" alt="Slide Image"/>
                                </div>

                                <div class="cg-carousel__slide js-carousel__slide full">
                                    <img src="<?php echo $website_url?>/all-images/body-pix/slide-img.png" alt="Slide Image"/>
                                </div>

                                <div class="cg-carousel__slide js-carousel__slide full">
                                    <img src="<?php echo $website_url?>/all-images/body-pix/slide-img.png" alt="jSlide Image"/>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>

        <script type="text/javascript">
        // List of sentences
        var _CONTENT = [ "Self confidence","A bright future","Equitable societies"];
        // Current sentence being processed
        var _PART = 0;
        // Character number of the current sentence being processed 
        var _PART_INDEX = 0;
        // Element that holds the text
        var _ELEMENT = document.querySelector("#page-title");
        // Implements typing effect
        function Type() { 
            var text =  _CONTENT[_PART].substring(0, _PART_INDEX + 1);
            _ELEMENT.innerHTML = text;
            _PART_INDEX++;

            // If full sentence has been displayed then start to delete the sentence after some time
            if(text === _CONTENT[_PART]) {
                clearInterval(_INTERVAL_VAL);
                setTimeout(function() {
                    _INTERVAL_VAL = setInterval(Delete, 2);
                }, 5000);
            }
        }
        // Implements deleting effect
        function Delete() {
            var text =  _CONTENT[_PART].substring(0, _PART_INDEX - 1);
            _ELEMENT.innerHTML = text;
            _PART_INDEX--;

            // If sentence has been deleted then start to display the next sentence
            if(text === '') {
                clearInterval(_INTERVAL_VAL);

                // If last sentence then display the first one, else move to the next
                if(_PART == (_CONTENT.length - 1))
                    _PART = 0;
                else
                    _PART++;
                _PART_INDEX = 0;

                // Start to display the next sentence after some time
                setTimeout(function() {
                    _INTERVAL_VAL = setInterval(Type, 50);
                }, 100);
            }
        }
        // Start the typing effect on load
        _INTERVAL_VAL = setInterval(Type, 50);
        </script>

    <script>
        window['carousel_options_1']= ({
            items:4,
                margin: 30,
                loop:true,
                dots: true,
                autoplayHoverPause: true,
                smartSpeed:650,         
                autoplay:true,      
                breakpoints: {
            768: {
            slidesPerView: 1,
            },
            1024: {
            slidesPerView: 1,
            }
        
            }
        });
        _call_carousel(1)
    </script>
    </section>
    

    <section class="index-content-div">
        <section class="body-div harsh-bg net-bg">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="title-div" data-aos="fade-in" data-aos-duration="1200">
                        <h2>Stats that explain everything about <span>#Our success</span></h2>
                        <a href="#" title="See how it works">
                        <button class="btn" title="See how it works">See how it works <i class="bi-chevron-right"></i></button></a>
                    </div>

                    <div class="success-back-div">
                        <div class="success" data-aos="fade-in" data-aos-duration="800">
                            <div class="icon-div">
                                <div class="inner">
                                    <img src="<?php echo $website_url?>/all-images/body-pix/placeholder.png" alt="Subjects available"/>
                                </div>
                            </div>

                            <div class="text-div">
                                <h5>56 +</h5>
                                <p>Subjects available for verified and topics</p>
                            </div>
                        </div>

                        <div class="success" data-aos="fade-in" data-aos-duration="900">
                            <div class="icon-div">
                                <div class="inner">
                                    <img src="<?php echo $website_url?>/all-images/body-pix/placeholder2.png" alt="Total dynamic"/>
                                </div>
                            </div>

                            <div class="text-div">
                                <h5>1,821 +</h5>
                                <p>Total dynamic digital classrooms and videos </p>
                            </div>
                        </div>

                        <div class="success" data-aos="fade-in" data-aos-duration="1000">
                            <div class="icon-div">
                                <div class="inner">
                                    <img src="<?php echo $website_url?>/all-images/body-pix/placeholder4.png" alt="User daily"/>
                                </div>
                            </div>

                            <div class="text-div">
                                <h5>20+ Hours</h5>
                                <p>User daily average time spent on the platform</p>
                            </div>
                        </div>

                        <div class="success" data-aos="fade-in" data-aos-duration="1200">
                            <div class="icon-div">
                                <div class="inner">
                                    <img src="<?php echo $website_url?>/all-images/body-pix/placeholder3.png" alt="Active students"/>
                                </div>
                            </div>

                            <div class="text-div">
                                <h5>112,124</h5>
                                <p>Active students available on the platform</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="body-div">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="title-div subjects-title" data-aos="zoom-in" data-aos-duration="1200">
                        <div class="icon-div">
                            <img src="<?php echo $website_url?>/all-images/body-pix/zigzag-line.svg" alt="profile Image"/>
                        </div>

                        <h2>Our Popular Topics And Views</h2>
                        <p>Explore e-learning opportunities that bring education to your fingertips, offering flexibility and accessibility. Enrich your journey with the best in online education, designed to cater to the unique needs of learners in Nigeria.</p>                     
                    </div>

                    <div class="subjects-back-div">
                        <div class="cg-carousel">
                            <div class="cg-carousel__container" id="js-carousel_2">                
                                <div class="cg-carousel__track js-carousel__track">

                                    <div class="cg-carousel__slide js-carousel__slide"  data-aos="fade-left" data-aos-duration="1200">
                                        <div class="subjects-div">
                                            <div class="title">BASIC 1</div>
                                            <div class="img-div">
                                                <img src="<?php echo $website_url?>/all-images/body-pix/basic1.webp" alt="Jss1"/>
                                            </div>
                                            <div class="text-div">
                                                <div class="profile-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url?>/all-images/body-pix/avatar.png" alt="profile1"/>
                                                    </div>
                                                    <div class="right-text">
                                                        <h4>Paul Emmanuel <i class="bi-check2-circle"></i></h4>
                                                        <p>ID:Lts202402031023</p>
                                                    </div>                                
                                                </div>

                                                <div class="list-back-div">
                                                    <div class="list-div">
                                                        <div>Subject:</div>
                                                        <div><span>Mathematics</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Term:</div>
                                                        <div><span>First Term</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Week:</div>
                                                        <div><span>Week 1</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Duration:</div>
                                                        <div><span>00:01:04</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bottom-div">
                                                <div class="view-div">
                                                    <span><i class="bi-eye-fill"></i> 0 VIEWS</span>
                                                </div>
                                                
                                                <div class="love-div">
                                                    <span><i class="bi-heart"></i></span>
                                                </div>       
                                            </div>
                                        </div>
                                    </div>
           
                                    <div class="cg-carousel__slide js-carousel__slide"  data-aos="fade-left" data-aos-duration="1200">
                                        <div class="subjects-div">
                                            <div class="title">BASIC 2</div>
                                            <div class="img-div">
                                                <img src="<?php echo $website_url?>/all-images/body-pix/basic2.webp" alt="Basic 2"/>
                                            </div>
                                            <div class="text-div">
                                                <div class="profile-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url?>/all-images/body-pix/avatar.png" alt="profile1"/>
                                                    </div>
                                                    <div class="right-text">
                                                        <h4>Samson Ayorinde <i class="bi-check2-circle"></i></h4>
                                                        <p>ID:Lts202402031023</p>
                                                    </div>                                
                                                </div>

                                                <div class="list-back-div">
                                                    <div class="list-div">
                                                        <div>Subject:</div>
                                                        <div><span>Use Of English</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Term:</div>
                                                        <div><span>First Term</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Week:</div>
                                                        <div><span>Week 1</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Duration:</div>
                                                        <div><span>00:01:04</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bottom-div">
                                                <div class="view-div">
                                                    <span><i class="bi-eye-fill"></i> 0 VIEWS</span>
                                                </div>
                                                
                                                <div class="love-div">
                                                    <span><i class="bi-heart"></i></span>
                                                </div>       
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cg-carousel__slide js-carousel__slide"  data-aos="fade-left" data-aos-duration="1200">
                                        <div class="subjects-div">
                                            <div class="title">JSS 1</div>
                                            <div class="img-div">
                                                <img src="<?php echo $website_url?>/all-images/body-pix/jss1.jpg" alt="Jss1"/>
                                            </div>
                                            <div class="text-div">
                                                <div class="profile-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url?>/all-images/body-pix/avatar.png" alt="profile1"/>
                                                    </div>
                                                    <div class="right-text">
                                                        <h4>Barry Job <i class="bi-check2-circle"></i></h4>
                                                        <p>ID:Lts202402031023</p>
                                                    </div>                                
                                                </div>

                                                <div class="list-back-div">
                                                    <div class="list-div">
                                                        <div>Subject:</div>
                                                        <div><span>Biology</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Term:</div>
                                                        <div><span>First Term</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Week:</div>
                                                        <div><span>Week 1</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Duration:</div>
                                                        <div><span>00:01:04</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bottom-div">
                                                <div class="view-div">
                                                    <span><i class="bi-eye-fill"></i> 0 VIEWS</span>
                                                </div>
                                                
                                                <div class="love-div">
                                                    <span><i class="bi-heart"></i></span>
                                                </div>       
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cg-carousel__slide js-carousel__slide"  data-aos="fade-left" data-aos-duration="1200">
                                        <div class="subjects-div">
                                            <div class="title">JSS 2</div>
                                            <div class="img-div">
                                                <img src="<?php echo $website_url?>/all-images/body-pix/jss2.jpg" alt="Jss 2"/>
                                            </div>

                                            <div class="text-div">
                                                <div class="profile-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url?>/all-images/body-pix/avatar.png" alt="profile1"/>
                                                    </div>
                                                    <div class="right-text">
                                                        <h4>Yakubu Ezekiel <i class="bi-check2-circle"></i></h4>
                                                        <p>ID:Lts202402031023</p>
                                                    </div>                                
                                                </div>

                                                <div class="list-back-div">
                                                    <div class="list-div">
                                                        <div>Subject:</div>
                                                        <div><span>Business Studies</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Term:</div>
                                                        <div><span>First Term</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Week:</div>
                                                        <div><span>Week 1</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Duration:</div>
                                                        <div><span>00:01:04</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bottom-div">
                                                <div class="view-div">
                                                    <span><i class="bi-eye-fill"></i> 0 VIEWS</span>
                                                </div>
                                                
                                                <div class="love-div">
                                                    <span><i class="bi-heart"></i></span>
                                                </div>       
                                            </div>
                                        </div>

                                    </div>

                                    <div class="cg-carousel__slide js-carousel__slide"  data-aos="fade-left" data-aos-duration="1200">
                                        <div class="subjects-div">
                                            <div class="title">JSS 2</div>
                                            <div class="img-div">
                                                <img src="<?php echo $website_url?>/all-images/body-pix/jss2.jpg" alt="Jss2"/>
                                            </div>

                                            <div class="text-div">
                                                <div class="profile-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url?>/all-images/body-pix/avatar.png" alt="profile1"/>
                                                    </div>
                                                    <div class="right-text">
                                                        <h4>Yyakubu Ezekiel <i class="bi-check2-circle"></i></h4>
                                                        <p>ID:Lts202402031023</p>
                                                    </div>                                
                                                </div>

                                                <div class="list-back-div">
                                                    <div class="list-div">
                                                        <div>Subject:</div>
                                                        <div><span>Mathematics</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Term:</div>
                                                        <div><span>First Term</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Week:</div>
                                                        <div><span>Week 1</span></div>
                                                    </div>
                                                    <div class="list-div">
                                                        <div>Duration:</div>
                                                        <div><span>00:01:04</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bottom-div">
                                                <div class="view-div">
                                                    <span><i class="bi-eye-fill"></i> 0 VIEWS</span>
                                                </div>
                                                
                                                <div class="love-div">
                                                    <span><i class="bi-heart"></i></span>
                                                </div>       
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div> 
                       
                    </div>
                    <div class="bottom-btn-div">
                        <div class="btn-div">
                            <button class="btn" title="Previous" id="js-carousel__prev_2"><i class="bi-chevron-double-left"></i></button>
                            <button class="btn" title="Next" id="js-carousel__next_2"><i class="bi-chevron-double-right"></i></button>
                        </div>
                    
                        <div class="right-btn">
                            <button class="btn" title="Explore all Classes">Explore all Classes <i class="bi-chevron-right"></i></button>
                        </div>
                    </div>

                    
                </div>
            </div>


            <script>
                window['carousel_options_2']= ({
                items:4,
                    margin: 30,
                    loop:true,
                    dots: true,
                    autoplayHoverPause: true,
                    smartSpeed:650,         
                    autoplay:false,      
                    breakpoints: {
                700: {
                slidesPerView: 2,
                },
                1000: {
                slidesPerView: 3,
                },
                1300: {
                slidesPerView: 4,
                }
            
                }
                });
                _call_carousel(2)
            </script>
        </section>


        <section class="body-div net-bg net-background">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="title-div redefine-title" data-aos="fade-in" data-aos-duration="1200">
                        <h2>Redefine your learning experience on Leaderstutors <span>#How its works</span></h2>
                        <a href="#" title="See how it works">
                        <button class="btn" title="See how it works">See how it works <i class="bi-chevron-right"></i></button></a>
                    </div>

                    <div class="success-back-div">
                        <div class="success how-it-works" data-aos="flip-right" data-aos-duration="800">
                            <div class="icon-div">
                                <div class="inner">
                                    <h3>1</h3>
                                </div>
                            </div>

                            <div class="text-div">
                                <h5>Sign Up</h5>
                                <p>Provide necessary data to create your account</p>
                                <button class="btn" title="Create Account"> <span>Create Account</span> <i class="bi-chevron-right"></i></button></a>
                            </div>
                        </div>

                        <div class="success how-it-works how-it-works-1" data-aos="flip-right" data-aos-duration="1000">
                            <div class="icon-div">
                                <div class="inner">
                                    <h3>2</h3>
                                </div>
                            </div>

                            <div class="text-div">
                                <h5>Subscribe</h5>
                                <p>Unlock endless learning and stay in the loop </p>
                                <button class="btn" title="Make Payment"> <span>Make Payment</span> <i class="bi-chevron-right"></i></button></a>
                            </div>
                        </div>

                        <div class="success how-it-works how-it-works-2" data-aos="flip-right" data-aos-duration="1200">
                            <div class="icon-div">
                                <div class="inner">
                                    <h3>3</h3>
                                </div>
                            </div>

                            <div class="text-div">
                                <h5>Get Tutorial</h5>
                                <p>Access wide range of topics to enhance your skills</p>
                                <button class="btn" title="Start Your Class"> <span>Start Your Class</span> <i class="bi-chevron-right"></i></button></a>
                            </div>
                        </div>

                        <div class="success how-it-works how-it-works-3" data-aos="flip-right" data-aos-duration="1400">
                            <div class="icon-div">
                                <div class="inner">
                                    <h3>4</h3>
                                </div>
                            </div>

                            <div class="text-div">
                                <h5>Earn</h5>
                                <p>Acquire valuable points for personal development</p>
                                <button class="btn" title="Rake In"> <span>Rake In</span> <i class="bi-chevron-right"></i></button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="body-div">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="about-div">
                        <div class="img-div" data-aos="fade-up" data-aos-duration="1400">
                            <img src="<?php echo $website_url?>/all-images/body-pix/about.jpg" alt="About Us"/>
                        </div>

                        <div class="content-div" data-aos="flip-right" data-aos-duration="1400">
                            <div class="icon-div">
                                <img src="<?php echo $website_url?>/all-images/body-pix/zigzag-line.svg" alt="About Us icon"/>
                            </div>

                            <h2>Empower yourself with the freedom to learn from <span class="text">Anywhere</span></h2>
                            <p>Discover the convenience of online classes in Nigeria. Elevate your skills and knowledge with a diverse range of virtual courses tailored to your schedule. Explore e-learning opportunities that bring education to your fingertips, offering flexibility and accessibility.</p>
                            <h5><i class="bi-check-lg"></i>Virtual Classroom Solution</h5>
                            <h5><i class="bi-check-lg"></i>Online Remote Learning</h5>
                            <h5><i class="bi-check-lg"></i>Lifetime Access</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="body-div net-bg3">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="testimonial">
                        <div class="content" data-aos="fade-up" data-aos-duration="1400">
                            <div class="icon-div">
                                <img src="<?php echo $website_url?>/all-images/body-pix/zigzag-line.svg" alt="testimonial"/>
                            </div>

                            <h2>What Our Students Have To Say</h2>
                            <p>Discover a diverse range of online tutor in Nigeria, connecting you to expert educators and valuable resources. Join the digital education revolution and unlock new possibilities with convenient and flexible online learning experiences right at your fingertips.</p>
                            <button class="btn" title="See how it works">View All<i class="bi-arrow-right"></i></button>
                        </div>

                        <div class="right-back-div">
                            <div class="cg-carousel">
                                <div class="cg-carousel__container" id="js-carousel_3">                
                                    <div class="cg-carousel__track js-carousel__track">

                                        <div class="cg-carousel__slide js-carousel__slide"  data-aos="fade-left" data-aos-duration="1200">
                                            <div class="main-testimonial">
                                                <div class="img-back-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url?>/all-images/body-pix/avatar.png" alt="testimonial"/>
                                                    </div>

                                                    <div class="icon">
                                                        <i class="bi-quote"></i>
                                                    </div>
                                                </div>
     
                                                <p>Leaders Tutors has revolutionized my learning journey. The online classes empower me to grow personally and professionally.</p>
                                               
                                                <div class="bottom-div">
                                                    <div class="star-div">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                    </div>

                                                    <h5>Barry Job</h5>
                                                    <p>JSS 3 </p>
                                                </div>   
                                            </div>
                                        </div>
            
                                        <div class="cg-carousel__slide js-carousel__slide"  data-aos="fade-left" data-aos-duration="1200">
                                            <div class="main-testimonial">
                                                <div class="img-back-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url?>/all-images/body-pix/avatar.png" alt="testimonial"/>
                                                    </div>

                                                    <div class="icon">
                                                        <i class="bi-quote"></i>
                                                    </div>
                                                </div>
     
                                                <p>With Leaders Tutors, I found the perfect after-school lesson for my children. The resources are top-notch, and the results speak for themselves.</p>
                                               
                                                <div class="bottom-div">
                                                    <div class="star-div">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                    </div>

                                                    <h5>Paul Emmanuel</h5>
                                                    <p>Parent </p>
                                                </div>   
                                            </div>
                                        </div>

                                        
                                        <div class="cg-carousel__slide js-carousel__slide"  data-aos="fade-left" data-aos-duration="1200">
                                            <div class="main-testimonial">
                                                <div class="img-back-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url?>/all-images/body-pix/avatar.png" alt="testimonial"/>
                                                    </div>

                                                    <div class="icon">
                                                        <i class="bi-quote"></i>
                                                    </div>
                                                </div>
     
                                                <p>Leaders Tutors surpassed all my expectations. I've gained valuable knowledge that are making a real difference in my career.</p>
                                               
                                                <div class="bottom-div">
                                                    <div class="star-div">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                    </div>

                                                    <h5>Afolabi Taiwo</h5>
                                                    <p>SS 2 </p>
                                                </div>   
                                            </div>
                                        </div>

                                        <div class="cg-carousel__slide js-carousel__slide"  data-aos="fade-left" data-aos-duration="1200">
                                            <div class="main-testimonial">
                                                <div class="img-back-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url?>/all-images/body-pix/avatar.png" alt="testimonial"/>
                                                    </div>

                                                    <div class="icon">
                                                        <i class="bi-quote"></i>
                                                    </div>
                                                </div>
     
                                                <p>The online classes are engaging, informative, and have helped me advance my studies in ways I never thought possible.</p>
                                               
                                                <div class="bottom-div">
                                                    <div class="star-div">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                    </div>

                                                    <h5>Semako Samuel</h5>
                                                    <p>JSS 2 </p>
                                                </div>   
                                            </div>
                                        </div>
                                                                              
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <script>
                window['carousel_options_3']= ({
                items:4,
                    margin: 30,
                    loop:true,
                    dots: true,
                    autoplayHoverPause: true,
                    smartSpeed:650,         
                    autoplay:true,      
                    breakpoints: {
                700: {
                slidesPerView: 1,
                },
                1100: {
                slidesPerView: 1,
                },
                1300: {
                slidesPerView: 2,
                }
            
                }
                });
                _call_carousel(3);
            </script>
        </section>


        <section class="body-div bg">
            <div class="body-div-in bg-dotted">
                <div class="main-pages-back-div">
                    <div class="get-started-content" data-aos="zoom-in" data-aos-duration="1200">
                        <h2>Enrich your educational journey with the best virtual educational platforms <span>#Leader Tutors</span></h2>
                        <a href="<?php echo $website_url?>/account/login" title="Start as a student">
                        <button class="btn" title="Get started now">Get started now<i class="bi-arrow-right"></i></button></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="body-div">
            <div class="body-div-in bg-dotted">
                <div class="main-pages-back-div">
                    <div class="testimonial">
                        <div class="content" data-aos="fade-up" data-aos-duration="1400">
                            <div class="icon-div">
                                <img src="<?php echo $website_url?>/all-images/body-pix/zigzag-line.svg" alt="icon"/>
                            </div>

                            <h2>Learn with Our Partners</h2>
                            <p>Partnerships with Leaders Tutors open doors to impactful collaborations in education. Together, we can create tailored solutions, leverage expertise, and empower learners across Nigeria.</p>
                        </div>

                        <div class="partners-back-div">
                            <div class="inner-div">
                                <div class="partners-div" data-aos="fade-in" data-aos-duration="1200">
                                    <img src="<?php echo $website_url?>/all-images/images/afootech-logo.png" alt="afootech"/>
                                </div>

                                <div class="partners-div" data-aos="fade-in" data-aos-duration="1200">
                                    <img src="<?php echo $website_url?>/all-images/images/MTN-logo.png" alt="mtn"/>
                                </div>

                                <div class="partners-div" data-aos="fade-in" data-aos-duration="1200">
                                    <img src="<?php echo $website_url?>/all-images/images/orisun-logo.png" alt="orisun"/>
                                </div>

                                <div class="partners-div" data-aos="fade-in" data-aos-duration="1200">
                                    <img src="<?php echo $website_url?>/all-images/images/tvc-logo.png" alt="tvc"/>
                                </div>
                            </div>

                           <div class="inner-div">
                                <div class="partner-div" data-aos="fade-in" data-aos-duration="1200">
                                    <img src="<?php echo $website_url?>/all-images/images/afootech-logo.png" alt="afootech"/>
                                </div>
                                
                                <div class="partner-div" data-aos="fade-in" data-aos-duration="1200">
                                    <img src="<?php echo $website_url?>/all-images/images/MTN-logo.png" alt="mtn"/>
                                </div>

                                <div class="partner-div" data-aos="fade-in" data-aos-duration="1200">
                                    <img src="<?php echo $website_url?>/all-images/images/orisun-logo.png" alt="orisun"/>
                                </div>

                                <div class="partner-div" data-aos="fade-in" data-aos-duration="1200">
                                    <img src="<?php echo $website_url?>/all-images/images/tvc-logo.png" alt="tvc"/>
                                </div>
                            </div>

                           
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <?php include 'footer.php'?>
        </section>
    </section>

    <section>
        <?php include 'bottom-scripts.php'?>
    </section>
</body>
</html>


