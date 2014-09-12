<h1>Daftar pengguna</h1>

<div id="body">
	<p><a href="<?php echo site_url('login/add_user')?>">Tambah pengguna</a></p>
	<p>
		<table border="1" style="border: 1px solid black;border-collapse: collapse;">
			<tr>
				<td style="font-size:15px" width="250px" align="center"><b>Username</b></td>
				<td style="font-size:15px" width="350px" align="center"><b>Nama Lengkap</b></td>
				<td style="font-size:15px" width="200px" align="center"><b>Action</b></td>
			</tr>

			<?php for ($i=0; $i < count($hasil); $i++) { ?>
				<tr>
					<td>
						<?php echo $hasil[$i]['email'];?>
					</td>
					<td>
						<?php echo $hasil[$i]['name'];?>
					</td>
					<td>
						<a href="">Edit</a> | <a href="">Ban</a>
					</td>					
				</tr>
			<?php } ?>
		</table>
	</p>
</div>

<p class="footer">

	<?php echo $this->pagination->create_links();?>
	Page rendered in <strong>{elapsed_time}</strong> seconds
</p>