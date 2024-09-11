<?php
include('../include/connect_db.php');
include('header1.php');

?>

<section class="feedback-section section-gaps">
    <div class="container">
        <h2 class="text-center mb-4">Feedback Received</h2>
        <table class="table text-center table-bordered">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $select_query = "SELECT * FROM tbl_contact";
                $result = mysqli_query($conn, $select_query);
                // Check if query result has rows
                if (isset($result) && mysqli_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$i}</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                        echo "</tr>";
                        $i++;
                    }
                } else {
                    // Display message if no feedback is available
                    echo "<tr><td colspan='5'>No feedback available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
