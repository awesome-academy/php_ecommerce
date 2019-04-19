<div class="col-12 col-lg-6">
    <div class="card bg-light card-body mb-3 card p-1 mb-3">
        <div class="row">
            <div class="col-12 col-lg-6 text-center">
                 <h1>{{ $avgStar }}/{{ @config('setting.product.number_rating') }} </h1>
                <div class="rating">
                    @for($i = 1; $i <= @config('setting.product.number_rating'); $i++)
                    <span class="{{ ($i <= (int)$avgStar) ? 'text-warning' : ''}} fa fa-star">
                    </span>
                    @endfor
                </div>
                <div> <span class="fas fa-user"></span> {{ $reviews->count() }} total</div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="row">
                    <div class="col-3 col-lg-3 text-right">
                        <span class="text-warning fa fa-star"></span>5
                    </div>
                    <div class="col-8 col-lg-9">
                        <div class="progress progress-bar-item">
                            <div class="progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                <span class="sr-only">80%</span>
                            </div>
                        </div>
                    </div>
                    <!-- end 5 -->
                    <div class="col-3 col-lg-3 text-right">
                        <span class="text-warning fa fa-star"></span>4
                    </div>
                    <div class="col-8 col-lg-9">
                        <div class="progress progress-bar-item">
                            <div class="progress-bar-striped progress-bar-animated progress-bar" role="progressbar" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                <span class="sr-only">60%</span>
                            </div>
                        </div>
                    </div>
                    <!-- end 4 -->
                    <div class="col-3 col-lg-3 text-right">
                        <span class="text-warning fa fa-star"></span>3</div>
                    <div class="col-8 col-lg-9">
                        <div class="progress progress-bar-item">
                            <div class="progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                <span class="sr-only">40%</span>
                            </div>
                        </div>
                    </div>
                    <!-- end 3 -->
                    <div class="col-3 col-lg-3 text-right">
                        <span class="text-warning fa fa-star"></span>2
                    </div>
                    <div class="col-8 col-lg-9">
                        <div class="progress progress-bar-item">
                            <div class="progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                <span class="sr-only">20%</span>
                            </div>
                        </div>
                    </div>
                    <!-- end 2 -->
                    <div class="col-3 col-lg-3 text-right"> <span class="text-warning fa fa-star"></span>1</div>
                    <div class="col-8 col-lg-9">
                        <div class="progress progress-bar-item">
                            <div class="progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="80"
                            aria-valuemin="0" aria-valuemax="100" style="width: 15%">
                                <span class="sr-only">15%</span>
                            </div>
                        </div>
                    </div>
                    <!-- end 1 -->
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>
