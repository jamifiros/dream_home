@extends('architect.layout')

@section('content')

<section id="manage-plan-gallery">
    <h2>Manage Plan Gallery</h2>
    <div class="gallery-actions">
        <p>View and manage plans displayed in the gallery below:</p>
        <button class="btn-add" id="btnOpenModal">Add New Plan</button>
    </div>
    <div id="myModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Plan</h2>
            <form id="addPlanForm" method="POST" action="{{ route('architect.createPlan') }}"
                enctype="multipart/form-data">
                @csrf
                <h2>Register</h2>
                <div class="form-row">
                    <div class="form-label full-width">
                        <label for="name">Plan Name</label>
                        <input type="text" name="plan_name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label">
                        <label for="type">Type</label>
                        <select name="plan_type" id="type">
                            <option disabledb selected>--select type--</option>
                            <option value="modern">Modern</option>
                            <option value="traditional">traditional</option>
                            <option value="luxuary">luxuary</option>
                        </select>
                    </div>
                    <div class="form-label">
                        <label for="sqft">Area in Sqft</label>
                        <input type="number" name="sqft">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label">
                        <label for="post">No of bedrooms</label>
                        <input type="number" name="no_bhk">
                    </div>
                    <div class="form-label">
                        <label for="pincode">no of bathrooms</label>
                        <input type="number" name="no_bathroom">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label">
                        <label for="place">no of floor</label>
                        <input type="number" name="no_floor">
                    </div>
                    <div class="form-label">
                        <label for="landmark">estimated cost</label>
                        <input type="number" name="estimated_cost">
                    </div>
                </div>

                <div class="form-label full-width">
                    <label for="id-proof">add plan image</label>
                    <input type="file" name="plan_image">
                </div>
                <div class="form-label full-width">
                    <button type="submit">Add</button>
                </div>

            </form>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Plan ID</th>
                <th>Plan Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plans as $plan)
                <tr>
                    <td>{{ $plan->id }}</td>
                    <td>{{ $plan->plan_name }}</td>
                    <td><img src="{{ asset($plan->plan_image) }}" alt="Plan Image" width="100"></td>
                    <td>
                        <a href="{{route('architect.editform', $plan->id)}}" class="edit-btn">Edit</a> |
                        <a href="{{route('architect.deletePlan', $plan->id)}}" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

<!-- success message -->
@if (session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
<script>
    // Get modal and button elements
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("btnOpenModal");
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on the close (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }


    // When the user clicks anywhere outside the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var editmodal = document.getElementById("edit-modal");
    var btnEdit = document.getElementById("btnOpeneditModal");

    // When the user clicks the button, open the modal
    btnEdit.onclick = function () {
        editmodal.style.display = "block";
    }

    // When the user clicks on the close (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }


    // When the user clicks anywhere outside the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            editmodal.style.display = "none";
        }
    }


</script>

@endsection