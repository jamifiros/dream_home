@extends('architect.layout')
@section('content')
<div id="view-request">

    <div class="details-card">
        <div class="details-head">
            <h2>Project Details </h2>
        </div>
        <div class="details">
            <div>
                <label for="">client Name:</label>
                <input type="text" value="{{ $project->client->user->name }}" readonly>
            </div>
            <div>
                <label>Plot Size:</label>
                <input type="text" value="{{ $project->projectRequest->planRequest->plot_size }}" readonly>
            </div>
            <div>
                <label>Location:</label>
                <input type="text" value="{{ $project->projectRequest->planRequest->work_location }}" readonly>
            </div>
            <div>
                <label>No of Bedrooms:</label>
                <input type="text" value="{{ $project->projectRequest->planRequest->no_bhk }}" readonly>
            </div>
            <div>
                <label>No of Bathrooms:</label>
                <input type="text" value="{{ $project->projectRequest->planRequest->no_bathrooms }}" readonly>
            </div>
            <div>
                <label>No of Floors:</label>
                <input type="text" value="{{ $project->projectRequest->planRequest->no_floors }}" readonly>
            </div>
        </div>
        <div>
            <div>
                <label>Requirements:</label>
                <textarea readonly>{{ $project->projectRequest->planRequest->requirements }}</textarea>
            </div>
            <div>
                <label>Additional Info:</label>
                <textarea readonly>{{ $project->projectRequest->planRequest->additional_info }}</textarea>
            </div>
        </div>
        <div style="display:flex; flex-wrap:wrap;justify-content:space-evenly">
            <div>
                <label>Plot Image:</label><br>
                <img class="modelImage" src="{{ asset($project->projectRequest->planRequest->plot_image) }}"
                    alt="plot image">
            </div>
            <div>
                <label>Model Image:</label><br>
                <img class="modelImage" src="{{ asset($project->projectRequest->planRequest->plan->plan_image) }}"
                    alt="model image">
            </div>
        </div>
        <div>
            @if ($project->status !== 'completed')
                <form action="{{route('architect.updateProject', $project->id)}}" method="post"
                    style="background-color:transparent; display:inline-block">
                    @csrf
                    @method('PUT') 
                    <button class="delete-btn" style="margin-top:20px;padding:10px;width:100%"
                        type="submit">completed</button>
            </form> @endif
        </div>
    </div>

</div>


@endsection