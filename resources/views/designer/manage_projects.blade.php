@extends('designer.layout')

@section('content')

<!-- Add this in the <head> section or before your script tags -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
    section#approved-projects {
        padding: 40px;
    }

    .tabs {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }

    .tablink {
        background-color: #343a40;
        color: white;
        padding: 15px 0;
        border: none;
        cursor: pointer;
        width: 20%;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        text-align: center;
    }

    .tablink.active {
        background-color: #BB86FC;
    }

    .tablink:hover {
        background-color: #8A2C8C;
    }

    .tabcontent {
        display: none;
        background-color: #282828;
        padding: 20px;
        border-radius: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #343a40;
    }

    th {
        background-color: #343a40;
    }

    .btn-generate,
    .btn-view,
    .btn-terminate,
    .btn-assign,
    .btn-reassign,
    .btn-update-cost {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: #f7f7f7;
        transition: background-color 0.3s ease;
    }

    .btn-view {
        background-color: #008CBA;
    }

    .btn-view:hover {
        color: #008CBA;
    }

    .btn-terminate {
        background-color: #ff4d4d;
        /* Subtle Red */
    }

    .btn-terminate:hover {
        background-color: #cc0000;
        /* Darker Red on hover */
    }

    .btn-assign,
    .btn-reassign {
        background-color: #4CAF50;
        /* Green */
    }

    .btn-assign:hover,
    .btn-reassign:hover {
        background-color: #45a049;
        /* Darker Green on hover */
    }

    .btn-update-cost {
        background-color: #008CBA;
        /* Blue */
    }

    .btn-update-cost:hover {
        background-color: #007bb5;
        /* Darker Blue on hover */
    }

    /* .tablink.active {
    background-color: #8A2C8C;
} */
</style>
<section id="approved-projects">
    <div class="tabs">
        <button class="tablink active" onclick="openTab(event, 'Waiting')">New Assign</button>
        <button class="tablink" onclick="openTab(event, 'InProgress')">In Progress</button>
        <button class="tablink" onclick="openTab(event, 'Completed')">Completed</button>
    </div>

    <div id="Waiting" class="tabcontent">
        <table>
            <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Estimated Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($waiting as $project)
                    <tr>
                        <td>{{ $project->client_id }}</td>
                        <td>{{ $project->client->user->name }}</td> <!-- Assuming the client has a user relationship -->
                        <td>{{ $project->projectRequest->type }}</td> <!-- Assuming projectRequest has type -->
                        @if ($project->projectRequest->type === 'plan')
                            <td>{{ $project->projectRequest->planRequest->estimated_cost }}</td>
                        @elseif($project->projectRequest->type === 'design')
                            <td>{{ $project->projectRequest->designRequest->estimated_cost }}</td>
                        @endif
                        <td>
                           <a href="{{route('designer.projectDetails',$project->id)}}" class="view-btn">view Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="InProgress" class="tabcontent">
        <table>
            <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Estimated Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($onprogress as $project)
                    <tr>
                        <td>{{ $project->client_id }}</td>
                        <td>{{ $project->client->user->name }}</td>
                        <td>{{ $project->projectRequest->type }}</td>
                        @if ($project->projectRequest->type === 'plan')
                            <td>{{ $project->projectRequest->planRequest->estimated_cost }}</td>
                        @elseif($project->projectRequest->type === 'design')
                            <td>{{ $project->projectRequest->designRequest->estimated_cost }}</td>
                        @endif

                        <td>
                        <a href="{{route('designer.projectDetails',$project->id)}}" class="view-btn">view Details</a>
                        <form action="{{route('designer.updateProject', $project->id)}}" method="post" style="background-color:transparent; display:inline-block">
                                @csrf
                                @method('PUT') 
                                <button class="delete-btn" style="margin-top:20px;padding:10px;width:100%"
                                    type="submit">completed</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div id="Completed" class="tabcontent">
        <table>
            <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Cost</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($completed as $project)
                <tr>
                        <td>{{ $project->client_id }}</td>
                        <td>{{ $project->client->user->name }}</td>
                        <td>{{ $project->projectRequest->type }}</td>
                        @if ($project->projectRequest->type === 'plan' && $project->projectRequest->planRequest)
                <td>{{ $project->projectRequest->planRequest->estimated_cost }}</td>
            @elseif($project->projectRequest->type === 'design' && $project->projectRequest->designRequest)
                <td>{{ $project->projectRequest->designRequest->estimated_cost }}</td>
            @else
                <td>N/A</td> <!-- Fallback if the related request is null -->
            @endif

                        <td>
                            <a href="{{route('designer.projectDetails',$project->id)}}" class="view-btn">view Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</section>
<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    // Hide all tab content
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove the 'active' class from all tab links
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    // Show the selected tab content and mark the clicked tab as active
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");

    // Save the current tab name to localStorage
    localStorage.setItem('activeTab', tabName);
}

// On page load, restore the previously selected tab
$(document).ready(function () {
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        // Open the saved tab
        document.getElementById(activeTab).style.display = "block";
        $('.tablink').removeClass('active'); // Remove active class from other tabs
        $("button[onclick*='" + activeTab + "']").addClass('active'); // Add active class to the selected tab
    } else {
        // Default open tab
        document.getElementById("Waiting").style.display = "block";
    }
});

// Restore the selected tab after page reload
$(window).on('load', function () {
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        document.getElementById(activeTab).style.display = "block";
        $('.tablink').removeClass('active');
        $("button[onclick*='" + activeTab + "']").addClass('active');
    } else {
        document.getElementById("Waiting").style.display = "block";
    }
});



</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



@endsection


