@extends('designer.layout')

@section('content')


<div id="view-profile">
    <div class="profile-card client-prfl">
        @if($staff->profile_image)
            <img src="{{ asset($staff->profile_image) }}" class="profileimg" alt="{{ $staff->user->name }}.jpg" />
        @else
            <img src="{{asset('images/DpDefault.jpg')}}" class="profileimg" alt="defaultDp.jpg">
        @endif
        <h3>{{$staff->user->name}}</h3>
    </div>

    <div class="details-card">
        <h2>Personal Details</h2>
        <div class="details">
            <div>
                <label>Name:</label>
                <input type="text" value="{{$staff->user->name}}" readonly>
            </div>
            <div>
                <label>Email:</label>
                <input type="email" value="{{$staff->user->email}}" readonly>
            </div>
            <div>
                <label>role:</label>
                <input type="text" value="{{$staff->user->role}}" readonly>
            </div>
            <div>
                <label>Age:</label>
                <input type="text" value="{{$staff->age}}" readonly>
            </div>
            <div>
                <label>Gender:</label>
                <input type="text" value="{{$staff->gender}}" readonly>
            </div>
            <div>
                <label>Date of Joining:</label>
                <input type="text" value="{{ $staff->user->created_at->format('d-m-Y') }}" readonly>
            </div>
            <div>
                <label>POST:</label>
                <input type="text" value="{{$staff->post}}" readonly>
            </div>
            <div>
                <label>Pincode:</label>
                <input type="text" value="{{$staff->pincode}}" readonly>
            </div>
            <div>
                <label>Contact:</label>
                <input type="text" value="{{$staff->contact}}" readonly>
            </div>
        </div>
    </div>
</div>


@endsection