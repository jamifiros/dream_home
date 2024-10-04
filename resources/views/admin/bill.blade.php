@extends('admin.layout')
@section('content')


<div class="main-container" id="payment-container">
    <div id="printable" class="card left-card" style="width:65%">
        <div class="invoice-header">
            <h1 style="text-align: center;">Custom Home Builder</h1>
            <h2 style="text-align: center;">INVOICE</h2>
        </div>
        <div class="client-info">
            <p><strong>Client Name:</strong>{{ $project->client->user->name}}</p>
            <p><strong>Address:</strong> 123 Main St, City, Country</p>
            <p><strong>Date:</strong> 2024-09-21</p>
            <p><strong>Invoice ID:</strong>{{ $project->payment->id}}</p>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$project->id}}</td>
                    <td>{{$project->projectrequest->type}}</td>
                    @if($project->projectrequest->type === 'plan')
                        <td>{{$project->projectrequest->planRequest->requirements}}</td>
                        <td>{{$project->projectrequest->planRequest->estimated_cost}}</td>
                    @elseif($project->projectrequest->type === 'design')
                        <td>{{$project->projectrequest->designRequest->requirements}}</td>
                        <td>{{$project->projectrequest->designRequest->estimated_cost}}</td>
                    @endif
                </tr>

                <tr>
                    <td colspan="3">SGST(9%)</td>
                    <td>{{$sgst}}</td>
                </tr>
                <tr>
                    <td colspan="3">CGST(9%)</td>
                    <td>{{$cgst}}</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Net Total</strong></td>
                    <td><strong>{{$total_amount}}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="invoice-footer">
            <div class="thank-you-box">
                <p>Thank you for choosing Custom Home Builder!</p>
                <p><strong>Address:</strong> 123 Builder Lane, City, Country</p>
                <p><strong>Contact:</strong> (123) 456-7890</p>
            </div>
        </div>
    </div>

    <div id="payment-info" class="card right-card" style="width:35%">
        @if ($project->payment->status === 'paid')
            <div>
                <div class="modal-content">
                    <h2>Payment Confirmation</h2>
                    <p>Payment has been processed successfully!</p>
                </div>
            </div>
        @else
            <form style="background-color:transparent" method="POST"
                action="{{ route('client.makePayment', $project->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="text" value="by cash" name="payment_method" hidden>
                <button type="submit" class="pay-btn" onclick="return confirm('Are you sure to proceed payment?')">Mark Paid
                    by cash</button>
            </form>
        @endif
        <button class="print-btn" onclick="printInvoice()" style="width:100%">Print INVOICE</button>
    </div>
</div>

<!-- Modal Structure -->

<div id="myModal" class="modal" style="top:80px;background-color:rgba(0,0,0,0.7)">
    <div class="modal-content">
        <p style="margin-bottom:10px">Paid By cash Updated successfully</p>
        <button onclick="closeModal()">Close</button>
    </div>
</div>


<script>
    function redirectToFeedback() {
        window.location.href = "feedback.html";
    }

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function openModal() {
        document.getElementById("myModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    function printInvoice() {
        var printContent = document.getElementById("printable").innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        document.body.style.color = "#000"; // Change text color to black
        window.print();
        document.body.innerHTML = originalContent;
        location.reload(); // Reload the page to restore original content
    }

    document.querySelectorAll('.pay-btn').forEach(btn => {
        btn.addEventListener('click', openModal);
    });

    // Default open tab
    document.getElementById("credit").style.display = "block";
</script>
@endsection