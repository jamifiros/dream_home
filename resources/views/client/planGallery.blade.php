@extends('client.layout')
@section('content')

<section id="gallery">
    <h2>Plans</h2>
    <div class="plan-cards" id="plans-list">
    @foreach($plans as $plan)
            <div class="plan-card">
                <img src="{{asset($plan->plan_image)}}" alt="{{$plan->plan_name}}">
                <h3>{{$plan->plan_name}}</h3>
                <p>Cost: {{$plan->estimated_cost}} inr</p>
                <p>Size: {{$plan->sqft}} sqft</p>
                <div class="details" style="display:none" id="plan_details">
                    <p>no of bedrooms: {{$plan->no_bhk}}</p>
                    <p>no of bathrooms:{{$plan->no_bathrooms}}</p>
                    <p>no of floors:{{$plan->no_floors}}</p>
                </div>
                <!-- <a href="#" class="view-details" onclick="displayDetails()">View Details</a> -->
            </div>
        @endforeach
    </div>
</section>
<script>
    // function displayDetails(){
    //     let details = document.getElementById('plan_details');
    //     details.style.display = 'block';
    // }
</script>
@endsection

