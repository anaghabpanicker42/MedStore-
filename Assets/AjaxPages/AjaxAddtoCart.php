<?php
include("../Connection/Connection.php");
session_start();
$selqry="select * from tbl_booking where request_id='".$_GET["rid"]."' and booking_status='0'";

$result=$Con->query($selqry);
if($result->num_rows>0)
{
	
	if($row=$result->fetch_assoc())
	{
		$bid = $row["booking_id"];
		
		
		
		$selqry="select * from tbl_cart where booking_id='".$bid."' and product_id='".$_GET["id"]."'";
		//echo $selqry;
		$result=$Con->query($selqry);
		if($result->num_rows>0)
		{
			 echo "Already Added to Cart";
			
		}
		else
		{
		
		 $insQry1="insert into tbl_cart(product_id,booking_id)values('".$_GET["id"]."','".$bid."')";
         if($Con->query($insQry1))
          { 
             echo "Added to Cart";
                        }
                        else
                        {
	                       echo"Failed";
                        }
		}
		
	}
	
}
else
{
	

$insQry=" insert into tbl_booking(request_id,booking_date)values('".$_GET["rid"]."',curdate())";
			if($Con->query($insQry))
			{
				$selqry1="select MAX(booking_id) as id from tbl_booking";
                $result=$Con->query($selqry1);
				if($row=$result->fetch_assoc())
				{
					$bid=$row["id"];
					
					
					$selqry="select * from tbl_cart where booking_id='".$bid."'and product_id='".$_GET["id"]."'";
		$result=$Con->query($selqry);
		if($result->num_rows>0)
		{
			 echo "Already Added to Cart";
			
		}
		else
		{
					
					
	                   $insQry1="insert into tbl_cart(product_id,booking_id)values('".$_GET["id"]."','".$bid."')";
                        if($Con->query($insQry1))
                        { 
                          echo "Added to Cart";
                        }
                        else
                        {
	                       echo"Failed";
                        }
					  
		}

                }
			}
}
?>