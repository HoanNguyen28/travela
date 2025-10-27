@include('clients.blocks.header')
@include('clients.blocks.banner')

   <!-- Benefit Area start -->
        <section class="benefit-area mt-100 rel z-1">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-5 col-lg-6">
                        <div class="mobile-app-content rmb-55" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="section-title counter-text-wrap mb-40">
                                <h2>Cẩm nang Nhà Thám Hiểm Tối Ưu – Hướng dẫn trọn vẹn cho mọi hành trình.</h2>
                            </div>
                            <p>Chúng tôi hợp tác chặt chẽ với khách hàng để thấu hiểu những thách thức và mục tiêu, từ đó mang đến các giải pháp tùy chỉnh nhằm nâng cao hiệu quả, 
                                gia tăng lợi nhuận và thúc đẩy tăng trưởng bền vững.</p>
                            <div class="skillbar mt-80" data-percent="93">
                                <span class="skillbar-title">Sự hài lòng của khách hàng</span>
                                <div class="progress-bar-striped skillbar-bar progress-bar-animated" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                <span class="skill-bar-percent"></span>
                            </div>
                            <ul class="list-style-two mt-35 mb-30">
                                <li>Công ty Trải Nghiệm</li>
                                <li>Đội ngũ chuyên nghiệp</li>
                            </ul>
                            <a href="{{ route('destination') }}" class="theme-btn style-two">
                                <span data-hover="Hướng dẫn khám phá">Hướng dẫn khám phá</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="benefit-image-part style-two">
                            <div class="image-one" data-aos="fade-down" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                                <img src="{{ asset('clients/assets/images/benefit/benefit1.png')}}" alt="Benefit">
                            </div>
                            <div class="image-two" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                                <img src="{{ asset('clients/assets/images/benefit/benefit2.png')}}" alt="Benefit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Benefit Area end -->
         
         
        <!-- Team Area start -->
        <section class="about-team-area pt-100 rel z-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h2>Gặp gỡ những hướng dẫn viên giàu kinh nghiệm của chúng tôi</h2>
                            <p>Website <span class="count-text plus bgc-primary" data-speed="3000" data-stop="34500">0</span> Trải nghiệm phổ biến nhất mà bạn sẽ nhớ</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-item hover-content" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/team/Hoan-Nguyen.jpg')}}" alt="Guide">
                            <div class="content">
                                <h6>Nguyen Van Hoan Nguyen</h6>
                                <span class="designation">Co-founder</span>
                                <div class="social-style-one inner-content">
                                    <a href="contact.html"><i class="fab fa-twitter"></i></a>
                                     <a href="https://www.facebook.com/hoannguyen2809/"><i class="fab fa-facebook-f"></i></a>
                                    <a href="contact.html"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    {{-- <div class="col-lg-12 text-center mt-20">
                        <a href="about.html" class="theme-btn style-three">
                            <span data-hover="View All Guides">Xem tất cả </span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- Team Area end -->
        
        
 
        
 @include('clients.blocks.new_letter')
            
@include('clients.blocks.footer')