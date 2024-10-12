@extends('layout.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Flight Offer Search</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Flight</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 ">
        <!-- <div class="py-1">
            <div class="button-items d-flex justify-content-end">
                <a href="" type="button" class="btn btn-info waves-effect waves-light">New</a>
                <a href="" type="button" class="btn btn-success waves-effect waves-light">List</a>
            </div>
        </div> -->
        <div class="card">
            <form action="{{ route('frontend.home') }}" method="POST" autocomplete="off" enctype="multipart/form-data" files="true">
                @csrf
                <div class="card-body ">

                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="originLocationCode" class="col-form-label">Origin Location Code</label> <small class="text-danger">*</small> </br>
                            <small>city/airport IATA code from which the traveler will depart, e.g. BOS for Boston</small> </br>
                            <small>Example : SYD</small>
                            <input id="originLocationCode" type="text" name="originLocationCode" placeholder="Write from Where you start the travel" value="{{ old('originLocationCode') }}" class="form-control" required>
                            @error('originLocationCode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="destinationLocationCode" class="col-form-label">Destination Location Code</label> <small class="text-danger">*</small> </br>
                            <small>city/airport IATA code from which the traveler will depart, e.g. BOS for Boston</small> </br>
                            <small>Example : SYD</small>
                            <input id="destinationLocationCode" type="text" name="destinationLocationCode" placeholder="Write your destination to go" value="{{ old('destinationLocationCode') }}" class="form-control" required>
                            @error('destinationLocationCode')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="departureDate" class="col-form-label">Departure Date</label> <small class="text-danger">*</small> <br>
                            <small>The date on which the traveler will depart from the origin to go to the destination</small> <br>
                            <small>Example : 2023-05-02</small>
                            <input type="date" class="form-control" name="departureDate" placeholder="" value="{{ date('Y-m-d') }}" required autocomplete="off">
                            @error('departureDate')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="col-md-3">
                            <label for="returnDate" class="col-form-label">Return Date</label> <small class="text-danger">*</small> <br>
                            <small>The date on which the traveler will depart from the destination to return to the origin</small> <br>
                            <small>Example : 2023-05-02</small>
                            <input type="date" class="form-control" name="returnDate" placeholder="" value="{{ date('Y-m-d') }}" required autocomplete="off">
                            @error('returnDate')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> -->

                    </div>

                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="adults" class="col-form-label">Adults</label> <small class="text-danger">*</small> <br>
                            <small>The number of adult travelers (age 12 or older on date of departure)</small> <br>
                            <input type="number" class="form-control" name="adults" placeholder="" value="{{ old('adults') }}" required autocomplete="off">

                            @error('adults')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="children" class="col-form-label">Children</label> <br>
                            <small>The number of child travelers (older than age 2 and younger than age 12 on date of departure)</small> <br>
                            <input type="number" class="form-control" name="children" placeholder="" value="{{ old('children') }}" required autocomplete="off">

                            @error('children')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="travelClass" class="col-form-label">Travel Class</label> <br>
                            <small>ECONOMY, PREMIUM_ECONOMY, BUSINESS, FIRST</small> <br>
                            <select class="form-control" name="travelClass" id="travelClass">
                                <option value="ECONOMY">ECONOMY</option>
                                <option value="PREMIUM_ECONOMY">PREMIUM_ECONOMY</option>
                                <option value="BUSINESS">BUSINESS</option>
                                <option value="FIRST">FIRST</option>
                            </select>

                            @error('travel_class')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="max" class="col-form-label">Max</label> <br>
                            <small>maximum number of flight offers to return. If specified, the value should be greater than or equal to 1</small> <br>
                            <input type="number" class="form-control" name="max" placeholder="" value="{{ old('max') }}" required autocomplete="off">

                            @error('max')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>


                    <div class="form-group row">
                        <div class="col-md-1">
                            <div class="button-items float-right">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection