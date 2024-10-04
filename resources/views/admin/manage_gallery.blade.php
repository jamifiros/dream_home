@extends('admin.layout')

@section('content')

    <section id="admin-dashboard">
        <div class="admin-sections">
            
            <div class="admin-section">
                <h3>Manage Plans</h3>
                <p>View, edit, and delete plans from the Plan gallery.</p>
                <a href="{{ route('admin.managePlan') }}" class="view-details">Manage Plans</a>
            </div>
            <div class="admin-section">
                <h3>Manage Designs</h3>
                <p>View, edit, and delete designs from the Design gallery.</p>
                <a href="{{ route('admin.manageDesign') }}" class="view-details">Manage Designs</a>
            </div>

        </div>
    </section>

    @endsection
