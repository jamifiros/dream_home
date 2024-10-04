@extends('client.layout')
@section('content')


<section id="feedback-form">
    <div class="form-container">
        <h2>Send Us Your Feedback</h2>
        <form method="POST" action="{{ route('client.storeFeedback', $project->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="rating">Rate Us</label>
                <div class="rating">
                    <input value="1" type="radio" id="star5" name="rate" required>
                    <label title="Excellent!" for="star5">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                            <path
                                d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                            </path>
                        </svg>
                    </label>
                    <input value="2" name="rate" id="star4" type="radio" required>
                    <label title="Great!" for="star4">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                            <path
                                d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                            </path>
                        </svg>
                    </label>
                    <input value="3" name="rate" id="star3" type="radio" required>
                    <label title="Good" for="star3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                            <path
                                d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                            </path>
                        </svg>
                    </label>
                    <input value="4" name="rate" id="star2" type="radio" required>
                    <label title="Okay" for="star2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                            <path
                                d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                            </path>
                        </svg>
                    </label>
                    <input value="5" name="rate" id="star1" type="radio" required>
                    <label title="Bad" for="star1">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                            <path
                                d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                            </path>
                        </svg>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="comments">Your Feedback</label>
                <textarea id="comments" name="comments" placeholder="Write your Feedback here..." required></textarea>
            </div>
            <div class="form-group">
                <label for="notes">Additional Notes(Optional)</label>
                <textarea id="notes" name="notes" placeholder="Any additional notes type here..."></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Submit Feedback</button>
            </div>
        </form>
    </div>
</section>

<script>
    // Star Rating System
    const stars = document.querySelectorAll('.rating input');
    const labels = document.querySelectorAll('.rating label');

    function resetStars() {
        labels.forEach(label => {
            label.querySelector('svg').style.fill = 'none';
            label.querySelector('svg').style.opacity = '0.5';
        });
    }

    function highlightStars(rating) {
        resetStars();
        for (let i = 0; i < rating; i++) {
            labels[i].querySelector('svg').style.fill = '#BB86FC';
            labels[i].querySelector('svg').style.opacity = '1';
        }
    }

    stars.forEach((star, index) => {
        star.addEventListener('change', function () {
            highlightStars(index + 1);
        });
    });

    labels.forEach((label, index) => {
        label.addEventListener('mouseover', function () {
            highlightStars(index + 1);
        });

        label.addEventListener('mouseleave', function () {
            const checkedStar = document.querySelector('.rating input:checked');
            if (checkedStar) {
                highlightStars(parseInt(checkedStar.value));
            } else {
                resetStars();
            }
        });
    });
</script>

@endsection