@extends('designer.layout')
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
                <label>Location:</label>
                <input type="text" value="{{ $project->projectRequest->designRequest->work_location }}" readonly>
            </div>
            <div>
            @if ($project->status !== 'completed')
                <label>Estimated Cost:</label>
            @else  
            <label>Cost:</label>
            @endif
                <input type="text" value="{{ $project->projectRequest->designRequest->estimated_cost}}" readonly>
            </div>
        </div>
        <div>
            <div>
                <label>Requirements:</label>
                <textarea readonly>{{ $project->projectRequest->designRequest->requirements }}</textarea>
            </div>
            <div>
                <label>Additional Info:</label>
                <textarea readonly>{{ $project->projectRequest->designRequest->additional_info }}</textarea>
            </div>
        </div>
        <div style="display:flex; flex-wrap:wrap;justify-content:space-evenly">
            <div>
                <label>Model Image:</label><br>
                <img class="modelImage" src="{{ asset($project->projectRequest->designRequest->design->design_image) }}"
                    alt="model image">
            </div>
        </div>
        <div>
            @if ($project->status !== 'completed')
                <form action="{{route('designer.updateProject', $project->id)}}" method="post"
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