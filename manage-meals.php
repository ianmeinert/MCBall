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
        ?>
        <script language="JavaScript" type="text/javascript">
		<!--
		function validate(form)
		{
			if (form.tbType.value == null || form.tbType.value == "" ) {
				alert( "Please enter a meal type." );
				form.tbType.focus();
				return false;
			}
			else {				
				return true ;
			}
		}
		//-->
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
                                
                            	<table>
                                    <thead>
                                        <tr>
                                            <td>Type</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>                                    
                                    <tbody>
                                        <?PHP 
											if(isset($_GET['edit']) && !empty($_GET['edit']))
											{
												getMealTypeWithEdit($_GET['edit']);
											}
											else
											{
												getMeals();
											}
										 ?>
                                    </tbody>
                                    <tfoot>
                                    	<tr>
                                        <form method="post" action="/includes/ui/addMeal.php" onsubmit="return validate(this);">
                                            <td align="left" style="padding-left:5px;">
                                            	<Label for="tbType">Add a new meal type:</Label><br />
                                            	<input type="text" name="tbType" maxlength="50" size="75" /><br />&nbsp;
                                            </td>
                                            <td><button type="submit" name="Submit" >Submit</button></td>
                                        </tr>
                                        </form>
                                    </tfoot>
                                </table>
                                
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
