<?php
    class crud{
        private $db;

        function __construct($conn){
            $this->db = $conn;
        }

        public function insertDetails($plot,$oname,$resname,$contact,$paid,$mstatus,$ptype){
            try {
                $sql = "INSERT INTO pending_appr (`plot_no`, `owner_name`, `occupant_name`, `contact`, `membership_status`, `paid_upto`, `resident_type`) VALUES (:plot,:oname,:resname,:contact,:mstatus,:paid,:ptype)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':plot',$plot);
                $stmt->bindparam(':oname',$oname);
                $stmt->bindparam(':resname',$resname);
                $stmt->bindparam(':contact',$contact);
                $stmt->bindparam(':mstatus',$mstatus);
                $stmt->bindparam(':paid',$paid);
                $stmt->bindparam(':ptype',$ptype);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getPendingReg(){
            try{
                $sql = "SELECT * FROM `pending_appr` p INNER JOIN plot_types t ON p.resident_type = t.resident_type";
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
                $sql = "SELECT * FROM residents_data p INNER JOIN plot_types t ON p.resident_type = t.resident_type WHERE plot_no = :plot";
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

        public function getResidentById($id){
            try {
                $sql = "SELECT * FROM residents_data WHERE resident_id = :id";
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

        public function approveRegistration($id){
            try {
                $sql = "INSERT INTO residents_data (plot_no, owner_name, contact, occupant_name, membership_status, paid_upto, resident_type)
                SELECT plot_no, owner_name, contact, occupant_name, membership_status, paid_upto, resident_type
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

        public function deleteReg($id){
            try{
                $sql = "DELETE FROM `pending_appr` WHERE tid = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id', $id);
                $stmt->execute();
                return true;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
        public function getPlotTypes(){
            try{
                $sql = "SELECT * FROM `plot_types` WHERE 1";
                $stmt = $this->db->prepare($sql);
                $result = $this->db->query($sql);
                return $result;
            }catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function insertPayReceipt($id,$amount,$paytype,$refnum,$paydate,$biller,$addmonth){
            try {
                $sql = "INSERT INTO `maintenance_receipt`(`resident_id`, `amount`, `payment_type`, `txndetail`, `timestamp`, `billedby`) VALUES (:id,:amount,:paytype,:refnum,:paydate,:biller)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id',$id);
                $stmt->bindparam(':amount',$amount);
                $stmt->bindparam(':paytype',$paytype);
                $stmt->bindparam(':refnum',$refnum);
                $stmt->bindparam(':paydate',$paydate);
                $stmt->bindparam(':biller',$biller);
                $res = $stmt->execute();
                $billid = $this->db->lastInsertId();
                if ($res) {
                    if($this->updatePaidMonth($id, $addmonth)) {
                        return $billid;
                    }
                    else {
                        $this->deleteTransaction($billid);
                        return -1;
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        private function updatePaidMonth($id, $addmonth) {
            try{ 
                $sql = "UPDATE `residents_data` SET `paid_upto`= DATE_ADD((SELECT paid_upto FROM residents_data WHERE resident_id = :id), INTERVAL :addmonth MONTH) WHERE resident_id = :rid;";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(':id',$id);
                $stmt->bindparam(':addmonth',$addmonth);
                $stmt->bindparam(':rid',$id);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>