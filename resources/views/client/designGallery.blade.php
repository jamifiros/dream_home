@extends('client.layout')
@section('content')

   <section id="gallery">
        <h2>Designs</h2>
        <div class="design-cards">
            @foreach ($designs as $design)
            <div class="design-card">
                <img src="{{asset($design->design_image)}}" alt="{{$design->name}}">
                <h3>{{$design->design_name}}</h3>
                <p>Type:{{$design->design_type}}</p>
                <p>Estimated Cost:{{$design->estimated_cost}}</p>
                <!-- <a href="#" class="view-details">View Details</a> -->
            </div>
            @endforeach
            
        </div>
    </section>

@endsection


