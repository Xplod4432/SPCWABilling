<?php
    class crud{
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }

        public function insertDetails($plot,$oname,$resname,$contact,$paid,$mstatus){
            try {
                $sql = "INSERT INTO pending_appr (`plot_no`, `owner_name`, `contact`, `occupant_name`, `membership_status`, `paid_upto`) VALUES (:plot,:oname,:resname,:contact,:mstatus,:paid)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':plot',$plot);
                $stmt->bindparam(':oname',$oname);
                $stmt->bindparam(':resname',$resname);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':mstatus',$mstatus);
                $stmt->bindparam(':paid',$paid);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getCourses(){
            try{
                $sql = "SELECT * FROM `courses`";
                $result = $this->db->query($sql);
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            
        }

        public function insertTests($cid,$dot,$mm){
            try {
                $sql = "INSERT INTO `tests`(`course_id`, `dateoftest`, `max_marks`) VALUES (:cid,:dot,:mm)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':cid',$cid);
                $stmt->bindparam(':dot',$dot);
                $stmt->bindparam(':mm',$mm);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function attemptTest($Sid,$tid,$mob){
            try {
                $sql = "INSERT INTO `testattempted`(`test_id`, `id`, `marks_ob`) VALUES (:tid,:Sid,:mob)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':Sid',$Sid);
                $stmt->bindparam(':tid',$tid);
                $stmt->bindparam(':mob',$mob);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
        public function getTests(){
            try{
                $sql = "SELECT * FROM `tests` a inner join courses s on a.course_id = s.course_id WHERE `dateoftest` >= CURDATE()";
                $result = $this->db->query($sql);
                return $result;                
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }   
        }

        public function getAllTests(){
            try{
                $sql = "SELECT * FROM `tests` a inner join courses s on a.course_id = s.course_id ORDER BY dateoftest DESC";
                $result = $this->db->query($sql);
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }   
        }

        public function getTestsById($testid){
            try {
                $sql = "SELECT * FROM `testattempted` a inner join userdetails s on a.id = s.id WHERE`test_id` = $testid";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getResidentByPlot($plot){
            try {
                $sql = "SELECT * FROM `residents_data` WHERE `plot_no` = $plot";
                $result = $this->db->query($sql);
                if ($result->rowCount() > 0) {
                    return $result;
                }
                else {
                    return 0;
                    echo "NO";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function insertAssgn($cid,$dot,$mm){
            try {
                $sql = "INSERT INTO `assignments`(`course_id`, `last_date`, `max_marks`) VALUES (:cid,:dot,:mm)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':cid',$cid);
                $stmt->bindparam(':dot',$dot);
                $stmt->bindparam(':mm',$mm);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function updateAssgnMarks($subid,$mob){
            try {
                $sql = "UPDATE `assgn_submitted` SET `marksob`=:mob WHERE submit_id = :subid";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':subid',$subid);
                $stmt->bindparam(':mob',$mob);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function uploadAssignment($Sid,$tid,$mob){
            try {
                $sql = "INSERT INTO `assgn_submitted`(`assign_id`, `id`, `upload_file`) VALUES (:Sid,:tid,:mob)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':Sid',$Sid);
                $stmt->bindparam(':tid',$tid);
                $stmt->bindparam(':mob',$mob);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
        public function getAllAssignments(){
            try{
                $sql = "SELECT * FROM `assignments` a inner join courses s on a.course_id = s.course_id ORDER BY last_date DESC";
                $result = $this->db->query($sql);
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            
        }

        public function getAssignments(){
            try{
                $sql = "SELECT * FROM `assignments` a inner join courses s on a.course_id = s.course_id WHERE `last_date` >= CURDATE()";
                $result = $this->db->query($sql);
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            
        }

        public function getAssignmentsById($assgnid){
            try {
                $sql = "SELECT * FROM `assgn_submitted` a inner join userdetails s on a.id = s.id WHERE `assign_id` = $assgnid";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getAssignmentsBySId($id){
            try {
                $sql = "SELECT * FROM `assgn_submitted` a inner join assignments s on a.assign_id = s.assign_id WHERE `id` = $id";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
 
    }
    
?>