@extends('admin.layout')
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

    .tablink .active {
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
</style>
<section id="approved-projects">
    <div class="tabs">
        <button class="tablink active" onclick="openTab(event, 'Waiting')">Waiting for Assign</button>
        <button class="tablink" onclick="openTab(event, 'InProgress')">In Progress</button>
        <button class="tablink" onclick="openTab(event, 'Completed')">Completed</button>
        <button class="tablink" onclick="openTab(event, 'Paid')">Paid</button>
    </div>

    <div id="Waiting" class="tabcontent">
        <table>
            <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Work Status</th>
                    <th>Cost</th>
                    <th>Assigned Staff</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($waiting as $project)
                    <tr>
                        <td>{{ $project->client_id }}</td>
                        <td>{{ $project->client->user->name }}</td> <!-- Assuming the client has a user relationship -->
                        <td>{{ $project->projectRequest->type }}</td> <!-- Assuming projectRequest has type -->
                        <td>{{ $project->status }}</td>
                        @if ($project->projectRequest->type === 'plan')
                            <td>{{ $project->projectRequest->planRequest->estimated_cost }}</td>
                        @elseif($project->projectRequest->type === 'design')
                            <td>{{ $project->projectRequest->designRequest->estimated_cost }}</td>
                        @endif
                        <td>
                            <select name="staffassign" class="staff-assign" data-project-id="{{ $project->id }}">
                                <option selected disabled>Not assigned</option>
                                @if ($project->projectRequest->type === 'plan')
                                    @foreach($architects as $user)
                                        <option value="{{ $user->staff->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @elseif ($project->projectRequest->type === 'design')
                                    @foreach($designers as $user)
                                        <option value="{{ $user->staff->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>

                        <td>
                            <button class="btn-terminate">Terminate</button>
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
                    <th>Work Status</th>
                    <th>Cost</th>
                    <th>Assigned Staff</th>
                    <th></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($onprogress as $project)
                    <tr>
                        <td>{{ $project->client_id }}</td>
                        <td>{{ $project->client->user->name }}</td>
                        <td>{{ $project->projectRequest->type }}</td>
                        <td>{{ $project->status }}</td>
                        @if ($project->projectRequest->type === 'plan')
                            <td>{{ $project->projectRequest->planRequest->estimated_cost }}</td>
                        @elseif($project->projectRequest->type === 'design')
                            <td>{{ $project->projectRequest->designRequest->estimated_cost }}</td>
                        @endif
                        <td>{{ $project->staff->user->name }}</td>
                        <td>
                            <select name="staffassign" class="staff-assign" data-project-id="{{ $project->id }}">
                                <option selected disabled>Re-assign</option>
                                @if ($project->projectRequest->type === 'plan')
                                    @foreach($architects as $user)
                                        <option value="{{ $user->staff->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @elseif ($project->projectRequest->type === 'design')
                                    @foreach($designers as $user)
                                        <option value="{{ $user->staff->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <form action="{{route('admin.terminateProject', $project->id)}}" method="post">
                                @csrf
                                @method('PUT') 
                                <button class="delete-btn" style="margin-top:20px;padding:10px;width:100%"
                                    type="submit">terminate</button>
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
                    <th>Work Status</th>
                    <th>Cost</th>
                    <th>Assigned Staff</th>
                    <th>Bill</th>
                </tr>
            </thead>
            <tbody>
                @foreach($completed as $project)
                    <tr>
                        <td>{{ $project->client_id }}</td>
                        <td>{{ $project->client->user->name }}</td>
                        <td>{{ $project->projectRequest->type }}</td>
                        <td>{{ $project->status }}</td>
                        @if ($project->projectRequest->type === 'plan')
                            <td>{{ $project->projectRequest->planRequest->estimated_cost }}</td>
                        @elseif($project->projectRequest->type === 'design')
                            <td>{{ $project->projectRequest->designRequest->estimated_cost }}</td>
                        @endif
                        <td>{{ $project->staff->user->name }}</td>
                        <td><a href="{{route('admin.viewBill',$project->id)}}" class="btn-view">View Bill</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="Paid" class="tabcontent">
    <table>
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Cost</th>
                <th>Assigned Staff</th>
                <th>Bill</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paid as $payment)
                @php
                    $project = $payment->project;
                    $projectRequest = $project ? $project->projectRequest : null;
                @endphp
                <tr>
                    <td>{{ $payment->client_id }}</td>
                    <td>{{ $payment->client->user->name ?? 'N/A' }}</td>
                    
                    <td>
                        @if($projectRequest)
                            {{ $projectRequest->type }}
                        @else
                            N/A
                        @endif
                    </td>                    
                    @if ($project->projectRequest->type === 'plan')
                            <td>{{ $project->projectRequest->planRequest->estimated_cost }}</td>
                        @elseif($project->projectRequest->type === 'design')
                            <td>{{ $project->projectRequest->designRequest->estimated_cost }}</td>
                        @endif

                    <td>{{ $project->staff->user->name ?? 'N/A' }}</td>
                    <td><a href="{{route('admin.viewBill',$project->id)}}" class="btn-view">View Bill</a></td>
                    </tr>
            @endforeach
        </tbody>
    </table>
</div>

</section>
<script>
    // Save the active tab before the page reloads
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";

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

        // Staff assignment AJAX request
        $('.staff-assign').change(function () {
            var staffId = $(this).val();
            var projectId = $(this).data('project-id');

            $.ajax({
                url: 'assignStaff',  // Define the correct route for staff assignment
                type: 'POST',
                data: {
                    staff_id: staffId,
                    project_id: projectId,
                    _token: '{{ csrf_token() }}'  // Add CSRF token for security
                },
                success: function (response) {
                    alert('Staff assigned successfully');
                    location.reload();  // Refresh the page on success
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
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