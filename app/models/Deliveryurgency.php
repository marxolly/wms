<?php
class DeliveryUrgency extends Model{
    public $table = "delivery_urgencies";

    public function getUrgencyName($id)
    {
        $db = Database::openConnection();
        return $db->queryValue($this->table, array('id' =>  $id), 'name');
    }

    public function getUrgencyId($name)
    {
        $db = Database::openConnection();
        return $db->queryValue($this->table, array('name' =>  $name));
    }

    public function getUrgencies($active = -1)
    {
        $db = Database::openConnection();
        $q = "SELECT * FROM ".$this->table;
        if($active >= 0)
        {
            $q .= " WHERE active = $active";
        }
        $q .= " ORDER BY name";
        return $db->queryData($q);
    }

    public function getSelectUrgencies($selected = false)
    {
        $db = Database::openConnection();
        $hour = date("G");
        $return_string = "";
        $urgencies = $db->queryData("SELECT id, name, cut_off FROM {$this->table} WHERE active = 1 ORDER BY name");
        if(!Session::isDeliveryClientUser() && !$selected)
            $selected = $this->getUrgencyId("Same Day");
        foreach($urgencies as $u)
        {
            if( $hour >= $u['cut_off'] && Session::isDeliveryClientUser() )
                continue;
            $label = ucwords($u['name']);
            $value = $u['id'];
            $return_string .= "<option value='$value' ";
            if($selected && $selected == $value)
            {
                $return_string .= "selected = 'selected' ";
            }
            elseif(!$selected && $hour >= 12 && $u['cut_off'] > 17)
            {
                $return_string .= "selected = 'selected' ";
            }
            elseif(!$selected && $hour < 12 && $u['cut_off'] > 12)
            {
                $return_string .= "selected = 'selected' ";
            }
            $return_string .= ">$label</option>";
        }
        return $return_string;
    }

    public function getSelectAllUrgencies($selected = false)
    {
        $db = Database::openConnection();
        $return_string = "";
        $urgencies = $db->queryData("SELECT id, name FROM {$this->table} WHERE active = 1 ORDER BY name");
        foreach($urgencies as $u)
        {
            $label = ucwords($u['name']);
            $value = $u['id'];
            $return_string .= "<option value='$value' ";
            if($selected && $selected == $value)
            {
                $return_string .= "selected = 'selected' ";
            }
            $return_string .= ">$label</option>";
        }
        return $return_string;
    }

    public function addUrgency($name, $cut_off, $charge_level)
    {
        $db = Database::openConnection();
        $db->insertQuery($this->table, array(
            'name'          => $name,
            'cut_off'       => $cut_off,
            'charge_level'  => $charge_level
        ));
    }

    public function updateLabel($data)
    {
        //print_r($data);
       $db = Database::openConnection();
       $vals = array(
            "name"          => $data['name'],
            'active'        => $data['active'],
            'cut_off'       => $data['cut_off'],
            'charge_level'  => $data['charge_level']
       );
       if(isset($data['locked'])) $vals['locked'] = $data['locked'];
       $db->updateDatabaseFields($this->table, $vals, $data['id']);
    }
}
?>