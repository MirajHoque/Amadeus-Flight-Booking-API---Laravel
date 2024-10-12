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
            <form action="{{ route('book.flight') }}" method="POST" autocomplete="off" enctype="multipart/form-data" files="true">
                @csrf

                <div class="row mt-2">
                    <h2 class="">Traveller ID {{ $element->travelerId}}</h2>
                    <h2>-</h2>
                    <h2>Traveller Type {{ $element->travelerType}}</h2>
                </div>

                <div class="card-body ">
                    <input type="hidden" name="id" value="{{ $element->travelerId }} ">

                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="first_name" class="col-form-label">First Name</label> <small class="text-danger">*</small> </br>
                            <input id="first_name" type="text" name="first_name" placeholder="Write your first name" value="{{ old('first_name') }}" class="form-control" required>
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="last_name" class="col-form-label">Last Name</label> <small class="text-danger">*</small> </br>
                            <input id="last_name" type="text" name="last_name" placeholder="Write your last name" value="{{ old('last_name') }}" class="form-control" required>
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="dob" class="col-form-label">Date Of Birth</label> <small class="text-danger">*</small> <br>
                            <input type="date" class="form-control" name="dob" placeholder="" value="{{ date('Y-m-d') }}" required autocomplete="off">
                            @error('dob')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="gender" class="col-form-label">Gender</label> <small class="text-danger">*</small> <br>
                            <select class="form-control" name="gender" id="gender">
                                <option value="ECONOMY">Male</option>
                                <option value="PREMIUM_ECONOMY">Female</option>
                            </select>

                            @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="email" class="col-form-label">Email</label> <small class="text-danger">*</small> <br>
                            <input type="email" class="form-control" name="email" placeholder="Write your email" value="{{ old('email') }}" required autocomplete="off">

                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="country_code" class="col-form-label">Country Code</label> <small class="text-danger">*</small> <br>
                            <input type="country_code" class="form-control" name="country_code" placeholder="Write your country code, +1 for US" value="{{ old('country_code') }}" required autocomplete="off">

                            @error('country_code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="phone" class="col-form-label">Phone Number</label> <small class="text-danger">*</small> <br>
                            <input type="phone" class="form-control" name="phone" placeholder="Write your phone number" value="{{ old('phone') }}" required autocomplete="off">

                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <input type="hidden" value="{{ json_encode($res) }}">
                    <div class="form-group row">
                        <div class="col-md-1">
                            <div class="button-items float-right">
                                <button type="submit" class="btn btn-success">Confirm Booking</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection