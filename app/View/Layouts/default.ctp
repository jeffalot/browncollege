<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if(!isset($home)){$home = "";}
if(!isset($people)){$people = "";}
if(!isset($courses)){$courses = "";}
if(!isset($resources)){$resources = "";}
if(!isset($social)){$social = "";}
if(!isset($calendar)){$calendar = false;}

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		//echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
	    <!-- Le styles -->
    <?php echo $this->Html->css('orange');?>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <?php echo $this->Html->css('bootstrap-responsive');?>
    
    <?php
    
    if ($calendar)
    {	
	echo $this->Html->css('/full_calendar/css/fullcalendar');//, null, array('inline' => false));
    }
	?>
	
	
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php //echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
		</div>
		
		
		<!-- NAVBAR HEAD -->
		
		<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img style="padding-right:20px" class="pull-left" src="./img/brown.png"></img>
          <a class="brand" href="<?php echo Router::url(array('controller'=>'pages', 'action'=>'index', 'plugin' => false))?>">Brown College</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="<?php echo $home?>"><a href="<?php echo Router::url(array('controller' => 'pages', 'action' => 'index', 'plugin' => false))?>">Home</a></li>
              <li class="<?php echo $people?>"><a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'index', 'plugin' => false))?>">People</a></li>
              <li><a href="#contact">Courses</a></li>
              <li class="<?php echo $resources?>dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Resources <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo Router::url(array('controller'=>'full_calendar', 'action'=>'index', 'plugin' => "full_calendar"))?>">Reservations</a></li>
                  <li><a href="#">Polls</a></li>
                  <li><a href="#">Movies</a></li>
                  <li><a href="#">Nukes</a></li>
                </ul>
              </li>
              <li class="<?php echo $social ?> dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Social <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo Router::url(array('controller' => 'pages', 'action' => 'calendar', 'plugin' => false))?>">Calendar</a></li>
                  <li><a href="#">Facebook</a></li>
                  <li><a href="#">Twitter</a></li>
                  <li><a href="#">Photos</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Profile <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Settings</a></li>
                	<?php 
                	if ($authUser)
						{
    						echo '<li><a href="' . Router::url(array('controller' => 'users', 'action' => 'logout', 'plugin' => false)) . '">Logout</a></li>';
						}  
                  	else
                  	{
                  			echo '<li><a href="' . Router::url(array('controller' => 'users', 'action' => 'login', 'plugin' => false)) . '">Login</a></li>';
                  	}
                	?>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
		
		
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			    <?php if (!$calendar){ echo $this->Html->script('jquery'); }?>
			    <!-- Jquery causing weird problems with FullCalendar -->
			    <?php if ($calendar) { 
			    	echo '<script type="text/javascript">';
			    	echo "plgFcRoot ='"; echo $this->Html->url('/') . "full_calendar'";
			    	echo '</script>';
			    	echo $this->Html->script(array('jquery', '/full_calendar/js/jquery-ui-1.8.9.custom.min', '/full_calendar/js/fullcalendar.min', '/full_calendar/js/jquery.qtip-1.0.0-rc3.min', 'bootstrap', '/full_calendar/js/ready'), array('inline' => 'false')); }?>
			    
    			<?php if (!$calendar){  echo $this->Html->script('bootstrap'); }?>

    			
    			
		</div>
	</div>
	<script type="text/javascript">
	$('#calendar').fullCalendar( 'refetchEvents' );
	</script>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
