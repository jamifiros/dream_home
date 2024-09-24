@extends('admin.layout')

@section('content')

    <section id="manage-designs">
        <h2>Manage Custom Designs</h2>
        <table>
            <thead>
                <tr>
                    <th>Custom Design ID</th>
                    <th>Client ID</th>
                    <th>Requirements</th>
                    <th>Additional Notes</th>
                    <th>Payment</th>
                    <th>Design Attachments</th>
                    <th>Design ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2</td>
                    <td>201</td>
                    <td>Modern design with glass facades</td>
                    <td>Requires approval for balcony extension</td>
                    <td>Paid</td>
                    <td><a href="design.jpg" target="_blank">View</a></td>
                    <td>7</td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>202</td>
                    <td>Classy design with Wooden accents</td>
                    <td>Requires approval for floor extension</td>
                    <td>Not Paid</td>
                    <td><a href="design.jpg" target="_blank">View</a></td>
                    <td>7</td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <div class="spacer"></div>

    <section id="manage-design-gallery">
        <h2>Manage Design Gallery</h2>
        <div class="gallery-actions">
            <p>View and manage designs displayed in the gallery below:</p>
            <button class="btn-add" id="btnOpenModal">Add Design</button>
        </div>

        <div id="myModal" class="modal" style="display: none;">
            <div class="modal-content">
               <span class="close">&times;</span>
               <h2>Add New Design</h2>
               <form id="addDesignForm" method="POST" action="{{ route('admin.createDesign') }}" enctype="multipart/form-data">
                @csrf
               <h2>Register</h2>
               <div class="form-row">
                  <div class="form-label"> 
                     <label for="name">Design Name</label>
                     <input type="text" name="design_name">
                  </div>
            </div>
            <div class="form-row">
                <div class="form-label">
                    <label for="type">Type</label>
                    <select name="design_type" id="type" >
                        <option disabledb selected>--select type--</option>
                        <option value="type1">Type1</option>
                        <option value="type2">Type2</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-label"> 
                    <label for="">estimated cost</label>
                    <input type="number" name="estimated_cost">
                </div>
            </div>
            
            <div class="form-label full-width"> 
                <label for="id-proof">add Design image</label>
                <input type="file" name="design_image">
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
                    <th>Design ID</th>
                    <th>Design Name</th>
                    <th>Type</th>
                    <th>Estimated Cost</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($designs as $design)
        <tr>
            <td>{{ $design->id }}</td>
            <td>{{ $design->design_name }}</td>
            <td>{{ $design->design_type }}</td>
            <td>{{ $design->estimated_cost }}</td>
            <td><img src="{{ asset($design->design_image) }}" alt="Plan Image" width="100"></td>
            <td>
                <a href="{{ route('admin.editDesign', $design->id) }}" class="edit-btn">Edit</a> | 
                <a href="{{ route('admin.deleteDesign', $design->id) }}" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
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
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on the close (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }


    // When the user clicks anywhere outside the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

</script>
@endsection
