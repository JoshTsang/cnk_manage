<?php
	class DB {
        private $menuDB;
        private $userDB;
        private $infoDB;
        private $err = array('succ' => false,
                             'error' => 'unknown');
        
        public function getError($msg = null) {
            if ($msg != null) {
                $this->setErrorMsg($msg);
            }
            return json_encode($this->err);
        }               
        
        //TODO finish
        public function login($username, $upwd) {
            $this->connectUserDB();
             
            $sql=sprintf("select %s, %s from %s where %s.%s = '%s'",
                         USER_ID, USER_PWD,USER_INFO,USER_INFO,USER_NAME,$uname);
            $resultSet = $this->userinfoDB->query($sql);
            if ($resultSet) {
                if ($row = $resultSet->fetchArray()) {
                    $id = $row[0];
                    $pwd = $row[1];
                } else {
                    $this->setErrorMsg('query failed:'.$this->$userDB->lastErrorMsg().' #sql:'.$sql);
                    $this->setErrorLocation(__FILE__, __FUNCTION__, __LINE__);
                    return false;
                }
            } else {
                $this->setErrorMsg('query failed:'.sqlite_last_error($this->$userDB).' #sql:'.$sql);
                $this->setErrorLocation(__FILE__, __FUNCTION__, __LINE__);
                return false;
            }
            
            if ($pwd == $upwd) {
                //TODO save id,username,permission in session
                return true;
            } else {
                $this->setErrorMsg('pwd mismatch');
                $this->setErrorLocation(__FILE__, __FUNCTION__, __LINE__);
                return false;
            }
        }
        
        public function getUserInfo() {
            if (!$this->connectUserDB()) {
                return false;
            }
            
            $users = array();
            $sql = sprintf("select * from %s", USER_INFO);
            $resultSet = $this->userDB->query($sql); 
            if ($resultSet) {
                $i = 0;
                while($row = $resultSet->fetchArray()) {
                    $user = array('uid' => $row[0],
                                  'name' => $row[1],
                                  'permissionPad' => $row[3],
                                  'permissionFG' => $row[4],
                                  'permissionBG' => $row[5] );
                    $users[$i] = $user;
                    $i++;
                 }
            } else {
                $this->setErrorMsg("query failed:".$this->userDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
           
            return json_encode($users);
        }
        
        //TODO
        public function addUser() {
            
        }
        
        //TODO
        public function updateUserInfo() {
                
        }
        
        //TODO test
        public function deleteUser($id) {
            if (!$this->connectUserDB()) {
                return false;
            }
            
            $sql = sprintf("Delete From %s where id=%s", USER_INFO, $id);
            $ret = $this->userDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->userDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        public function getTableInfo() {
            if (!$this->connectInfoDB()) {
                return false;
            }
            
            $tables = array();
            $sql = sprintf("select * from %s ORDER BY tableOrder", TABLE_INFO);
            $resultSet = $this->infoDB->query($sql); 
            if ($resultSet) {
                $i = 0;
                while($row = $resultSet->fetchArray()) {
                    $table = array('id' => $row[0],
                                  'name' => $row[1],
                                  'index' => $row[3],
                                  'category' => $row[4],
                                  'area' => $row[5],
                                  'floor' => $row[6] );
                    $tables[$i] = $table;
                    $i++;
                 }
            } else {
                $this->setErrorMsg("query failed:".$this->infoDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
           
            return json_encode($tables);
        }

        //TODO
        public function addTable() {
            
        }

        //TODO
        public function updateTable() {
            
        }
        
        public function deleteTable($id) {
            if (!$this->connectinfoDB()) {
                return false;
            }
            
            $sql = sprintf("Delete from %s where id=%s", TABLE, $id);
            $ret = $this->infoDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->infoDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        //TODO
        public function updateTableIndex() {
            
        }
        
        public function getCategoryPrint() {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $categoryPrintList = array();
            $sql = sprintf("select * from %s order by %s", CATEGORIES, 'categoryOrder');
            $rsCategories = $this->menuDB->query($sql); 
            if ($rsCategories) {
                $i = 0;
                while($rowCategory = $rsCategories->fetchArray()) {
                    $sql = sprintf("select %s.categoryID, categoryName, sortPrintID, sortPrintName
                                           from %s, %s, %s, %s 
                                           WHERE %s.id=%s.dishID AND %s.id=sortPrintID AND %s.categoryID=%s
                                           GROUP BY sortPrintID",
                                           CATEGORIES,
                                           DISHES, CATEGORIES, PRINTERS, DISH_CATEGORY,
                                           DISHES, DISH_CATEGORY, PRINTERS, DISH_CATEGORY, $rowCategory[0]);
                    $resultSet = $this->menuDB->query($sql); 
                    if ($resultSet) {
                        $printerIndex = 0;
                        $printers = array();
                        $printerNames = "";
                        
                        while($row = $resultSet->fetchArray()) {
                            $printers[$printerIndex] = $row[2];
                            $printerNames .= $row[3].",";
                            $printerIndex++;
                         }
                         if (count($printers) > 0) {
                             $printerNames = substr($printerNames, 0, strlen($printerNames) - 1);
                         }
                         $categoryPrint = array('id' => $rowCategory[0],
                                             'name' => $rowCategory[1],
                                             'printerNames' => $printerNames,
                                             'printerIds' => $printers);
                         $categoryPrintList[$i] = $categoryPrint;
                         $i++;
                    } else {
                        $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                        return false;
                    }
                 }
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
            
           
            return json_encode($categoryPrintList);
        }
        
        //TODO
        public function updateCategoryPrint() {
            
        }

        public function getServices() {
            if (!$this->connectInfoDB()) {
                return false;
            }
            
            $services = array();
            $sql = sprintf("select * from %s", SERVICES);
            $resultSet = $this->infoDB->query($sql); 
            if ($resultSet) {
                $i = 0;
                while($row = $resultSet->fetchArray()) {
                    $service = array('id' => $row[0],
                                  'service' => $row[1]);
                    $services[$i] = $service;
                    $i++;
                 }
            } else {
                $this->setErrorMsg("query failed:".$this->infoDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
           
            return json_encode($services);
        }
        
        public function addService($service) {
            if (!$this->connectinfoDB()) {
                return false;
            }
            
            $sql = sprintf("Insert into %s values(null, '%s')", SERVICES, $service);
            $ret = $this->infoDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->infoDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        public function deleteService($id) {
            if (!$this->connectinfoDB()) {
                return false;
            }
            
            $sql = sprintf("Delete from %s where id=%s", SERVICES, $id);
            $ret = $this->infoDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->infoDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        public function getCategories() {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $categories = array();
            $sql = sprintf("select * from %s order by %s", CATEGORIES, 'categoryOrder');
            $resultSet = $this->menuDB->query($sql); 
            if ($resultSet) {
                $i = 0;
                while($row = $resultSet->fetchArray()) {
                    $category = array('id' => $row[0],
                                     'name' => $row[1],
                                     'index' => $row[2]);
                    $categories[$i] = $category;
                    $i++;
                 }
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
           
            return json_encode($categories);
        }
        
        //TODO
        public function addCategory($name, $index) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $sql = sprintf("Delete From %s where categoryID=%s", CATEGORIES, id);
            $ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
        }
        
        //TODO test
        public function deleteCategory($id) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $sql = sprintf("Delete From %s where categoryID=%s", CATEGORIES, $id);
            $ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
        }
        
        //TODO
        public function updateCategory() {
            
        }
        
        //TODO
        public function updateCategoryIndex() {
            
        }
        
        public function getUnits() {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $units = array();
            $sql = sprintf("select * from %s", UNITS);
            $resultSet = $this->menuDB->query($sql); 
            if ($resultSet) {
                $i = 0;
                while($row = $resultSet->fetchArray()) {
                    $unit = array('id' => $row[0],
                                     'name' => $row[1]);
                    $units[$i] = $unit;
                    $i++;
                 }
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
           
            return json_encode($units);
        }
        
        public function addUnit($unit) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $sql = sprintf("Insert into %s values(null, '%s')", UNITS, $unit);
            $ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        public function deleteUnit($id) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $sql = sprintf("Delete From %s where id=%s", UNITS, $id);
            $ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        public function getDishes($categoryId) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $dishes = array();
            $sql = sprintf("select %s.id, name, shortcut, price, unitName,
                                   description, sortPrintName, dishOrder, englishName
                                   from %s, %s, %s, %s 
                                   WHERE %s.id=%s.dishID AND %s.id=unitID AND %s.id=sortPrintID AND categoryID=%s
                                   ORDER BY dishOrder",
                                   DISHES,
                                   DISHES, UNITS, PRINTERS, DISH_CATEGORY,
                                   DISHES, DISH_CATEGORY, UNITS, PRINTERS, $categoryId);
            $resultSet = $this->menuDB->query($sql); 
            if ($resultSet) {
                $i = 0;
                while($row = $resultSet->fetchArray()) {
                    $dish = array('id' => $row[0],
                                   'name' => $row[1],
                                   'ename' => $row[8],
                                   'shortcut' => $row[2],
                                   'price' => $row[3],
                                   'unitName' => $row[4],
                                   'description' => $row[5],
                                   'sortPrintName' => $row[6],
                                   'index' => $row[7]);
                    $dishes[$i] = $dish;
                    $i++;
                 }
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
           
            return json_encode($dishes);
        }
        
        //TODO
        public function addDish() {
            
        }
                
        //TODO
        public function updateDish() {
            
        }
        
        //TODO test
        public function deleteDish($id) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $sql = sprintf("Delete From %s where id=%s", DISHES, $id);
            $ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
    	private function setErrorMsg($msg) {
            $this->err['error'] = $msg;
        }

        private function setErrorLocation($file, $func, $line) {
            $this->err['location'] = basename($file)." : $func : $line";    
        }

        private function setErrorNone() {
            $this->err['succ'] = TRUE;
        }

        private function connectMenuDB() {
            if ($this->menuDB == null) {
                $this->menuDB = new SQLite3(MENU_DB);
                $this->menuDB->busyTimeout(5000);
                if (!$this->menuDB) {
                    $this->setErrorMsg('could not connect db:'.MENU_DB);
                    return false;
                }
            }
            
            return true;
        }
        
    	private function connectUserDB(){
    	    if ($this->userDB == null) {
    	        $this->userDB = new SQLite3(USER_DB);
                $this->userDB->busyTimeout(5000);
                if (!$this->userDB) {
                    $this->setErrorMsg('could not connect db:'.USER_DB);
                    return false;
                }
    	    }
            
            return true;
        }
        
        private function connectInfoDB(){
            if ($this->infoDB == null) {
                $this->infoDB = new SQLite3(INFO_DB);
                $this->infoDB->busyTimeout(5000);
                if (!$this->infoDB) {
                    $this->setErrorMsg('could not connect db:'.INFO_DB);
                    return false;
                }
            }
            
            return true;
        }
        
    	function __destruct() {
            if (isset($this->menuDB)) {
                $this->menuDB->close();
            }
            if (isset($this->userDB)) {
                $this->userDB->close();
            }
            if (isset($this->infoDB)) {
                $this->infoDB->close();
            }
        }
	}
?>