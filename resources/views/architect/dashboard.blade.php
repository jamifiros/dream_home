@extends('architect.layout')
@section('content')

    <section id="architect-dashboard">
        <h2>Welcome, Architect</h2>
        <div class="architect-sections">
            <div class="architect-section">
                <h3>Project Management</h3>
                <p>View and update your projects ...</p>
                <a href="{{route('architect.viewProjects')}}" class="view-details">View Projects</a>
            </div>
            <div class="architect-section">
                <h3>Manage Plan gallery</h3>
                <p>View, edit, and manage plan gallery...</p>
                <a href="{{route('architect.planGallery')}}" class="view-details">Manage Plans</a>
            </div>
            <div class="architect-section">
                <h3>Profile Management</h3>
                <p>View and update your profile details...</p>
                <a href="{{route('architect.viewProfile')}}" class="view-details">View Profile</a>
            </div>
            <div class="architect-section">
                <h3>Chat</h3>
                <p>Engage in conversations with Admin,staffs and Clients...</p>
                <a href="#" class="view-details">Go to Chat</a>
            </div>
        </div>
    </section>

@endsection
