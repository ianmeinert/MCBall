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
									<form action="/checkout.php" method="post">
                                    	<table>
                                        	<thead>
                                            	<th>Full Name</th>
                                                <th>Table</th>
                                                <th>Chair</th>
                                                <th>Meal Type</th>
                                                <th>Complimentary?</th>
                                            </thead>
                                            <tbody id="tbody">
                                            </tbody>
                                        </table>
                                        <input type="submit" name="submit" value="Submit"/>
                                    </form>
                                </div>
								<script type="text/javascript">
									<?PHP $array = $_SESSION["PurchaseOrderInformation"]; ?>
									var rowcount = <?PHP echo $array["NumberTickets"]-1 ?>;
									
									for(var i = 1; i <= rowcount; i++) {				
										var tbody = document.getElementById('tbody');
										var row = document.createElement('tr');
										var nameCell = document.createElement('td');
										var tableCell = document.createElement('td');
										var chairCell = document.createElement('td');
										var mealTypeCell = document.createElement('td');
										var complimentaryCell = document.createElement('td');
																															
										var fullnameInput = document.createElement('input');
											fullnameInput.setAttribute('type','text');
											fullnameInput.setAttribute('name','guest'+i+'fullname');										
										nameCell.appendChild(fullnameInput);
										row.appendChild(nameCell);
										
										var tableElement = "guest"+i+"tableList";
										var tableSelect = document.createElement('select');
											tableSelect.setAttribute('onchange', "getList(this.value, 'guest"+i+"tableList', "+i+")");
											tableSelect.setAttribute('name',"guest"+i+"tableNum");
											
										var tableDefaultOption = document.createElement('option');
											tableDefaultOption.text = "Select a Table";
											tableSelect.add(tableDefaultOption);
										<?PHP
											$result = getTableList();
											$rowcount = mysqli_num_rows($result);
											
											while($row = mysqli_fetch_assoc($result))
											{	
												echo 'var tableNumOption=document.createElement(\'option\');';
												echo 'tableNumOption.text="Table '. $row['ID'] .'";';
												echo 'tableNumOption.value="'. $row['ID'] .'";';
												echo 'tableSelect.add(tableNumOption);';
											}
										?>
										tableCell.appendChild(tableSelect);
										row.appendChild(tableCell);
										
										var chairDiv = document.createElement('div');
											chairDiv.setAttribute('id',tableElement);
										chairCell.appendChild(chairDiv);
										row.appendChild(chairCell);
										
										var mealtypeSelect = document.createElement('select');
											mealtypeSelect.setAttribute('name','guest'+i+'MealType');
										var mealtypeDefaultOption = document.createElement('option');
											mealtypeDefaultOption.text = "Select a Meal";
											mealtypeSelect.add(mealtypeDefaultOption);
										<?PHP
											$result = getMealList();
											$rowcount = mysqli_num_rows($result);
											
											while($row = mysqli_fetch_assoc($result))
											{	
												echo 'var mealtypeOption=document.createElement(\'option\');';
												echo 'mealtypeOption.text="'. $row['type'] .'";';
												echo 'mealtypeOption.value="'. $row['ID'] .'";';
												echo 'mealtypeSelect.add(mealtypeOption);';
											}
										?>
										mealTypeCell.appendChild(mealtypeSelect);
										row.appendChild(mealTypeCell);
										
										var isComplementaryCb = document.createElement('input');
											isComplementaryCb.setAttribute('type','checkbox');
											isComplementaryCb.setAttribute('name','guest'+i+'isComplementary');
										complimentaryCell.appendChild(isComplementaryCb);
										row.appendChild(complimentaryCell);
										
										tbody.appendChild(row);
									}
									
									function getList(str, element, guestId)
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
										xmlhttp.open("GET","/includes/ui/getChairs.php?s="+str+"\&g="+guestId, true);
										xmlhttp.send();
									}
								</script>
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
