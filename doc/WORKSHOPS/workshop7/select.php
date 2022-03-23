<?php
require "connect.php";

$sql = "SELECT * FROM ToDo";

$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  echo '<table>';
  echo '<tr><th>User ID</th><th>Task</th></tr>';
  while( $row = mysqli_fetch_assoc($result) ) {
    echo "<tr>";
    echo "<td>" . $row["userid"]. "</td>";
    echo "<td>" . $row["task"]. "</td>";
    echo "</tr>";
  }
  echo '</table>';
} else {
  echo "No tasks to show.";
}


$conn->close();
?>
