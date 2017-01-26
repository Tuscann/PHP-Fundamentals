<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            text-indent: 5px;
            border-collapse: collapse;
        }
        table th, table td {
            width: 120px;
            line-height: 25px;
            border: 1px solid black;
        }
        table th {
            text-align: left;
            background: #FFA100;
        }
        table td {
            text-align: right;
        }
    </style>
</head>
</html>

<?php
class Person {
    var $name;
    var $gsmNumber;
    var $age;
    var $address;

    function set_name($new_name) {
        $this->name = $new_name;
    }
    function get_name(){
        return $this -> name;
    }
    function set_gsmNumber($new_gsmNumber) {
        $this->gsmNumber = $new_gsmNumber;
    }
    function get_gsmNumber(){
        return $this -> gsmNumber;
    }
    function set_age($new_age) {
        $this->age = $new_age;
    }
    function get_age(){
        return $this -> age;
    }
    function set_address($new_address) {
        $this->address = $new_address;
    }
    function get_address(){
        return $this -> address;
    }
}

function createPerson($array){
    $person = new Person();
    $person->set_name($array[0]);
    $person->set_gsmNumber($array[1]);
    $person->set_age($array[2]);
    $person->set_address($array[3]);

    echo "<table>
			<tr>
				<th>Name</th>
				<td>".$person->get_name()." </td>
			</tr>
			<tr>
				<th>Phone number</th>
				<td>".$person->get_gsmNumber()." </td>
			</tr>
			<tr>
				<th>Age</th>
				<td>".$person->get_age()." </td>
			</tr>
			<tr>
				<th>Address</th>
				<td>".$person->get_address()." </td>
			</tr>
			<br/>
		</table>";
}

createPerson(array("Gosho", "0882-321-423", 24, "Hadji Dimitar"));
createPerson(array("Pesho", "0884-888-888", 67, "Suhata Reka"));
?>