<?php
include 'connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resident_ID = trim($_POST['resident_ID']);
    $password = trim($_POST['password']);
    
    $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
              strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    $sql = "SELECT * FROM users1 WHERE resident_ID = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $resident_ID, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['resident_ID'] = $user['resident_ID'];
        $_SESSION['password'] = $user['password'];

        if ($user['user_role'] === 'admin' || $user['user_role'] === 'resident') {
            if ($isAjax) {
                echo json_encode(["success" => true, "role" => $user['user_role']]);
                exit();
            } else {
                if ($user['user_role'] === 'admin') {
                    header("Location: adminDashboard.php");
                } else {
                    header("Location: userDashboard.php");
                }
                exit();
            }
        } else {
            $errorMsg = "Unknown user role.";
        }
    } else {
        $errorMsg = "Invalid resident ID or password.";
    }

    if ($isAjax) {
        echo json_encode(["success" => false, "message" => $errorMsg]);
        exit();
    } else {
        $_SESSION['error'] = $errorMsg;
        header("Location: frontpage.php");
        exit();
    }
}
?>
