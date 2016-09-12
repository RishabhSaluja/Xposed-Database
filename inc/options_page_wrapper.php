<div class="wrap">
	
        <div id="icon-options-general" class="icon32"></div>
	<h2>The Official Xposed Database</h2>
	
	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
		
			<!-- main content -->
			<div id="post-body-content">
				
				<div class="meta-box-sortables ui-sortable">
				
				<!-- Checks if any table was selected -->
				<?php if(isset($_GET['table'])): ?>
				
				<a href="?page=wp_db">Back to Main Plugin Page</a>
				
				<form method="post" action="?page=wp_db">
					<input type="checkbox" name="del">
					<input type="hidden" name="tbname" value="<?php echo sanitize_text_field( $_GET['table'] ); ?>">
					<input type="submit" value="Delete This Table">
				</form>
				
				<div class="postbox" style="overflow: scroll;">
				
					<!-- Display the contents of the table selected -->
					<?php $result = $wpdb->get_results( "SELECT * FROM " . sanitize_text_field( $_GET['table'] )); 
					$colx = $wpdb->get_col( "DESC " . sanitize_text_field( $_GET['table'] ), 0 );
					$num = 0;
				
					echo '<table border><tr>';
					foreach($colx as $column_name) {
						echo '<th>' . $column_name . '</th>';
					}
					echo '</tr>';
					foreach($result as $row) {
						echo '<tr>';
						foreach($colx as $column_name) {
							echo '<td>' . $row->$column_name . '</td>';
						}
						echo '</tr>';
					}
					echo '</table>';
				
					// Text Input boxes to insert a new row in an existing table
					echo '<br /><br /><br /><form method="post" action=""><table border><tr>';
					foreach($colx as $column_name) {
						echo '<th>' . $column_name . '</th>';
						$num++;
					}
					echo '</tr><tr>';
					for($i=0; $i<$num; $i++) {
						echo '<td><input type="text" name="value[' . $i . ']"</td>';
					}
					echo '</tr></table><input type="submit" value="Save Value"></form>';
					?>				
				</div>
		 			
		 		<!-- First page of plugin's settings -->
				<?php elseif(!isset($db_name) || $db_name==''): ?>			
					
				<div class="postbox">
					
				 	<h3><span>Let's Get Started!</span></h3>
					<div class="inside">
							
						<form name="db_username_form" method="post" action="">

						<div class="inside">
							
							<input type="hidden" name="db_form_submitted" value="Y">
							
							<!-- Create a new table by giving its names and number of columns -->
							<table class="form-table">
								<tr>
									<td>
										<label>Table Name</label>
									</td>
									<td>
										<input name="db_name" id="db_name" type="text" value="" class="regular-text" required />
									</td>
								</tr>
                                                                <tr>
                                                                        <td>
                                                                                <label>Enter Number of columns</label>
                                                                        </td>
                                                                        <td>
                                                                                <input name="col_num" id="col_num" type="number" min="1" required />
                                                                        </td>
                                                                </tr>									
							</table>

							<p>
								<input class="button-primary" type="submit" name="db_submit" value="Save" /> 
							</p>

							<?php
								// List all the tables stored in Wordpress database
								$sql1 = "SHOW TABLES LIKE '%'";
								$results = $wpdb->get_results($sql1);

								foreach($results as $index => $value) {
    									foreach($value as $db_name) {
        									echo '<a href="?page=wp_db&table=' . $db_name . '">' . $db_name . '</a><br />';
    									}
								}
							?>
							</form>
						</div> <!-- .inside -->					
					</div> <!-- .postbox -->
					<?php else: ?>
						<!-- Page on specifying table name and number of columns -->
						<div class="postbox">
							<div class="inside">
								<form method="post" action="">
									<h1>
									        Enter details for each column
									</h1>

									<!-- Mention entry level details for each specified column including constraints and data types -->
									<table border>
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
									                         NOT NULL
									                </th>
									                <th>
									                         Auto Increment
									                </th>
									        </tr>
                                        			                <?php for( $i = 0; $i < $col_num; $i++ ): ?> 
									        <tr>
									                <td>
									                         <input name="col_name[<?php echo $i; ?>]" type="text" value="" class="regular-text" required />
									                </td>
     									                <td>
									                          <select name="col_type[<?php echo $i; ?>]">
									                                 <option value="varchar">Varchar</option>
									                                 <option value="int">Integer</option>
									                                 <option value="date">Date</option>
									                                 <option value="decimal">Decimal</option>
									                                 <option value="boolean">Boolean</option>
									                          </select>
									                </td>
       									                <td>
									                         <input name="col_len[<?php echo $i; ?>]" type="number" min="1">
									                </td>
       									                <td>
												  <select name="primary[<?php echo $i; ?>]">
									                                 <option value=" PRIMARY KEY">ON</option>
													<option value='' selected>OFF</option>
									                          </select>
									                </td>
       									                <td>
												  <select name="nullx[<?php echo $i; ?>]">
									                                 <option value=" NOT NULL">ON</option>
													<option value='' selected>OFF</option>
									                          </select>
									                </td>
									                <td>
                                        			                                  <select name="autoincr[<?php echo $i; ?>]">
									                                 <option value=" AUTO_INCREMENT">ON</option>
													<option value='' selected>OFF</option>
									                          </select>
									                </td>
									        </tr>
						        			<?php endfor; ?>
						        			<tr>
						                			<td>
									                         <input class="button-primary" type="submit" name="col_submit" value="Save" />
									 			<input type="hidden" name="db_table_submitted" value="Y"> 
						                			</td>
						        			</tr>
									</table>
								</form>
							</div--> <!-- .inside -->
						</div> <!-- .postbox -->	
						<?php endif; ?>
					</div> <!-- .meta-box-sortables -->				
				</div> <!-- #postbox-container-1 .postbox-container -->			
			</div> <!-- #post-body .metabox-holder .columns-2 -->		
			<br class="clear">
		</div> <!-- #poststuff -->	
	</div> <!-- .wrap -->
