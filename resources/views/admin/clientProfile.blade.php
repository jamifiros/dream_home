@extends('admin.layout')
@section('content')
    
      
    <div id="view-profile">
        <div class="profile-card client-prfl">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVNN58XFDLxdqtwwWRSE924NjtuSryXFGxjg&s" alt="Profile Picture" class="profile-pic">
            <h3>name here</h3>
            <h5>client id: 003</h5>
        </div>
        
        <div class="details-card">
            <h2>Personal Details</h2>
            <div class="details">
                <div>
                    <label>Name:</label>
                    <input type="text" value="John Doe" readonly>
                </div>
                <div>
                    <label>Email:</label>
                    <input type="email" value="john.doe@example.com" readonly>
                </div>
                <div>
                    <label>POST:</label>
                    <input type="text" value="Manager" readonly>
                </div>
                <div>
                    <label>Pincode:</label>
                    <input type="text" value="123456" readonly>
                </div>
                <div>
                    <label>Place:</label>
                    <input type="text" value="City Name" readonly>
                </div>
                <div>
                    <label>Landmark:</label>
                    <input type="text" value="Near Park" readonly>
                </div>
                <div>
                    <label>ID Proof Type:</label>
                    <input type="text" value="Passport" readonly>
                </div>
                <div>
                    <label>Contact:</label>
                    <input type="text" value="+1234567890" readonly>
                </div>
            </div>
        </div>
    </div>

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
                
            </tbody>
        </table>
    </div>

@endsection
