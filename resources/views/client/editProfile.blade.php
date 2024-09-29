@extends('client.layout')
@section('content')

<section class="profile-container">
    <div class="profile-card">
        <h2>Profile Information</h2>
        <form method="POST" action="{{ route('client.updateProfile', $client->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="profile-column">
                <div class="profile-picture">
                   @if($client->profile_image)
                      <img src="{{ asset($client->profile_image) }}" alt=""/>
                   @else
                      <img src="{{ asset('images/DpDefault.jpg') }}" alt="defaultDp.jpg">
                   @endif 
                </div>
            </div>
            <div class="details">
                <div>
                   <label for="displayName">Name:</label>
                    <input type="text" id="displayName" name="name" value="{{ $client->user->name }}">
                </div>
                <div>
                    <label for="post">POST:</label>
                    <input type="text" id="post" name="post" value="{{ $client->post }}">
                </div>
                <div>
                    <label for="pincode">Pincode:</label>
                    <input type="text" id="pincode" name="pincode" value="{{ $client->pincode }}">
                </div>
                <div>
                    <label for="place">Place:</label>
                    <input type="text" id="place" name="place" value="{{ $client->place }}">
                </div>
                <div>
                    <label for="landmark">Landmark:</label>
                    <input type="text" id="landmark" name="landmark" value="{{ $client->landmark }}">
                </div>
                <div>
                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" name="contact" value="{{ $client->contact }}">
                </div>
                <div>
                    <label for="profilePicUpload">Change Profile Image:</label>
                    <input type="file" id="profilePicUpload" name="profile_image" accept="image/*" class="file-upload">
                </div>
            </div>
            <button type="submit" class="save-btn">Save Changes</button>
        </form>
    </div>
</section>

@endsection


 