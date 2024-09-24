@extends('admin.layout')

@section('content')

<section id="manage-users">
        <h2>User Management Overview</h2>
        <div class="admin-sections">
            <div class="admin-section">
                <h3>Manage Staff</h3>
                <p>View, edit, and delete staff accounts (Architects and Designers).</p>
                <a href="{{ route('admin.manageStaffs') }}" class="view-details">Manage Staffs</a>
            </div>
            <div class="admin-section">
                <h3>Manage Clients</h3>
                <p>View, edit, and delete client accounts.</p>
                <a href="{{ route('admin.manageClients') }}" class="view-details">Manage Clients</a>
            </div>
            <div class="admin-section">
                <h3>New Client Requests</h3>
                <p>Review and approve new client registration requests.</p>
                <a href="{{ route('admin.viewRequests') }}" class="view-details">View Requests</a>
            </div>
            <div class="admin-section">
                <h3>Ongoing Projects</h3>
                <p>Manage and view details of ongoing projects.</p>
                <a href="{{ route('admin.viewProjects') }}" class="view-details">View Projects</a>
            </div>
        </div>
    </section>
@endsection