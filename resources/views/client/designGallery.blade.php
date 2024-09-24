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
            <div class="design-card">
                <img src="design2.jpg" alt="Design 1">
                <h3>Design 1</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="design-card">
                <img src="design2.jpg" alt="Design 2">
                <h3>Design 2</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="design-card">
                <img src="design2.jpg" alt="Design 3">
                <h3>Design 3</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="design-card">
                <img src="design2.jpg" alt="Design 4">
                <h3>Design 4</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="design-card">
                <img src="design2.jpg" alt="Design 5">
                <h3>Design 5</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
            <div class="design-card">
                <img src="design2.jpg" alt="Design 6">
                <h3>Design 6</h3>
                <p>desc</p>
                <a href="#" class="view-details">View Details</a>
            </div>
        </div>
    </section>

@endsection


