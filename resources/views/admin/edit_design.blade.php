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
        <form id="addDesignForm" method="POST" action="{{ route('admin.updateDesign',$design->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <span class="close" onclick="history.back()" >&times;</span>
               <h2>Edit Design</h2>
               <div class="form-row">
                  <div class="form-label"> 
                     <label for="name">Design Name</label>
                     <input type="text" name="design_name" value="{{$design->design_name}}">
                  </div>
            </div>
            <div class="form-row">
                <div class="form-label">
                    <label for="type">Type</label>
                    <select name="design_type" id="type" >
                        <option disabledb selected>--select type--</option>
                        <option value="type1"  {{ $design->design_type == 'type1' ? 'selected' : '' }}>Type1</option>
                        <option value="type2"  {{ $design->design_type == 'type2' ? 'selected' : '' }}>Type2</option>
                        <option value="type3"  {{ $design->design_type == 'type3' ? 'selected' : '' }}>Type3</option>
                        <option value="type4"  {{ $design->design_type == 'type4' ? 'selected' : '' }}>Type4</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-label"> 
                    <label for="">estimated cost</label>
                    <input type="number" name="estimated_cost" value="{{$design->estimated_cost}}">
                </div>
            </div>
            
            <div class="form-label full-width"> 
                <img src="{{ asset($design->design_image) }}" alt="Plan Image" width="250px" height="250px"><br>
            
                <label for="design_image">Add new Image</label>
                <input type="file" name="design_image">
            </div>
            <div class="form-label full-width">
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
