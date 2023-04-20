<?php
    include ("person.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body style="margin: 50px;">
        <h1>Persons Table</h1>
        <br>
        <table class="table">
            <thread>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                </tr>
            </thread>
            <tbody>
                <?php
                function Retrieve(){
                    Connection();
                
                    // Read all row from datbase
                    $sql_data = "SELECT * FROM persons";
                    $result = $conn-> query($sql_data);

                    if(!$result){
                        die("Invalid query: ".$conn->error);
                    }

                    while($row = $result-> fetch_assoc()){
                        echo "<tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["name"]."</td>
                            <td>".$row["age"]."</td>
                        </tr>";            
                    }
                    $conn->close();
                }
                ?>
            </tbody>
        </table>
</body>
</html>