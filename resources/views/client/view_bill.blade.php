@extends('client.layout')
@section('content')
<main>
        <h1>Your Bills</h1>
        <section class="bills-container">
            <h2>Bill List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Project ID</th>
                        <th>Type</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>Bill</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $bill)
                    <tr>
                        <td>{{$bill->project->id}}</td>
                        <td>{{$bill->project->projectRequest->type}}</td>
                        <td>{{$bill->amount}}</td>
                        <td>{{$bill->status}}</td>
                        <td><a href="{{route('client.bill',$bill->project->id)}}" class="view-btn">view Bill</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection    