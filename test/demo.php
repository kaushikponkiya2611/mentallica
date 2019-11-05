
				
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="sriniv_1293527277_biz@inbox.com">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="Premium Umbrella">
  <input type="text" name="amount" value="">
  <input type="hidden" name="currency_code" value="USD">

  <!-- Provide a drop-down menu option field. -->
  <input type="hidden" name="on0" value="Type">Type of umbrella <br />
 <input type='hidden' name='cancel_return' value='<?php echo $FRNT_DOMAIN_NAME;?>cancel'>
				<input type='hidden' name='return' value='<?php echo $FRNT_DOMAIN_NAME;?>paypal/paypal_success.php'>

  <!-- Display the payment button. -->
  <input type="image" name="submit" border="0"
    src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png"
    alt="Buy Now">

  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>
