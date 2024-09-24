@extends('admin.layout')

@section('content')

    <section id="new-client-requests">
        <div class="table-card">
            <h2>Client Requests Overview</h2>
            <table>
                <thead>
                    <tr>
                        <th>Plan ID</th>
                        <th>Client ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Estimated Budget</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>C001</td>
                        <td>John Doe</td>
                        <td>Plan</td>
                        <td><button class="send-budget-btn">Send Estimated Budget</button></td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>C002</td>
                        <td>Jane Smith</td>
                        <td>Design</td>
                        <td><button class="send-budget-btn">Send Estimated Budget</button></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal for Send Estimated Budget -->
    <div id="budget-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Send Estimated Budget</h2>
            <label for="estimated-amount">Enter Estimated Amount:</label>
            <input type="number" id="estimated-amount" placeholder="Enter amount">
            <div class="button-container">
                <button class="send-btn">Send</button>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>

    <script>
        // Get modal element
        const budgetModal = document.getElementById("budget-modal");

        // Get the buttons that open the modal
        const sendBudgetButtons = document.querySelectorAll('.send-budget-btn');

        sendBudgetButtons.forEach(button => {
            button.onclick = function() {
                budgetModal.style.display = "block";
            };
        });

        // Get the <span> element that closes the modal
        const closeModal = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        closeModal.onclick = function() {
            budgetModal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target === budgetModal) {
                budgetModal.style.display = "none";
            }
        };
    </script>
@endsection