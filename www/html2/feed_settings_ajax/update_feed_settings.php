<?php
header('Content-Type: application/json');
include '../logindbase.php';

$amount = isset($_POST['amount']) ? $_POST['amount'] : null;
$times = isset($_POST['times']) ? $_POST['times'] : null;
$adjust = isset($_POST['adjust']) ? $_POST['adjust'] : null;

$fields = [];
if ($amount !== null) {
    $fields[] = "amount_per_feeding='$amount'";
}
if ($times !== null) {
    $fields[] = "feeding_session_frequency='$times'";
}
if ($adjust !== null) {
    $fields[] = "adjust_amount_by='$adjust'";
}

if (!empty($fields)) {
    $query = "UPDATE feed_settings SET " . implode(', ', $fields) . " WHERE id=1";
    if ($conn->query($query) === TRUE) {
        echo json_encode(['success' => 'Settings updated successfully']);
    } else {
        echo json_encode(['error' => 'Error updating settings']);
    }
} else {
    echo json_encode(['error' => 'No fields to update']);
}

$conn->close();
?>
