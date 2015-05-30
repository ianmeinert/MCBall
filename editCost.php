<?PHP
	require_once(dirname(__FILE__) ."/includes/globals.php");
	require_once(dirname(__FILE__) ."/includes/functions/manage.php");
	$cost = getCost($_GET['id']);
	
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
                                <?PHP
                                if(isset($_SESSION['user'])) 
                                {
									
                            	?>
                                    <form action="/includes/ui/editCost.php" method="post">
                                        <table>
                                            <tr>
                                                <td><label for="grade">Grade:</label></td>
                								<td><?PHP echo $cost['grade']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><label for="price">Author:</label></td>
                								<td><input type="text" name="price" value="<?PHP echo $cost['price']; ?>"/></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="hidden" name="costID" value="<?PHP echo $cost['ID']; ?>" />
                                                    <button type="button" name="Cancel" onClick="history.go(-1);return true;">Cancel</button>
                                                    <button type="submit" name="Submit" >Submit</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
								<?PHP } ?>
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
