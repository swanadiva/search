<h1>Create New Post</h1>
<?php echo form_open_multipart('admin/save_post');?>
	<div id="body">			
		<?php if ($this->session->flashdata('hasil')) { ?>
			<p style="color: #404040;font-size: 17px;">
				<?php echo $this->session->flashdata('hasil');?>
			</p>
		<?php } ?>

		<p>
			<table border="0">
				<tr>						
					<td width="200px">Judul</td>
					<td width="20px">:</td>
					<td width="400px"><input type="text" name="judul" size="100px" required/> </td>									
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<?php echo form_error('judul'); ?>
					</td>
				</tr>
				<tr>
					<td>Content</td>
					<td>:</td>
					<td><textarea cols="130" rows="15" name="content" required></textarea> </td>	
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<?php echo form_error('content'); ?>
					</td>
				</tr>
				<tr>
					<td>Upload file</td>
					<td>:</td>
					<td><input type="file" name="userfile" size="30"/></td>					
				</tr>
				<tr>
					<td>Unit</td>
					<td>:</td>
					<td>						
						<select name="unit" required style="width:200px">
							<option value="">--Please Select--</option>
							<?php for ($i=0; $i < sizeof($unit); $i++) { ?>
								<option value="<?php echo $unit[$i]['id']?>"><?php echo $unit[$i]['nama_unit']?></option>
							<?php } ?>							
						</select>
					</td>	
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<?php echo form_error('unit'); ?>
					</td>
				</tr>
				<tr>
					<td>Category</td>
					<td>:</td>
					<td>						
						<select name="category" required style="width:200px">
							<option value="">--Please Select--</option>
							<?php for ($i=0; $i < sizeof($category); $i++) { ?>
								<option value="<?php echo $category[$i]['id']?>"><?php echo $category[$i]['nama_category']?></option>
							<?php } ?>							
						</select>
					</td>									
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<?php echo form_error('category'); ?>
					</td>
				</tr>
				<tr>
					<td>Keyword</td>
					<td>:</td>
					<td>
						<input type="text" name="keyword" size="75px" required/> <i>Separated with comma(,) ex: bpp, sk, radir</i>
					</td>	
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<?php echo form_error('keyword'); ?>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<br /><br />
						<input type="submit" value="Submit" />
					</td>
				</tr>
			</table>
		</p>
	</div>
</form>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>