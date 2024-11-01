<?php ?>

<?php if ($error):?>
	<div id="message" class="error fade"><p><strong><?php echo $error?></strong></p></div>
<?php elseif ($message):?>
	<div id="message" class="updated fade"><p><strong><?php echo $message?></strong></p></div>
<?php endif;?>

<link rel='stylesheet' href='<?php echo ZANOX_SEARCH_TEMPLATE_DIR_ . 'admin.css	'; ?>' type='text/css' media='all' />

<script language="javascript">
<!--

    function check_program_list(id)
    {
        var program_list = document.getElementsByName("program[]");
        var counter = 0;

        for (i=0; i<program_list.length; i++)
        {
            if (id!=0)
            {
                if (i==0)
                {
                    program_list[i].checked = false;
                }
                else
                {
                    if (program_list[i].checked == true)
                    {
                        counter++;
                    }
                }
            }
            else
            {
                if (i!=0)
                {
                    program_list[i].checked = false;
                }
            }
        }
        if (counter>20)
        {
            alert("The maximum number of programs is 20.");
            program_list[id].checked = false;
        }
    }

//-->
</script>

<div class="wrap">

    <div id="icon-options-zanox" class="zanox_icon"><br /></div>

	<h2 id="write-post"><?php echo 'Zanox Search Configuration'; ?></h2>


	<form method="post" name="zx_plugin_admin_form">

		<?php wp_nonce_field('zanox_admin.php'); ?>

		<fieldset class="options">

			<legend>&nbsp;Web Service API Configuration&nbsp;</legend>

    		<div class="help_text"><?php echo ''; ?></div>

    		<div class="option">

                <div class="config_label">Please enter your Connect ID:</div>

                <div class="config_option">
                    <input class="textField" type="text" size="40" maxlength="100" name="application_id" id="application_id" value="<?php echo $_set_application_id; ?>" />
                    <?php
                        if (isset($_set_check_application_id))
                        {
                            if ($_set_check_application_id == true)
                            {
                                echo "<img src='" . get_option("siteurl") . "/wp-admin/images/yes.png' alt='OK'>";
                            }
                            else
                            {
                                echo "<img src='" . get_option("siteurl") ."/wp-admin/images/no.png' alt='Invalid Application ID'>";
                            }
                        }
                    ?>

                    <br />
                    <input class="button-primary" type="submit" name="check_application_id" value="Check Connect ID" />
                </div>

            </div>

        </fieldset>






        <fieldset class="options">

			<legend>&nbsp;<?php echo 'Search parameter'; ?>&nbsp;</legend>

			<div class="help_text"><?php echo ''; ?></div>

			<div class="option">
				<div class="config_label">Please choose a sales region (optional):</div>
				<div class="config_option">
					<select name="sales_region" id="sales_region">
						<?php
							foreach ($ZS_sales_regions as $region_code => $region_name)
							{
								$selected = "";

								if ($region_code == $_set_region_code)
								{
									$selected = "selected";
								}
								echo "<option value='" . $region_code . "' " . $selected . ">" . $region_name . "</option>";
							}
						?>
					</select>
				</div>
			</div>

			<div class="option">
				<div class="config_label">Please enter a minimum price limit (optional):</div>
				<div class="config_option"><input class="textField" type="text" size="40" maxlength="100" name="min_price" id="min_price" value="<?php echo $_set_min_price; ?>" /></div>
			</div>

			<div class="option">
				<div class="config_label">Please enter a maximum price limit (optional):</div>
				<div class="config_option"><input class="textField" type="text" size="40" maxlength="100" name="max_price" id="max_price" value="<?php echo $_set_max_price ?>" /></div>
			</div>

			<div class="option">
				<div class="config_label">
				    It is possible to limit the search to a defined advertiser. Please choose between "All advertisers" or a maximum of 20 advertiser.

				</div>
				<div class="config_option">
				    <ul class="dealer_listing">
						<?php
                            $i=0;

                            if ($_set_program_code == "" || $_set_program_code[0] == 0)
                            {
                                $selected = "checked";
                            }
                            echo "<li><label for='" . $i . "'><input onClick='check_program_list(this.id);' id='" . $i . " 'type='checkbox' name='program[]' value='0' " . $selected . ">All advertisers</li>";

                            if (count($ZS_programs)>0)
                            {
    							foreach ($ZS_programs as $program_code => $program_name)
    							{
    							    $i++;
    								$selected = "";

    								if (is_array($_set_program_code))
        							{
        								foreach ($_set_program_code as $set_program_code)
        								{
        								    if ($program_code == $set_program_code)
            								{
            									$selected = "checked";
            								}
                                        }
                                    }
    								echo "<li><label for='" . $i . "'><input onClick='check_program_list(this.id);' id='" . $i . " 'type='checkbox' name='program[]' value='" . $program_code . "' " . $selected . ">" . $program_name . "</li>";
    							}
                            }

						?>
					</ul>

					<input class="button-primary" type="submit" name="update_programs" value="Update advertisers" /><small><br /><br />Please be aware that the update of all advertisers may take up to a few minutes.</small>

				</div>
			</div>

			<div class="option">
				<div class="config_label">Please choose a product category (optional):</div>
				<div class="config_option">
					<select name="product_category" id="product_category">
						<?php
							foreach ($ZS_product_categories as $category_code => $category_name)
							{
								$selected = "";

								if ($category_code == $_set_category_code)
								{
									$selected = "selected";
								}

								if (($category_code % 1000) != 0)
								{
									$category_name = "&nbsp;&nbsp;&nbsp;&nbsp;" . $category_name;
								}
								echo "<option value='" . $category_code . "' " . $selected . ">" . $category_name . "</option>";
							}
						?>
					</select>
				</div>
			</div>

			<!-- NOT implemented yet.. Shared Key should not be send (page 4)
			<div class="option">
				<div class="config_label">Wählen Sie eine Ihrer Werbeflächen aus.</div>
				<div class="config_option">
					<select name="ad_space" id="ad_space">
						<?php
                            /*
							foreach ($ZS_ad_spaces as $space_code => $space_name)
							{
								$selected = "";

								if ($space_code == $_set_space_code)
								{
									$selected = "selected";
								}

								echo "<option value='" . $space_code . "' " . $selected . ">" . $space_name . "</option>";
							}
							*/
						?>
					</select>
				</div>
			</div>
			//-->

			<div>&nbsp;</div>

		</fieldset>





		<fieldset class="options">

			<legend>&nbsp;<?php echo 'Search result page layout'; ?> &nbsp;</legend>

    		<div class="help_text"><?php echo ''; ?></div>

			<div class="option">
				<div class="config_label">Maximum number of products (optional):</div>
				<div class="config_option">

					<select name="max_products" id="max_products">
						<?php
							for ($i=1; $i<=10; $i++)
							{
								$selected = "";

								if ($i == $_set_max_products)
								{
									$selected = "selected";
								}
								echo "<option value='" . $i . "' " . $selected . ">" . $i . "</option>";
							}
						?>
					</select>
				</div>
			</div>




    		<div class="option">
				<div class="config_label">Only products with images?</div>
				<div class="config_option"><table cellpadding="0" cellspacing="0" border="0">
				        <tr><td><input type="radio" name="display_images" id="display_images" value="1" <?php if ($_set_display_images == "1") echo "checked"; ?>> yes</td></tr>
				        <tr><td><input type="radio" name="display_images" id="display_images" value="0" <?php if ($_set_display_images == "0") echo "checked"; ?>> no</td></tr>
				    </table>
				</div>
			</div>

			<div class="option">
				<div class="config_label">Where are the products to be displayed?</div>
				<div class="config_option">
				    <table cellpadding="0" cellspacing="0" border="0">
				        <tr><td><input type="radio" name="ad_position" id="ad_position" value="top" <?php if ($_set_ad_position == "top") echo "checked"; ?>> Above search results</td></tr>
				        <tr><td><input type="radio" name="ad_position" id="ad_position" value="bottom" <?php if ($_set_ad_position == "bottom") echo "checked"; ?>> Below search results</td></tr>
				    </table>
				</div>
			</div>

			<div>&nbsp;</div>

		</fieldset>

		<br />

		<input class="button-primary" type="submit" name="save_zanox_search_settings" value="Save settings" />

	</form>

	<br />&nbsp;


</div>

<br />&nbsp;