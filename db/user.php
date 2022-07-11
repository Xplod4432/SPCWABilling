<?php 

    class user{
        // private database object\
        private $db;
        
        //constructor to initialize private variable to the database connection
        function __construct($conn){
            $this->db = $conn;
        }

        public function insertUser($fname,$lname,$dob,$username,$password,$contact,$course1,$resaddress,$destination){
            try {
                $result = $this->getUserbyUsername($username);
                if($result['num'] > 0){
                    echo "E-Mail already Registered";
                    return false;
                } else{
                    $new_password = hash("sha512", $password.$username);
                    // define sql statement to be executed
                    $sql = "INSERT INTO userdetails (firstname,lastname,dateofbirth,username,password,contactnumber,course1,resaddress,avatar_path) VALUES (:fname,:lname,:dob,:username,:password,:contact,:course1,:resaddress,:destination)";
                    //prepare the sql statement for execution
                    $stmt = $this->db->prepare($sql);
                    // bind all placeholders to the actual values
                    $stmt->bindparam(':fname',$fname);
                    $stmt->bindparam(':lname',$lname);
                    $stmt->bindparam(':dob',$dob);
                    $stmt->bindparam(':username',$username);
                    $stmt->bindparam(':password',$new_password);
                    $stmt->bindparam(':contact',$contact);
                    $stmt->bindparam(':course1',$course1);
                    $stmt->bindparam(':resaddress',$resadress);
                    $stmt->bindparam(':destination',$destination);
                    
                    // execute statement
                    $stmt->execute();
                    return true;
                }
                
        
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getUser($username,$password){
            try{
                $sql = "SELECT * FROM `users` WHERE `designation` = :username AND `password` = :pass";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':username', $username);
                $stmt->bindparam(':pass', $password);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
           }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getUserbyUsername($username){
            try{
                $sql = "select count(*) as num from users where designation = :username";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':username',$username);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            }catch (PDOException $e) {
                    echo $e->getMessage();
                    return false;
            }
        }
        public function getUserDetails($userid){
            try {
                $sql = "select * from users where userid = :userid";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':userid', $userid);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
        public function getUsers(){
            try{
                $sql = "SELECT * FROM users";
                $result = $this->db->query($sql);
                return $result;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
    }
?>