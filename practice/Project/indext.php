<!DOCTYPE html>
<html>

<head>
  <title>Form</title>
  <style>
    body{
      margin: 0;
      padding: 0;
    }
    .header {
      background: #888;
      padding: 20px 0px;
      text-align: center;
    }

    .form {
      text-align: center;
      padding: 40px 0px;
      background: antiquewhite;
    }

    input {
      padding: 10px 5px;
      margin-bottom: 15px;
      text-transform: capitalize;
    }

    button[type="submit"] {
      background: darkorange;
      padding: 10px 30px;
      border: none;
      border-radius: 20px;
      color: #fff;
      font-weight: 700;
      cursor: pointer;
    }

    table {
      border-collapse: collapse;
      width: 400px;
      color: #588c7e;
      font-family: monospace;
      font-size: 25px;
      text-align: left;
      background: #fff;
      margin: 0 auto;
    }

    th {
      background-color: #588c7e;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }


    .database {
      text-align: center;
      /* padding: 20px 0px; */
      background: chocolate;
      /* width: 400px; */
      align-items: center;
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <div class="header">
    <h2>This Is Header</h2>
  </div>

  <div class="form">
    <form action="connect.php" method="post">
      <input type="text" name="username" placeholder="Username"><br>
      <input type="password" name="password" placeholder="password"><br>
      <button type="submit" value="Submit">Submit</button><br>
    </form>
  </div>


  <div class="database">
    <table>
      <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Password</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
      <?php
      include ("config.php");
      $sql = "SELECT id, username, password FROM login";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
          <td>" . $row["id"] . "</td>
          <td>" . $row["username"] . "</td>
          <td>". $row["password"] . "</td>
          <td>"."<a href='update.php?rn=$row[id]&nm=$row[username]&pw=$row[password]'>Edit</a>"."</td>
          <td>"."<a onclik='return checkdelete()' href='delete.php?rn=$row[id]'>Delete</a>"."</td>
 
          </tr>";
        }
        echo "</table>";
      } else {
        echo "0 results";
      }
      $conn->close();
      ?>
    </table>
  </div>



  <div class="header">
    <h2>This Is Footer</h2>
  </div>


<script>
  function checkdelete(){
  return Confirm('Are you sure want to delete this record???');
}

</script>
</body>

</html>