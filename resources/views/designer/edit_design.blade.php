@extends('designer.layout')
@section('content')
<style>
    .flex-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: space-between;
    }
    .form-row{
        width:550px;
    }
    .form-label label{
            text-align:left;
        }
</style>
<div class="form-div">
    <form id="addDesignForm" method="POST" action="{{ route('designer.updateDesign', $design->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        <span class="close" onclick="history.back()">&times;</span>
        <h2>Edit Design</h2>
        <div class="flex-container">
            <div>
                <div class="form-row ">
                    <div class="form-label full-width">
                        <label for="name" style="text-align:left">Design Name</label>
                        <input type="text" name="design_name" value="{{$design->design_name}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label full-width">
                        <label for="type">Type</label>
                        <select name="design_type" id="type">
                            <option disabled selected>--select type--</option>
                            <option value="type1" {{ $design->design_type == 'type1' ? 'selected' : '' }}>Type1</option>
                            <option value="type2" {{ $design->design_type == 'type2' ? 'selected' : '' }}>Type2</option>
                            <option value="type3" {{ $design->design_type == 'type3' ? 'selected' : '' }}>Type3</option>
                            <option value="type4" {{ $design->design_type == 'type4' ? 'selected' : '' }}>Type4</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label full-width">
                        <label for="">estimated cost</label>
                        <input type="number" name="estimated_cost" value="{{$design->estimated_cost}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label full-width">
                        <label for="design_image">Add new Image</label>
                        <input type="file" name="design_image">
                    </div>
                </div>
            </div>

            <div class="form-label">
                <img src="{{ asset($design->design_image) }}" alt="Plan Image" width="250px" height="250px"><br>
            </div>
        </div>

        <div class="form-label full-width">
            <button type="submit">Update</button>
        </div>
    </form>
</div>

@endsection