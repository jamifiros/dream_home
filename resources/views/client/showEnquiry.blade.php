@extends('admin.layout')

@section('content')

<section id="new-client-requests">
    <div class="table-card">
        <h2>Client Requests Overview</h2>
        <table>
            <thead>
                <tr>
                    <th>Plan ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projectrequests as $projectRequest)
                    <tr>
                        <td>{{$projectRequest->id}}</td>
                        <td>{{$projectRequest->type}}</td>
                        @if($projectRequest->type === 'plan')
                        <td>Plot Size:{{$projectRequest->planRequest->plot_size}}<br>
                            Location:{{$projectRequest->planRequest->work_location}}
                        </td>
                        <td>Estimated Cost:{{$projectRequest->planRequest->estimated_cost}}</td>
                        @endif
                        <!-- <td><button class="send-budget-btn">Send Estimated Budget</button></td> -->
                         <!-- <td><a href="{{route('admin.requestDetails', $projectRequest->id)}}" class="view-btn">View Details</a></td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>



@endsection