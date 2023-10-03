@props(['dataWeb'])
<footer id="footer" class="footer bg-overlay">
    <div class="footer-main">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-9 col-md-6 footer-widget footer-about">
                    <h3 class="widget-title">Tentang Kami</h3>
                    <img loading="lazy" width="200px" class="footer-logo" src="{{ (isset($dataWeb[0]->logo)) ? Storage::url($dataWeb[0]->logo) : url('assets/images/footer-logo.png') }}"
                        alt="Constra">
                    <p>{!! $dataWeb[0]->tentang_kami ?? '' !!}</p>
                    <div class="footer-social">
                        <ul>
                            <li><a href="{{ $dataWeb[0]->facebook ?? '' }}" aria-label="Facebook"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{ $dataWeb[0]->twitter ?? '' }}" aria-label="Twitter"><i
                                        class="fab fa-twitter"></i></a>
                            </li>
                            <li><a href="{{ $dataWeb[0]->instagram ?? '' }}" aria-label="Instagram"><i
                                        class="fab fa-instagram"></i></a></li>
                            <li><a href="{{ $dataWeb[0]->linkedin ?? '' }}" aria-label="LinkedIn"><i
                                        class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div><!-- Footer social end -->
                </div><!-- Col end -->

            </div><!-- Row end -->
        </div><!-- Container end -->
    </div><!-- Footer main end -->

    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright-info">
                        <span>Copyright &copy; {{ date('Y') }}, Theme By <a
                                href="https://themefisher.com">Themefisher</a> | Developed By <a href="https://sinigwkerjain.com">Sinigwkerjain</a>
                        </span>
                    </div>
                </div>

            </div><!-- Row end -->

            <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
                <button class="btn btn-primary" title="Back to Top">
                    <i class="fa fa-angle-double-up"></i>
                </button>
            </div>

        </div><!-- Container end -->
    </div><!-- Copyright end -->
</footer><!-- Footer end -->

<!-- initialize jQuery Library -->
<script src="{{ url('assets/plugins/jQuery/jquery.min.js') }}"></script>
<!-- Bootstrap jQuery -->
<script src="{{ url('assets/plugins/bootstrap/bootstrap.min.js') }}" defer></script>
<!-- Slick Carousel -->
<script src="{{ url('assets/plugins/slick/slick.min.js') }}"></script>
<script src="{{ url('assets/plugins/slick/slick-animation.min.js') }}"></script>
<!-- Color box -->
<script src="{{ url('assets/plugins/colorbox/jquery.colorbox.js') }}"></script>
<!-- shuffle -->
<script src="{{ url('assets/plugins/shuffle/shuffle.min.js') }}" defer></script>


<!-- Google Map API Key-->
@if (Request::routeIs('public.contact'))
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
<!-- Google Map Plugin-->
<script src="{{ url('assets/plugins/google-map/map.js') }}" defer></script>
@endif

<!-- Template custom -->
<script src="{{ url('assets/js/script.js') }}"></script>