<?php 


//load footer data (extra html code) from the page that called it.
//if there isnt any, prevent undeclared warning
if (!isset($otherFooterData))
    $otherFooterData = '';

?>
        </div>
        <footer id='footer' class='clearfix'>
			<div class='container margin-bottom-20 margin-top-20'>
				<div class='row text-center'>
					<h4 class='lead'>I hope you enjoyed my website.</h4>
                    <a class='btn btn-lg btn-primary margin-top-20 margin-bottom-20' href='/create.php'><i class='fa fa-check'></i> Create a Meme</a>
				</div>
			</div>
			<div class='copyright'>
				<div class='container'>
					<div class='col-xs-12'>
						<p>
							2015 &copy; Doug Mathew
						</p> 
					</div>
				</div>
			</div>
		</footer>
		
		<!-- Placed at the end of the document so the pages load faster -->
		<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
		<script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>
		<script src='/util/js/bootstrap.min.js'></script>
		<script src='/util/js/meme.js'></script>
		<script src='/util/js/custom.js'></script>

        <?php echo $otherFooterData; ?>
		
		<!--<script src='/util/js/twitter-bootstrap-hover-dropdown.min.js'></script>-->
		<!--<script src='/util/js/jquery.easing.1.3.js'></script>-->
		
	</body>
</html>