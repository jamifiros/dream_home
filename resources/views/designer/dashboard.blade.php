@extends('designer.layout')
@section('content')

    <section id="designer-dashboard">
        <h2>Welcome, Designer</h2>
        <div class="designer-sections">
           <div class="designer-section">
                <h3>Project Management</h3>
                <p>View and update your projects ...</p>
                <a href="{{route('designer.viewProjects')}}" class="view-details">View Projects</a>
            </div>
            <div class="designer-section">
                <h3>Profile Management</h3>
                <p>View and update your profile details.</p>
                <a href="{{route('designer.viewProfile')}}" class="view-details">View Profile</a>
            </div>
            <div class="designer-section">
                <h3>Manage Designs</h3>
                <p>View, edit, and manage your designs in the gallery.</p>
                <a href="{{route('designer.designGallery')}}" class="view-details">Manage Designs</a>
            </div>
            <div class="designer-section">
                <h3>Chat</h3>
                <p>Engage in conversations with Admin, Architect, and Clients.</p>
                <a href="{{route('designer.chat')}}" class="view-details">Go to Chat</a>
            </div>
        </div>
    </section>
@endsection
