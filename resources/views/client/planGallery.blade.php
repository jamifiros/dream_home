@extends('client.layout')
@section('content')

<section class="filter-section">
    <h2>Filter Plans</h2>
    <div class="filter-options">
        <select id="type-filter">
            <option selected disabled value="">--Filter by Type--</option>
            <option value="0">All</option>
            <option value="modern">Modern</option>
            <option value="Traditional">Traditional</option>
            <option value="Minimalist">Minimalist</option>
            <option value="Luxury">Luxury</option>
            <option value="Villa">Villa</option>
            <option value="Eco Friendly">Eco Friendly</option>
        </select>

        <select id="cost-filter">
            <option selected disabled value="">Filter by Cost</option>
            <option value="0">All</option>
            <option value="1">Below 10,00,000</option>
            <option value="2">10,00,000 - 50,00,000</option>
            <option value="3">50,00,000 - 100,00,000</option>
            <option value="4">Above 100,00,000</option>
        </select>

        <select id="size-filter">
            <option selected disabled value="">Filter by Size</option>
            <option value="0">All</option>
            <option value="1">Below 1000 sqft</option>
            <option value="2">1,000 - 3,000 sqft</option>
            <option value="3">Above 3,000 sqft</option>
        </select>
    </div>
</section>

<section id="gallery">
    <h2>Plans</h2>
    <div class="plan-cards" id="plans-list">
    @foreach($plans as $plan)
            <div class="plan-card">
                <img src="{{asset($plan->plan_image)}}" alt="{{$plan->plan_name}}">
                <h3>{{$plan->plan_name}}</h3>
                <p>Cost: {{$plan->estimated_cost}} inr</p>
                <p>Size: {{$plan->sqft}} sqft</p>
                <a href="#" class="view-details">View Details</a>
            </div>
        @endforeach
    </div>
</section>

@endsection

