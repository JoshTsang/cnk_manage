<?php
    class Permission {
        private $permission = array(
            0 => "老板",
            1 => "经理",
            2 => "副经理",
            3 => "财务",
            4 => "收银员",
            5 => "服务员",
            6 => "传菜员",
            7 => "点菜员");
       
       private $PadStr = array("点菜", "清台", "退菜", "预付", "转台/合并", "收银", "设置", "统计", "备份/恢复");
       private $Pad = array(array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, FALSE, FALSE),
                            array(FALSE, FALSE, FALSE, FALSE, FALSE, TRUE, FALSE, TRUE, FALSE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, FALSE, FALSE, FALSE),
                            array(TRUE, TRUE, TRUE, FALSE, TRUE, FALSE, TRUE, FALSE, FALSE),
                            array(TRUE, FALSE, TRUE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE),
                            array(TRUE, TRUE, TRUE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE));
       
       private $FGStr = array("事件1", "事件2", "事件3", "事件4", "事件5", "事件6", "事件7", "事件8", "事件9");
       private $FG = array(array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE));
                            
       private $BGStr = array("桌台管理", "菜品管理", "打印机管理", "口味管理", "服务管理", "用户管理");
       private $BG = array(array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, FALSE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, FALSE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, FALSE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, FALSE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, FALSE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, FALSE),
                            array(TRUE, TRUE, TRUE, TRUE, TRUE, FALSE));
                            
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
            if (isset($this->permission[$permission])) {
                return $this->permission[$permission];
            }
            return $permission;
        }
        
        private function permissionSelect() {
            $permissionCount = count($this->permission);
            for ($i=0; $i<$permissionCount; $i++) {
                echo "<option value=\"$i\">".$this->permission[$i]."</option>\n";
            }
        }
        
        public function permissionHelp($type) {
            switch(strtolower($type)) {
                case "pad":
                    $str = $this->PadStr;
                    $per = $this->Pad;
                    break;
                case 'fg':
                    $str = $this->FGStr;
                    $per = $this->FG;
                    break;
                case 'bg':
                default:
                    $str = $this->BGStr;
                    $per = $this->BG;
            }

            $countColum = count($this->permission);
            $ret = "";
            $ret .= '<table class="table table-striped table-bordered"><thead><tr><td>动作</td>';
            for ($i=0; $i<$countColum; $i++) {
                $ret .= "<td>".$this->permission[$i]."</td>";
            }
            $ret .= "</tr></thead>";
            $count = count($str);
            for ($i=0; $i<$count; $i++) {
                $ret .= '<tr><td style="width: 20%">'.$str[$i]."</td>";
                for ($j=0; $j<$countColum; $j++) {
                    $ret .= '<td>';
                    $ret .= $per[$j][$i]?'<i class="icon-ok"></i>':"";
                    $ret .= '</td>';
                }
                $ret .= "</tr>";
            }
            $ret .= '</table>';
            return $ret;
        }
    }
    
        
?>