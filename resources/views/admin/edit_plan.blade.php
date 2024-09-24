<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Plan</title>
    <style>
      body{
            background-color: #000;
        }
        form{
            width: 60%;
    background-color:#fff;
    padding: 30px 30px 20px;
    margin: auto;
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

    </style>
</head>
<body>
    <div class="form-div">
        <form id="editPlanForm" method="POST" action="{{ route('admin.updatePlan', $plan->plan_id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <span class="close" onclick="history.back()" >&times;</span>

            <h2>Edit Plan</h2>
            <div class="form-row">
                <div class="form-label  full-width"> 
                    <label for="name">Plan Name</label>
                    <input type="text" name="plan_name" value="{{ $plan->plan_name }}" required>
                </div>
            </div>
            <div class="form-row ">
                <div class="form-label  full-width">
                    <label for="type">Type</label>
                    <select name="plan_type" id="type" required>
                        <option value="" disabled>Select type</option>
                        <option value="modern" {{ $plan->plan_type == 'modern' ? 'selected' : '' }}>Modern</option>
                        <option value="traditional" {{ $plan->plan_type == 'traditional' ? 'selected' : '' }}>Traditional</option>
                        <option value="minimalist" {{ $plan->plan_type == 'minimalist' ? 'selected' : '' }}>Minimalist</option>
                        <option value="luxuary" {{ $plan->plan_type == 'luxuary' ? 'selected' : '' }}>Luxuary</option>
                        <option value="villa" {{ $plan->plan_type == 'villa' ? 'selected' : '' }}>Villa</option>
                        <option value="eco friendly" {{ $plan->plan_type == 'eco friendly' ? 'selected' : '' }}>Eco Friendly</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"> 
                    <label for="no_bhk">No of Bedrooms</label>
                    <input type="number" name="no_bhk" value="{{ $plan->no_bhk }}" required>
                </div>
                <div class="form-label"> 
                    <label for="no_bathroom">No of Bathrooms</label>
                    <input type="number" name="no_bathroom" value="{{ $plan->no_bathroom }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-label"> 
                    <label for="no_floor">No of Floors</label>
                    <input type="number" name="no_floor" value="{{ $plan->no_floor }}" required>
                </div>
                <div class="form-label"> 
                    <label for="estimated_cost">Estimated Cost</label>
                    <input type="number" name="estimated_cost" value="{{ $plan->estimated_cost }}" required>
                </div>
            </div>
            
            <div class="form-label full-width"> 
                <img src="{{ asset($plan->plan_image) }}" alt="Plan Image" width="250px" height="250px"><br>
            
                <label for="plan_image">Add new Image</label>
                <input type="file" name="plan_image">
            </div>
            <div class="form-label full-width">
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
