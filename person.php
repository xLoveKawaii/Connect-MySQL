<!DOCTYPE html>
<html>
    <body>

    <?php
    
    class Person {
        public $name;
        public $age;

        function __construct($name, $age){
            $this->name = $name;
            $this->age = $age;
        }
        function set_name($name){
            $this->name = $name;       
        }

        function set_age($age){
            $this->age = $age;
        }

        function get_name(){
            return $this->name;
        }

        function get_age(){
            return $this->age;
        }
        
    }
    

        $hostname = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "myDatabase";

        //Create Connection
        $conn = mysqli_connect($hostname, $username, $password, $dbname);

        //Check Connection
        if ($conn->connect_errno){
            echo"Connection failed: ".$conn->connect_error;
        }
            echo "Sucessfully Connected";

        /*

        //Create DB
        $sqli = "CREATE DATABASE myDatabase";
        if ($conn->query($sqli) === TRUE){
            echo "Database created successfully";
        } else {
            echo "Error creating database: ".$conn->error;
        }
        */

    //Create persons Table in mySQL database
        $sql_table = "CREATE TABLE persons(
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            age INT NOT NULL
        )";

       if($conn->query($sql_table) === TRUE){
            echo "Table persons is created successfully";
        } else {
            echo "Error creating table: ".$conn->error;
        }

    $person = new Person("nobody", 0);
    $person->set_name('Jo');
    $person->set_age("5");

    $PersonName = $person->get_name();
    $PersonAge = $person->get_age();
    
    
    //Insert new Person Obj. into persons table   
        $sql_person = "INSERT INTO persons (name, age) 
        VALUES ('$PersonName',$PersonAge)";

        if($conn->query($sql_person) === TRUE){
            echo "New Record created successfully";
        } else {
            echo "Error: ".$sql_table."<br>".$conn->error;
        }
    

//Update Person age in persons table        

        $newAge = (int)readline("Age: ");
        $id = (int)readline("What Id would you like to update: ");
        $sql_update = "UPDATE persons SET age=$newAge WHERE id=$id";

            if($conn->query($sql_update) === TRUE){
                echo "Record updated successfully";
            }else{
            echo "Error updating reecord: ".$conn->error;
            }
        
    


    //Delete Person from persons table

        $id = (int)readline("What row would you like to remove?: ");
        $sql_Delete = "DELETE FROM persons WHERE id=$id";

        if($conn->query($sql_Delete) === TRUE){
            echo "Record deleted successfully";
        }else{
         echo "Error deleting reecord: ".$conn->error;
        }
        $conn->close();
    

    ?>
    </body>
</html>