<?php
//code for Cart
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	//code for adding product in cart
	case "add":
        if(!empty($_POST["quantity"])) {
            $pid = $_GET["pid"];
            $price = isset($_POST["price"]) ? $_POST["price"] : 0;
            $result = DB::select('select * from business_services where id = "'.$pid.'"');
            if (count($result) > 0) {
                foreach ($result as $item) {
                    $itemArray = array($item->serviceid=>array('type'=>$item->service_type, 'name'=>$item->program_name, 'code'=>$item->serviceid, 'quantity'=>$_POST["quantity"], 'price'=>$price, 'image'=>$item->profile_pic));
                    if(!empty($_SESSION["cart_item"])) {
                        if(in_array($item->serviceid, array_keys($_SESSION["cart_item"]))) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                if($item->serviceid == $k) {
                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                    }
                                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                }
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                        }
                    }  else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
            }
	}
	break;

	// code for removing product from cart
	case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k)
                    unset($_SESSION["cart_item"][$k]);				
                    if(empty($_SESSION["cart_item"]))
                    unset($_SESSION["cart_item"]);
                }
            }
	break;
	// code for if cart is empty
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
?>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#successAddCart').modal('show');
    });
</script>
<?php
}
?>