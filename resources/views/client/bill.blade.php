@extends('client.layout')
@section('content')

<div class="main-container" id="payment-container">
    <div id="printable" class="card left-card">
        <div class="invoice-header">
            <h1 style="text-align: center;">Custom Home Builder</h1>
            <h2 style="text-align: center;">INVOICE</h2>
        </div>
        <div class="client-info">
            <p><strong>Client Name:</strong>{{ $project->client->user->name}}</p>
            <p><strong>Address:</strong>{{ $project->client->landmark}}, {{ $project->client->place}},
                {{ $project->client->post}}, {{ $project->client->pincode}}
            </p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($project->payment->created_at)->format('d-m-y') }}</p>
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

    <div id="payment-info" class="card right-card">
        @if ($project->payment->status === 'paid')
            <div>
                <div class="modal-content">
                    <h2>Payment Confirmation</h2>
                    <p>Your payment has been processed successfully!</p>
                    <a class="btn" href="{{route('client.reviewForm',$project->id)}}">Give Feedback!</a>
                </div>
            </div>
        @else
            <h2>Choose your payment method</h2>

            <div class="tabs" style="gap:10px">
                <button class="tablinks active" onclick="openTab(event, 'credit')">Credit/Debit Card</button>
                <button class="tablinks" onclick="openTab(event, 'bank')">Bank Transfer</button>
                <button class="tablinks" onclick="openTab(event, 'upi')">UPI</button>
            </div>

            <div id="credit" class="tabcontent">
                <label for="">Amount</label>
                <input type="text" value="{{$total_amount}}" readonly>
                <div class="tab-input">
                    <label for="card-number">Card Number</label>
                    <input type="text" id="card-number" placeholder="1234 5678 9101 1121">
                    <label for="expiry">Expiry Date</label>
                    <input type="text" id="expiry" placeholder="MM/YY">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" placeholder="123">
                </div>
                <form style="background-color:transparent" method="POST"
                    action="{{ route('client.makePayment', $project->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" value="by card" name="payment_method" hidden>
                    <input type="text" name="amount" value="{{$total_amount}}" hidden>
                    <button type="submit" class="pay-btn" onclick="return confirm('Are you sure to proceed payment?')">Pay
                        Now</button>
                </form>
            </div>

            <div id="bank" class="tabcontent">
                <label for="">Amount</label>
                <input type="text" value="{{$total_amount}}" readonly>
                <p><strong>Account Number:</strong> 9876543210</p><br>
                <p><strong>IFSC Code:</strong> ABCD0123456</p><br>

                <form style="background-color:transparent" method="POST"
                    action="{{ route('client.makePayment', $project->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" value="by bank_transfer" name="payment_method" hidden>
                    <input type="text" name="amount" value="{{$total_amount}}" hidden>
                    <button type="submit" class="pay-btn" onclick="return confirm('Are you sure to proceed payment?')">Pay
                        Now</button>
                </form>
            </div>

            <div id="upi" class="tabcontent">
                <label for="">Amount</label>
                <input type="text" value="{{$total_amount}}" readonly>
                <div class="tab-input">
                    <label for="upi-id">Enter your UPI ID</label>
                    <input type="text" id="upi-id" placeholder="example@upi">
                </div>
                <form style="background-color:transparent" method="POST"
                    action="{{ route('client.makePayment', $project->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" value="by upi" name="payment_method" hidden>
                    <input type="text" name="amount" value="{{$total_amount}}" hidden>
                    <button type="submit" class="pay-btn" onclick="return confirm('Are you sure to proceed payment?')">Pay
                        Now</button>
                </form>
            </div>
        @endif
        <div class="print-container">
            <button class="print-btn" onclick="printInvoice()">Print INVOICE</button>
        </div>
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