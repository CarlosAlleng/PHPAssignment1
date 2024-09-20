

<?php
    // Get the data from the form
    $investment = filter_input(INPUT_POST, 'investment', FILTER_VALIDATE_FLOAT);
    $interest_rate = filter_input(INPUT_POST, 'interest_rate', FILTER_VALIDATE_FLOAT);
    $years = filter_input(INPUT_POST, 'years', FILTER_VALIDATE_INT);

    // Validate inputs
    $error_message = '';
    if ($investment === FALSE || $investment <= 0) {
        $error_message .= 'Investment must be a valid number greater than zero.<br>';
    }
    if ($interest_rate === FALSE || $interest_rate <= 0 || $interest_rate > 15) {
        $error_message .= 'Interest rate must be a valid number between 0 and 15.<br>';
    }
    if ($years === FALSE || $years <= 0 || $years > 30) {
        $error_message .= 'Years must be a valid whole number between 1 and 30.<br>';
    }

    // If there are errors, go back to the form
    if (!empty($error_message)) {
        include('index.php');
        exit();
    }

    // Calculate the future value
    $future_value = $investment;
    for ($i = 1; $i <= $years; $i++) {
        $future_value += $future_value * $interest_rate * 0.01;
    }

    // Format values
    $investment_f = '$'.number_format($investment, 2);
    $yearly_rate_f = $interest_rate.'%';
    $future_value_f = '$'.number_format($future_value, 2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" href="main.css"/>
</head>
<body>
    <main>
        <h1>Future Value Calculator</h1>

        <!-- Display the results -->
        <label>Investment Amount:</label>
        <span><?php echo htmlspecialchars($investment_f); ?></span><br />

        <label>Yearly Interest Rate:</label>
        <span><?php echo htmlspecialchars($yearly_rate_f); ?></span><br />

        <label>Number of Years:</label>
        <span><?php echo htmlspecialchars($years); ?></span><br />

        <label>Future Value:</label>
        <span><?php echo htmlspecialchars($future_value_f); ?></span><br />
        
        <p>This calculation was done on <?php echo date('m/d/Y'); ?>.</p>

        <!-- Link to go back to the form -->
        <p><a href="index.php">Go back to the form</a></p>
    </main>
</body>
</html>
