@extends('client.layout')

@section('content')

<section id="new-client-requests">
    <div class="table-card">
        <h2>Client Requests Overview</h2>
        <table>
            <thead>
                <tr>
                    <th>Plan ID</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Details</th>
                    <th>Estimated Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projectRequests as $projectRequest)
                    @if($projectRequest->status === 'send')
                        <tr>
                            <td>{{$projectRequest->id}}</td>
                            <td>{{$projectRequest->type}}</td>
                            @if($projectRequest->type === 'plan')
                                <td>{{$projectRequest->planRequest->work_location}}</td>
                                <td>
                                    <ul style="list-style-type:none; text-align:left;">
                                        <li><span>Plot Size: </span>{{$projectRequest->planRequest->plot_size}}</li>
                                        <li><span>Plot Size: </span> {{$projectRequest->planRequest->no_floors}}</li>
                                        <li><span>No of BHk: </span>{{$projectRequest->planRequest->no_bhk}}</li>
                                        <li><span>No of Bathrooms: </span>{{$projectRequest->planRequest->no_bathrooms}}</li>
                                    </ul>
                                </td>
                                <td>{{$projectRequest->planRequest->estimated_cost}}</td>
                            @elseif($projectRequest->type === 'design')
                                <td>{{$projectRequest->designRequest->work_location}}</td>
                                <td>
                                    <p>Details:{{$projectRequest->designRequest->requirments}}<br>
                                        {{$projectRequest->designRequest->additional_info}}
                                    </p>
                                </td>
                                <td>{{$projectRequest->designRequest->estimated_cost}}</td>
                            @endif
                            <td>
            <form action="{{ route('client.acceptRequest', $projectRequest->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="view-btn">Accept</button>
            </form>
            
            <form action="{{ route('client.refuseRequest', $projectRequest->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <button type="submit" class="delete-btn">Reject</button>
            </form>
        </td>
                        </tr>
                    @elseif($projectRequest->status === 'pending')
                        <tr>
                            <td>{{$projectRequest->id}}</td>
                            <td>{{$projectRequest->type}}</td>
                            @if($projectRequest->type === 'plan')
                                <td>{{$projectRequest->planRequest->work_location}}</td>
                                <td>
                                    <ul style="list-style-type:none; text-align:left;">
                                        <li><span>Plot Size: </span>{{$projectRequest->planRequest->plot_size}}</li>
                                        <li><span>Plot Size: </span> {{$projectRequest->planRequest->no_floors}}</li>
                                        <li><span>No of BHk: </span>{{$projectRequest->planRequest->no_bhk}}</li>
                                        <li><span>No of Bathrooms: </span>{{$projectRequest->planRequest->no_bathrooms}}</li>
                                    </ul>
                                </td>
                                <td>{{$projectRequest->status}}</td>
                            @elseif($projectRequest->type === 'design')
                                <td>{{$projectRequest->designRequest->work_location}}
                                </td>
                                <td>
                                    <p>{{$projectRequest->designRequest->requirements}}<br>
                                        {{$projectRequest->designRequest->additional_info}}
                                    </p>
                                </td>
                                <td>{{$projectRequest->status}}</td>
                            @endif
                            <td></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</section>



@endsection