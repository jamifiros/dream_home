<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Plans</title>
</head>
<style>
    /* General Styles */
body {
    background-color: #1c1c1c;
    color: #f7f7f7;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #343a40;
    padding: 15px 30px;
}

nav .title h1 {
    color: #ffffff;
    margin: 0;
    font-size: 24px;
    text-decoration: none;
}

nav .nav-links {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

nav .nav-links li {
    margin-left: 20px;
}

nav .nav-links li a {
    color: #f7f7f7;
    text-decoration: none;
    transition: color 0.5s ease;
}

nav .nav-links li a:hover {
    color: #b5b5b5;
}

footer {
    text-align: center;
    padding: 5px;
    background-color: #bb86fc;
    color: #f7f7f7;
}
/* Manage Plans and Gallery Section */
#manage-plans, #manage-plan-gallery {
    margin: 40px auto;
    padding: 20px;
    background-color: #282828;
    border-radius: 10px;
    width: 90%;
    max-width: 1200px;
}

#manage-plans h2, #manage-plan-gallery h2 {
    font-size: 28px;
    margin-bottom: 20px;
}

.spacer {
    height: 40px;
}

.gallery-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.gallery-actions .btn-add {
    padding: 10px 20px;
    background-color: #BB86FC;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.gallery-actions .btn-add:hover {
    background-color: #8A2C8C;
    cursor: pointer;
}

/* Table Styles */
table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

table th, table td {
    border: 1px solid #343a40;
    padding: 15px;
    text-align: center;
}

table th {
    background-color: #282828;
    color: #ffffff;
}

table td {
    background-color: #1c1c1c;
    color: #b5b5b5;
}

/* Action Buttons */
.edit-btn, .delete-btn {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
    color: #ffffff;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.edit-btn {
    background-color: #BB86FC;
}

.delete-btn {
    background-color: #E74C3C;
}

.edit-btn:hover {
    background-color: #8A2C8C;
}

.delete-btn:hover {
    background-color: #C0392B;
}

.modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    background-color: rgba(0,0,0,0.5); 
  }
  
  .modal-content {
    background-color: #000;
    margin: 15% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
  }
  
  .close {
    color: red;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover, .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

  form{
    background-color: rgba(0,0,0,0.5);
    padding: 10px 20px;
  }
.form-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.form-label {
    width: 48%;
}

.form-label.full-width {
    width: 100%;
    margin-top: 10px;
    text-align: center;
}

.form-label input, .form-label select {
    display: block;
    width: 100%;
    padding: 10px;
    border: 1px solid rgb(200, 200, 200);
    border-radius: 5px;
    background-color: rgb(240, 240, 240);
    color: black;
}

.form-label input:focus, .form-label select:focus {
    outline: none;
    border: 1px solid rgb(150, 150, 150);
}

.form-label button {
    color: white;
    width: 100%;
    padding: 10px;
    background-color: rgb(187, 134, 252); /* Violet color for button */
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.form-label button:hover {
    background-color: rgb(138, 44, 140); /* Darker violet on hover */
}

a {
    color: #BB86FC;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}
</style>
<body>
    <nav>
        <div class="title">
            <a href="admin.html"><h1>Admin Dashboard</h1></a>
        </div>
        <ul class="nav-links">
            <li><a href="Homepag2.html">Home</a></li>
            <li><a href="plan_gallery.html">Plan Gallery</a></li>
            <li><a href="designer_gallery.html">Designer Gallery</a></li>
            <li><a href="admin.html">Admin</a></li>
        </ul>
    </nav>

    <section id="manage-plans">
        <h2>Manage Plans</h2>
        <table>
            <thead>
                <tr>
                    <th>Custom Plan ID</th>
                    <th>Client ID</th>
                    <th>Area (sqft)</th>
                    <th>No. of Floors</th>
                    <th>No. of BHK</th>
                    <th>No. of Bathrooms</th>
                    <th>Payment</th>
                    <th>Requirements</th>
                    <th>Additional Notes</th>
                    <th>Plan ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>101</td>
                    <td>1500</td>
                    <td>2</td>
                    <td>3</td>
                    <td>2</td>
                    <td>Paid</td>
                    <td>Modern style with open kitchen</td>
                    <td>No additional notes</td>
                    <td>5</td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>102</td>
                    <td>2400</td>
                    <td>3</td>
                    <td>4</td>
                    <td>3</td>
                    <td>Not Paid</td>
                    <td>Vintage style with large courtyard</td>
                    <td>Budget friendly</td>
                    <td>5</td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <div class="spacer"></div>

    <section id="manage-plan-gallery">
        <h2>Manage Plan Gallery</h2>
        <div class="gallery-actions">
            <p>View and manage plans displayed in the gallery below:</p>
            <!-- <a href="{{route('admin.addplan')}}" class="btn-add">Add New Plan</a> -->
            <button class="btn-add" id="btnOpenModal">Add New Plan</button>
        </div>
        <div id="myModal" class="modal" style="display: none;">
            <div class="modal-content">
               <span class="close">&times;</span>
               <h2>Add New Plan</h2>
               <form id="addPlanForm" method="POST" action="{{ route('admin.create') }}" >
               <h2>Register</h2>
               <div class="form-row">
                  <div class="form-label"> 
                     <label for="name">Plan Name</label>
                     <input type="text" name="plan_name">
                  </div>
            </div>
            <div class="form-row">
                <div class="form-label">
                    <label for="type">Type</label>
                    <select name="plan_type" id="type" >
                        <option disabledb selected>--select type--</option>
                        <option value="modern">Modern</option>
                        <option value="traditional">traditional</option>
                        <option value="minimalist">minimalist</option>
                        <option value="luxuary">luxuary</option>
                        <option value="villa">villa</option>
                        <option value="eco friendly">eco friendly</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"> 
                    <label for="post">No of bedrooms</label>
                    <input type="number" name="no_bhk">
                </div>
                <div class="form-label"> 
                    <label for="pincode">no of bathrooms</label>
                    <input type="number" name="no_bathrooms">
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
                <tr>
                    <td>1</td>
                    <td>Luxury Villa Plan</td>
                    <td><img src="plan2.png" alt="Plan Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Traditional Bungalow</td>
                    <td><img src="plan2.png" alt="Plan Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
        
                <tr>
                    <td>3</td>
                    <td>Minimalist Apartment</td>
                    <td><img src="plan2.png" alt="Plan Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
        
                <tr>
                    <td>4</td>
                    <td>Luxury Mansion</td>
                    <td><img src="plan2.png" alt="Plan Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
        
                <tr>
                    <td>5</td>
                    <td>Eco-Friendly House</td>
                    <td><img src="plan2.png" alt="Plan Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
        
                <tr>
                    <td>6</td>
                    <td>Modern Townhouse</td>
                    <td><img src="plan2.png" alt="Plan Image" width="100"></td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> | 
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; 2024 CUSTOM HOME BUILDER</p>
    </footer>

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

</body>
</html>
