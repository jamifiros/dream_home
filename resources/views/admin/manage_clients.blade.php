@extends('admin.layout')

@section('content')

<section id="manage-clients">
    <div class="table-card">
        <h2>Client Management Overview</h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td class="prfl-img">
                        @if($client->profile_image)
                            <img src="{{ asset($client->profile_image) }}" alt="{{ $client->user->name }}.jpg"/>
                        @else
                           <img src="{{asset('images/DpDefault.jpg')}}" alt="defaultDp.jpg">
                        @endif
                    </td>
                    <td>{{ $client->user->name }}</td>
                    <td>{{ $client->user->email }}</td>
                    <td>{{ $client->contact }}</td>
                    <td>{{ $client->place }}, {{ $client->landmark }},{{ $client->post }}(PO), {{ $client->pincode }}</td>
                    <td>
                       @if($client->id_proof)
                       <!-- Button to open modal -->
                       <button class="view-btn openIdBtn" data-idproof="{{ asset( $client->id_proof)}}" data-idtype="{{ $client->id_proof_type }}">View ID Proof</button>
                       @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Modal -->
<div id="idProofModal" class="Idmodal">
    <span class="close">&times;</span>
    <img class="modal-content" id="idProofImage">
    <div id="caption"></div>
</div>

<script>
    // Get the modal and elements
    var modal = document.getElementById("idProofModal");
    var modalImg = document.getElementById("idProofImage");
    var captionText = document.getElementById("caption");
    var span = document.getElementsByClassName("close")[0];

    // Loop over all buttons and attach event listeners
    document.querySelectorAll('.openIdBtn').forEach(function(button) {
        button.addEventListener('click', function() {
            // Open the modal and set the image source and caption
            modal.style.display = "block";
            modalImg.src = this.getAttribute('data-idproof');
            var idType = this.getAttribute('data-idtype');
            captionText.innerHTML = "ID Proof Type: <span>" + idType + "</span>";
        });
    });

    // Close the modal when the <span> (x) is clicked
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Close the modal when clicking outside the modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

@endsection
