@extends('admin.layout')

@section('content')

    <main>
        <h1>Client Feedback and Ratings</h1>
        
        <section class="feedback-container">
            <h2>Feedback List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Feedback</th>
                        <th>Rating</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>201</td>
                        <td>Great design and service!</td>
                        <td>5</td>
                        <td>Very satisfied with the outcome.</td>
                    </tr>
                    <tr>
                        <td>202</td>
                        <td>Good work but delayed delivery.</td>
                        <td>3</td>
                        <td>Needs improvement in meeting deadlines.</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
@endsection
