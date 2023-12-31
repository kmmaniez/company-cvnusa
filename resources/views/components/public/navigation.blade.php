@props(['dataWeb'])
<div class="bg-white">
    <div class="container">
        <div class="logo-area">
            <div class="row align-items-center">
                <div class="logo col-lg-3 text-center text-lg-left mb-3 mb-md-5 mb-lg-0">
                    <a class="d-block" href="index.html">
                        <img loading="lazy" src="{{ (isset($dataWeb[0]->logo)) ? Storage::url($dataWeb[0]->logo) : url('assets/images/logo.png') }}" alt="Constra">
                    </a>
                </div><!-- logo end -->

                <div class="col-lg-9 header-right">
                    <ul class="top-info-box">
                        <li>
                            <div class="info-box">
                                <div class="info-box-content">
                                    <p class="info-box-title">Hubungi</p>
                                    <p class="info-box-subtitle">{{ $dataWeb[0]->telepon ?? 'Telepon Perusahaan'}}</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="info-box">
                                <div class="info-box-content">
                                    <p class="info-box-title">Email</p>
                                    <p class="info-box-subtitle">{{ $dataWeb[0]->email ?? 'email@perusahaan.com'}}</p>
                                </div>
                            </div>
                        </li>
                        <li class="last">
                            <div class="info-box last">
                                <div class="info-box-content">
                                    <p class="info-box-title">Alamat</p>
                                    <p class="info-box-subtitle">{{ $dataWeb[0]->alamat ?? 'Alamat Perusahaan'}}</p>
                                </div>
                            </div>
                        </li>
                    </ul><!-- Ul end -->
                </div><!-- header right end -->
            </div><!-- logo area end -->

        </div><!-- Row end -->
    </div><!-- Container end -->
</div>
<div class="site-navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-dark p-0">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
                        aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div id="navbar-collapse" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item {{ (request()->routeIs('public.index') ? 'active' : '') }}"><a class="nav-link" href="{{ route('public.index') }}">Home</a></li>

                            <li class="nav-item {{ (request()->routeIs('public.about') ? 'active' : '') }}"><a class="nav-link" href="{{ route('public.about') }}">About Us</a></li>

                            <li class="nav-item {{ (request()->routeIs('public.projects') ? 'active' : '') }}"><a class="nav-link" href="{{ route('public.projects') }}">Projects</a></li>

                            <li class="nav-item {{ (request()->routeIs('public.pricing') ? 'active' : '') }}"><a class="nav-link" href="{{ route('public.pricing') }}">Pricing</a></li>
                            
                            <li class="nav-item {{ (request()->routeIs('public.services') ? 'active' : '') }}"><a class="nav-link" href="{{ route('public.services') }}">Services</a></li>
                            
                            <li class="nav-item {{ (request()->routeIs('public.clientpublic') ? 'active' : '') }}"><a class="nav-link" href="{{ route('public.clientpublic') }}">Clients</a></li>

                            <li class="nav-item {{ (request()->routeIs('public.contact') ? 'active' : '') }}"><a class="nav-link" href="{{ route('public.contact') }}">Contact Us</a></li>
                            
                            <li class="nav-item"><a class="nav-link" target="_blank" href="/login">Login</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!--/ Col end -->
        </div>
        <!--/ Row end -->

    </div>
    <!--/ Container end -->

</div>
