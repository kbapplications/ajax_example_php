<?php

class JsonResult {
    public $amount;
    public $value;

    function __construct($value) {
        $this->amount = 1;
        $this->value = $value;

        if(gettype($this->value) == "array") {
            $this->amount = sizeof($this->value);
        }
    }
}

// Simple function to check if a string contains
function contains($haystack, $search) {
    return strpos(strtolower($haystack), strtolower($search)) !== false;
}

$result = null;

if(!empty($_POST)) {
    $action = $_POST["action"];

    if($action == "updateCustomer") {
        // Update customer in database
    }
}
if(!empty($_GET)) {
    $action = $_GET["action"];

    if($action == "getCustomers") {
        // Get customers from db
        $customers = array();
        // Set custom value for testing purposes
        $customers[] = [
            "id" => 1,
            "name" => "Kevin Beye",
            "address" => "Molenweg 1 Berlicum",
            "createdAt" => "2020-06-11 09:00",
            "lastUpdated" => "2020-06-11 09:30"
        ];
        $customers[] = [
            "id" => 2,
            "name" => "Thomas Sprong",
            "address" => "Molenweg 2 Berlicum",
            "createdAt" => "2020-06-10 08:45",
            "lastUpdated" => "2020-06-11 06:00"
        ];
        $customers[] = [
            "id" => 3,
            "name" => "Peter Nöcker",
            "address" => "Molenweg 3 Berlicum",
            "createdAt" => "2020-01-10 12:45",
            "lastUpdated" => "2020-04-27 21:05"
        ];
        
        $search = $_GET["search"];
        if(!empty($search)) {
            $toDelete = [];
            for($i = 0; $i < sizeof($customers); $i++) {
                $customer = $customers[$i];
                if(!contains($customer["name"], $search)) {
                    $toDelete[] = $i;
                }
            }
            for($i = 0; $i < sizeof($toDelete); $i++) {
                unset($customers[$toDelete[$i]]);
            }
            $customers = array_values($customers);
        }

        $result = new JsonResult($customers);
    }
}

echo json_encode($result);
?>