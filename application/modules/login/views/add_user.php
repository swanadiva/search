<h1>Tambah pengguna baru</h1>
<?php echo form_open_multipart('login/save_new_user');?>
	<div id="body">			
		<?php if ($this->session->flashdata('hasil')) { ?>
			<p style="color: #404040;font-size: 17px;">
				<?php echo $this->session->flashdata('hasil');?>
			</p>
		<?php } ?>

		<p>
			<table border="0">
				<tr>						
					<td width="100px">Nama</td>
					<td width="20px">:</td>
					<td width="200px"><input type="text" name="nama" size="50px" required/> </td>									
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<?php echo form_error('nama'); ?>
					</td>
				</tr>
				<tr>						
					<td width="100px">Username</td>
					<td width="20px">:</td>
					<td width="200px"><input type="text" name="username" size="50px" required/> </td>									
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<?php echo form_error('username'); ?>
					</td>
				</tr>
				<tr>						
					<td width="100px">Password</td>
					<td width="20px">:</td>
					<td width="200px"><input type="text" name="password" size="50px" required/> </td>									
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<?php echo form_error('password'); ?>
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