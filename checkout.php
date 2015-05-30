<?PHP 
	session_start(); 
	require_once(dirname(__FILE__) ."/includes/globals.php");
	require_once(dirname(__FILE__) ."/includes/functions/order.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/blogTemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="Description" content="" />
        <meta name="Keywords" content="" />
        <link rel="stylesheet" href="includes/css/main.css" type="text/css"/>
        
        <title><?PHP echo $site['title'] ?></title>
        <!-- InstanceBeginEditable name="head" -->
		<script>
			function updateBalance(paid, balance)
			{
				var formattedPaid = parseFloat(Math.round(paid * 100) / 100).toFixed(2);
				var remainingBalanace = balance - formattedPaid;
				
				var balanceDue = document.getElementById("balance");
					balanceDue.value = "$"+parseFloat(Math.round(remainingBalanace * 100) / 100).toFixed(2);
			}
		</script>

        <!-- InstanceEndEditable -->
    </head>
    <body>
            <div id="outer-wrapper">
                <div id="inner-wrapper">
                    <div id="content-wrapper">
    
                        <!-- Begin Content -->
                        <div id="content">
        
                            <!-- Main Navigation -->
                            <?PHP include("includes/topnav.php"); ?>				
        
                            <!-- Body Content -->
                            <div id="content-inner">
                                <!-- InstanceBeginEditable name="body" --> 
                                <div class="content-full">
                                	<form action="/includes/ui/makeSale.php" method="post">
                                        <div id="invoice">
                                            <span style="text-align:right;"><h1>Purchase Order</h1></span>
                                            <p>
                                            Below is the invoice for 
                                                <?PHP 
                                                    $totalDue = 0.00;
                                                    $_SESSION["GuestTickets"] = $_POST;
                                                    
                                                    echo "<strong>", getRank($_SESSION["PurchaseOrderInformation"][Rank]), " ";
                                                    echo $_SESSION["PurchaseOrderInformation"][Name], "</strong>. ";
                                                    
                                                    if($_SESSION["PurchaseOrderInformation"][EmailReceipt] == "on")
                                                    {
                                                        echo 	"A copy of this invoice will be emailed to <strong>", 
                                                                $_SESSION["PurchaseOrderInformation"][EmailAddress], 
                                                                "</strong> once the invoice is submitted.";
                                                    }
                                                ?>
                                            </p>
                                            <table>
                                                <thead>
                                                    <th>Person Name</th>
                                                    <th>Meal</th>
                                                    <th>Table</th>
                                                    <th>Chair</th>
                                                    <th>Price</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?PHP echo $_SESSION["PurchaseOrderInformation"][Name] ?></td>
                                                        <td><?PHP echo getMeal($_SESSION["PurchaseOrderInformation"][Meal]) ?></td>
                                                        <td><?PHP echo $_SESSION["PurchaseOrderInformation"][Table] ?></td>
                                                        <td><?PHP echo $_SESSION["PurchaseOrderInformation"][Chairs] ?></td>
                                                        <td>
                                                            <?PHP 
                                                                if($_SESSION["PurchaseOrderInformation"][IsComplimentary] == "on")
                                                                {
                                                                    echo "$0.00";
                                                                }
                                                                else
                                                                {
                                                                    $ticketCost =  getTicketPrice($_SESSION["PurchaseOrderInformation"][Rank]);
                                                                    echo "$", $ticketCost;
                                                                    $totalDue += $ticketCost;
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    
                                                    <?PHP
                                                        $numTickets = $_SESSION["PurchaseOrderInformation"][NumberTickets];
                                                        if($numTickets > 1)
                                                        {
                                                            for ($i = 1; $i < $numTickets; $i++)
                                                            {
                                                    ?>
                                                                <tr>
                                                                    <td><?PHP echo $_POST['guest' . $i . 'fullname'] ?></td>
                                                                    <td><?PHP echo getMeal($_POST['guest' . $i . 'MealType']) ?></td>
                                                                    <td><?PHP echo $_POST['guest' . $i . 'tableNum'] ?></td>
                                                                    <td><?PHP echo $_POST['guest' . $i . 'chairNum'] ?></td>
                                                                    <td>
                                                                        <?PHP 
                                                                            if($_POST['guest' . $i . 'IsComplimentary'] == "on")
                                                                            {
                                                                                echo "$0.00";
                                                                            }
                                                                            else
                                                                            {
                                                                                $ticketCost =  getTicketPrice($_SESSION["PurchaseOrderInformation"][Rank]);
                                                                                echo "$", $ticketCost;
                                                                                $totalDue += $ticketCost;
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                    <?PHP														
                                                            }
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td colspan="3">&nbsp;</td>
                                                        <td>Balance:</td>
                                                        <td><?PHP echo "$", number_format($totalDue, 2, '.', ''); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">&nbsp;</td>
                                                        <td>Amount Paid:</td>
                                                        <td>$<input name="paid" type="text" onchange="updateBalance(this.value, '<?PHP echo number_format($totalDue, 2, '.', ''); ?>');" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">&nbsp;</td>
                                                        <td>Balance Due:</td>
                                                        <td><input class="label" disabled="disabled" id="balance" type="text" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div align="right"><button type="submit" name="submit" >Purchase</button></div>                                            	
                                        </div>
                                    </form>
                                </div>
								
								<!-- InstanceEndEditable -->                                
                            </div>
                            
                        </div>
        
                        <!-- Begin Left Column -->
                        <?PHP include("includes/leftCol.php"); ?>
    
                    </div><!-- End Content-Wrapper -->
    
                    <!-- Begin Footer -->
                    <?PHP include("includes/footer.php"); ?>
                    
                </div>
            </div>
    </body>
<!-- InstanceEnd --></html>
