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
                    <th>Status</th>
                    <th>estimated cost</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projectRequests as $projectRequest)                   
                    <tr>
                        <td>{{$projectRequest->id}}</td>
                        <td>{{$projectRequest->client->user->name}}</td>
                        <td>{{$projectRequest->type}}</td>
                        <td>{{$projectRequest->status}}</td>

                        {{-- Display Estimated Cost and Reset Button if status is refused --}}
                        @if ($projectRequest->status === 'refused')
                            @if ($projectRequest->type === 'plan')
                                <td>{{$projectRequest->planRequest->estimated_cost}}
                                </td>
                            @elseif ($projectRequest->type === 'design')
                                <td>{{$projectRequest->designRequest->estimated_cost}}
                                </td>
                            @endif
                        @else
                            @if ($projectRequest->type === 'plan')
                                <td>{{$projectRequest->planRequest->estimated_cost}}
                                </td>
                            @elseif ($projectRequest->type === 'design')
                                <td>{{$projectRequest->designRequest->estimated_cost}}
                                </td>
                            @endif
                        @endif
                        @if ($projectRequest->status === 'refused')
                            <td> <button class="send-budget-btn" style="margin-top:20px">Reset Estimated Cost</button>

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
                            </td>
                        @endif
                        <td><a href="{{ route('admin.requestDetails', $projectRequest->id) }}" class="view-btn">View
                                Details</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

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