@extends('layouts.landing_page.index')
@section('title')
    <title>Helpdesk HAI Kejati Jateng</title>
@endsection


@section('content')
    <!-- Spinner Start -->
    {{-- <div id="spinner"
        class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div> --}}
    <!-- Spinner End -->

    <!-- Topbar Start -->
    {{-- <div class="container-fluid bg-light py-2 d-none d-md-flex">
        <div class="container">
            <div class="d-flex justify-content-between topbar">
                <div class="top-info">
                    <small class="me-3 text-white-50"><a href="#"><i
                                class="fas fa-map-marker-alt me-2 text-secondary"></i></a>Jl. Pahlawan 50241 Semarang
                        Selatan Jawa Tengah ·</small>
                    <small class="me-3 text-white-50"><a href="#"><i
                                class="fas fa-envelope me-2 text-secondary"></i></a>Email@Example.com</small>
                </div>
                <div id="note" class="text-secondary d-none d-xl-flex"><small>Note : We help you to Grow your
                        Business</small></div>
                <div class="top-link">
                    <a href="https://www.facebook.com/KejatiJateng"
                        class="bg-light nav-fill btn btn-sm-square rounded-circle"><i
                            class="fab fa-facebook-f text-primary"></i></a>
                    <a href="" class="bg-light nav-fill btn btn-sm-square rounded-circle"><i
                            class="fab fa-twitter text-primary"></i></a>
                    <a href="https://www.instagram.com/kejatijateng/"
                        class="bg-light nav-fill btn btn-sm-square rounded-circle"><i
                            class="fab fa-instagram text-primary"></i></a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Topbar End -->

    <!-- Navbar Start -->
    {{-- <div class="container-fluid bg-primary">
        <div class="container">
            <nav class="navbar navbar-dark navbar-expand-lg py-0">
                <a href="index.html" class="navbar-brand">
                    <h1 class="text-white fw-bold d-block">High<span class="text-secondary">Tech</span> </h1>
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">
                    <div class="navbar-nav ms-auto mx-xl-auto p-0">
                        <a href="index.html" class="nav-item nav-link active text-secondary">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Services</a>
                        <a href="project.html" class="nav-item nav-link">Projects</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded">
                                <a href="blog.html" class="dropdown-item">Our Blog</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
                <div class="d-none d-xl-flex flex-shirink-0">
                    <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4">
                        <a href="" class="position-relative animated tada infinite">
                            <i class="fa fa-phone-alt text-white fa-2x"></i>
                            <div class="position-absolute" style="top: -7px; left: 20px;">
                                <span><i class="fa fa-comment-dots text-secondary"></i></span>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex flex-column pe-4 border-end">
                        <span class="text-white-50">Ada pertanyaan?</span>
                        <span class="text-secondary">Telepon: (024) 8413985</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center ms-4 ">
                        <a href="#"><i class="bi bi-search text-white fa-2x"></i> </a>
                    </div>
                </div>
            </nav>
        </div>
    </div> --}}
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid px-0">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="First slide"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="{{ asset('template/landing_page/img/' . $dataApp['img_banner1']) }}" class="img-fluid"
                        alt="First slide">
                    <div class="carousel-caption">
                        <div class="container carousel-content">
                            <h6 class="text-secondary h4 animated fadeInUp">Help Desk</h6>
                            <h1 class="text-white display-1 mb-4 animated fadeInRight">{{ $dataApp['header1'] }}</h1>
                            <p class="mb-4 text-white fs-5 animated fadeInDown">
                                {{ $dataApp['header_desc1'] }}
                            </p>
                            <a href="{{ route('login') }}" class="me-2"><button type="button"
                                    class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">Masuk</button></a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="{{ asset('template/landing_page/img/' . $dataApp['img_banner2']) }}" class="img-fluid"
                        alt="Second slide">
                    <div class="carousel-caption">
                        <div class="container carousel-content">
                            <h6 class="text-secondary h4 animated fadeInUp">Help Desk</h6>
                            <h1 class="text-white display-1 mb-4 animated fadeInLeft">{{ $dataApp['header2'] }}</h1>
                            <p class="mb-4 text-white fs-5 animated fadeInDown">
                                {{ $dataApp['header_desc2'] }}
                            </p>
                            <a href="{{ route('login') }}" class="me-2"><button type="button"
                                    class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInLeft">Masuk</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Fact Start -->
    {{-- <div class="container-fluid bg-secondary py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".1s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-primary counter-value">99</h1>
                        <h5 class="text-white mt-1">Success in getting happy customer</h5>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".3s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-primary counter-value">25</h1>
                        <h5 class="text-white mt-1">Thousands of successful business</h5>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".5s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-primary counter-value">120</h1>
                        <h5 class="text-white mt-1">Total clients who love HighTech</h5>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeIn" data-wow-delay=".7s">
                    <div class="d-flex counter">
                        <h1 class="me-3 text-primary counter-value">5</h1>
                        <h5 class="text-white mt-1">Stars reviews given by satisfied clients</h5>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Fact End -->


    <!-- About Start -->


    <div class="container-fluid py-5 my-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-5 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                    <div class="h-100 position-relative">
                        <img src="{{ asset('template/landing_page/img/' . $dataApp['img_about_us1']) }}"
                            class="img-fluid w-75 rounded" alt="" style="margin-bottom: 25%;">
                        <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                            <img src="{{ asset('template/landing_page/img/' . $dataApp['img_about_us2']) }}"
                                class="img-fluid w-100 rounded" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s">
                    <h5 class="text-primary">Tentang Kami</h5>
                    <h1 class="mb-4">Help Desk Kejaksaan Tinggi Jawa Tengah</h1>
                    <p>{{ $dataApp['about_us'] }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Services Start -->
    {{-- <div class="container-fluid services py-5 mb-5">
    <div class="container">
        <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
            <h5 class="text-primary">Our Services</h5>
            <h1>Services Built Specifically For Your Business</h1>
        </div>
        <div class="row g-5 services-inner">
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                <div class="services-item bg-light">
                    <div class="p-4 text-center services-content">
                        <div class="services-content-icon">
                            <i class="fa fa-code fa-7x mb-4 text-primary"></i>
                            <h4 class="mb-3">Web Design</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum. Aliquam dolor eget urna ultricies tincidunt.</p>
                            <a href="" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                <div class="services-item bg-light">
                    <div class="p-4 text-center services-content">
                        <div class="services-content-icon">
                            <i class="fa fa-file-code fa-7x mb-4 text-primary"></i>
                            <h4 class="mb-3">Web Development</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum. Aliquam dolor eget urna ultricies tincidunt.</p>
                            <a href="" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".7s">
                <div class="services-item bg-light">
                    <div class="p-4 text-center services-content">
                        <div class="services-content-icon">
                            <i class="fa fa-external-link-alt fa-7x mb-4 text-primary"></i>
                            <h4 class="mb-3">UI/UX Design</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum. Aliquam dolor eget urna ultricies tincidunt.</p>
                            <a href="" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                <div class="services-item bg-light">
                    <div class="p-4 text-center services-content">
                        <div class="services-content-icon">
                            <i class="fas fa-user-secret fa-7x mb-4 text-primary"></i>
                            <h4 class="mb-3">Web Cecurity</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum. Aliquam dolor eget urna ultricies tincidunt.</p>
                            <a href="" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Read More</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                <div class="services-item bg-light">
                    <div class="p-4 text-center services-content">
                        <div class="services-content-icon">
                            <i class="fa fa-envelope-open fa-7x mb-4 text-primary"></i>
                            <h4 class="mb-3">Digital Marketing</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum. Aliquam dolor eget urna ultricies tincidunt.</p>
                            <a href="" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".7s">
                <div class="services-item bg-light">
                    <div class="p-4 text-center services-content">
                        <div class="services-content-icon">
                            <i class="fas fa-laptop fa-7x mb-4 text-primary"></i>
                            <h4 class="mb-3">Programming</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum. Aliquam dolor eget urna ultricies tincidunt.</p>
                            <a href="" class="btn btn-secondary text-white px-5 py-3 rounded-pill">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <!-- Services End -->


    <!-- Project Start -->
    {{-- <div class="container-fluid project py-5 mb-5">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h5 class="text-primary">Our Project</h5>
                <h1>Our Recently Completed Projects</h1>
            </div>
            <div class="row g-5">
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                    <div class="project-item">
                        <div class="project-img">
                            <img src="{{ asset('template/landing_page/img/project-1.jpg') }}"
                                class="img-fluid w-100 rounded" alt="">
                            <div class="project-content">
                                <a href="#" class="text-center">
                                    <h4 class="text-secondary">Web design</h4>
                                    <p class="m-0 text-white">Web Analysis</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                    <div class="project-item">
                        <div class="project-img">
                            <img src="{{ asset('template/landing_page/img/project-2.jpg') }}"
                                class="img-fluid w-100 rounded" alt="">
                            <div class="project-content">
                                <a href="#" class="text-center">
                                    <h4 class="text-secondary">Cyber Security</h4>
                                    <p class="m-0 text-white">Cyber Security Core</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".7s">
                    <div class="project-item">
                        <div class="project-img">
                            <img src="{{ asset('template/landing_page/img/project-3.jpg') }}"
                                class="img-fluid w-100 rounded" alt="">
                            <div class="project-content">
                                <a href="#" class="text-center">
                                    <h4 class="text-secondary">Mobile Info</h4>
                                    <p class="m-0 text-white">Upcomming Phone</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                    <div class="project-item">
                        <div class="project-img">
                            <img src="{{ asset('template/landing_page/img/project-4.jpg') }}"
                                class="img-fluid w-100 rounded" alt="">
                            <div class="project-content">
                                <a href="#" class="text-center">
                                    <h4 class="text-secondary">Web Development</h4>
                                    <p class="m-0 text-white">Web Analysis</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                    <div class="project-item">
                        <div class="project-img">
                            <img src="{{ asset('template/landing_page/img/project-5.jpg') }}"
                                class="img-fluid w-100 rounded" alt="">
                            <div class="project-content">
                                <a href="#" class="text-center">
                                    <h4 class="text-secondary">Digital Marketing</h4>
                                    <p class="m-0 text-white">Marketing Analysis</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".7s">
                    <div class="project-item">
                        <div class="project-img">
                            <img src="{{ asset('template/landing_page/img/project-6.jpg') }}"
                                class="img-fluid w-100 rounded" alt="">
                            <div class="project-content">
                                <a href="#" class="text-center">
                                    <h4 class="text-secondary">keyword Research</h4>
                                    <p class="m-0 text-white">keyword Analysis</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Project End -->


    <!-- Blog Start -->
    {{-- <div class="container-fluid blog py-5 mb-5">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h5 class="text-primary">Our Blog</h5>
                <h1>Latest Blog & News</h1>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-6 col-xl-4 wow fadeIn" data-wow-delay=".3s">
                    <div class="blog-item position-relative bg-light rounded">
                        <img src="{{ asset('template/landing_page/img/blog-1.jpg') }}" class="img-fluid w-100 rounded-top"
                            alt="">
                        <span class="position-absolute px-4 py-3 bg-primary text-white rounded"
                            style="top: -28px; right: 20px;">Web Design</span>
                        <div class="blog-btn d-flex justify-content-between position-relative px-3"
                            style="margin-top: -75px;">
                            <div class="blog-icon btn btn-secondary px-3 rounded-pill my-auto">
                                <a href="" class="btn text-white">Read More</a>
                            </div>
                            <div class="blog-btn-icon btn btn-secondary px-4 py-3 rounded-pill ">
                                <div class="blog-icon-1">
                                    <p class="text-white px-2">Share<i class="fa fa-arrow-right ms-3"></i></p>
                                </div>
                                <div class="blog-icon-2">
                                    <a href="https://www.facebook.com/KejatiJateng" class="btn me-1"><i
                                            class="fab fa-facebook-f text-white"></i></a>
                                    <a href="" class="btn me-1"><i class="fab fa-twitter text-white"></i></a>
                                    <a href="https://www.instagram.com/kejatijateng/" class="btn me-1"><i
                                            class="fab fa-instagram text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-center position-relative px-3" style="margin-top: -25px;">
                            <img src="{{ asset('template/landing_page/img/admin.jpg') }}"
                                class="img-fluid rounded-circle border border-4 border-white mb-3" alt="">
                            <h5 class="">By Daniel Martin</h5>
                            <span class="text-secondary">24 March 2023</span>
                            <p class="py-2">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum.
                                Aliquam dolor eget urna ultricies tincidunt libero sit amet</p>
                        </div>
                        <div class="blog-coment d-flex justify-content-between px-4 py-2 border bg-primary rounded-bottom">
                            <a href="" class="text-white"><small><i
                                        class="fas fa-share me-2 text-secondary"></i>5324 Share</small></a>
                            <a href="" class="text-white"><small><i
                                        class="fa fa-comments me-2 text-secondary"></i>5 Comments</small></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeIn" data-wow-delay=".5s">
                    <div class="blog-item position-relative bg-light rounded">
                        <img src="{{ asset('template/landing_page/img/blog-2.jpg') }}" class="img-fluid w-100 rounded-top"
                            alt="">
                        <span class="position-absolute px-4 py-3 bg-primary text-white rounded"
                            style="top: -28px; right: 20px;">Development</span>
                        <div class="blog-btn d-flex justify-content-between position-relative px-3"
                            style="margin-top: -75px;">
                            <div class="blog-icon btn btn-secondary px-3 rounded-pill my-auto">
                                <a href="" class="btn text-white ">Read More</a>
                            </div>
                            <div class="blog-btn-icon btn btn-secondary px-4 py-3 rounded-pill ">
                                <div class="blog-icon-1">
                                    <p class="text-white px-2">Share<i class="fa fa-arrow-right ms-3"></i></p>
                                </div>
                                <div class="blog-icon-2">
                                    <a href="https://www.facebook.com/KejatiJateng" class="btn me-1"><i
                                            class="fab fa-facebook-f text-white"></i></a>
                                    <a href="" class="btn me-1"><i class="fab fa-twitter text-white"></i></a>
                                    <a href="https://www.instagram.com/kejatijateng/" class="btn me-1"><i
                                            class="fab fa-instagram text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-center position-relative px-3" style="margin-top: -25px;">
                            <img src="{{ asset('template/landing_page/img/admin.jpg') }}"
                                class="img-fluid rounded-circle border border-4 border-white mb-3" alt="">
                            <h5 class="">By Daniel Martin</h5>
                            <span class="text-secondary">23 April 2023</span>
                            <p class="py-2">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum.
                                Aliquam dolor eget urna ultricies tincidunt libero sit amet</p>
                        </div>
                        <div class="blog-coment d-flex justify-content-between px-4 py-2 border bg-primary rounded-bottom">
                            <a href="" class="text-white"><small><i
                                        class="fas fa-share me-2 text-secondary"></i>5324 Share</small></a>
                            <a href="" class="text-white"><small><i
                                        class="fa fa-comments me-2 text-secondary"></i>5 Comments</small></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 wow fadeIn" data-wow-delay=".7s">
                    <div class="blog-item position-relative bg-light rounded">
                        <img src="{{ asset('template/landing_page/img/blog-3.jpg') }}" class="img-fluid w-100 rounded-top"
                            alt="">
                        <span class="position-absolute px-4 py-3 bg-primary text-white rounded"
                            style="top: -28px; right: 20px;">Mobile App</span>
                        <div class="blog-btn d-flex justify-content-between position-relative px-3"
                            style="margin-top: -75px;">
                            <div class="blog-icon btn btn-secondary px-3 rounded-pill my-auto">
                                <a href="" class="btn text-white ">Read More</a>
                            </div>
                            <div class="blog-btn-icon btn btn-secondary px-4 py-3 rounded-pill ">
                                <div class="blog-icon-1">
                                    <p class="text-white px-2">Share<i class="fa fa-arrow-right ms-3"></i></p>
                                </div>
                                <div class="blog-icon-2">
                                    <a href="https://www.facebook.com/KejatiJateng" class="btn me-1"><i
                                            class="fab fa-facebook-f text-white"></i></a>
                                    <a href="" class="btn me-1"><i class="fab fa-twitter text-white"></i></a>
                                    <a href="https://www.instagram.com/kejatijateng/" class="btn me-1"><i
                                            class="fab fa-instagram text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-center position-relative px-3" style="margin-top: -25px;">
                            <img src="{{ asset('template/landing_page/img/admin.jpg') }}"
                                class="img-fluid rounded-circle border border-4 border-white mb-3" alt="">
                            <h5 class="">By Daniel Martin</h5>
                            <span class="text-secondary">30 jan 2023</span>
                            <p class="py-2">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum.
                                Aliquam dolor eget urna ultricies tincidunt libero sit amet</p>
                        </div>
                        <div
                            class="blog-coments d-flex justify-content-between px-4 py-2 border bg-primary rounded-bottom">
                            <a href="" class="text-white"><small><i
                                        class="fas fa-share me-2 text-secondary"></i>5324 Share</small></a>
                            <a href="" class="text-white"><small><i
                                        class="fa fa-comments me-2 text-secondary"></i>5 Comments</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Blog End -->


    <!-- Team Start -->
    {{-- <div class="container-fluid py-5 mb-5 team">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h5 class="text-primary">Our Team</h5>
                <h1>Meet our expert Team</h1>
            </div>
            <div class="owl-carousel team-carousel wow fadeIn" data-wow-delay=".5s">
                <div class="rounded team-item">
                    <div class="team-content">
                        <div class="team-img-icon">
                            <div class="team-img rounded-circle">
                                <img src="{{ asset('template/landing_page/img/team-1.jpg') }}"
                                    class="img-fluid w-100 rounded-circle" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Full Name</h4>
                                <p class="m-0">Designation</p>
                            </div>
                            <div class="team-icon d-flex justify-content-center pb-4">
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href="https://www.facebook.com/KejatiJateng"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href="https://www.instagram.com/kejatijateng/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content">
                        <div class="team-img-icon">
                            <div class="team-img rounded-circle">
                                <img src="{{ asset('template/landing_page/img/team-2.jpg') }}"
                                    class="img-fluid w-100 rounded-circle" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Full Name</h4>
                                <p class="m-0">Designation</p>
                            </div>
                            <div class="team-icon d-flex justify-content-center pb-4">
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href="https://www.facebook.com/KejatiJateng"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href="https://www.instagram.com/kejatijateng/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content">
                        <div class="team-img-icon">
                            <div class="team-img rounded-circle">
                                <img src="{{ asset('template/landing_page/img/team-3.jpg') }}"
                                    class="img-fluid w-100 rounded-circle" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Full Name</h4>
                                <p class="m-0">Designation</p>
                            </div>
                            <div class="team-icon d-flex justify-content-center pb-4">
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href="https://www.facebook.com/KejatiJateng"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href="https://www.instagram.com/kejatijateng/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content">
                        <div class="team-img-icon">
                            <div class="team-img rounded-circle">
                                <img src="{{ asset('template/landing_page/img/team-4.jpg') }}"
                                    class="img-fluid w-100 rounded-circle" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Full Name</h4>
                                <p class="m-0">Designation</p>
                            </div>
                            <div class="team-icon d-flex justify-content-center pb-4">
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href="https://www.facebook.com/KejatiJateng"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href=""><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href="https://www.instagram.com/kejatijateng/"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Team End -->

    <!-- Testimonial Start -->
    {{-- <div class="container-fluid testimonial py-5 mb-5">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h5 class="text-primary">Our Testimonial</h5>
                <h1>Our Client Saying!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay=".5s">
                <div class="testimonial-item border p-4">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <img src="{{ asset('template/landing_page/img/testimonial-1.jpg') }}" alt="">
                        </div>
                        <div class="ms-4">
                            <h4 class="text-secondary">Client Name</h4>
                            <p class="m-0 pb-3">Profession</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="border-top mt-4 pt-3">
                        <p class="mb-0">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum aliquam
                            dolor eget urna. Nam volutpat libero sit amet leo cursus, ac viverra eros morbi quis quam mi.
                        </p>
                    </div>
                </div>
                <div class="testimonial-item border p-4">
                    <div class=" d-flex align-items-center">
                        <div class="">
                            <img src="{{ asset('template/landing_page/img/testimonial-2.jpg') }}" alt="">
                        </div>
                        <div class="ms-4">
                            <h4 class="text-secondary">Client Name</h4>
                            <p class="m-0 pb-3">Profession</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="border-top mt-4 pt-3">
                        <p class="mb-0">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum aliquam
                            dolor eget urna. Nam volutpat libero sit amet leo cursus, ac viverra eros morbi quis quam mi.
                        </p>
                    </div>
                </div>
                <div class="testimonial-item border p-4">
                    <div class=" d-flex align-items-center">
                        <div class="">
                            <img src="{{ asset('template/landing_page/img/testimonial-3.jpg') }}" alt="">
                        </div>
                        <div class="ms-4">
                            <h4 class="text-secondary">Client Name</h4>
                            <p class="m-0 pb-3">Profession</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="border-top mt-4 pt-3">
                        <p class="mb-0">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum aliquam
                            dolor eget urna. Nam volutpat libero sit amet leo cursus, ac viverra eros morbi quis quam mi.
                        </p>
                    </div>
                </div>
                <div class="testimonial-item border p-4">
                    <div class=" d-flex align-items-center">
                        <div class="">
                            <img src="{{ asset('template/landing_page/img/testimonial-4.jpg') }}" alt="">
                        </div>
                        <div class="ms-4">
                            <h4 class="text-secondary">Client Name</h4>
                            <p class="m-0 pb-3">Profession</p>
                            <div class="d-flex pe-5">
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                                <i class="fas fa-star me-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="border-top mt-4 pt-3">
                        <p class="mb-0">Lorem ipsum dolor sit amet elit. Sed efficitur quis purus ut interdum aliquam
                            dolor eget urna. Nam volutpat libero sit amet leo cursus, ac viverra eros morbi quis quam mi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Testimonial End -->


    <!-- Contact Start -->
    {{-- <div class="container-fluid py-5 mb-5">
        <div class="container">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h5 class="text-primary">Get In Touch</h5>
                <h1 class="mb-3">Contact for any query</h1>
                <p class="mb-2">The contact form is currently inactive. Get a functional and working contact form with
                    Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a
                        href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
            </div>
            <div class="contact-detail position-relative p-5">
                <div class="row g-5 mb-5 justify-content-center">
                    <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".3s">
                        <div class="d-flex bg-light p-3 rounded">
                            <div class="flex-shrink-0 btn-square bg-secondary rounded-circle"
                                style="width: 64px; height: 64px;">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h4 class="text-primary">Address</h4>
                                <a href="https://goo.gl/maps/Zd4BCynmTb98ivUJ6" target="_blank" class="h5">23 rank
                                    Str, NY</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".5s">
                        <div class="d-flex bg-light p-3 rounded">
                            <div class="flex-shrink-0 btn-square bg-secondary rounded-circle"
                                style="width: 64px; height: 64px;">
                                <i class="fa fa-phone text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h4 class="text-primary">Call Us</h4>
                                <a class="h5" href="tel:+0123456789" target="_blank">+012 3456 7890</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".7s">
                        <div class="d-flex bg-light p-3 rounded">
                            <div class="flex-shrink-0 btn-square bg-secondary rounded-circle"
                                style="width: 64px; height: 64px;">
                                <i class="fa fa-envelope text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h4 class="text-primary">Email Us</h4>
                                <a class="h5" href="mailto:info@example.com" target="_blank">info@example.com</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                        <div class="p-5 h-100 rounded contact-map">
                            <iframe class="rounded w-100 h-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3025.4710403339755!2d-73.82241512404069!3d40.685622471397615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c26749046ee14f%3A0xea672968476d962c!2s123rd%20St%2C%20Queens%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1686493221834!5m2!1sen!2sbd"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                        <div class="p-5 rounded contact-form">
                            <div class="mb-4">
                                <input type="text" class="form-control border-0 py-3" placeholder="Your Name">
                            </div>
                            <div class="mb-4">
                                <input type="email" class="form-control border-0 py-3" placeholder="Your Email">
                            </div>
                            <div class="mb-4">
                                <input type="text" class="form-control border-0 py-3" placeholder="Project">
                            </div>
                            <div class="mb-4">
                                <textarea class="w-100 form-control border-0 py-3" rows="6" cols="10" placeholder="Message"></textarea>
                            </div>
                            <div class="text-start">
                                <button class="btn bg-primary text-white py-3 px-5" type="button">Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Contact End -->


    <!-- Footer Start -->
    <div class="container-fluid footer bg-dark wow fadeIn" data-wow-delay=".3s">
        <div class="container pt-5 pb-4">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <a href="index.html">
                        <h1 class="text-white fw-bold d-block">Help Desk<span class="text-secondary"> KEJATI JATENG</span>
                        </h1>
                    </a>
                    <p class="mt-4 text-light">
                        {{ $dataApp['footer_desc'] }}
                    </p>
                    {{-- <div class="d-flex hightech-link">
                        <a href="{{ $dataApp['url_facebook'] }}"
                            class="btn-light nav-fill btn btn-square rounded-circle me-2"><i
                                class="fab fa-facebook-f text-primary"></i></a>
                        <a href="{{ $dataApp['url_x'] }}" class="btn-light nav-fill btn btn-square rounded-circle me-2"><i
                                class="fab fa-twitter text-primary"></i></a>
                        <a href="{{ $dataApp['url_instagram'] }}"
                            class="btn-light nav-fill btn btn-square rounded-circle me-2"><i
                                class="fab fa-instagram text-primary"></i></a>
                    </div> --}}
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#" class="h3 text-secondary">Link</a>
                    <div class="mt-4 d-flex flex-column short-link">
                        <a href="{{ route('login') }}" class="mb-2 text-white"><i
                                class="fas fa-angle-right text-secondary me-2"></i>Login Staff</a>
                        <a href="{{ route('daskrimti') }}" class="mb-2 text-white"><i
                                class="fas fa-angle-right text-secondary me-2"></i>Login Daskrimti</a>
                        <a href="{{ route('forgetPassword') }}" class="mb-2 text-white"><i
                                class="fas fa-angle-right text-secondary me-2"></i>Lupa Kata Sandi</a>

                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="#" class="h3 text-secondary">Sosial Media</a>
                    <div class="mt-4 d-flex flex-column help-link">
                        <a href="{{ $dataApp['url_instagram'] }}" class="mb-2 text-white"><i
                                class="fas fa-angle-right text-secondary me-2"></i>Instagram</a>
                        <a href="{{ $dataApp['url_facebook'] }}" class="mb-2 text-white"><i
                                class="fas fa-angle-right text-secondary me-2"></i>Facebook</a>
                        <a href="{{ $dataApp['url_x'] }}" class="mb-2 text-white"><i
                                class="fas fa-angle-right text-secondary me-2"></i>X</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <a href="#" class="h3 text-secondary">Hubungi Kami</a>
                    <div class="text-white mt-4 d-flex flex-column contact-link">
                        <a href="#" class="pb-3 text-light border-bottom border-primary"><i
                                class="fas fa-map-marker-alt text-secondary me-2"></i>{{ $dataApp['address'] }}</a>
                        <a href="#" class="py-3 text-light border-bottom border-primary"><i
                                class="fas fa-phone-alt text-secondary me-2"></i> {{ $dataApp['telp'] }}</a>
                        <a href="#" class="py-3 text-light border-bottom border-primary"><i
                                class="fas fa-envelope text-secondary me-2"></i>{{ $dataApp['email'] }}</a>
                    </div>
                </div>


            </div>
            <hr class="text-light mt-5 mb-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <span class="text-light"><a href="https://kejati-jawatengah.kejaksaan.go.id/"
                            class="text-secondary"><i class="fas fa-copyright text-secondary me-2"></i>HAI Kejati
                            Jateng</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    <span class="text-light">Designed By<a href="https://htmlcodex.com" class="text-secondary">HTML
                            Codex</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a></span>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer End -->
@endsection
