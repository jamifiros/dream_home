@extends('admin.layout')
@section('content')


<div id="view-profile">
    <div class="profile-card client-prfl">
        @if($staff->profile_image)
            <img src="{{ asset($staff->profile_image) }}" class="profileimg" alt="{{ $staff->user->name }}.jpg" />
        @else
            <img src="{{asset('images/DpDefault.jpg')}}" class="profileimg" alt="defaultDp.jpg">
        @endif
        <h3>{{$staff->user->name}}</h3>
        <div class="action-btns">
            <div>
                <a href="#" class="view-btn" id="prjctmodalBtn">Projects</a>
                <a href="#" class="edit-btn" id="editmodalBtn">Edit profile</a>
            </div>
            <div>
                <a href="#" class="edit-btn" id="pswmodalBtn">Change password</a>
                <a href="{{route('admin.deleteStaff', $staff->id)}}" class="delete-btn"
                    onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </div>
        </div>
    </div>


    <!-- Modal 1: Projects -->
    <div id="prjctmodal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="projects-card">
                <h2>Projects</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Assigned Staff</th>
                            <th>Requirements</th>
                            <th>Cost</th>
                            <th>Status</th>
                            <th>Bill</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Plan</td>
                            <td>Architect</td>
                            <td>3 BHK House</td>
                            <td>$200,000</td>
                            <td>Completed</td>
                            <td><button class="view-bill">View Bill</button></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Plan</td>
                            <td>Architect</td>
                            <td>3 BHK House</td>
                            <td>$200,000</td>
                            <td>Completed</td>
                            <td><button class="view-bill">View Bill</button></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Plan</td>
                            <td>Architect</td>
                            <td>3 BHK House</td>
                            <td>$200,000</td>
                            <td>Completed</td>
                            <td><button class="view-bill">View Bill</button></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Plan</td>
                            <td>Architect</td>
                            <td>3 BHK House</td>
                            <td>$200,000</td>
                            <td>Completed</td>
                            <td><button class="view-bill">View Bill</button></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Plan</td>
                            <td>Architect</td>
                            <td>3 BHK House</td>
                            <td>$200,000</td>
                            <td>Completed</td>
                            <td><button class="view-bill">View Bill</button></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Plan</td>
                            <td>Architect</td>
                            <td>3 BHK House</td>
                            <td>$200,000</td>
                            <td>Completed</td>
                            <td><button class="view-bill">View Bill</button></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Plan</td>
                            <td>Architect</td>
                            <td>3 BHK House</td>
                            <td>$200,000</td>
                            <td>Completed</td>
                            <td><button class="view-bill">View Bill</button></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Plan</td>
                            <td>Architect</td>
                            <td>3 BHK House</td>
                            <td>$200,000</td>
                            <td>Completed</td>
                            <td><button class="view-bill">View Bill</button></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Plan</td>
                            <td>Architect</td>
                            <td>3 BHK House</td>
                            <td>$200,000</td>
                            <td>Completed</td>
                            <td><button class="view-bill">View Bill</button></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal 2: Edit Profile -->
    <div id="editmodal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Profile</h2>
            <!-- Edit Profile Form -->
            <form id="staffForm" method="POST" action="{{route('admin.updateStaff', $staff->id)}}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Method for updating -->

                @if($staff->profile_image)
                    <img src="{{ asset($staff->profile_image) }}" alt="{{ $staff->user->name }}.jpg" />
                @else
                    <img src="{{asset('images/DpDefault.jpg')}}" alt="defaultDp.jpg">
                @endif

                <label for="profile image">Profile image:</label>
                <input type="file" name="profile_image">
                <br>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $staff->user->name }}" readonly required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ $staff->user->email }}" readonly required>

                <label for="role">Role:</label>
                <select id="role" name="role" required readonly>
                    <option value="Architect" {{ $staff->user->role == 'Architect' ? 'selected' : '' }}>Architect</option>
                    <option value="Designer" {{ $staff->user->role == 'Designer' ? 'selected' : '' }}>Designer</option>
                </select>

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="{{ $staff->age }}" required>

                <label for="gender">Gender:</label>
                <input type="radio" name="gender" id="gender" value="male" {{ $staff->gender == 'male' ? 'checked' : '' }}
                    required> Male
                <input type="radio" name="gender" id="gender" value="female" {{ $staff->gender == 'female' ? 'checked' : '' }} required> Female
                <input type="radio" name="gender" id="gender" value="others" {{ $staff->gender == 'others' ? 'checked' : '' }} required> Others
                <br>

                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" value="{{ $staff->contact }}" required>

                <label for="post">Post:</label>
                <input type="text" id="post" name="post" value="{{ $staff->post }}" required>

                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" value="{{ $staff->pincode }}" required>

                <input type="submit" value="Update Profile">
            </form>
        </div>
    </div>

    <!-- Modal 3: Change Password -->
    <div id="pswmodal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Change Password</h2>
            <form id="staffForm" method="POST" action="{{route('admin.changePswd', $staff->id)}}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Method for updating -->
                <label for="password">change password:</label>
                <input type="password" name="password" id="password" required>
                <label for="password_confirmation">confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
                <input type="submit" value="change password">
            </form>

        </div>
    </div>
    <div class="details-card">
        <h2>Personal Details</h2>
        <div class="details">
            <div>
                <label>Name:</label>
                <input type="text" value="{{$staff->user->name}}" readonly>
            </div>
            <div>
                <label>Email:</label>
                <input type="email" value="{{$staff->user->email}}" readonly>
            </div>
            <div>
                <label>role:</label>
                <input type="text" value="{{$staff->user->role}}" readonly>
            </div>
            <div>
                <label>Age:</label>
                <input type="text" value="{{$staff->age}}" readonly>
            </div>
            <div>
                <label>Gender:</label>
                <input type="text" value="{{$staff->gender}}" readonly>
            </div>
            <div>
                <label>Date of Joining:</label>
                <input type="text" value="{{ $staff->user->created_at->format('d-m-Y') }}" readonly>
            </div>
            <div>
                <label>POST:</label>
                <input type="text" value="{{$staff->post}}" readonly>
            </div>
            <div>
                <label>Pincode:</label>
                <input type="text" value="{{$staff->pincode}}" readonly>
            </div>
            <div>
                <label>Contact:</label>
                <input type="text" value="{{$staff->contact}}" readonly>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the modals
    var prjctmodal = document.getElementById("prjctmodal");
    var editmodal = document.getElementById("editmodal");
    var pswmodal = document.getElementById("pswmodal");

    // Get the buttons that open the modals
    var prjctmodalBtn = document.getElementById("prjctmodalBtn");
    var editmodalBtn = document.getElementById("editmodalBtn");
    var pswmodalBtn = document.getElementById("pswmodalBtn");

    // Get the <span> elements that close the modals
    var closeBtns = document.querySelectorAll(".close");

    // Function to open the modal
    function openModal(modal) {
        modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal(modal) {
        modal.style.display = "none";
    }

    // Event listeners to open modals
    prjctmodalBtn.onclick = function () {
        openModal(prjctmodal);
    }

    editmodalBtn.onclick = function () {
        openModal(editmodal);
    }

    pswmodalBtn.onclick = function () {
        openModal(pswmodal);
    }

    // Event listeners to close modals
    closeBtns.forEach(function (btn) {
        btn.onclick = function () {
            closeModal(btn.closest(".modal"));
        }
    });

    // Close the modal if user clicks outside of it
    window.onclick = function (event) {
        if (event.target.classList.contains('modal')) {
            closeModal(event.target);
        }
    }
</script>


@endsection