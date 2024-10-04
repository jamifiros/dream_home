@extends('client.layout')
@section('content')

  <section id="client-dashboard">
        <h2>Client Dashboard Overview</h2>
        <div class="admin-sections">
            <div class="admin-section">
                <h3>View Projects</h3>
                <p>Check your ongoing and completed projects...</p>
                <a href="{{route('client.projects')}}" class="view-details">View Projects</a>
            </div>
            <div class="admin-section">
                <h3>View Bill</h3>
                <p>View your current and past bills...</p>
                <a href="{{route('client.viewBills')}}" class="view-details">View Bill</a>
            </div>
            <div class="admin-section">
                <h3>Project Enquiry</h3>
                <p>Details about the project enquiry can be added here...</p>
                <a href="{{route('client.ProjectEnquiry')}}" class="view-details">view</a>
            </div>            
            <div class="admin-section">
                <h3>Chat</h3>
                <p>Communicate with your designer/architects...</p>
                <a href="client_chat.html" class="view-details">Chat</a>
            </div>
        </div>
    </section>
<script>
     // Handle errors and success messages
     @if ($errors->any())
        let errorMessages = "";
        @foreach ($errors->all() as $error)
            errorMessages += "{{ $error }}\n";
        @endforeach
        alert(errorMessages);
    @endif
    @if (session('success'))
        alert("{{ session('success') }}");
    @endif
</script>
@endsection


