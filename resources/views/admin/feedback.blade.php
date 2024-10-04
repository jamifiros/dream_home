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
                        <th>Project ID</th>
                        <th>Feedback</th>
                        <th>Rating</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{$feedback->client_id}}</td>
                        <td>{{$feedback->project_id}}</td>
                        <td>{{$feedback->comments}}</td>
                        <td><span class="review-stars" data-rating="{{$feedback->rating}}" style="color:gold"></span></td>
                        <td>{{$feedback->notes}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </section>
    </main>

    <script>
    // Get all review-stars elements
    const reviewStarsElements = document.querySelectorAll('.review-stars');
    // Loop through each review-stars element
    reviewStarsElements.forEach(function(reviewStars) {
        // Get the rating for the current feedback
        const rating = parseInt(reviewStars.dataset.rating, 10);

        // Generate the stars based on the rating
        const stars = '\u2605'.repeat(rating) + '\u2606'.repeat(5 - rating);

        // Set the generated stars as the content of the current review stars element
        reviewStars.innerHTML = stars;
    });
</script>

@endsection
