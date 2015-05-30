<?PHP 
	session_start(); 
	require_once(dirname(__FILE__) ."/includes/globals.php");
	
	if(!isset($_SESSION['user'])) 
	{
		header("Location: /");
	}
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
		<?PHP
            require_once(dirname(__FILE__) ."/includes/functions/manage.php");
            
            $loc = getLocation();
        ?>
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
                                                             
                                <form action="/includes/ui/editLocation.php" method="post">
                                    <table>
                                        <tr>
                                            <td><label for="locationName">Facility Name:</label></td>
                                            <td><input type="text" name="locationName" value="<?PHP echo $loc['L_Name']; ?>" size="50"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="locationStreet">Street Address:</label></td>
                                            <td><input type="text" name="locationStreet" value="<?PHP echo $loc['L_Street']; ?>" size="50"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="locationCity">City:</label></td>
                                            <td><input type="text" name="locationCity" value="<?PHP echo $loc['L_City']; ?>" size="50"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="locationState">State:</label></td>
                                            <td><input type="text" name="locationState" value="<?PHP echo $loc['L_State']; ?>" maxlength="2" size="2"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="locationZip">Zip Code:</label></td>
                                            <?PHP $zip = strlen($loc['L_Zip']) > 5 ? substr($loc['L_Zip'],0,5) . "-" . substr($loc['L_Zip'],5,9) : substr($loc['L_Zip'],0,5) ; ?>
                                            <td><input type="text" name="locationZip" value="<?PHP echo $loc['L_Zip']; ?>" maxlength="10"  size="10"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="locationPhone">Phone Number:</label></td>
                                            <?PHP $phone = $loc['L_Phone']; ?>
                                            <td><input type="text" name="locationPhone" value="<?PHP echo "(".substr($phone, 0, 3).") ".substr($phone, 3, 3)."-".substr($phone,6); ?>"  size="13"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="locationTables">Number of tables:</label></td>
                                            <td><input type="text" name="locationTables" value="<?PHP echo $loc['NumTables']; ?>" maxlength="3" size="3"/></td>
                                        </tr>
                                        <tr>
                                            <td><label for="locationSeats">Number of seats per table:</label></td>
                                            <td><input type="text" name="locationSeats" value="<?PHP echo $loc['NumChairs']; ?>" maxlength="2" size="2"/></td>
                                        </tr>
                                        <tr>
                                            <td><INPUT Type="button" VALUE="Cancel" onClick="window.location = '/';">
                                            	<input type="hidden" name="locationID" value="<?PHP echo $loc['ID']; ?>" /></td>
                                            <td><button type="submit" name="Submit" >Submit</button></td>
                                        </tr>                        
                                    </table>
                                </form>
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
