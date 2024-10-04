@extends('client.layout')
@section('content')

<div class="admin-sections">
            <div class="admin-section">
                <h3>View Your Enquiries</h3>
                <p>Check your current enquiries and its status...</p>
                <a href="{{route('client.Enquiry')}}" class="view-details">View</a>
            </div>
            <div class="admin-section">
                <h3>New Project Enquiry</h3>
                <p>Details about the project enquiry can be added here...</p>
                <a href="{{route('client.newEnquiry')}}" class="view-details">Add</a>
            </div>            

        </div>

@endsection


