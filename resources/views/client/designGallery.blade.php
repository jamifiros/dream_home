@extends('client.layout')
@section('content')


   <section class="filter-section">
        <h2>Filter Plans</h2>
        <div class="filter-options">
            <select id="cost-filter">
                <option value="">Filter by Cost</option>
                <option value="100000-200000">$100,000 - $200,000</option>
                <option value="200000-400000">$200,000 - $400,000</option>
                <option value="400000-600000">$400,000 - $600,000</option>
            </select>

            <select id="size-filter">
                <option value="">Filter by Type</option>
                <option value="1000-2000">1,000 - 2,000 sq ft</option>
                <option value="2000-3000">2,000 - 3,000 sq ft</option>
                <option value="3000-4000">3,000 - 4,000 sq ft</option>
            </select>
        </div>
    </section>

   <section id="gallery">
        <h2>Designs</h2>
        <div class="design-cards">
            @foreach ($designs as $design)
            <div class="design-card">
                <img src="{{asset($design->design_image)}}" alt="{{$design->name}}">
                <h3>{{$design->design_name}}</h3>
                <p>Type:{{$design->design_type}}</p>
                <p>Estimated Cost:{{$design->estimated_cost}}</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            @endforeach
            
        </div>
    </section>

@endsection


