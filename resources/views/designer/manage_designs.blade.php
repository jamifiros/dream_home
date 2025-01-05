@extends('designer.layout')
@section('content')

    <section id="manage-design-gallery">
        <h2>Manage Design Gallery</h2>
        <div class="gallery-actions">
            <p>View and manage designs displayed in the gallery below:</p>
            <button class="btn-add" id="btnOpenModal">Add New Design</button>
        </div>
        <!-- model -->
        <div id="myModal" class="modal" style="display: none;">
            <div class="modal-content">
               <span class="close">&times;</span>
               <h2>Add New Design</h2>
               <form id="addDesignForm" method="POST" action="{{ route('designer.createDesign') }}" enctype="multipart/form-data">
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
                        <option value="modern">Modern</option>
                            <option value="traditional">traditional</option>
                            <option value="luxuary">luxuary</option>
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
                    <th>Design Type</th>
                    <th>Estimated Cost</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forEach($designs as $design)
                <tr>
                    <td>{{$design->id}}</td>
                    <td>{{$design->design_type}}</td>
                    <td>{{$design->estimated_cost}}</td>
                    <td><img src="{{asset($design->design_image)}}" alt="Design Image" width="100"></td>
                    <td>
                    <a href="{{route('designer.editform', $design->id)}}" class="edit-btn">Edit</a>|                    | 
                        <a href="{{route('designer.deleteDesign',$design->id)}}" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>


                </tr>
               @endforeach
            </tbody>
        </table>
    </section>
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