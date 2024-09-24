@extends('client.layout')
@section('content')

  <section id="client-dashboard">
        <h2>Client Dashboard Overview</h2>
        <div class="admin-sections">
            <div class="admin-section">
                <h3>View Projects</h3>
                <p>Check your ongoing and completed projects.</p>
                <a href="view_projects.html" class="view-details">View Projects</a>
            </div>
            <div class="admin-section">
                <h3>View Bill</h3>
                <p>View your current and past bills.</p>
                <a href="view_bills.html" class="view-details">View Bill</a>
            </div>
            <div class="admin-section">
                <h3>Chat</h3>
                <p>Communicate with your designer.</p>
                <a href="client_chat.html" class="view-details">Chat</a>
            </div>
            <div class="admin-section">
                <h3>Edit Profile</h3>
                <p>Update your profile information.</p>
                <a href="edit_profile.html" class="view-details">Edit Profile</a>
            </div>
        </div>
    </section>

@endsection


