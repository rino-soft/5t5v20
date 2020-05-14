

	<title>Graficos estadisticos</title>
	<style type="text/css">
		a, a:link, a:visited {
			color: #444;
			text-decoration: none;
		}
		a:hover {
			color: #000;
		}
		.left {
			float: left;
		}
		#menu {
			width: 20%;
		}
		#g_render {
			width: 80%;
		}
		li {
			margin-bottom: 1em;
		}
                
                
	
        </style>
        
	<script type="text/javascript" src="<?php echo base_url() . "JS/jquery.min.js";?>"></script>
	
	
	<script type="text/javascript" src="<?php echo base_url() . "JS/highcharts.js";?>"></script>

	<div id="g_render"  class="left">
		<?php if (isset($charts)) echo $charts; ?>
		<?php if (isset($json)): ?>
			
			<pre><?php echo print_r($json); ?></pre>
		<?php endif; if (isset($array)): ?>
			
			<pre><?php echo print_r($array); ?></pre>
		<?php endif; ?>
	</div>
