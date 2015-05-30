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
									<?PHP
										if(isset($_SESSION['user'])) 
										{
									?>                                
                                	<p>This years Marine Corps Ball is being held at:</p>
                                        <span style="margin-left:.5em;">
											<?PHP
                                                    require_once(dirname(__FILE__) ."/includes/functions/manage.php");
                                                    
                                                    if ($loc = getLocation()) 
                                                    {
                                                        echo "<p>" . $loc["L_Name"] . "<br />";
                                                        echo $loc["L_Street"] . "<br />";
                                                        echo $loc["L_City"] . ", " . $loc["L_State"] . " " . $loc["L_Zip"] . "<br />";
                                                        echo $loc["L_Phone"] . "</p>";
                                                        
                                                        $tableCount = $loc["NumTables"];
                                                        $seatCount = $loc["NumChairs"];
                                                    }
											?>                                                   
                                    </span>
                                    <p>There are currently <span style="font-weight:bold;text-decoration:underline;"><?PHP echo $tableCount ?></span> tables and <span style="font-weight:bold;text-decoration:underline;"><?PHP echo $seatCount ?></span> seats with a total of <span style="font-weight:bold;text-decoration:underline;"><?PHP echo $tableCount * $seatCount ?></span> possible attendees.</p>
                                    <?PHP 
										}
									?>
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
