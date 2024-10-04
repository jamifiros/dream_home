@extends('client.layout')
@section('content')
<div id="view-request">

    <div class="details-card">
        <div class="details-head">
            <h2>Project Details </h2>
        </div>
        @if ($project->projectRequest->type === "plan")
            <div class="details">
            <div>
                    <label for="">Project Id:</label>
                    <input type="text" value="{{ $project->id }}" readonly>
                </div>
            <div>
                    <label for="">Project status:</label>
                    <input type="text" value="{{ $project->status }}" readonly>
                </div>
                <div>

                    <label for="">Architect Name:</label>
                    <input type="text" value="{{ $project->staff->user->name ?? 'N/A' }}" readonly>
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
            <div>
                @if ($project->status === 'completed')
                <a href="{{route('client.bill',$project->id)}}" class="view-btn">view Bill</a>                @endif
            </div>
            </div>

        @elseif($project->projectRequest->type === "design")
            <div class="details">
            <div>
                    <label for="">Project Id:</label>
                    <input type="text" value="{{ $project->id }}" readonly>
                </div>
            <div>
                    <label for="">Project status:</label>
                    <input type="text" value="{{ $project->status }}" readonly>
                </div>
                <div>
                    <label for="">Designer Name:</label>
                    <input type="text" value="{{ $project->staff->user->name ?? 'N/A' }}" readonly>
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
                @if ($project->status === 'completed')
                <a href="{{route('client.bill',$project->id)}}" class="view-btn">view Bill</a>                @endif
            </div>
        @endif
    </div>

</div>


@endsection