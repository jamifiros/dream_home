@extends('admin.layout')

@section('content')


    <section id="manage-staff">
        <div class="table-card">
            <h2>Staff Management Overview</h2>
            <button class="btn-add" id="openModal">Add New Staff</button>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date of Join</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $staff)
                    
                    <tr>
                        <td>{{$staff->id}}</td>
                        <td class="prfl-img">
                        @if($staff->profile_image)
                            <img src="{{ asset( $staff->profile_image) }}" alt="{{ $staff->user->name }}.jpg"/>
                        @else
                           <img src="{{asset('images/DpDefault.jpg')}}" alt="defaultDp.jpg">
                        @endif
                    </td>
                        <td>{{$staff->user->name}}</td>
                        <td>{{$staff->user->email}}</td>
                        <td>{{$staff->user->role}}</td>
                        <td>{{ $staff->user->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{route('admin.viewstaffprofile',$staff->id)}}" class="view-btn">view</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Staff:</h2>
            <form id="staffForm" method="POST" action="{{route('admin.addStaff')}}" enctype="multipart/form-data">
            @csrf
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required onchange="checkEmail()">
                <div id="email-error"  style="color:red;display: none;"></div>
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="Architect">Architect</option>
                    <option value="Designer">Designer</option>
                </select>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
                <label for="gender">gender:</label>
                <input type="radio" name="gender" id="gender" value="male" required>male
                <input type="radio" name="gender" id="gender" value="female" required>female
                <input type="radio" name="gender" id="gender" value="others" required>others
                <br>
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" required>
                <label for="post">Post:</label>
                <input type="text" id="post" name="post" required>
                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" required>
                <label for="password">Set password:</label>
                <input type="password" name="password" id="password" required>
                <label for="password_confirmation">Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
                <label for="profileImage">add Image:</label>
                <input type="file" name="profile_image" id="profile_image">
                <input type="submit" value="Add Staff">
            </form>

           @if ($errors->any())
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
            {{ $error }}<br>
          @endforeach
         </div>
        @endif


        </div>
    </div>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("openModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    function checkEmail() {
        const email = document.getElementById('email').value;
        const url = "{{ route('checkEmail') }}?email=" + encodeURIComponent(email);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const errorDiv = document.getElementById('email-error');
                if (data.exists) {
                    errorDiv.textContent = 'This email is already registered.';
                    errorDiv.style.display = 'block';
                } else {
                    errorDiv.style.display = 'none';
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
@endsection