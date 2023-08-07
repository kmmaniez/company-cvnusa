@props(['dataclient'])

<section class="content">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 mt-5 mt-lg-0 text-center">

                <h3 class="column-title">Our Clients</h3>

                <div class="row all-clients">

                    @foreach ($dataclient as $client)
                    <div class="col-sm-3 col-6">
                        <figure class="clients-logo">
                            <a href="#!"><img loading="lazy" class="img-fluid"
                                    src="{{ asset('client-logo') }}/{{ $client->logo }}" alt="clients-logo" /></a>
                        </figure>
                    </div>
                    @endforeach

                    {{-- <div class="col-sm-3 col-6">
                        <figure class="clients-logo">
                            <a href="#!"><img loading="lazy" class="img-fluid"
                                    src="{{ url('assets/images/clients/client2.png') }}" alt="clients-logo" /></a>
                        </figure>
                    </div><!-- Client 2 end -->

                    <div class="col-sm-3 col-6">
                        <figure class="clients-logo">
                            <a href="#!"><img loading="lazy" class="img-fluid"
                                    src="{{ url('assets/images/clients/client3.png') }}" alt="clients-logo" /></a>
                        </figure>
                    </div><!-- Client 3 end -->

                    <div class="col-sm-3 col-6">
                        <figure class="clients-logo">
                            <a href="#!"><img loading="lazy" class="img-fluid"
                                    src="{{ url('assets/images/clients/client4.png') }}" alt="clients-logo" /></a>
                        </figure>
                    </div><!-- Client 4 end -->

                    <div class="col-sm-3 col-6">
                        <figure class="clients-logo">
                            <a href="#!"><img loading="lazy" class="img-fluid"
                                    src="{{ url('assets/images/clients/client5.png') }}" alt="clients-logo" /></a>
                        </figure>
                    </div><!-- Client 5 end -->

                    <div class="col-sm-3 col-6">
                        <figure class="clients-logo">
                            <a href="#!"><img loading="lazy" class="img-fluid"
                                    src="{{ url('assets/images/clients/client6.png') }}" alt="clients-logo" /></a>
                        </figure>
                    </div><!-- Client 6 end -->

                    <div class="col-sm-3 col-6">
                        <figure class="clients-logo">
                            <a href="#!"><img loading="lazy" class="img-fluid"
                                    src="{{ url('assets/images/clients/client2.png') }}" alt="clients-logo" /></a>
                        </figure>
                    </div><!-- Client 6 end -->

                    <div class="col-sm-3 col-6">
                        <figure class="clients-logo">
                            <a href="#!"><img loading="lazy" class="img-fluid"
                                    src="{{ url('assets/images/clients/client3.png') }}" alt="clients-logo" /></a>
                        </figure>
                    </div><!-- Client 6 end -->

                    <div class="col-sm-3 col-6">
                        <figure class="clients-logo">
                            <a href="#!"><img loading="lazy" class="img-fluid"
                                    src="{{ url('assets/images/clients/client1.png') }}" alt="clients-logo" /></a>
                        </figure>
                    </div><!-- Client 6 end --> --}}

                </div><!-- Clients row end -->

            </div><!-- Col end -->

        </div>
        <!--/ Content row end -->
    </div>
    <!--/ Container end -->
</section><!-- Content end -->