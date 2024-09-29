@extends('client.layout')
@section('content')
<style>
    #enquiry {
        padding-top: 20px;

        section#plan {
            padding: 40px;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tablink {
            background-color: #343a40;
            color: white;
            padding: 15px 0;
            border: none;
            cursor: pointer;
            width: 20%;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .tablink.active {
            background-color: #BB86FC;
        }

        .tablink:hover {
            background-color: #8A2C8C;
        }

        .tabcontent {
            display: none;
            background-color: #282828;
            padding: 20px;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .btn-view {
            background-color: #008CBA;
        }

        .btn-view:hover {
            color: #008CBA;
        }



        /* Form Section Styling */
        #plan-request {
            padding: 30px;
            text-align: center;

        }

        .form-container {
            background-color: #282828;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #ffffff;
        }

        .form-group select,
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #f7f7f7;
            border-radius: 5px;
            background-color: #1c1c1c;
            color: #f7f7f7;
        }

        /* Split Form Inputs into Two Columns */
        .form-columns {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: end;
            column-gap: 20px;
        }

        .form-columns .form-group {
            width: 48%;
        }

        /* Button Styling */
        .submit-btn,

        .select-plan-btn,
        .select-design-btn {
            background-color: #BB86FC;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px 0;

        }

        .submit-btn:hover,
        .choose-plan-btn:hover,
        .select-plan-btn:hover {
            background-color: #8A2C8C;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow-y: scroll;
        }

        .modal-content {
            background-color: #282828;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 70%;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        /* Close button for the modal */
        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            color: #aaa;
            font-size: 28px;
            cursor: pointer;
        }

        .close:hover {
            color: #ffffff;
        }

        #design {
            text-align: center;
        }

        /* Grid Layout for Plan Cards in Modal */
        .design-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* Fixed to 3 columns */
            gap: 20px;
            margin-top: 20px;
        }

        .design-card {
            background-color: #282828;
            padding: 15px;
            /* Adjust padding for less width */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: transform 0.2s;
            width: 250px;
        }

        .design-card:hover {
            transform: scale(1.05);
            /* Slight zoom on hover */
        }

        .design-card img {
            width: 100%;
            height: 130px;
            /* Adjust height if needed */
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .design-card h3 {
            color: #ffffff;
        }

        .design-card p {
            color: #ffffff;
            margin-bottom: 10px;
        }

        /* Select button inside modal */
        .select-plan-btn {
            background-color: #BB86FC;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .select-plan-btn:hover {
            background-color: #8A2C8C;
        }

        label {
            text-align: left;
        }

        .button-group {
            flex-grow: 1;
            margin: auto;
        }

        .button-group input[type="radio"] {
            display: none;
        }

        .button-group label {
            display: inline-block;
            padding: 10px 20px;
            cursor: pointer;
            border: 1px solid #2b426d;
            background-color: #385c7e;
            color: white;
            border-radius: 15px;
            transition: all ease 0.2s;
            text-align: center;
            flex-grow: 1;
            flex-basis: 0;
            width: 90px;
            font-size: 13px;
            margin: 5px;
            box-shadow: 0px 0px 50px -15px #000000;
        }

        .button-group input[type="radio"]:checked+label {
            background-color: white;
            color: #02375a;
            border: 1px solid #2b426d;
        }

    }

    
</style>


<section id="enquiry">
    <div class="tabs">
        <button class="tablink active" onclick="openTab(event, 'plan')">For Plan</button>
        <button class="tablink" onclick="openTab(event, 'design')">for Design</button>
    </div>

    <div id="plan" class="tabcontent">
        <!-- Main Form Section -->
        <section id="plan-request">
            <div class="form-container">
                <h3>Provide Your Plot Details and Requirements</h3>
                <form action="{{ route('client.requestPlan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Choose Plan Button -->
                    <div class="form-group">
                        <!-- Modal for Plan Selection -->
                        <div id="planModal" class="modal">
                            <div class="modal-content">
                                <span class="close" id="closeModal">&times;</span>
                                <h3>Select a Plan</h3>
                                <div class="design-cards">
                                    @foreach($plans as $plan)
                                        <div class="design-card">
                                            <img src="{{asset($plan->plan_image)}}" alt="{{$plan->plan_name}}">
                                            <h3>{{$plan->plan_name}}</h3>
                                            <p>Size: {{$plan->sqft}}</p>
                                            <p>Estimated Cost: {{$plan->estimated_cost}}</p>
                                            <button type="button" class="select-plan-btn" id="select-pln-btn"
                                                data-plan-id="{{$plan->id}}">Select</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form Inputs Split into Two Columns -->
                    <div class="form-columns">
                        <div class="form-group">
                            <label for="plot-size">Plot Size</label>
                            <select id="plot-size" name="plot_size">
                                <option value="small">Small (up to 100 sqm)</option>
                                <option value="medium">Medium (100 - 500 sqm)</option>
                                <option value="large">Large (500+ sqm)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="location">Plot Location</label>
                            <input type="text" id="location" name="work_location" placeholder="Enter plot location"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="bedrooms">Number of Bedrooms</label>
                            <input type="number" id="bedrooms" name="no_bhk" min="1"
                                placeholder="Enter number of bedrooms" required>
                        </div>

                        <div class="form-group">
                            <label for="floors">Number of Floors</label>
                            <input type="number" id="floors" name="no_floors" min="1"
                                placeholder="Enter number of floors" required>
                        </div>

                        <div class="form-group">
                            <label for="bathrooms">Number of Bathrooms</label>
                            <input type="number" id="bathrooms" name="no_bathrooms" min="1"
                                placeholder="Enter number of bathrooms" required>
                        </div>

                        <div class="form-group btn-div">
                            <button type="button" class="choose-plan-btn" id="openModal">Select</button>

                            <label for="model">Selected Plan model:</label>
                            <input type="text" name="model_id" placeholder="select a plan model..." readonly>
                        </div>
                    </div>
                    <!-- Requirements and Additional Notes -->
                    <div class="form-group">
                        <label for="requirements">Requirements</label>
                        <textarea id="requirements" name="requirements" rows="4"
                            placeholder="Describe your requirements" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="additional-notes">Additional Notes</label>
                        <textarea id="additional-notes" name="additional_notes" rows="4"
                            placeholder="Any additional information you'd like to share"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="attachments">Upload Attachments</label>
                        <input type="file" id="attachments" name="attachments" accept=".jpg,.png,.pdf" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn">Send Request</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <!-- Design tab -->
    <div id="design" class="tabcontent">
        <!-- Main Form Section -->
        <section id="design-request">
            <div class="form-container">
                <h3 style="margin-bottom:30px">Provide Your Requirements for the Design</h3>
                <!-- Choose Design Button -->
                <form action="{{ route('client.requestDesign') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-columns" style="display:flex; justify-content:space-between;">
                        <div class="form-group">
                            <label for="location">work location</label>
                            <input type="text" name="work_location" placeholder="work location here..">
                        </div>
                        <div class="form-group">
                            <button type="button" class="choose-design-btn" id="openDesignModal">Select</button>
                            <label for="model">Selected Design model:</label>
                            <input type="text" name="design_model_id" placeholder="select design model..." readonly>
                        </div>
                    </div>

                    <!-- Modal for Design Selection -->
                    <div id="designModal" class="modal">
                        <div class="modal-content">
                            <span class="close" id="closeDesignModal">&times;</span>
                            <h3>Select a Design</h3>
                            <div class="design-cards">
                                @foreach($designs as $design)
                                    <div class="design-card">
                                        <img src="{{asset($design->design_image)}}" alt="{{$design->design_name}}">
                                        <h3>{{$design->design_name}}</h3>
                                        <button type="button" class="select-design-btn" id="select-design-btn"
                                            data-design-id="{{$design->id}}">Select</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Requirements and Additional Notes -->
                    <div class="form-group">
                        <label for="requirements">Requirements</label>
                        <textarea id="requirements" name="requirements" rows="4"
                            placeholder="Describe your requirements" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="additional-notes">Additional Notes</label>
                        <textarea id="additional-notes" name="additional_notes" rows="4"
                            placeholder="Any additional information you'd like to share"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="button-container">
                            <button type="submit" class="submit-btn">Send Request</button>
                        </div>
                    </div>
            </div>
        </section>

    </div>
</section>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get modal and buttons
    var modal = document.getElementById("planModal");
    var openModalBtn = document.getElementById("openModal");
    var closeModalBtn = document.getElementById("closeModal");

    // Open modal when button is clicked
    openModalBtn.addEventListener("click", function () {
        modal.style.display = "block";
    });

    // Close modal when close button is clicked
    closeModalBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Close modal when clicking outside of the modal
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });



    // Default open tab
    document.getElementById("plan").style.display = "block";

    // Design modal functionality (if needed)
    var designModal = document.getElementById("designModal");
    var openDesignModalBtn = document.getElementById("openDesignModal");
    var closeDesignModalBtn = document.getElementById("closeDesignModal");

    openDesignModalBtn.addEventListener("click", function () {
        designModal.style.display = "block";
    });

    closeDesignModalBtn.addEventListener("click", function () {
        designModal.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target === designModal) {
            designModal.style.display = "none";
        }
    });


    document.addEventListener("DOMContentLoaded", function () {
        // Get modal and buttons
        var modal = document.getElementById("planModal");
        var openModalBtn = document.getElementById("openModal");
        var closeModalBtn = document.getElementById("closeModal");


        // Open modal when button is clicked
        openModalBtn.addEventListener("click", function () {
            modal.style.display = "block";
        });

        // Close modal when close button is clicked
        closeModalBtn.addEventListener("click", function () {
            modal.style.display = "none";
        });

        // Close modal when clicking outside of the modal
        window.addEventListener("click", function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });


        // Modal functionality for Design Selection
        var designModal = document.getElementById("designModal");
        var openDesignModalBtn = document.getElementById("openDesignModal");
        var closeDesignModalBtn = document.getElementById("closeDesignModal");

        openDesignModalBtn.addEventListener("click", function () {
            designModal.style.display = "block";
        });

        closeDesignModalBtn.addEventListener("click", function () {
            designModal.style.display = "none";
        });

        window.addEventListener("click", function (event) {
            if (event.target === designModal) {
                designModal.style.display = "none";
            }
        });

        // Add event listener for selecting designs
        document.querySelectorAll(".select-design-btn").forEach(function (button) {
            button.addEventListener("click", function () {
                var designId = this.getAttribute("data-design-id");
                document.querySelector("input[name='design_model_id']").value = designId; // Set the value of the hidden input
                designModal.style.display = "none"; // Close the modal
            });
        });

        // Add event listener for selecting plans
        document.querySelectorAll(".select-plan-btn").forEach(function (button) {
            button.addEventListener("click", function () {
                var planId = this.getAttribute("data-plan-id");
                document.querySelector("input[name='model_id']").value = planId; // Set the value of the hidden input
                planModal.style.display = "none"; // Close the modal
            });
        });


    });
   
</script>

@endsection