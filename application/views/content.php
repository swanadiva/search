<h1>Selamat datang di pencarian informasi internal Bank DKI.</h1>

<div id="body">
	<?php 
		$ambil = array("method" => "get");
		echo form_open('welcome/search');?>
		<p>Silahkan mengisi data yang akan dicari:</p>
		<code align="center">
		<input type="text" name="txt_cari" size="100px" value="<?=(isset($_POST['txt_cari'])?$_POST['txt_cari']:trim_slashes(str_replace("-", " ",$this->uri->slash_segment(3,""))));?>" autofocus/>
			<input type="submit" value="Search" />
		</code>
	</form>

	<p>
		<?php if(isset($hasil)): ?>
		<?php for ($i=0; $i < count($hasil); $i++) { ?>
			<b style="font-size:20px"><?php echo $hasil[$i]['judul'];?></b><br />
			<p align="justify"><?php echo strip_tags(substr($hasil[$i]['content'], 0, 550))?>... Baca Selengkapnya</p>
			<?php 
				if ($hasil[$i]['nama_file'] != '' || $hasil[$i]['nama_file'] != NULL) {
					echo "View PDF";
				}
			?>
			<br /><br />
		<?php } ?>
		<?php endif; ?>
	</p>
</div>

<p class="footer">		
	<?php $this->load->view($menu);?>
</p>