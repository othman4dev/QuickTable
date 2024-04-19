@extends('layouts.app')
@section('content')

<section class="all" style="align-items: flex-start;">
    <section class="table-heading">
        <h1>Coffee Shops</h1>
    </section>
    <section class="feed" style="width: 100%;padding-top:15px;">
        <section class="restaurants">
            @foreach ($businesses as $business)
            <div class="business-card" style="background-image: url('{{ $business->background_image }}');width:100%;flex-grow:1;height:370px">
                <div class="business-card-overlay">
                    
                </div>
                <div class="business-card-top" style="justify-content: flex-start;gap:15px;padding:15px">
                    <div class="business-card-logo" style="background-image: url('{{ $business->pp }}');min-width:50px;min-height:50px;">
                        
                    </div>
                    <div class="business-card-texts">
                        <h1 class="business-card-title" style="font-size: 24px">{{ $business->name }}</h1>
                        <p class="business-card-description">{{ $business->description }}</p>
                    </div>
                    <div class="user-status" style="width: fit-content;flex-grow:1;justify-content:flex-end">
                        <div class="user-status-item" style="max-width: 150px;" onclick="window.location.href = '/getBusiness/{{ $business->businessId }}'">
                            <h1>Profile</h1>
                        </div>
                        <div class="user-status-item" style="max-width: 150px;"  onclick="window.location.href = '/getBusiness/{{ $business->businessId }}'">
                            <h1>Reserve</h1>
                        </div>
                        <div class="user-status-item" style="max-width: fit-content;" onclick="reportBusiness({{ $business->businessId }},this)">
                            <h1>Report</h1>
                        </div>
                    </div>
                </div>
                <div class="business-card-bottom" style="padding-bottom: 15px">
                    <div class="texts">
                        <p class="business-card-description" style="display:flex;flex-direction:column;font-size:14px;padding-inline:15px;width:250px">
                            <label class="labels">Owner Name :</label>
                            {{ $business->firstname }} {{ $business->lastname }}
                        </p>
                        <p class="business-card-description" style="display:flex;flex-direction:column;font-size:14px;padding-inline:15px;width:250px">
                            <label class="labels">Business Type :</label>
                            {{ $business->business_type }}
                        </p>
                    </div>
                    <div class="texts">
                        <p class="business-card-description" style="display:flex;flex-direction:column;font-size:14px;padding-inline:15px;width:250px">
                            <label class="labels">Address :</label>
                            {{ $business->address }}
                        </p>
                        <p class="business-card-description" style="display:flex;flex-direction:column;font-size:14px;padding-inline:15px;width:250px">
                            <label class="labels">Reservation Price :</label>
                            {{ $business->base_price }}$ / seat
                        </p>
                    </div>
                    <div class="texts">
                        <p class="business-card-description" style="display:flex;flex-direction:column;font-size:14px;padding-inline:15px;width:250px">
                            <label class="labels">Email :</label>
                            {{ $business->email }}
                        </p>
                        <p class="business-card-description" style="display:flex;flex-direction:column;font-size:14px;padding-inline:15px;width:250px">
                            <label class="labels">Phone :</label>
                            {{ $business->phone }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
    </section>
</section>
@endsection