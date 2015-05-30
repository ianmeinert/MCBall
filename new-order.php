<?PHP 
	session_start(); 
	require_once(dirname(__FILE__) ."/includes/globals.php");
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
        <script type="text/javascript">
			function getList(str, element)
			{
				if (str=="")
				{
					// if blank, we'll set our innerHTML to be blank.
					document.getElementById(element).innerHTML="";
					return;
				}
				
				if (window.XMLHttpRequest)
				{    // code for IE7+, Firefox, Chrome, Opera, Safari
					// create a new XML http Request that will go to our generator webpage.
					xmlhttp=new XMLHttpRequest();
				}
				else
				{    // code for IE6, IE5
					// create an activeX object
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				
				// on state change
				xmlhttp.onreadystatechange=function()
				{
					// if we get a good response from the webpage, display the output
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById(element).innerHTML=xmlhttp.responseText;
					}
				}
				
				// use our XML HTTP Request object to send a get to our content php.
				switch (element)
				{
					case "rankList":
						xmlhttp.open("GET","/includes/ui/getRank.php?s="+str, true);
						xmlhttp.send();
						break;
					case "tableList":
						xmlhttp.open("GET","/includes/ui/getChairs.php?s="+str, true);
						xmlhttp.send();
						break;
				}
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
									<form action="/includes/ui/beginPurchase.php" method="post">
                                    <table>
                                        <tr>
                                            <td><label for="name">Full Name:</label></td>
                                            <td><input type="text" name="name" size="50"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="service">Branch of Service:</label></td>
                                            <td>
                                            	<select name="service" onchange="getList(this.value, 'rankList')">
                                                	<option value="" >Select a Service</option>
                                                    <option value="Marine Corps" >Marine Corps</option>
                                                    <option value="Navy" >Navy</option>
                                                    <option value="Civilian" >Civilian</option>
                                                </select> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rank:</td>
                                            <td><div id="rankList"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Meal type:</td>
                                            <td><?PHP require_once(dirname(__FILE__) ."/includes/ui/getMeals.php"); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Are the tickets complimentary?</td>
                                            <td><input type="checkbox" name="isComplimentary" /></td>
                                        </tr>
                                        <tr>
                                            <td>Table:</td>
                                            <td><select name="table" onchange="getList(this.value, 'tableList')">
                                            		<option value="">Select a Table</option>
													<?PHP require_once(dirname(__FILE__) ."/includes/ui/getTables.php"); ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Seat:</td>
                                            <td><div id="tableList"></div></td>
                                        </tr>
                                        <tr>
                                            <td>Number of Tickets:</td>
                                            <td><input type="text" name="numberTickets" /></td>
                                        </tr>
                                        <tr>
                                            <td>Do you want to be emailed a receipt?</td>
                                            <td><input type="checkbox" name="emailReceipt" /></td>
                                        </tr>
                                        <tr>
                                            <td>Email Address: (not required)</td>
                                            <td><input type="email" name="emailAddress" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input type="submit" name="submit" value="Submit"/></td>
                                        </tr>
                                    </table>
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
