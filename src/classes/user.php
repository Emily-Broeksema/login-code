<?php
   
    namespace LoginOpdracht\classes;

    class User extends Database{

        public $username;
        public $email;
        private $password;
        
        function SetPassword($password){
            $this->password = $password;
        }
        function GetPassword(){
            return $this->password;
        }

        public function ShowUser() {
            echo "<br>Username: $this->username<br>";
            echo "<br>Password: $this->password<br>";
            echo "<br>Email: $this->email<br>";
        }

        public function RegisterUser(){
            $status = false;
            $errors=[];
            if($this->username != "" || $this->password != ""){

                // Check user exist
                if(true){
                    array_push($errors, "Username bestaat al.");
                } else {

                    // username opslaan in tabel login
                    // INSERT INTO `user` (`username`, `password`, `role`) VALUES ('kjhasdasdkjhsak', 'asdasdasdasdas', '');
                    // Manier 1
                    
                    $sql = "INSERT INTO user VALUES (:name, :password, '')";
                    $query = $conn->prepare($sql);
                    $query->execute([
                        'name'=>$username,
                        'pwd'=>$password
                    ]);

                    $status = true;
                }
                            
                
            }
            return $errors;
        }

        function ValidateUser(){
            $errors=[];

            if (empty($this->username)){
                array_push($errors, "Invalid username");
            } else if (empty($this->password)){
                array_push($errors, "Invalid password");
            } else if (strlen($this->username) < 3 && strlen($this->username) > 50)
            {
                array_push($errors, "Username moet kleiner dan 3 en groter dan 50 tekens zijn.");
            }

            return $errors;

            // Test username > 3 tekens en <br 50 tekens
            //$len_username = strlen($username);
           // echo $len_username;
            //echo "</br>";
            //if ($len_username > 3 && $len_username < 50)
            //{
            //    echo "ok";
            //}
                        
        }

        public function LoginUser(){

            // Connect database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "login";

            try {
                $this->$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $this->$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Connected successfully<br>"; 
                }
            catch(PDOException $e)
                {
                echo "Connection failed: " . $e->getMessage();
                }


            // Zoek user in de table user
           echo "Username:" . $this->username;

           $sql = "SELECT * FROM user WHERE username = :name";
           $query = $conn->prepare($sql);
           $query->execute(['name'=>$username]);


            // Indien gevonden dan sessie vullen
            session_start();
            $_SESSION['user'] = $row['username'];

            header("location: index.php");

            return true;
        }

        // Check if the user is already logged in
        public function IsLoggedin() {
            // Check if user session has been set
            
            return false;
        }

        public function GetUser($username){
            
		    // Doe SELECT * from user WHERE username = $username
            if (false){
                //Indien gevonden eigenschappen vullen met waarden uit de SELECT
                $this->username = 'Waarde uit de database';
            } else {
                return NULL;
            }   
        }

        public function Logout(){
            session_start();
            // remove all session variables
            session_unset();

            // destroy the session
            session_destroy();
        
        }


    }
    

?>