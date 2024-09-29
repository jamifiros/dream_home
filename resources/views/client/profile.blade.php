@extends('client.layout')
@section('content')

   <div id="view-profile">
        <div class="profile-card">
            @if($client->profile_image)
                <img src="{{ asset($client->profile_image) }}" alt=""/>
        @else
            <img src="{{asset('images/DpDefault.jpg')}}" alt="defaultDp.jpg">
        @endif 
            <a href="{{route('client.editprofile',$client->id)}}" class="btn">Edit Profile</a>
            <a href="#" class="btn" id="psw-btn">Change password</a>
            <a href="{{route('logout')}}" class="btn">Logout</a>
        </div>
        
        <div class="details-card">
            <h2>Personal Details</h2>
            <div class="details">
                <div>
                    <label>Name:</label>
                    <input type="text" value="{{$client->user->name}}" readonly>
                </div>
                <div>
                    <label>Email:</label>
                    <input type="email" value="{{$client->user->email}}" readonly>
                </div>
                <div>
                    <label>POST:</label>
                    <input type="text" value="{{$client->post}}" readonly>
                </div>
                <div>
                    <label>Pincode:</label>
                    <input type="text" value="{{$client->pincode}}" readonly>
                </div>
                <div>
                    <label>Place:</label>
                    <input type="text" value="{{$client->place}}" readonly>
                </div>
                <div>
                    <label>Landmark:</label>
                    <input type="text" value="{{$client->landmark}}" readonly>
                </div>
                <div>
                    <label>ID Proof Type:</label>
                    <input type="text" value="{{$client->id_proof_type}}" readonly>
                </div>
                <div>
                    <label>Contact:</label>
                    <input type="text" value="{{$client->contact}}" readonly>
                </div>
            </div>
        </div>
<!-- Change Password modal-->
        <div id="pswmodal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Change Password</h2>
                <form id="changePswForm" method="POST" action="{{route('client.changePswd', $client->id)}}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT') <!-- Method for updating -->
                   <label for="password">change password:</labe>
                   <input type="password" name="password" id="password" required>
                   <label for="password_confirmation">confirm Password:</label>
                   <input type="password" name="password_confirmation" id="password_confirmation" required>
                   <input type="submit" value="change password">
               </form>
            </div>
        </div>

    </div> 
    
    <script>
         // Get the modal
var modal = document.getElementById("pswmodal");

// Get the button that opens the modal
var btn = document.getElementById("psw-btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

    </script>

@endsection


