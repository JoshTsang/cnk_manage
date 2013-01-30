<?php
	class DB {
        private $menuDB;
        private $userDB;
        private $infoDB;
        private $err = array('err_code' => 0,
                             'err_msg' => 'unknown',
                             'tip' => NULL);
        
        public function getError($msg = null) {
            if ($msg != null) {
                $this->setErrorMsg($msg);
            }
            return json_encode($this->err);
        }               
        
        //TODO finish
        public function login($username, $upwd) {
            if (!$this->connectUserDB()) {
                return false;
            }
            
            $sql=sprintf("SELECT %s, %s, bgadm FROM %s WHERE %s.%s = '%s'",
                         USER_ID, USER_PWD,USER_INFO,USER_INFO,USER_NAME,$username);
            $resultSet = $this->userDB->query($sql);
            if ($resultSet) {
                if ($row = $resultSet->fetchArray()) {
                    $id = $row[0];
                    $pwd = $row[1];
                    $permission = $row[2];
                } else {
                    $this->setErrorMsg('query failed:'.$this->userDB->lastErrorMsg().' #sql:'.$sql);
                    $this->setErrorLocation(__FILE__, __FUNCTION__, __LINE__);
                    return false;
                }
            } else {
                $this->setErrorMsg('query failed:'.$this->userDB->lastErrorMsg().' #sql:'.$sql);
                $this->setErrorLocation(__FILE__, __FUNCTION__, __LINE__);
                return false;
            }
            
            if ($upwd == md5($pwd)) {
                $_SESSION['user'] = $username;
                $_SESSION['id'] = $id;
                $_SESSION['permission'] = $permission;
                $_SESSION['logedin'] = TRUE;
                $_SESSION['time'] = time();
                $this->setErrorNone();
                return $this->getError();
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
            $permission = New Permission(); 
            $users = array();
            $sql = sprintf("SELECT * FROM %s", USER_INFO);
            @$resultSet = $this->userDB->query($sql); 
            if ($resultSet) {
                $i = 0;
                while($row = $resultSet->fetchArray()) {
                    $user = array('uid' => $row[0],
                                  'name' => $row[1],
                                  'permissionPad' => $row[3],
                                  'permissionPadStr' => $permission->toString($row[3]),
                                  'permissionFG' => $row[4],
                                  'permissionFGStr' => $permission->toString($row[4]),
                                  'permissionBG' => $row[5],
                                  'permissionBGStr' => $permission->toString($row[5]));
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
        public function addUser($user) {
            if (!isset($user->name) || !isset($user->passwd) || !isset($user->permissionPad)) {
                $this->setErrorMsg("some filed of user is missing");
                return false;
            }
            
            if (!$this->connectUserDB()) {
                return false;
            }
             
            //TODO
            $sql = sprintf("INSERT INTO userInfo(username, password, permission, fgadm, bgadm) VALUES('%s', '%s', %s, %s, %s)",
                            $user->name, $user->passwd, $user->permissionPad, $user->permissionFG, $user->permissionBG);
            @$ret = $this->userDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->userDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        //TODO
        public function updateUserInfo($user) {
            if (!isset($user->name)) {
                $this->setErrorMsg("some filed of user is missing");
                return false;
            }
            
            if (!$this->connectUserDB()) {
                return false;
            }
            
            if (isset($user->passwd) && isset($user->permissionPad)) {
                $sql = sprintf("UPDATE userInfo SET username='%s', password='%s', permission=%s, fgadm=%s, bgadm=%s WHERE id=%s",
                                $user->name, $user->passwd, $user->permissionPad, $user->permissionFG, $user->permissionBG, $user->id);
            } else if (isset($user->permissionPad)){
                $sql = sprintf("UPDATE userInfo SET username='%s', permission=%s, fgadm=%s, bgadm=%s WHERE id=%s",
                                $user->name, $user->permissionPad, $user->permissionFG, $user->permissionBG, $user->id);
            } else {
                $sql = sprintf("UPDATE userInfo SET username='%s', password='%s' WHERE id=%s",
                                $user->name, $user->passwd, $user->id);
            }
            @$ret = $this->userDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->userDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        public function deleteUser($id) {
            if (!$this->connectUserDB()) {
                return false;
            }
            
            $sql = sprintf("DELETE FROM %s WHERE id=%s", USER_INFO, $id);
            @$ret = $this->userDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->userDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        public function getPrinters() {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $printers = array();
            $sql = sprintf("SELECT * FROM %s", "sortPrint");
            $resultSet = $this->menuDB->query($sql); 
            if ($resultSet) {
                $i = 0;
                while($row = $resultSet->fetchArray()) {
                    $printer = array('id' => $row[0],
                                  'name' => $row[1]);
                    $printers[$i] = $printer;
                    $i++;
                 }
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
           
            return json_encode($printers);
        }
        
        public function getTableInfo() {
            if (!$this->connectInfoDB()) {
                return false;
            }
            
            $tables = array();
            $sql = sprintf("SELECT * FROM %s ORDER BY tableOrder", TABLE_INFO);
            @$resultSet = $this->infoDB->query($sql); 
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
        public function addTable($table) {
            $index = 0;
            $floor = 1;
            $category = 0;
            $tableArea = 0;
            $index = 0;
            if (!isset($table->name)) {
                $this->setErrorMsg("table name?");
                return false;
            }
            if (isset($table->index)) {
                $index = $table->index;
            } else {
                $index = $this->getMaxTableIndex();
                if (!$index) {
                    return FALSE;
                }
                $index++;
            }
            
            if (isset($table->floor)) {
                $floor = $table->floor;
            }
            
            if (isset($table->category)) {
                $category = $table->category;
            }
            
            if (isset($table->area)) {
                $tableArea = $table->area;
            }
            
            if (!$this->connectInfoDB()) {
                return false;
            }
            
            $sql = sprintf('INSERT INTO tableInfo(tableName, status, tableOrder, tableCategory, tableArea, tableFloor) '.
                     "VALUES('%s', 0, %s, %s, %s, %s)", $table->name, $index, $category, $tableArea, $floor);
            @$ret = $this->infoDB->exec($sql);
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec faild, err:".$this->infoDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
        }
        
        public function getMaxTableIndex() {
            if (!$this->connectInfoDB()) {
                return false;
            }
            
            //TODO sql;
            $sql = 'SELECT max(tableOrder) FROM tableInfo';
            @$ret = $this->infoDB->query($sql);
            if ($ret) {
                if ($row = $ret->fetchArray()) {
                    return $row[0];
                } else {
                    $this->setErrorMsg("getMaxTableIndex failed, #sql:".$sql);
                    return false;
                }
            } else {
                $this->setErrorMsg("getMaxTableIndex failed, #sql:".$sql);
                return false;
            }
        }
        //TODO
        public function updateTable($table) {
            $index = 0;
            $floor = 1;
            $category = 0;
            $tableArea = 0;
            $index = 0;
            if (!isset($table->name)) {
                $this->setErrorMsg("table name?");
                return false;
            }
            if (isset($table->index)) {
                $index = $table->index;
            } else {
                $index = $this->getMaxTableIndex();
                if (!$index) {
                    return FALSE;
                }
                $index++;
            }
            
            if (isset($table->floor)) {
                $floor = $table->floor;
            }
            
            if (isset($table->category)) {
                $category = $table->category;
            }
            
            if (isset($table->area)) {
                $tableArea = $table->area;
            }
            
            if (!$this->connectInfoDB()) {
                return false;
            }
            
            $sql = sprintf('UPDATE tableInfo SET tableName=%s, tableOrder=%s, tableCategory=%s, tableArea=%s, tableFloor=%s WHERE id=%s'
                     , $table->name, $index, $category, $tableArea, $floor, $table->id);
            @$ret = $this->infoDB->exec($sql);
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec faild, err:".$this->infoDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
        }
        
        public function deleteTable($id) {
            if (!$this->connectInfoDB()) {
                return false;
            }
            
            $sql = sprintf("DELETE FROM %s WHERE id=%s", TABLE, $id);
            @$ret = $this->infoDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->infoDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        //TODO
        public function updateTableIndex($table) {
            if (!$this->connectInfoDB()) {
                return false;
            }
            $count = count($table);
            for ($i=0; $i<$count; $i++) {
                $sql = sprintf("UPDATE %s SET tableOrder=%s WHERE id=%s", TABLE, -$i, $table[$i]->id);
                @$ret = $this->infoDB->exec($sql); 
                if (!$ret) {
                    $this->setErrorMsg("query failed:".$this->infoDB->lastErrorMsg()."#sql:".$sql);
                    return false;
                }
            }
            for ($i=0; $i<$count; $i++) {
                $sql = sprintf("UPDATE %s SET tableOrder=%s WHERE id=%s", TABLE, $table[$i]->index, $table[$i]->id);
                @$ret = $this->infoDB->exec($sql); 
                if (!$ret) {
                    $this->setErrorMsg("query failed:".$this->infoDB->lastErrorMsg()."#sql:".$sql);
                    return false;
                }
            }
            $this->setErrorNone();
            return $this->getError();
        }
        
        public function getCategoryPrint() {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $categoryPrintList = array();
            $sql = sprintf("SELECT * FROM %s ORDER BY %s", CATEGORIES, 'categoryOrder');
            $rsCategories = $this->menuDB->query($sql); 
            if ($rsCategories) {
                $i = 0;
                while($rowCategory = $rsCategories->fetchArray()) {
                    $sql = sprintf("SELECT %s.categoryID, categoryName, sortPrintID, sortPrintName
                                           FROM %s, %s, %s, %s 
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
        public function updateCategoryPrint($categoryPrint) {
            if (!isset($categoryPrint->printer) || !isset($categoryPrint->category)) {
                $this->setErrorMsg("printer?category?");
                return FALSE;
            }
            $sql = sprintf("UPDATE %s SET sortPrintID=%s".
                           " WHERE id IN (SELECT %s.id from %s, %s WHERE %s.id=%s.dishID AND categoryID=%s)",
                           DISHES,
                           $categoryPrint->printer,
                           DISHES,
                           DISHES, DISH_CATEGORY,
                           DISHES, DISH_CATEGORY, $categoryPrint->category);
            
            if (!$this->connectMenuDB()) {
                return FALSE;
            }
            @$ret = $this->menuDB->exec($sql);
            if ($ret) {
                $this->updateVersion();
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
        }

        public function getServices() {
            if (!$this->connectInfoDB()) {
                return false;
            }
            
            $services = array();
            $sql = sprintf("SELECT * FROM %s", SERVICES);
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
            
            $sql = sprintf("INSERT INTO %s VALUES(null, '%s')", SERVICES, $service);
            @$ret = $this->infoDB->exec($sql); 
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
            
            $sql = sprintf("DELETE FROM %s WHERE id=%s", SERVICES, $id);
            @$ret = $this->infoDB->exec($sql); 
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
            $sql = sprintf("SELECT * FROM %s ORDER BY %s", CATEGORIES, 'categoryOrder');
            @$resultSet = $this->menuDB->query($sql); 
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
        
        public function addCategory($category) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            if (!isset($category->name)) {
                $this->setErrorMsg("name?");
                return false;
            }
            
            if (isset($category->index)) {
               $index =  $category->index;
            } else {
                $index = $this->getMaxCategoryIndex();
                if (!$index) {
                    return false;
                }
                $index++;
            }
            
            $sql = sprintf("INSERT INTO %s(categoryName, categoryOrder) VALUES('%s', %s)", CATEGORIES, $category->name, $index);
            @$ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
        }
        
        public function getMaxCategoryIndex() {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            //TODO sql;
            $sql = 'SELECT max(categoryOrder) FROM category';
            @$ret = $this->menuDB->query($sql);
            if ($ret) {
                if ($row = $ret->fetchArray()) {
                    return $row[0];
                } else {
                    $this->setErrorMsg("getMaxTableIndex failed, #sql:".$sql);
                    return false;
                }
            } else {
                $this->setErrorMsg("getMaxTableIndex failed, #sql:".$sql);
                return false;
            }
        }
        
        //TODO test
        public function deleteCategory($id) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $sql = sprintf("DELETE FROM %s WHERE categoryID=%s", CATEGORIES, $id);
            @$ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->updateVersion();
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
        }
        
        //TODO
        public function updateCategory($category) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            if (!isset($category->name)) {
                $this->setErrorMsg("name?");
                return false;
            }
            
            if (isset($category->index)) {
               $index =  $category->index;
            } else {
                $this->setErrorMsg("index?");
                return false;
            }
            
            $sql = sprintf("UPDATE %s SET categoryName='%s', categoryOrder=%s WHERE categoryID=%s", CATEGORIES, $category->name, $index, $category->id);
            @$ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->updateVersion();
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
        }
        
        //TODO
        public function updateCategoryIndex($category) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            $count = count($category);
            for ($i=0; $i<$count; $i++) {
                $sql = sprintf("UPDATE %s SET categoryOrder=%s WHERE categoryID=%s", CATEGORIES, -$i, $category[$i]->id);
                @$ret = $this->menuDB->exec($sql); 
                if (!$ret) {
                    $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                    return false;
                }
            }
            for ($i=0; $i<$count; $i++) {
                $sql = sprintf("UPDATE %s SET categoryOrder=%s WHERE categoryID=%s", CATEGORIES, $category[$i]->index, $category[$i]->id);
                @$ret = $this->menuDB->exec($sql); 
                if (!$ret) {
                    $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                    return false;
                }
            }
            $this->updateVersion();
            $this->setErrorNone();
            return $this->getError();
        }
        
        public function getUnits() {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $units = array();
            $sql = sprintf("SELECT * FROM %s", UNITS);
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
            
            $sql = sprintf("INSERT INTO %s VALUES(null, '%s')", UNITS, $unit);
            @$ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->updateVersion();
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
            
            $sql = sprintf("DELETE FROM %s WHERE id=%s", UNITS, $id);
            @$ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->updateVersion();
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
            $sql = sprintf("SELECT %s.id, name, shortcut, price, unitName,
                                   description, sortPrintName, dishOrder, englishName, unitID, discount 
                                   FROM %s, %s, %s, %s 
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
                                   'unitId' => $row[9],
                                   'description' => $row[5],
                                   'sortPrintName' => $row[6],
                                   'discount' => $row[10],
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
        public function addDish($dish) {
            $ename = "";
            $price2 = "null";
            $price3 = "null";
            $shortcut = "";
            $discount = 10;
            $description = "";
            $pic = "";
            
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            if (!isset($dish->name) || !isset($dish->price) ||
                !isset($dish->printer) || !isset($dish->unit) || !isset($dish->category)) {
                $this->setErrorMsg("name/price/printer/unit?");
                return false;
            } else {
                $name = $dish->name;
                $price = $dish->price;
                $printer = $dish->printer;
                $unit = $dish->unit;
                $ret = json_decode($this->queryDish($dish));
                if ($ret->id > 0) {
                    $dish->id = $ret->id;
                    
                    if (FALSE === $this->updateDish($dish)) {
                        return FALSE;
                    }
                    $ret = $this->addDishCategoryMap($ret->id, $dish->category);
                    if (!$ret) {
                        return FALSE;
                    }
                      
                    $this->updateVersion();
                    $this->setErrorNone();
                    return $this->getError();
                }
            }
            
            if(isset($dish->ename)) {
                $ename = $dish->ename;
            }
            if(isset($dish->price2)) {
                $price2 = $dish->price2;
            }
            if(isset($dish->price3)) {
                $price3 = $dish->price3;
            }
            if(isset($dish->shortcut)) {
                $shortcut = $dish->shortcut;
            } else {
                $shortcut = $this->getShortcut();
                if (!$shortcut) {
                    return FALSE;
                }
            }
            
            if(isset($dish->discount)) {
                $discount = $dish->discount;
            }
            if(isset($dish->description)) {
                $description = $dish->description;
            }
            
            if (isset($dish->index)) {
               $index =  $dish->index;
            } else {
                $index = $this->getMaxDishIndex();
                if (!$index) {
                    return false;
                }
                $index++;
            }
            
            if (isset($dish->img)) {
                $pic = $this->dishImg($dish->img);
            }
            
            $sql = sprintf("INSERT INTO %s VALUES(null, '%s', '%s', '%s', %s, %s, %s, %s, %s, '%s', '%s', null, 1, 1, %s, %s)",
                             DISHES,
                             $name, $ename, $shortcut, $price, $price2, $price3, $discount, $unit, $description, $pic, $printer, $index);
            @$ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $sql = "SELECT id FROM dishInfo WHERE dishOrder=$index";
                 @$ret = $this->menuDB->query($sql);
                  if ($ret) {
                      if ($row = $ret->fetchArray()) {
                          $ret = $this->addDishCategoryMap($row[0], $dish->category);
                          if (!$ret) {
                              return false;
                          }
                      }
                  } else {
                     $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                     return false;
                  }
                $this->updateVersion();
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
        }
        
        private function addDishCategoryMap($did, $cid) {
             $sql = "INSERT INTO dishCategory VALUES(null, $did, $cid)";
             @$ret = $this->menuDB->exec($sql);
              if ($ret) {
                  return true;
              } else {
                 $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                 return false;
              }
        }
        
        private function getShortcut() {
            $sql = 'SELECT max(shortcut) FROM dishInfo';
            @$ret = $this->menuDB->query($sql);
            if ($ret) {
                if ($row = $ret->fetchArray()) {
                    return $row[0] + 1;
                } else {
                    $this->setErrorMsg("getMaxTableIndex failed, #sql:".$sql);
                    return false;
                }
            } else {
                $this->setErrorMsg("getMaxTableIndex failed, #sql:".$sql);
                return false;
            }
        }
        
        private function dishImg($src) {
            $pic = md5_file(IMG_UPLOAD_PATH.$src);
            $pathInfo = pathinfo($src);
            $pic .= '.'.$pathInfo['extension'];
            copy(IMG_UPLOAD_PATH.$src,IMG_PATH.$pic);
            unlink(IMG_UPLOAD_PATH.$src);
            return $pic;
        }
        
        //TODO
        public function updateDish($dish) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $sql = "UPDATE dishInfo SET ";
            if (!isset($dish->name) || !isset($dish->price) ||
                !isset($dish->printer) || !isset($dish->unit)|| !isset($dish->id)) {
                $this->setErrorMsg("name/price/printer/unit?");
                return false;
            } else {
                $sql .= "name='".$dish->name."', price=".$dish->price.", sortPrintID=".$dish->printer.", unitID=".$dish->unit;
            }
            
            if(isset($dish->ename)) {
                $sql .= ", ename='".$dish->ename."'";
            }
            if(isset($dish->price2)) {
                $sql .= ", priceTwo=".$dish->price2;
            }
            if(isset($dish->price3)) {
                $sql .= ", priceThree=".$dish->price3;
            }
            if(isset($dish->shortcut)) {
                $sql .= ", shortcut='".$dish->shortcut."'";
            }
            
            if(isset($dish->discount)) {
                $sql .= ", discount = ".$dish->discount;
            }
            
            if(isset($dish->description)) {
                $sql .= ", description='".$dish->description."'";
            }
            
            if (isset($dish->index)) {
               $sql .= ", dishOrder=".$dish->index;
            }
            
            if (isset($dish->img)) {
                $pic = $this->dishImg($dish->img);
                $sql .= ", pictureBUrl='".$pic."'";
            }
            
            $sql .= " WHERE id=".$dish->id;
            @$ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->updateVersion();
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("query failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return false;
            }
        }
        
        public function queryDish($dish) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $sql = sprintf("SELECT %s.id, categoryName FROM %s, %s, %s WHERE %s.name like '%s' AND %s.id = %s.dishID AND %s.categoryID = %s.categoryID",
                             DISHES, DISHES, DISH_CATEGORY, CATEGORIES,
                             DISHES, $dish->name, DISHES, DISH_CATEGORY, CATEGORIES, DISH_CATEGORY);
            
            $ret = $this->menuDB->query($sql);
            if ($ret) {
                $categories = array();
                $i = 0;
                
                $id = 0;
                while ($row = $ret->fetchArray()) {
                    $id = $row[0];
                    $categories[$i] = $row[1];
                    $i++;
                }
                
                $ret = array('id' => $id,
                             'category' => $categories);
                return json_encode($ret);
            } else {
                $this->setErrorMsg("exec failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        //TODO test
        public function deleteDish($id, $cid) {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            $sql = sprintf("DELETE FROM %s WHERE dishID=%s AND categoryID=%s", DISH_CATEGORY, $id, $cid);
            @$ret = $this->menuDB->exec($sql); 
            if ($ret) {
                $this->updateVersion();
                $this->setErrorNone();
                return $this->getError();
            } else {
                $this->setErrorMsg("exec failed:".$this->menuDB->lastErrorMsg()."#sql:".$sql);
                return FALSE;
            }
        }
        
        private function getMaxDishIndex() {
            if (!$this->connectMenuDB()) {
                return false;
            }
            
            //TODO sql;
            $sql = 'SELECT max(dishOrder) FROM dishInfo';
            @$ret = $this->menuDB->query($sql);
            if ($ret) {
                if ($row = $ret->fetchArray()) {
                    return $row[0];
                } else {
                    $this->setErrorMsg("getMaxTableIndex failed, #sql:".$sql);
                    return false;
                }
            } else {
                $this->setErrorMsg("getMaxTableIndex failed, #sql:".$sql);
                return false;
            }
        }
        
        private function updateVersion() {
            $sql = 'SELECT id,version FROM version';
            @$ret = $this->menuDB->query($sql);
            if ($ret) {
                if ($row = $ret->fetchArray()) {
                    $sql = sprintf("UPDATE version SET version=%s WHERE id=%s", $row[1]+1, $row[0]);
                    $ret = $this->menuDB->exec($sql);
                } else {
                    $this->setErrorMsg("getMaxTableIndex failed, #sql:".$sql);
                    return false;
                }
            } else {
                $this->setErrorMsg("getMaxTableIndex failed, #sql:".$sql);
                return false;
            }
        }
        
    	private function setErrorMsg($msg) {
    	    $this->err['err_code'] = 1;
            $this->err['err_msg'] = $msg;
        }

        private function setTip($tip) {
            $this->err['tip'] = $tip;
        }
        
        private function setErrorLocation($file, $func, $line) {
            $this->err['location'] = basename($file)." : $func : $line";    
        }

        private function setErrorNone() {
            $this->err['err_code'] = 0;
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