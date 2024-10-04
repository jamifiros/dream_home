@extends('admin.layout')
@section('content')

<div id="view-request">

    <div class="details-card">
        <div class="details-head">
            <h2>Request Details : {{ $projectRequest->type }} request</h2>
            <button class="send-budget-btn" style="margin-top:20px">Send Estimated Cost</button>
            <!-- Modal for Send Estimated Budget -->
            <div id="budget-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Send Estimated Budget</h2>
                    <form action="{{ route('admin.sendBudget', $projectRequest->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- This indicates it's a PUT request -->
                        <label for="budget">Estimated Budget:</label>
                        <input type="number" name="budget" required>
                        <div class="button-container">
                            <button class="send-btn" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="details">
            <div>
                <label for="">client Name:</label>
                <input type="text" value="{{ $client->user->name }}" readonly>
            </div>
            @if($projectRequest->type === 'plan')
                    <div>
                        <label>Plot Size:</label>
                        <input type="text" value="{{ $projectRequest->planRequest->plot_size }}" readonly>
                    </div>
                    <div>
                        <label>Location:</label>
                        <input type="text" value="{{ $projectRequest->planRequest->work_location }}" readonly>
                    </div>
                    <div>
                        <label>No of Bedrooms:</label>
                        <input type="text" value="{{ $projectRequest->planRequest->no_bhk }}" readonly>
                    </div>
                    <div>
                        <label>No of Bathrooms:</label>
                        <input type="text" value="{{ $projectRequest->planRequest->no_bathrooms }}" readonly>
                    </div>
                    <div>
                        <label>No of Floors:</label>
                        <input type="text" value="{{ $projectRequest->planRequest->no_floors }}" readonly>
                    </div>
                </div>
                <div>
                    <div>
                        <label>Requirements:</label>
                        <textarea readonly>{{ $projectRequest->planRequest->requirements }}</textarea>
                    </div>
                    <div>
                        <label>Additional Info:</label>
                        <textarea readonly>{{ $projectRequest->planRequest->additional_info }}</textarea>
                    </div>
                </div>
                <div style="display:flex; flex-wrap:wrap;justify-content:space-evenly">
                    <div>
                        <label>Plot Image:</label><br>
                        <img class="modelImage" src="{{ asset($projectRequest->planRequest->plot_image) }}" alt="plot image">
                    </div>
                    <div>
                        <label>Model Image:</label><br>
                        <img class="modelImage" src="{{ asset($projectRequest->planRequest->plan->plan_image) }}"
                            alt="model image">
                    </div>
                </div>
            @elseif($projectRequest->type === 'design') 
                <div>
                    <label>Location:</label>
                    <input type="text" value="{{ $projectRequest->designRequest->work_location }}" readonly>
                </div>
                <div>
                    <label>Requirements:</label>
                    <textarea readonly>{{ $projectRequest->designRequest->requirements }}</textarea>
                </div>
                <div>
                    <label>Additional Info:</label>
                    <textarea readonly>{{ $projectRequest->designRequest->additional_info }}</textarea>
                </div>
                <div>
                    <label>Model Image:</label><br>
                    <img class="modelImage" src="{{ asset($projectRequest->designRequest->design->design_image) }}"
                        alt="model image">
                </div>

            @endif
        <div>
            <form action="{{route('admin.terminateRequest', $projectRequest->id)}}" method="post">
                @csrf
                @method('PUT') 
                <button class="delete-btn" style="margin-top:20px;padding:10px;width:100%"
                    type="submit">terminate</button>
            </form>
        </div>
    </div>

</div>
</div>
</div>

<script>
    // Get modal element
    const budgetModal = document.getElementById("budget-modal");

    // Get the buttons that open the modal
    const sendBudgetButtons = document.querySelectorAll('.send-budget-btn');

    sendBudgetButtons.forEach(button => {
        button.onclick = function () {
            budgetModal.style.display = "block";
        };
    });

    // Get the <span> element that closes the modal
    const closeModal = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    closeModal.onclick = function () {
        budgetModal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target === budgetModal) {
            budgetModal.style.display = "none";
        }
    };
</script>
@endsection