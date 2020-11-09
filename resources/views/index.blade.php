@extends('layout.master')
@section('content')
    <div>
        <div class="row">
            <livewire:counter />
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card bg-primary border-0 position-relative">
                    <div class="card-body">
                        <h2 class="text-white">Announcements</h2>
                        <div id="performanceOverview">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-md-10 item">
                                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">
                                                <div class="content text-white">
                                                    <div class="d-flex flex-wrap align-items-center mb-2 mt-3 mt-xl-1">
                                                        <h3 class="font-weight-light mr-2 mb-1">Allotment Reconciliation Process Change for 2020-21</h3>
                                                    </div>
                                                    <p class="text-white font-weight-light pr-lg-2 pr-xl-5">
                                                        The typical Day 10 headcount window is pushed back to September 14, 2020, which is Day 20 for traditional and single-track calendar schools. Schools that have start dates prior to August 17th will report their student numbers as of the actual dates listed below.
                                                    </p>
                                                    <p class="text-white font-weight-light pr-lg-2 pr-xl-5">
                                                        Schools will report on the following dates:
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 item">
                                            <div class="d-flex flex-column flex-xl-row mt-5 mt-md-0">

                                                    <div class="table-responsive">
                                                        <table class="table table-borderless text-white">
                                                            <thead>
                                                            <tr>
                                                                <th class="pl-0 border-bottom">Student Enrollment Reporting Day</th>
                                                                <th class="border-bottom">All School Calendars</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td><p class="mb-0"><span class="font-weight-bold mr-2">Day 1</span></p></td>
                                                                <td>August 17, 2020</td>
                                                            </tr>
                                                            <tr>
                                                                <td><p class="mb-0"><span class="font-weight-bold mr-2">Day 10</span></p></td>
                                                                <td>August 28, 2020</td>
                                                            </tr>
                                                            <tr>
                                                                <td><p class="mb-0"><span class="font-weight-bold mr-2">Day 15</span></p></td>
                                                                <td>September 4, 2020</td>
                                                            </tr>
                                                            <tr>
                                                                <td><p class="mb-0"><span class="font-weight-bold mr-2">Day 20</span></p></td>
                                                                <td>September 14, 2020</td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
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
@endsection

@push('plugin-scripts')
    <script src="{{ asset('/assets/plugins/chartjs/chart.min.js') }}" defer></script>
    <script src="{{ asset('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}" defer></script>
    <script src="{{ asset('/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" defer></script>
    <script src="{{ asset('/assets/js/dashboard.js') }}" defer></script>
@endpush
