<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Baliwag Bus Booking Admin</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="../images/new_baliwag_logo.png" alt="Baliwag Logo">
        </div>
        <button onclick="showSection('records')">Bus Records</button>
        <button onclick="showSection('booking')">Bus Booking</button>

        <div class="logout-btn-wrapper">
            <button id="logout" onclick="window.location.href='index.php'">Logout</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <!-- Manage RECORDS SECTIONNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN__------------------------------------- -->
        <div id="records" class="section">
            <h3>Bus Records</h3>
            <button onclick="openModal()" style=" margin-bottom: 10px;">+
                Add Bus</button>
            <div id="containerBusses">
                <!-- Baliwag example -->
                <div onclick="showBusInfo()" id="busses">
                    <strong>Baliwag 7820</strong>
                    <img id="imgbus" src="../images/baliwag_frontView.png" alt="Bus Picture">
                </div>
                <!-- Golden Bee example tanggalin mo tong isa another ex lng yan -->
                <div onclick="showBusInfo()" id="busses">
                    <strong>Baliwag 7820</strong>
                    <img id="imgbus" src="../images/gb_frontView.png" alt="Bus Picture">
                </div>
            </div>

            <!-- Bus Info Modal if pic is cliked -->
            <div id="busInfoModal">
                <div id="innerbusInfoModal">
                    <span id="xbutt" onclick="closeBusInfo()">×</span>

                    <h3 style="text-align: center;">Baliwag 7820</h3>
                    <hr style="margin-bottom: 15px;">
                    <p><strong>Route:</strong> Cabanatuan - Manila</p>
                    <p><strong>Travel Time:</strong> 1: 00 PM</p>
                    <p><strong>Total Fare:</strong> ₱300</p>
                    <p><strong>Plate No.:</strong> ABC1234</p>
                    <p><strong>Driver:</strong> Juan Dela Cruz</p>
                    <p><strong>Driver Contact:</strong> 09123456789</p>
                    <p><strong>Conductor:</strong> Pedro Santos</p>
                    <p><strong>Conductor Contact:</strong> 09123456789</p>
                    <div class="button-container">
                        <button id="btnInfMod" class="button">Edit</button>
                    </div>
                </div>
            </div>

            <!-- ADD BUS BUTTON IN BUS RECORDS MODALLLLLLLLLL -------------------------------------------->
            <div id="busModal">
                <!-- Modal Box -->
                <div id="modalbusbutton">
                    <span onclick="closeModal()" id="closeModal">x</span>
                    <h3 style="width: 100%;">Add Bus</h3>
                    <!-- Image Upload -->
                    <div style="flex: 1 1 220px;">
                        <label>Bus Image:</label><br>
                        <div id="imageUpload">
                            <input type="file" accept="image/*" onchange="previewImage(event)" style="display: none;"
                                id="busImageInput">
                            <label for="busImageInput" style="cursor: pointer;">
                                <img id="previewImage" src="../images/add_img_photo.jpg" alt="Add Image">
                            </label>
                        </div>
                    </div>

                    <!-- Form Inputs in add bus button -->
                    <div id="formouter">
                        <div id="forminner">
                            <label>Bus Name:</label><br>
                            <select style="width: 87%; padding: 10px;">
                                <option value="Baliwag">Baliwag</option>
                                <option value="Golden Bee">Golden Bee</option>
                            </select>
                        </div>
                        <div id="forminner">
                            <label>Driver Name:</label><br>
                            <input id="formtext" type="text">
                        </div>
                        <div id="forminner">
                            <label>Bus No.:</label><br>
                            <input id="formtext" type="text">
                        </div>
                        <div id="forminner">
                            <label>Driver Contact:</label><br>
                            <input id="formtext" type="text">
                        </div>
                        <div id="forminner">
                            <label>Plate No.:</label><br>
                            <input id="formtext" type="text">
                        </div>
                        <div id="forminner">
                            <label>Conductor Name:</label><br>
                            <input id="formtext" type="text">
                        </div>
                        <div id="forminner">
                            <label>Route:</label><br>
                            <input id="formtext" type="text">
                        </div>
                        <div id="forminner">
                            <label>Conductor Contact:</label><br>
                            <input id="formtext" type="text">
                        </div>
                        <div id="forminnerr">
                            <label>Travel Time:</label><br>
                            <input id="formtime" type="time" step="3600">
                        </div>
                    </div>
                    <!-- Confirm Button -->
                    <div id="confbut">
                        <button id="confbutt">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- PANGALAWANG SECTIONNNNNNNNNNNNNNNNNNNNNNNN ------------------- BUS BOOKING SECTION ------------------------------------------------>
        <div id="booking" class="section hidden">
            <h3>Bus Booking</h3>
            <button onclick="openBookingModal()">+ Add Booking</button>
            <!-- ACEEPTED BOOKINGS SECTION ------------------------------------------------>
            <h3>Accepted Bookings</h3>
            <div id="outerAccepted">
                <table id="tblAccepted">
                    <thead id="theadAccepted">
                        <tr>
                            <th>Reference No.</th>
                            <th>Passenger Name</th>
                            <th>Contact</th>
                            <th>Bus Name</th>
                            <th>Bus Number</th>
                            <th>Route</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- laman ng table accepted -->
                        <tr>
                            <td>ZXC9823</td>
                            <td>Juan Dela Cruz</td>
                            <td>09123456789</td>
                            <td>Baliwag</td>
                            <td>1014</td>
                            <td>Manila - Cabanatuan</td>
                            <td>
                                <button class="button" onclick="showDetailsModal()">Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add Booking BUTTON MODAL POP UP -->
            <div id="bookingModal">
                <div id="innerBookingModal">
                    <span id="spanBookModal" onclick="closeBookingModal()">x</span>
                    <h3>Add Booking</h3>
                    <!-- Route Search -->
                    <label>Route:</label>
                    <div id="outerSearch">
                        <input id="searchField" type="text" placeholder="Search">
                    </div>
                    <!-- Scrollable Bus Table -->
                    <div id="addbooktbl">
                        <table id="addbooktbll" border="1" width="100%">
                            <thead id="theadAccepted">
                                <!-- Header sa table ng add booking -->
                                <tr>
                                    <th>Bus No.</th>
                                    <th>Bus Name</th>
                                    <th>Travel Time</th>
                                    <th>Driver</th>
                                    <th>Conductor</th>
                                    <th>Seats Left</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data sa table ng add booking -->
                                <tr>
                                    <td>7820</td>
                                    <td>Baliwag</td>
                                    <td>1:00 PM</td>
                                    <td>Juan Dela Cruz</td>
                                    <td>Pedro Santos</td>
                                    <td>45</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <!-- Passenger Info -->
                    <h4>Passenger Information</h4>
                    <div id="passInfo">
                        <div id="forminner">
                            <label>First Name:</label><br>
                            <input id="formtext" type="text">
                        </div>
                        <div id="forminner">
                            <label>Last Name:</label><br>
                            <input id="formtext" type="text">
                        </div>
                        <div id="forminner">
                            <label>Contact:</label><br>
                            <input id="formtext" type="text">
                        </div>
                        <div id="forminner">
                            <label>Mode of Payment:</label><br>
                            <input id="formtextt" type="text" value="Cash" readonly>
                        </div>
                    </div>
                    <!-- Book Button -->
                    <div id="bookdiv">
                        <button id="bookbtn">Book</button>
                    </div>
                </div>
            </div>

            <!-- PENDING BOOKINGS SECTION ------------------------------------------------>
            <h3>Pending Bookings</h3>
            <div id="outerAccepted">
                <table id="tblAccepted">
                    <thead id="theadAccepted">
                        <tr>
                            <th>Reference No.</th>
                            <th>Date and Time</th>
                            <th>Passenger Name</th>
                            <th>Contact</th>
                            <th>Bus Name</th>
                            <th>Bus Number</th>
                            <th>Route</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- laman ng table pending booking -->
                        <tr>
                            <td>ZXC9823</td>
                            <td>2025-04-09 10:00 PM</td>
                            <td>Juan Dela Cruz</td>
                            <td>09123456789</td>
                            <td>Baliwag</td>
                            <td>1014</td>
                            <td>Manila - Cabanatuan</td>
                            <td>
                                <button id="pendDet" class="button" onclick="showDetailsModal()">Details</button>
                                <button id="accDet" class="button">Accept</button>
                                <button id="rejDet" class="button">Reject</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Booking Details Modal -->
        <div class="modal" id="detailsModal">
            <div class="modal-content">
                <h3>Booking Details</h3>
                <hr>
                <p><strong>Reference No.:</strong> ZXC9234</p>
                <p><strong>Booking Date and Time:</strong> 2025-04-08 10:00 PM</p>
                <p><strong>Passenger Name:</strong> Makiyato</p>
                <p><strong>Route:</strong> Cabanatuan - Cubao</p>
                <p><strong>Travel Time:</strong> 1:00 PM</p>
                <p><strong>Bus Name:</strong> Baliwag</p>
                <p><strong>Bus No.:</strong> 1015</p>
                <p><strong>Driver:</strong> Mang Juan</p>
                <p><strong>Conductor:</strong> Jose Manalo</p>
                <p><strong>Mode of Payment:</strong> GCash</p>
                <p><strong>Total Fare:</strong> 150</p>

                <div class="button-container">
                    <button id="butbookDet" class="button">Edit</button>
                    <button id="butbookDet" class="button" onclick="closeDetailsModal()">Close</button>
                </div>
            </div>
        </div>

        <script>
            /* PARA SA SIDEBAR */
            function showSection(id) {
                document.querySelectorAll('.section').forEach(sec => sec.classList.add('hidden'));
                document.getElementById(id).classList.remove('hidden');
            }

            window.onclick = function(e) {
                if (e.target.id === 'modal') {
                    document.getElementById('modal').style.display = 'none';
                }
                if (e.target.id === 'detailsModal') {
                    document.getElementById('detailsModal').style.display = 'none';
                }
            }

            /* modals mga pop up window yan */
            function showDetailsModal() {
                document.getElementById('detailsModal').style.display = 'flex';
            }

            function closeDetailsModal() {
                document.getElementById('detailsModal').style.display = 'none';
            }

            /* Function to open the modal ADD BUS */
            function openModal() {
                document.getElementById('busModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('busModal').style.display = 'none';
            }

            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const output = document.getElementById('previewImage');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }

            /* Function to open the modal BUS INFO bus pic clicked */
            function showBusInfo() {
                document.getElementById('busInfoModal').style.display = 'flex';
            }

            function closeBusInfo() {
                document.getElementById('busInfoModal').style.display = 'none';
            }

            /* Function to open the modal add booking button cliked */
            function openBookingModal() {
                document.getElementById('bookingModal').style.display = 'flex';
            }

            function closeBookingModal() {
                document.getElementById('bookingModal').style.display = 'none';
            }
        </script>
</body>

</html>