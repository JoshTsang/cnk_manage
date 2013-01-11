<?php
    class Permission {
        private $permission = array(
            0 => "权限0",
            1 => "权限1",
            2 => "权限2",
            3 => "权限3",
            4 => "权限4",
            5 => "权限5",
            6 => "权限6",
            7 => "权限7");
            
       public function permissionSelectSection() {
            echo '<div class="control-group">
                <label class="control-label" for="permissionPad">Pad权限</label>
                <div class="controls"><select id="permissionPad">';
            $this->permissionSelect();
            echo '</select></div></div>';
             echo '<div class="control-group">
                <label class="control-label" for="permissionFG">前台权限</label>
                <div class="controls"><select id="permissionFG">';
            $this->permissionSelect();
            echo '</select></div></div>';
             echo '<div class="control-group">
                <label class="control-label" for="permissionBG">后台权限</label>
                <div class="controls"><select id="permissionBG">';
            $this->permissionSelect();
            echo '</select></div></div>';
        }

        public function toString($permission) {
            return $this->permission[$permission];
        }
        
        private function permissionSelect() {
            $permissionCount = count($this->permission);
            for ($i=0; $i<$permissionCount; $i++) {
                echo "<option value=\"$i\">".$this->permission[$i]."</option>\n";
            }
        }
        
    }
    
        
?>