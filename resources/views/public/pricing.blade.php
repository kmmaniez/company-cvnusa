@extends('layouts.public.master')
@push('stylesheet')
    <style>
        .ts-pricing-featured{
            transform:translateY(-48px); box-shadow: 0px 0px 30px #eaeaea;
        }
        .ts-pricing-features ul{
            list-style-type: none;
        }
    </style>
@endpush

@section('content')
    <div id="banner-area" class="banner-area" style="background-image:url({{ url('assets/images/banner/banner1.jpg') }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">{{ request()->route()->uri() }}</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('public.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ request()->route()->uri() }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div>

    <section id="main-container" class="main-container">
        <div class="container" >
            <div class="row text-center">
                <div class="col-12">
                    <h2 class="section-title">Grab the Packages</h2>
                    <h3 class="section-sub-title">{{ request()->route()->uri() }}</h3>
                </div>
            </div>
            <!--/ Title row end -->

            <div class="row">

                @foreach ($prices as $price)
                
                    <div class="col-lg-4 col-md-6">
                        <div class="ts-pricing-box {{ ($price->is_featured) ? 'ts-pricing-featured' : '' }}">
                            <div class="ts-pricing-header">
                                <h2 class="ts-pricing-name">{{ $price->judul }}</h2>
                                <h2 class="ts-pricing-price">
                                    <span class="currency">IDR <strong>{{ number_format($price->harga,0,2,',') }}</strong></span>
                                </h2>
                            </div><!-- Pricing header -->
                            <div class="ts-pricing-features">
                                {!! $price->keterangan !!}
                                {{-- <ul class="list-unstyled">
                                    <li>Project Management for Owners</li>
                                    <li>Pre-construction feasibility</li>
                                    <li>On-site representation</li>
                                    <li>Quality control inspections</li>
                                    <li>Schedule claim preparation/defense</li>
                                    <li>Project phasing development</li>
                                </ul> --}}
                            </div><!-- Features end -->
                            <div class="plan-action">
                                <a href="#" class="btn btn-dark">{{ $price->custom_text_button ?? 'Order Now' }}</a>
                            </div>
                        </div><!-- Plan 1 end -->
                    </div>
                @endforeach

                {{-- <div class="col-lg-3 col-md-6">
                    <div class="ts-pricing-box">
                        <div class="ts-pricing-header">
                            <h2 class="ts-pricing-name">Building Remodels</h2>
                            <h2 class="ts-pricing-price">
                                <span class="currency">$</span><strong>89.9</strong><small>/Month</small>
                            </h2>
                        </div><!-- Pricing header -->
                        <div class="ts-pricing-features">
                            <ul class="list-unstyled">
                                <li>Project Management for Owners</li>
                                <li>Pre-construction feasibility</li>
                                <li>On-site representation</li>
                                <li>Quality control inspections</li>
                                <li>Schedule claim preparation/defense</li>
                                <li>Project phasing development</li>
                            </ul>
                        </div><!-- Features end -->
                        <div class="plan-action">
                            <a href="#" class="btn btn-dark">Order Now</a>
                        </div>
                    </div><!-- Plan 1 end -->
                </div><!-- Col end -->  --}}
                
                {{-- <div class="col-lg-3 col-md-6">
                    <div class="ts-pricing-box ts-pricing-featured" style="transform:translateY(-48px); box-shadow: 0px 0px 30px #eaeaea;">
                        <div class="ts-pricing-header">
                            <h2 class="ts-pricing-name">Renovation</h2>
                            <h2 class="ts-pricing-price">
                                <span class="currency">$</span><strong>179.9</strong><small>/Month</small>
                            </h2>
                        </div><!-- Pricing header -->
                        <div class="ts-pricing-features">
                            <ul class="list-unstyled">
                                <li>Project Management for Owners</li>
                                <li>Pre-construction feasibility</li>
                                <li>On-site representation</li>
                                <li>Quality control inspections</li>
                                <li>Schedule claim preparation/defense</li>
                                <li>Project phasing development</li>
                            </ul>
                        </div><!-- Features end -->
                        <div class="plan-action">
                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div><!-- Plan 2 end -->
                </div><!-- Col end --> --}}

            </div>
            <!--/ Content row end -->

        </div><!-- Conatiner end -->
    </section><!-- Main container end -->
@endsection
