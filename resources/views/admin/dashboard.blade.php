@extends('admin.layout')

@section('content')

    <section id="admin-dashboard">
        <h2>Welcome {{ Auth::user()->name }}</h2>
        <div class="admin-sections">
            <div class="admin-section">
                <h3>User Management</h3>
                <p>Manage user accounts and permissions.</p>
                <a href="{{ route('admin.manageUsers') }}" class="view-details">Manage Users</a>
            </div>

            <div class="admin-section">
                <h3>Ongoing Projects</h3>
                <p>Manage and view details of ongoing projects.</p>
                <a href="{{ route('admin.viewProjects') }}" class="view-details">View Projects</a>
            </div>
            <div class="admin-section">
                <h3>Manage Plan gallery/ Design gallery</h3>
                <p>View, edit, and delete plans/designs from the gallery.</p>
                <a href="{{ route('admin.manageGallery') }}" class="view-details">Manage Designs</a>
            </div>
            <div class="admin-section">
                <h3>View Feedback / Ratings</h3>
                <p>View Feedback / Ratings from the Clients.</p>
                <a href="{{ route('admin.feedbacks') }}" class="view-details">Site Settings</a>
            </div>

        </div>
    </section>

    @endsection
