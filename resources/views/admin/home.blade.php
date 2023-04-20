@extends('admin.layouts.admin')

@section('title', 'Home')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab"
                                       href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences"
                                       role="tab" aria-selected="false">Audiences</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics"
                                       role="tab" aria-selected="false">Demographics</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more"
                                       role="tab" aria-selected="false">More</a>
                                </li>
                            </ul>
                            <div>
                                <div class="btn-wrapper">
                                    <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                                    <a href="#" class="btn btn-primary text-white me-0"><i
                                            class="icon-download"></i> Export</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content tab-content-basic">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                 aria-labelledby="overview">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div
                                            class="statistics-details d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="statistics-title">Bounce Rate</p>
                                                <h3 class="rate-percentage">32.53%</h3>
                                                <p class="text-danger d-flex"><i
                                                        class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                                            </div>
                                            <div>
                                                <p class="statistics-title">Page Views</p>
                                                <h3 class="rate-percentage">7,682</h3>
                                                <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="statistics-title">New Sessions</p>
                                                <h3 class="rate-percentage">68.8</h3>
                                                <p class="text-danger d-flex"><i
                                                        class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                            </div>
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Avg. Time on Site</p>
                                                <h3 class="rate-percentage">2m:35s</h3>
                                                <p class="text-success d-flex"><i
                                                        class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                                            </div>
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">New Sessions</p>
                                                <h3 class="rate-percentage">68.8</h3>
                                                <p class="text-danger d-flex"><i
                                                        class="mdi mdi-menu-down"></i><span>68.8</span></p>
                                            </div>
                                            <div class="d-none d-md-block">
                                                <p class="statistics-title">Avg. Time on Site</p>
                                                <h3 class="rate-percentage">2m:35s</h3>
                                                <p class="text-success d-flex"><i
                                                        class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 d-flex flex-column">
                                        <div class="row flex-grow">
                                            <div class="col-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div
                                                            class="d-sm-flex justify-content-between align-items-start">
                                                            <div>
                                                                <h4 class="card-title card-title-dash">Market
                                                                    Overview</h4>
                                                                <p class="card-subtitle card-subtitle-dash">Lorem
                                                                    ipsum dolor sit amet consectetur adipisicing
                                                                    elit</p>
                                                            </div>
                                                            <div>
                                                                <div class="dropdown">
                                                                    <button
                                                                        class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                                                        type="button" id="dropdownMenuButton2"
                                                                        data-bs-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        This month
                                                                    </button>
                                                                    <div class="dropdown-menu"
                                                                         aria-labelledby="dropdownMenuButton2">
                                                                        <h6 class="dropdown-header">Settings</h6>
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another
                                                                            action</a>
                                                                        <a class="dropdown-item" href="#">Something
                                                                            else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated
                                                                            link</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                            <div
                                                                class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                                <h2 class="me-2 fw-bold">$36,2531.00</h2><h4
                                                                    class="me-2">USD</h4><h4 class="text-success">
                                                                    (+1.37%)</h4></div>
                                                            <div class="me-3">
                                                                <div id="marketing-overview-legend"></div>
                                                            </div>
                                                        </div>
                                                        <div class="chartjs-bar-wrapper mt-3">
                                                            <canvas id="marketingOverview"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row flex-grow">
                                            <div class="col-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div
                                                            class="d-sm-flex justify-content-between align-items-start">
                                                            <div>
                                                                <h4 class="card-title card-title-dash">Pending
                                                                    Requests</h4>
                                                                <p class="card-subtitle card-subtitle-dash">You have
                                                                    50+ new requests</p>
                                                            </div>
                                                            <div>
                                                                <button
                                                                    class="btn btn-primary btn-lg text-white mb-0 me-0"
                                                                    type="button"><i
                                                                        class="mdi mdi-account-plus"></i>Add new
                                                                    member
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive  mt-1">
                                                            <table class="table select-table">
                                                                <thead>
                                                                <tr>
                                                                    <th>
                                                                        <div
                                                                            class="form-check form-check-flat mt-0">
                                                                            <label class="form-check-label">
                                                                                <input type="checkbox"
                                                                                       class="form-check-input"
                                                                                       aria-checked="false"><i
                                                                                    class="input-helper"></i></label>
                                                                        </div>
                                                                    </th>
                                                                    <th>Customer</th>
                                                                    <th>Company</th>
                                                                    <th>Progress</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div
                                                                            class="form-check form-check-flat mt-0">
                                                                            <label class="form-check-label">
                                                                                <input type="checkbox"
                                                                                       class="form-check-input"
                                                                                       aria-checked="false"><i
                                                                                    class="input-helper"></i></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex ">
                                                                            <img src="images/faces/face1.jpg"
                                                                                 alt="">
                                                                            <div>
                                                                                <h6>Brandon Washington</h6>
                                                                                <p>Head admin</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h6>Company name 1</h6>
                                                                        <p>company type</p>
                                                                    </td>
                                                                    <td>
                                                                        <div>
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                                                <p class="text-success">79%</p>
                                                                                <p>85/162</p>
                                                                            </div>
                                                                            <div class="progress progress-md">
                                                                                <div class="progress-bar bg-success"
                                                                                     role="progressbar"
                                                                                     style="width: 85%"
                                                                                     aria-valuenow="25"
                                                                                     aria-valuemin="0"
                                                                                     aria-valuemax="100"></div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="badge badge-opacity-warning">In
                                                                            progress
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 d-flex flex-column">
                                        <div class="row stretch-card">
                                            <div class="col-12 grid-margin stretch-card">
                                                <div class="card card-rounded">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-3">
                                                                    <h4 class="card-title card-title-dash">Type By
                                                                        Amount</h4>
                                                                </div>
                                                                <canvas class="my-auto" id="doughnutChart"
                                                                        height="200"></canvas>
                                                                <div id="doughnut-chart-legend"
                                                                     class="mt-5 text-center"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layouts.inner-footer')
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
@endsection
