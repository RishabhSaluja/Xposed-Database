<div class="wrap">
	
	<div id="icon-options-general" class="icon32"></div>
	<h2>The Official Xposed Database</h2>
	
	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
		
			<!-- main content -->
			<div id="post-body-content">
				
				<div class="meta-box-sortables ui-sortable">
					
					<?php if(!isset($db_name) || $db_name==''): ?>			
					
					<div class="postbox">
					
					 	<h3><span>Let's Get Started!</span></h3>
						<div class="inside">
							
							<form name="db_username_form" method="post" action="">

							<div class="inside">
							
							<input type="hidden" name="db_form_submitted" value="Y">

							<table class="form-table">
								<tr>
									<td>
										<label>Database Name</label>
									</td>
									<td>
										<input name="db_name" id="db_name" type="text" value="" class="regular-text" />
									</td>
								</tr>
                                                                <tr>
                                                                        <td>
                                                                                <label>Enter Number of columns</label>
                                                                        </td>
                                                                        <td>
                                                                                <input name="col_num" id="col_num" type="number" min="1" />
                                                                        </td>
                                                                </tr>									
							</table>

							<p>
								<input class="button-primary" type="submit" name="db_submit" value="Save" /> 
							</p>

							</form>

						</div> <!-- .inside -->
					
					</div> <!-- .postbox -->

<?php else: ?>

					<div class="postbox">
					<div class="inside">
					<form method="post" action="<?php echo $plugin_url . '/inc/disp.php'; ?>">
						<h1>
						        Enter details for each column
						</h1>

						<table>
						        <tr>
						                <th>
						                         Column Name
						                </th>
						                <th>
						                         DataType
						                </th>
						                <th>
						                         Length
						                </th>
						                <th>
						                         Primary Key
						                </th>
						                <th>
						                         NULL
						                </th>
						                <th>
						                         Auto Increment
						                </th>
						        </tr>
                                                        <?php for( $i = 0; $i < $col_num; $i++ ): ?> 
						        <tr>
						                <td>
						                         <input name="col_name[<?php echo $i; ?>]" type="text" value="" class="regular-text" />
						                </td>
     						                <td>
						                          <select name="col_type[<?php echo $i; ?>]">
						                                 <option value="varchar">varchar</option>
						                                 <option value="int">int</option>
						                                 <option value="date">date</option>
						                                 <option value="decimal">decimal</option>
						                                 <option value="boolean">boolean</option>
						                          </select>
						                </td>
       						                <td>
						                         <input name="col_len[<?php echo $i; ?>]" type="number" min="1">
						                </td>
       						                <td>
						                         <input name="primary[<?php echo $i; ?>]" type="checkbox">
						                </td>
       						                <td>
						                         <input name="nullx[<?php echo $i; ?>]" type="checkbox">
						                </td>
						                <td>
						                         <input name="autoincr[<?php echo $i; ?>]" type="checkbox"> 
						                </td>
						        </tr>
						        <?php endfor; ?>
						        <tr>
						                <td>
						                         <input class="button-primary" type="submit" name="col_submit" value="Save" /> 
						                </td>
						        </tr>
						</table>
						</form>
</div--> <!-- .inside -->
					</div> <!-- .postbox -->					
					
<?php endif; ?>
