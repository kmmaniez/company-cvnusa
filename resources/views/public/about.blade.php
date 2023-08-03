@extends('layouts.public.master')

@section('content')
    <div id="banner-area" class="banner-area" style="background-image:url({{ url('assets/images/banner/banner1.jpg') }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">About</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">company</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->

    <section id="main-container" class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Who We Are</h3>
                    <p>when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a
                        horrible vermin.</p>
                    <p>He lay on his armour-like back, and if he lifted. ultrices ultrices sapien, nec tincidunt
                        nunc posuere ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. If you are going
                        to use a passage of Lorem Ipsum, you need to be sure there isn’t anything embarrassing.</p>
                </div>
                <div class="col-lg-12 mt-5 text-justify">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3>Our Vision</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus accusamus adipisci
                                sapiente earum, voluptate qui consequuntur quae voluptates cupiditate molestias delectus
                                harum magni velit nulla itaque ab ullam dolore? Suscipit ipsa impedit illo tempore cum
                                provident ducimus fugit at laboriosam?</p>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum aliquam nihil, aliquid
                                asperiores cupiditate doloribus? Eum iure nemo ab quos!</p>
                        </div>
                        <div class="col-lg-6">
                            <h3>Our Mission</h3>
                            <div class="content">
                                <ul>
                                    <li style="font-size: 1rem;">Lorem ipsum dolor sit amet.</li>
                                    <li style="font-size: 1rem;">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Delectus officiis ad eligendi, deserunt quos omnis.</li>
                                    <li style="font-size: 1rem">Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        Recusandae, quaerat.</li>
                                    <li style="font-size: 1rem">Lorem ipsum dolor sit amet consectetur adipisicing.</li>
                                    <li style="font-size: 1rem">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                        Nesciunt.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- Content row end -->

        </div><!-- Container end -->
    </section><!-- Main container end -->

    <section id="ts-team" class="ts-team">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h2 class="section-title">Team Service</h2>
                    <h3 class="section-sub-title">Professional Team</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row">
                <div class="col-lg-12">
                    <div id="team-slide" class="team-slide">
                        <div class="item">
                            <div class="ts-team-wrapper">
                                <div class="team-img-wrapper">
                                    <img loading="lazy" class="w-100" src="{{ url('assets/images/team/team1.jpg') }}"
                                        alt="team-img">
                                </div>
                                <div class="ts-team-content">
                                    <h3 class="ts-name">Nats Stenman</h3>
                                    <p class="ts-designation">Chief Operating Officer</p>
                                    <p class="ts-description">Nats Stenman began his career in construction with
                                        boots on the ground</p>
                                    <div class="team-social-icons">
                                        <a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-google-plus"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
                                    </div>
                                    <!--/ social-icons-->
                                </div>
                            </div>
                            <!--/ Team wrapper end -->
                        </div><!-- Team 1 end -->

                        <div class="item">
                            <div class="ts-team-wrapper">
                                <div class="team-img-wrapper">
                                    <img loading="lazy" class="w-100" src="{{ url('assets/images/team/team2.jpg') }}"
                                        alt="team-img">
                                </div>
                                <div class="ts-team-content">
                                    <h3 class="ts-name">Angela Lyouer</h3>
                                    <p class="ts-designation">Innovation Officer</p>
                                    <p class="ts-description">Nats Stenman began his career in construction with
                                        boots on the ground</p>
                                    <div class="team-social-icons">
                                        <a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
                                    </div>
                                    <!--/ social-icons-->
                                </div>
                            </div>
                            <!--/ Team wrapper end -->
                        </div><!-- Team 2 end -->

                        <div class="item">
                            <div class="ts-team-wrapper">
                                <div class="team-img-wrapper">
                                    <img loading="lazy" class="w-100" src="{{ url('assets/images/team/team3.jpg') }}"
                                        alt="team-img">
                                </div>
                                <div class="ts-team-content">
                                    <h3 class="ts-name">Mark Conter</h3>
                                    <p class="ts-designation">Safety Officer</p>
                                    <p class="ts-description">Nats Stenman began his career in construction with
                                        boots on the ground</p>
                                    <div class="team-social-icons">
                                        <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-google-plus"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
                                    </div>
                                    <!--/ social-icons-->
                                </div>
                            </div>
                            <!--/ Team wrapper end -->
                        </div><!-- Team 3 end -->

                        <div class="item">
                            <div class="ts-team-wrapper">
                                <div class="team-img-wrapper">
                                    <img loading="lazy" class="w-100" src="{{ url('assets/images/team/team4.jpg') }}"
                                        alt="team-img">
                                </div>
                                <div class="ts-team-content">
                                    <h3 class="ts-name">Ayesha Stewart</h3>
                                    <p class="ts-designation">Finance Officer</p>
                                    <p class="ts-description">Nats Stenman began his career in construction with
                                        boots on the ground</p>
                                    <div class="team-social-icons">
                                        <a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-google-plus"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
                                    </div>
                                    <!--/ social-icons-->
                                </div>
                            </div>
                            <!--/ Team wrapper end -->
                        </div><!-- Team 4 end -->

                        <div class="item">
                            <div class="ts-team-wrapper">
                                <div class="team-img-wrapper">
                                    <img loading="lazy" class="w-100" src="{{ url('assets/images/team/team5.jpg') }}"
                                        alt="team-img">
                                </div>
                                <div class="ts-team-content">
                                    <h3 class="ts-name">Dave Clarkte</h3>
                                    <p class="ts-designation">Civil Engineer</p>
                                    <p class="ts-description">Nats Stenman began his career in construction with
                                        boots on the ground</p>
                                    <div class="team-social-icons">
                                        <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-google-plus"></i></a>
                                        <a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
                                    </div>
                                    <!--/ social-icons-->
                                </div>
                            </div>
                            <!--/ Team wrapper end -->
                        </div><!-- Team 5 end -->

                    </div><!-- Team slide end -->
                </div>
            </div>
            <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </section>
    <!--/ Team end -->
@endsection
