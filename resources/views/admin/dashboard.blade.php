@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h5 page-title">Welcome!</h2>
                </div>
                <div class="col-auto">
                    <form class="form-inline">
                        <div class="form-group d-none d-lg-inline">
                            <label for="reportrange" class="sr-only">Date Ranges</label>
                            <div id="reportrange" class="px-2 py-2 text-muted">
                                <span class="small"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-sm"><span
                                    class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                            <button type="button" class="btn btn-sm mr-2"><span
                                    class="fe fe-filter fe-16 text-muted"></span></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="mb-0">15%</h4>
                                            <p class="small text-muted mb-0">Cpu Usage</p>
                                        </div>
                                        <div class="col-5">
                                            <div id="gauge1" class="gauge-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="mb-0">65%</h4>
                                            <p class="small text-muted mb-0">Ram Usage</p>
                                        </div>
                                        <div class="col-5">
                                            <div id="gauge2" class="gauge-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <p class="small text-muted mb-0">Network</p>
                                            <h4 class="mb-0">20%</h4>
                                        </div>
                                        <div class="col-5">
                                            <div id="gauge3" class="gauge-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end section -->
                    
                    
                </div> <!-- /. col -->
            </div> <!-- end section -->
        </div>
    </div> <!-- .row -->
</div> <!-- .container-fluid -->

@endsection