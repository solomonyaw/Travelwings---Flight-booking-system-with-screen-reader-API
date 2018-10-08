<?php

include_once 'db_connect.php';

function login($email, $password, $mysqli) {
    
    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE email = ? LIMIT 1");
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
        
        // get variables from result.
        $stmt->bind_result($user_id, $db_password);
        $stmt->fetch();
        if ($stmt->num_rows == 1) {            
                // Check if the password in the database matches
                // the password the user submitted.
            if ($db_password == $password) {
                    // Password is correct!
                session_start();
                $_SESSION['user_id'] = $user_id;
                return true;
            } else {
                    // Password is not correct
                return false;
            }            
        } else {
            // No such user exists.
            return false;
        }
    }
}

function cancelbooking($bookingid) {
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
    $bookingres = $mysqli->query(sprintf('SELECT * FROM bookings WHERE id = %d', $bookingid));
    $booking = $bookingres->fetch_array();
    
    $flightres = $mysqli->query(sprintf('SELECT * FROM flights WHERE id = %d', $booking['flightid']));
    $flight = $flightres->fetch_array();
    
    $mysqli->query(sprintf("DELETE FROM bookings WHERE id = %d", $bookingid));
    
    if($booking['class'] == 'economy') {
        $flight['econavl'] += $booking['quantity'];
        $mysqli->query(sprintf('UPDATE flights SET econavl = %d WHERE id = %d', $flight['econavl'], $flight['id']));
    }
    if($booking['class'] == 'business') {
        $flight['bizavl'] += $booking['quantity'];
        $mysqli->query(sprintf('UPDATE flights SET bizavl = %d WHERE id = %d', $flight['bizavl'], $flight['id']));
    }
    if($booking['class'] == 'first') {
        $flight['firstavl'] += $booking['quantity'];
        $mysqli->query(sprintf('UPDATE flights SET econavl = %d WHERE id = %d', $flight['firstavl'], $flight['id']));
    }
    
    return $booking['amount'];
}
?>
