<html>
<head>
</head>

<?php include('header_dashboard.php'); ?>
    <body>
	<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('calendar_sidebar.php'); ?>
                <div class="span9" id="content">
                	
                     <div class="row-fluid">
                        <!-- block -->
                        <?php include('include/lbtreportcontent.php'); ?>
                        <!-- /block -->
					</div>
				</div>
			</div>
			<?php include('footer.php'); ?>
		</div>
    </body>
</html>