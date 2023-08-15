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
                            <a href="#!"><img loading="lazy" class="img-fluid" src="{{ Storage::url($client->logo) }}" alt="clients-logo" /></a>
                        </figure>
                    </div>
                    @endforeach

                </div><!-- Clients row end -->

            </div><!-- Col end -->

        </div>
        <!--/ Content row end -->
    </div>
    <!--/ Container end -->
</section><!-- Content end -->