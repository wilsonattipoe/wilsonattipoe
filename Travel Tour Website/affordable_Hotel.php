<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affordable Hotel</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
        }

        nav ul li a:hover {
            color: #f0f0f0;
        }

        .hotels-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .hotel-info {
            width: calc(25% - 20px); /* Four items per row with margin */
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .hotel-info img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .hotel-info img:hover {
            transform: scale(1.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
        }

        .amenities ul {
            list-style-type: none;
            padding: 0;
        }

        .booking .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .booking .btn:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Header, Navigation, etc. -->
    <header>
        <h1>Affordable Hotel</h1>
        <!-- Navigation -->
        <nav>
            <ul>
                <li><a href="home.php" target="_blank">Home</a></li>
                <li><a href="about.php" target="_blank">About Us</a></li>
                <li><a href="contact.php" target="_blank">Contact</a></li>
            </ul>
        </nav>
    </header>

    

    <!-- Main content area -->
    <div class="container">
        <h1>United Kingdom Hotel</h1>
        <div class="hotels-container">
            <!-- First hotel info -->
            <div class="hotel-info">
                <!-- First hotel image -->
                <img src="./photos/images.jpg" alt="Hotel Image" onclick="showHotelDetails('Hotel Name 1')">
                <!-- First hotel details -->
                <h2>Hotel Name 1</h2>
                <p>Address: 123 Main Street, Example City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Swimming Pool</li>
                        <li>Restaurant</li>
                        <li>Gym</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>


            <!-- Second hotel info -->
            <div class="hotel-info">
                <!-- Second hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 2')">
                <!-- Second hotel details -->
                <h2>Hotel Name 2</h2>
                <p>Address: 456 Elm Street, Another City</p>
                <p>Phone: 987-654-3210</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Pool</li>
                        <li>Spa</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>



            <!-- Third hotel info -->
            <div class="hotel-info">
                <!-- Third hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 3')">
                <!-- Third hotel details -->
                <h2>Hotel Name 3</h2>
                <p>Address: 789 Oak Avenue, Yet Another City</p>
                <p>Phone: 555-123-4567</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Breakfast Included</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>

            <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 4</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>






            <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 5</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>
                <!-- Add more hotel info as needed -->



                <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 6</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>
                

        </div>
    </div>




    <!-- Main content area -->
    <div class="container">
        <h1>China Hotel</h1>
        <div class="hotels-container">
            <!-- First hotel info -->
            <div class="hotel-info">
                <!-- First hotel image -->
                <img src="./photos/images.jpg" alt="Hotel Image" onclick="showHotelDetails('Hotel Name 1')">
                <!-- First hotel details -->
                <h2>Hotel Name 1</h2>
                <p>Address: 123 Main Street, Example City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Swimming Pool</li>
                        <li>Restaurant</li>
                        <li>Gym</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>




            <!-- Second hotel info -->
            <div class="hotel-info">
                <!-- Second hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 2')">
                <!-- Second hotel details -->
                <h2>Hotel Name 2</h2>
                <p>Address: 456 Elm Street, Another City</p>
                <p>Phone: 987-654-3210</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Pool</li>
                        <li>Spa</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>




            <!-- Third hotel info -->
            <div class="hotel-info">
                <!-- Third hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 3')">
                <!-- Third hotel details -->
                <h2>Hotel Name 3</h2>
                <p>Address: 789 Oak Avenue, Yet Another City</p>
                <p>Phone: 555-123-4567</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Breakfast Included</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>





            <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 4</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>






            <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 5</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>
                <!-- Add more hotel info as needed -->





                <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 6</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>
                

        </div>
    </div>




    <!-- Main content area -->
    <div class="container">
        <h1>India Hotel</h1>
        <div class="hotels-container">
            <!-- First hotel info -->
            <div class="hotel-info">
                <!-- First hotel image -->
                <img src="./photos/images.jpg" alt="Hotel Image" onclick="showHotelDetails('Hotel Name 1')">
                <!-- First hotel details -->
                <h2>Hotel Name 1</h2>
                <p>Address: 123 Main Street, Example City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Swimming Pool</li>
                        <li>Restaurant</li>
                        <li>Gym</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>




            <!-- Second hotel info -->
            <div class="hotel-info">
                <!-- Second hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 2')">
                <!-- Second hotel details -->
                <h2>Hotel Name 2</h2>
                <p>Address: 456 Elm Street, Another City</p>
                <p>Phone: 987-654-3210</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Pool</li>
                        <li>Spa</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>


            <!-- Third hotel info -->
            <div class="hotel-info">
                <!-- Third hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 3')">
                <!-- Third hotel details -->
                <h2>Hotel Name 3</h2>
                <p>Address: 789 Oak Avenue, Yet Another City</p>
                <p>Phone: 555-123-4567</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Breakfast Included</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>




            <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 4</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>






            <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 5</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>
                <!-- Add more hotel info as needed -->

               
               
               
                <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 6</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>
                

        </div>
    </div>






    <!-- Main content area -->
    <div class="container">
        <h1>France Hotel</h1>
        <div class="hotels-container">
            <!-- First hotel info -->
            <div class="hotel-info">
                <!-- First hotel image -->
                <img src="./photos/images.jpg" alt="Hotel Image" onclick="showHotelDetails('Hotel Name 1')">
                <!-- First hotel details -->
                <h2>Hotel Name 1</h2>
                <p>Address: 123 Main Street, Example City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Swimming Pool</li>
                        <li>Restaurant</li>
                        <li>Gym</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>

            <!-- Second hotel info -->
            <div class="hotel-info">
                <!-- Second hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 2')">
                <!-- Second hotel details -->
                <h2>Hotel Name 2</h2>
                <p>Address: 456 Elm Street, Another City</p>
                <p>Phone: 987-654-3210</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Pool</li>
                        <li>Spa</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>

            <!-- Third hotel info -->
            <div class="hotel-info">
                <!-- Third hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 3')">
                <!-- Third hotel details -->
                <h2>Hotel Name 3</h2>
                <p>Address: 789 Oak Avenue, Yet Another City</p>
                <p>Phone: 555-123-4567</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Breakfast Included</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>

            <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 4</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>






            <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 5</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>

                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>
                <!-- Add more hotel info as needed -->

                <!-- Fourth hotel info -->
            <div class="hotel-info">
                <!-- Fourth hotel image -->
                <img src="./photos/images.jpg" alt="Another Hotel Image" onclick="showHotelDetails('Hotel Name 4')">
                <!-- Fourth hotel details -->
                <h2>Hotel Name 6</h2>
                <p>Address: 321 Cedar Lane, Yet Another City</p>
                <p>Phone: 123-456-7890</p>
                <div class="amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <li>Free Wi-Fi</li>
                        <li>Parking</li>
                        <!-- Add more amenities as needed -->
                    </ul>
                </div>
                <!-- Pricing information -->
                    <div class="pricing">
                        <h3>Pricing</h3>
                         <p>Starting from: $100 per night</p>
                    </div>
                <div class="booking">
                    <h3>Book Now</h3>
                    <!-- Add booking form or button -->
                    <a href="booking.php" class="btn">Book Now</a>
                </div>
            </div>
                

        </div>
    </div>


    
    <!-- Footer, JavaScript includes, etc. -->
    <footer>
        <!-- Your footer content goes here -->
        <p>&copy; 2024 Affordable Hotel. All rights reserved.</p>
    </footer>

    <script>
        function showHotelDetails(hotelName) {
            alert("Showing details for " + hotelName);
            // You can add more JavaScript functionality here
        }
    </script>
</body>
</html>
