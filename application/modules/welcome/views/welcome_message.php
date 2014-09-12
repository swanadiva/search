<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">
		::selection{ background-color: #E13300; color: white; }
		::moz-selection{ background-color: #E13300; color: white; }
		::webkit-selection{ background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body{
			margin: 0 15px 0 15px;
		}
		
		p.footer{
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}
		
		#container{
			margin: 10px;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
		}
	</style>
</head>
<body>

<div id="container">
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
						echo anchor('welcome/viewPDF/'.$hasil[$i]['id'],"View PDF");
					}					
				?>
				<br /><br />
			<?php } ?>
			<?php endif; ?>
		</p>
	</div>

	<p class="footer">	
		<?php echo $this->pagination->create_links();?>
		Page rendered in <strong>{elapsed_time}</strong> seconds
	</p>
</div>

</body>
</html>