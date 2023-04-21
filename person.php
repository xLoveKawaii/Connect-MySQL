<!--Project by Carman Tran-->

<!DOCTYPE html>
<html>
    <body>

    <?php
    
    //Created Person Class
    class Person {
        public $name;
        public $age;

        //Initialize Constructor
        function __construct($name, $age){
            $this->name = $name;
            $this->age = $age;
        }

        //Setter Method
        function set_name($name){
            $this->name = $name;       
        }
        function set_age($age){
            $this->age = $age;
        }

        //Getter Method
        function get_name(){
            return $this->name;
        }
        function get_age(){
            return $this->age;
        }
        
    }
    
    //Establish a connection w/ mySQL
    function connection(){
        $hostname = "localhost";
        $username = "root";
        $password = "password";
        $dbname = "myDatabase";

        static $conn;
        //Create Connection
        $conn = mysqli_connect($hostname, $username, $password, $dbname);

        //Check Connection
        if ($conn->connect_errno){
            echo"Connection failed: ".$conn->connect_error;
        }
            echo "Sucessfully Connected";

        return $conn;
    }

    //Create Table in mySQL database
    function sqlTable(){  
       $conn = connection();

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
        $conn->close();

    }

    //Function to update person age in persons table  
    function updateAge(){
       $conn = connection();      

        $newAge = (int)readline("Age: ");
        $id = (int)readline("What Id would you like to update: ");

        //User input new age & id from command line
        $sql_update = "UPDATE persons SET age=$newAge WHERE id=$id";

            if($conn->query($sql_update) === TRUE){
                echo "Record updated successfully";
            }else{
            echo "Error updating reecord: ".$conn->error;
            }
            $conn->close();
    }

    //Function to delete person from persons table
    function deletePerson(){
       $conn = connection();

        $id = (int)readline("What row would you like to remove?: ");
        //User input id to delete a record from command line
        $sql_Delete = "DELETE FROM persons WHERE id=$id";

        if($conn->query($sql_Delete) === TRUE){
            echo "Record deleted successfully";
        }else{
         echo "Error deleting reecord: ".$conn->error;
        }
        $conn->close();
    }

    ?>
    </body>
</html>