<?php
    class crud{
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }

        public function insertDetails($plot,$oname,$resname,$contact,$paid,$mstatus){
            try {
                $sql = "INSERT INTO pending_appr (`plot_no`, `owner_name`, `occupant_name`, `contact`, `membership_status`, `paid_upto`) VALUES (:plot,:oname,:resname,:contact,:mstatus,:paid)";
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

        public function getPendingReg(){
            try{
                $sql = "SELECT * FROM `pending_appr`";
                $result = $this->db->query($sql);
                if ($result->rowCount() > 0) {
                    return $result;
                }
                else {
                    return 0;
                }
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
            
        }

        public function countResidentByPlot($plot){
            try {
                $sql = "SELECT * FROM `residents_data` WHERE `plot_no` = $plot";
                $result = $this->db->query($sql);
                return $result->rowCount();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getPendingById($id){
            try {
                $sql = "SELECT * FROM pending_appr WHERE tid = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id',$id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getResidentByPlot($plot){
            try {
                $sql = "SELECT * FROM residents_data WHERE plot_no = :plot";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':plot',$plot);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function approveRegistration($id){
            try {
                $sql = "INSERT INTO residents_data (plot_no, owner_name, contact, occupant_name, membership_status, paid_upto)
                SELECT plot_no, owner_name, contact, occupant_name, membership_status, paid_upto
                FROM pending_appr
                WHERE tid = $id";
                $result = $this->db->query($sql);
                $sql = "DELETE FROM pending_appr WHERE tid = $id";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
        public function editDetails($id,$plot,$oname,$resname,$contact,$paid,$mstatus){
            try{ 
                $sql = "UPDATE `residents_data` SET `plot_no`=:plot,`owner_name`=:oname,`contact`=:contact,`occupant_name`= :resname,`membership_status`=:mstatus,`paid_upto`=:paid WHERE resident_id = :id";
                $stmt = $this->db->prepare($sql);
                // bind all placeholders to the actual values
                $stmt->bindparam(':id',$id);
                $stmt->bindparam(':plot',$plot);
                $stmt->bindparam(':oname',$oname);
                $stmt->bindparam(':resname',$resname);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':mstatus',$mstatus);
                $stmt->bindparam(':paid',$paid);
                // execute statement
                $stmt->execute();
                return true;
            }catch (PDOException $e) {
             echo $e->getMessage();
             return false;
            }
             
         }
    }
?>