<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Report</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        body {
            background-color: #f5f5f5;
        }

        .header-image {
            background-image: url('image/background12.jpg'); /* Replace 'your-image-url.jpg' with your image URL */
            background-size: cover;
            background-position: center;
            height: 400px; /* Adjust the height as needed */
            display: flex;
            filter: grayscale(90px);
            justify-content: center;
            align-items: top;
            color: #ffffff;
            text-align: center;
            font-style: italic;
        }

        .welcome-text {
            font-size: 54px;
        }

        .main-content {
            display: flex;
            flex-direction: row;
        }



        .content {
            flex: 1;
            padding: 20px;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        
 
/* sdfjsd */
.sidebar {
    background-color: #333;
    color: #fff;
    padding: 20px;
}

.sidebar-heading {
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.dropdown-btn {
    background-color: #555;
    color: #fff;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: left;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #444;
    min-width: 160px;
    z-index: 1;
}

.dropdown-content a {
    color: #fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #666;
}

.dropdown:hover .dropdown-content {
    display: block;
}
    </style>
</head>
<body>
    <div class="header-image">
        <div class="welcome-text">
            Welcome to K Munidasa <br> Library
        </div>
    </div>

    <div class="main-content">
        <nav class="sidebar">
            <div class="sidebar-heading">Library Dashboard</div>
            <div class="dropdown">
                <button class="dropdown-btn">Menu</button>
                <div class="dropdown-content">
                    <a href="userprofile.php">User Profile</a>
                    <a href="dashboard.php">Book Tab</a>
                    <a href="bookreservation.php">Book Reservation</a>
                    <a href="index.php">Log out</a>
                </div>
            </div>
        </nav>
        



        <div class="content">
            <div class="search-bar">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search books...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">Search</button>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="user-profile">
                    <h2>User Profile</h2>
                    <!-- User information section -->
                    <div class="user-info">
                        <?php
                        // Connect to the database
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "bookdb";
                    
                        $conn = new mysqli($servername, $username, $password, $dbname);
                    
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        
                        session_start();

                        if (isset($_SESSION['user_id'])) {
                            $userId = $_SESSION['user_id'];
                        } else {
                            echo "User ID not found in session.";
                        }
                        // Retrieve user data from the usersignup table
                        $sql = "SELECT * FROM usersignup WHERE userid = '$userId'";
                        $result = mysqli_query($conn, $sql);

                        // Display user data
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<p><strong>User ID:</strong> " . $row['userid'] . "</p>";
                                echo "<p><strong>User Name:</strong> " . $row['username'] . "</p>";
                                echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
                            }
                        } else {
                            echo "No user data found.";
                        }

                        // Close the database connection
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
        
                    <!-- Books Received table -->
                    <div class="books-received">
                        <h3>Books Received</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Book ID</th>
                                    <th>Book Name</th>
                                    <th>Received Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>1</td>
                                    <td>Book Name 1</td>
                                    <td>2023-01-15</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
        
                    <!-- Books Not Received table -->
                    <div class="books-not-received">
                        <h3>Books Not Received</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Book ID</th>
                                    <th>Book Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Sample not received book row, replace with actual data from your database -->
                                <tr>
                                    <td>2</td>
                                    <td>Book Name 2</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

           

            
        </div>
    </div>
</body>
</html>