<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('Please log in to access the report page.');
        window.location.href = '../auth/login.php';
    </script>";
    exit();
}
?>
<form name="report" method="post" action="process_report.php">
    <div class="message text-center">
        <?php
        session_start();
        if (isset($_SESSION['report_status'])) {
            echo $_SESSION['report_status'];
            unset($_SESSION['report_status']);
        }
        ?>
    </div>

    <h1 class="text-center">Report Lost Item</h1>

    <div>
        <div class="row">
            <label for="title">Item Title</label>
            <input type="text" name="title" id="title" class="full-width" required>
        </div>

        <div class="row">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="full-width" rows="4" required></textarea>
        </div>

        <div class="row">
            <label for="location">Location Lost</label>
            <input type="text" name="location" id="location" class="full-width" required>
        </div>

        <div class="row">
            <label for="date_lost">Date Lost</label>
            <input type="date" name="date_lost" id="date_lost" class="full-width">
        </div>

        <div class="row">
            <input type="submit" name="submit" value="Submit Report" class="full-width">
        </div>
    </div>
</form>

<form action="../logout.php" method="post" style="display: inline;">
    <button type="submit">Logout</button>
</form>
