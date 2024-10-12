@extends('layout.master')

@section('content')

@if(Session::has('msg'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('msg') !!}</em></div>
@endif

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Avaiable Flights</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Available Flight Offer</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="py-1">
            <div class="button-items d-flex justify-content-end">
                <!-- <a href="" type="button" class="btn btn-info waves-effect waves-light">New</a> -->
            </div>
        </div>



        @if (session()->has('noOfTraveller'))
        @php
        $numOfTraveller = session()->pull('noOfTraveller', 'default');
        @endphp
        @endif


        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @foreach ($res as $key => $element)

                    <div class="mb-5">
                        <li class="bg-success" scope="row">#{{ $key + 1 }} Flight Offer</li>
                        <li class="ml-3">Offer ID {{ $element->id }}</li>
                        <li class="ml-3">Source {{ $element->source }}</li>
                        <li class="ml-3" style="font-weight: bold;">Total Price {{ $element->price->total }} {{ $element->price->currency }}</li>
                    </div>

                    @php
                    $segments = $element->itineraries[0]->segments;
                    $travelerPricings = $element->travelerPricings;
                    @endphp
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Segment</th>
                                <th>Flight Number</th>
                                <th>Departure Time</th>
                                <th>Arrival Time</th>
                            </tr>
                        </thead>
                        @foreach ($segments as $key => $segment)
                        <tbody>
                            <th scope="row">{{ $key + 1}}</th>
                            <td>{{ $segment->departure->iataCode}} - {{$segment->arrival->iataCode}}</td>
                            <td>{{ $segment->carrierCode}} {{ $segment->number }}</td>
                            <td>{{ $segment->departure->at}}</td>
                            <td>{{ $segment->arrival->at}}</td>
                        </tbody>
                        @endforeach
                    </table>


                    @foreach ($travelerPricings as $key => $traveller)

                    <div class="mb-5">
                        <li scope="row">#{{ $key + 1 }}</li>
                        <li class="ml-3">Traveller {{ $traveller->travelerId }}</li>
                        <li class="ml-3">Traveller Type {{ $traveller->travelerType }}</li>
                        <li class="ml-3" style="font-weight: bold;">Total Price {{ $traveller->price->total }} {{ $traveller->price->currency }}</li>
                    </div>
                    @endforeach


                    @php
                    $price = json_encode($element);
                    @endphp


                    <div class="m-3">
                        <form action="{{ route('flight.offer.price') }}" method="post">
                            @csrf
                            <input name="data" type="hidden" value="{{ $price }}">
                            <input type="hidden" name="noOfTraveller" value="{{ $numOfTraveller }}">
                            <button class="btn btn-warning btn-sm">Book Flight</button>
                        </form>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
{{-- modal --}}
<div class="col-sm-6 col-md-4 col-xl-3">
    <div class="modal fade " id="dataModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="get_data">

            </div>
        </div>
    </div>
</div>

@endsection