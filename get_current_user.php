<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch all users and their corresponding graph data
    $conn = new mysqli("localhost", "root", "", "week9");

    // Fetch user-specific data
    $userDataQuery = "SELECT u.username, ud.data_name, ud.data_value
                      FROM users u
                      JOIN user_data ud ON u.id = ud.user_id";
    
    $result = mysqli_query($conn, $userDataQuery);

    $userData = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $userData[$row['username']][] = ['label' => $row['data_name'], 'value' => $row['data_value']];
    }

   
    $graphData = [
        'userData' => $userData
    ];

    header('Content-Type: application/json');
    echo json_encode($graphData);
} else {
    // Handle the case where the user is not logged in
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'User not logged in']);
}
?>
