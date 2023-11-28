@extends('dashboard.admin')
@section('title')
Dashboard    
@endsection
@section('content')
<!-- content-wrapper  -->
<div class="tab-content home-tab-content">
    <div class="tab-pane fade show active" id="Dashboards-1" role="tabpanel"
        aria-labelledby="Dashboards-tab">                 
        <div class="row">
            <div class="col-xl-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Account Retention</h4>
                            <button type="button" class="btn btn-link btn-md text-light p-0">14
                                Jan
                                2019</button>
                        </div>
                        <h2 class="text-dark font-weight-bold my-3">$23,769</h2>
                        <canvas id="account-retension"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="custom-fieldset mb-4">
                            <div class="clearfix">
                                <label class="">Product Sold</label>
                            </div>
                            <div class="d-lg-flex align-items-center text-dark">
                                <i class="mdi mdi-inbox-arrow-up mr-3 mdi-36px animate-icon"></i>
                                <div>
                                    <h2 class="mb-0 mt-2 mt-sm-0">$45300</h2>
                                    <div class="text-light d-flex align-items-center"><span
                                            class="text-success mr-2 font-weight-medium d-flex align-items-center"><i
                                                class="mdi mdi-menu-up mdi-18px"></i>+4531</span>avg.
                                        sales per day</div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-fieldset mt-3">
                            <div class="clearfix">
                                <label>Product Orders</label>
                            </div>
                            <div class="d-lg-flex align-items-center text-dark">
                                <i class="mdi mdi-cart-outline mr-3 mdi-36px animate-icon"></i>
                                <div>
                                    <h2 class="mb-0 mt-2 mt-sm-0">$61404</h2>
                                    <div class="text-light d-flex align-items-center"><span
                                            class="text-danger mr-2 font-weight-medium d-flex align-items-center"><i
                                                class="mdi mdi-menu-down mdi-18px"></i>-231.33</span>avg.
                                        sales per day</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-4 grid-margin stretch-card">
              
            </div> --}}
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="card-title">Revenue Statistics</h4>
                            <div class="dropdown">
                                <button type="button"
                                    class="btn btn-outline-light dropdown-toggle my-2 my-lg-0"
                                    data-toggle="dropdown" id="profileDropdown2">
                                    <i class="mdi mdi-calendar-blank text-extra-small"></i> Jan
                                    12,2019
                                    - Mar 12,2019
                                </button>
                                <div class="dropdown-menu dropdown-menu-left custom-drop-down"
                                    aria-labelledby="profileDropdown2">
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-calendar-blank"></i> Sep 12,2018 - Dec
                                        12,2018
                                    </a>
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-calendar-blank"></i> Jun 12,2018 - Aug
                                        12,2018
                                    </a>
                                </div>
                                <button type="button"
                                    class="btn btn-warning ml-sm-3 my-2 my-lg-0">Download
                                    Report</button>
                            </div>
                        </div>
                        <div class="mb-4">
                            <span class="pr-2">Sales</span><span class="pr-2"><i
                                    class="mdi mdi-chevron-right"></i></span><span>Revenue
                                statistics</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row chart-legends-revenue-statistics">
                                    <div class="col-sm-6 mb-4 mb-sm-0">
                                        <div class="legend-label d-flex align-items-center">
                                            <span class="bg-secondary"></span>
                                            <h5 class="mb-0 font-weight-normal">Gross Earnings</h5>
                                        </div>
                                        <h3 class="text-dark font-weight-medium mt-2">$14,000.00
                                        </h3>
                                    </div>
                                    <div class="col-sm-6  mb-4 mb-sm-0">
                                        <div class="legend-label d-flex align-items-center">
                                            <span class="bg-info"></span>
                                            <h5 class="mb-0 font-weight-normal">Gross Earnings</h5>
                                        </div>
                                        <h3 class="text-dark font-weight-medium mt-2">$23,000.00
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="text-dark font-weight-normal">Summary</h5>
                                <p>A comparison of people who mark themeselves of their interest
                                    based
                                    from
                                    the date range given above. <a href="#"
                                        class="text-success">Learn More</a></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <canvas id="revenue-statistics"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Total Conversion Rate</h4>
                        <div
                            class="d-xl-flex justify-content-between mt-3 mb-3 align-items-center">
                            <h6 class="font-weight-normal">Mar 28 - Apr 28.2019</h6>
                            <button type="button"
                                class="btn btn-outline-primary">Details</button>
                        </div>
                        <div class="row mt-4 mb-4 mb-sm-0 d-flex align-items-center">
                            <div class="col-xl-9 mb-4 mb-sm-0">
                                <h1 class="font-weight-medium m-0 text-dark">$2345.00 <span
                                        class="text-danger text-small font-weight-normal">-11.45%
                                        (1.2%)</span></h1>
                            </div>

                            <div class="col-xl-3"><canvas id="total-conversion"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Avg. Order Quantity</h4>
                        <div
                            class="d-xl-flex justify-content-between mt-3 mb-3 align-items-center">
                            <h6 class="font-weight-normal">Mar 28 - Apr 28.2019</h6>
                            <button type="button"
                                class="btn btn-outline-primary">Details</button>
                        </div>
                        <div class="row mt-4 mb-4 mb-sm-0 d-flex align-items-center">
                            <div class="col-xl-9  mb-4 mb-sm-0">
                                <h1 class="font-weight-medium m-0 text-dark">4,356 <span
                                        class="text-success text-small font-weight-normal">+54.34
                                        (1.2%)</span></h1>
                            </div>

                            <div class="col-xl-3"><canvas id="avrg-order-quantity"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Percentage of licenses used</h4>
                        <div
                            class="d-xl-flex justify-content-between mt-3 mb-3 align-items-center">
                            <h6 class="font-weight-normal">Mar 28 - Apr 28.2019</h6>
                            <button type="button"
                                class="btn btn-outline-primary">Details</button>
                        </div>
                        <div class="row mt-4 mb-4 mb-sm-0 d-flex align-items-center">
                            <div class="col-xl-9 mb-4 mb-sm-0">
                                <h1 class="font-weight-medium m-0 text-dark">45.34% <span
                                        class="text-success text-small font-weight-normal">+24.18
                                        (2.6%)</span></h1>
                            </div>

                            <div class="col-xl-3"><canvas id="percentage"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> >
        
    </div>
</div>
<!-- content-wrapper ends -->
</div>
</div>   
@endsection

   