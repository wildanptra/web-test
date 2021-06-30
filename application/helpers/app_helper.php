<?php

function getFormSearch($view){
	$CI =getCI();
	$CI->load->view($view);
}
function JCfg($params=false) {
	$CI =getCI();
	$CI->load->library('session');
	$jCfg = $CI->session->userdata('jcfg');
	if(!$params) {
		return $jCfg;
	} else {
		return $jCfg[$params];
	}
}

function FormatDate($date, $format='Y-m-d') {
	return Date($format, strtotime($date));
	// $tanggal_survey		= explode("-", $date);
	// return $tanggal_survey[2].'-'.$tanggal_survey[1].'-'.$tanggal_survey[0];
}

function userdaTa($params=false){
	$jCfg = JCfg('user');
	if(!$params) {
		return $jCfg;
	} else {
		return $jCfg[$params];
	}
}

function add_breadcrumb($data=array(), $reset=false) {
	$CI =getCI();
	$CI->load->library('session');
	if($reset) {
		$CI->session->set_userdata('breadcrumb', $data);
	} else {
		$dataSession = $CI->session->userdata('breadcrumb');
		$data = array_merge($dataSession, $data);
		$CI->session->set_userdata('breadcrumb', $data);
	}
}
function _breadcrumb() {
	$CI =getCI();
	$CI->load->library('session');
	$data = $CI->session->userdata('breadcrumb');
	return $data;
}

function pTxt($key='',$sep='-'){
	return str_replace($sep,' ', trim($key));
}

function symClean($string){
	$a = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	return $a;
}

function dateRev($d, $format='Y-m-d'){
	$nd 	=  date($format, strtotime($d));
	return $nd;
}

function myNum($num=0,$curr="IDR"){
	$curr2 = strtolower($curr);
	if($curr2=="Rp."){
		return $curr.". ".number_format($num,0,",",".");
	}elseif($curr2=="$" || $curr2=="e"){
		return number_format((float)$num,2,".",",")." ".$curr;
	}elseif($curr2=="$" || $curr2=="dec"){
		return number_format((float)$num,2,".",",");
	}else{
		return $curr.number_format($num,0,",",".");
	}
}

function cfg($o='cp_app_name'){
	$CI =getCI();
	$return = '';

	$logic = '';
	if(is_array($CI->config->item($o))){
		$logic = count($CI->config->item($o))>0?1:"";
	}else{
		$logic = $CI->config->item($o);
	}

	if(trim($logic)!=""){
		$return = $CI->config->item($o);
	}else{
		$v = $CI->db->get_where("cp_app_config",array(
				'config_name' => $o
			))->row();
		if(count($v)>0)
			$return = $v->config_value;
	}

	return $return;
}

function myDate($dt,$f="d/m/Y H:i",$s=true){
	$day = array(
		1 => "Senin",
		2 => "Selasa",
		3 => "Rabu",
		4 => "Kamis",
		5 => "Jumat",
		6 => "Sabtu",
		7 => "Minggu"
	);
	if(trim($dt)!="0000-00-00" && trim($dt)!=""){
		$ts = strtotime($dt);
		$dtm = date($f,$ts);
		if( trim($dtm) == "01/01/1970" ){
			return "-";
		}else{
			return ($s)?$day[date("N",$ts)].", ".$dtm:$dtm;
		}
	}else{
		return "-";
	}
}

function get_date_id($date=""){

	$date = trim($date)==""?date("Y-m-d"):$date;

	$tgl = myDate($date,"d",false);
	$thn = myDate($date,"Y",false);

	$month = array(
			'01' 	=> "Januari",
			'02' 	=> "Februari",
			'03' 	=> "Maret",
			'04' 	=> "April",
			'05' 	=> "Mei",
			'06' 	=> "Juni",
			'07'	=> "Juli",
			'08' 	=> "Agustus",
			'09' 	=> "September",
			'10'  => "Oktober",
			'11'  => "November",
			'12' 	=> "Desember"
		);
	$bulan = $month[myDate($date,"m",false)];

	return $tgl." ".$bulan." ".$thn;
}

function list_number(){
	$list = array(
		1,2,3,4,5,6,7,8,9,10,
		11,12,13,14,15,16,17,18,19,20,
		21,22,23,24,25
	);
	// dd($list);

	return $list;
}

function debugCode($r=array(),$f=TRUE){
	echo "<pre>";
	print_r($r);
	echo "</pre>";

	if($f==TRUE)
		die;
}

function dq($f=TRUE){
	$CI = getCI();
	print_r($CI->db->last_query());


	if($f==TRUE)
		die;
}

function dd($r=array(),$f=TRUE){
	echo "<pre>";
	print_r($r);
	echo "</pre>";

	if($f==TRUE)
		die;
}

function _now($format="Y-m-d") {
	return gmdate($format, time()+60*60*7);
}

function ceiling($number, $significance = 1){
	return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
}

function mDate($date="",$v="+1 day",$format='Y-m-d'){
	$date 	= (trim($date)=="")?date("Y-m-d"):$date;
	$nd 	=  strtotime(date("Y-m-d", strtotime($date)) . $v);
	return date($format,$nd);
}

function get_new_image($p=array()){
	$CI = getCI();
	$no_image = base_url()."assets/common/img/temp/photos/no_image.jpg";
	$return = $no_image;

	$url_source_no_image = base_url()."assets/common/img/temp/photos/no_image.jpg";
	$p['url'] = trim($p['url'])==""?$url_source_no_image:$p['url'];

	if( trim($p['url']) != ""){
		$img_source = "./".str_replace(base_url(),"",$p['url']);
		$width = isset($p['width'])?$p['width']:0;
		$height = isset($p['height'])?$p['height']:0;

		if( file_exists($img_source) && !is_dir($img_source)){
			//get file source info.
			$finfo = pathinfo($img_source);
			$n_width = $width==0?'ori':$width;

			$new_image_name = $finfo['filename']."_".$n_width.".".$finfo['extension'];
			if($height>0){
				$new_image_name = $finfo['filename']."_".$n_width."_".$height.".".$finfo['extension'];
			}

			$new_path 	= "./assets/images/".$new_image_name;

			if(!file_exists($new_path) && !is_dir($new_path) ){
				$CI->load->library('image_lib');
				$quality = isset($p['quality'])?$p['quality']:'100%';

				$v = array(
						"width"                 => $width,
						"height"                => $height,
						"quality"               => $quality,
						"source_image"  		=> $img_source,
						"new_image"             => $new_path
				);
				$img = getimagesize($v['source_image']);
				$realWidth      = $img[0];
				$realHeight 	= $img[1];

				if( $height > 0){

					//resize
					$oriW = $v['width'];
					$oriH = $v['height'];
					$x = $v['width']/$realWidth;
					$y = $v['height']/$realHeight;
					if($x < $y) {
						$v['width'] = round($realWidth*($v['height']/$realHeight));
					} else {
						$v['height'] = round($realHeight*($v['width']/$realWidth));
					}

					$CI->image_lib->initialize($v);
					if(!$CI->image_lib->resize()){
							//debugCode($this->image_lib->display_errors());
							//echo "eror resize ".$new_image_name;
							$return = base_url()."assets/common/img/temp/photos/no_image.jpg";
					}
					$CI->image_lib->clear();

					// CROP..
					$config = null;
					$config['image_library'] = 'GD2';
					$im = getimagesize($v['new_image']);
					$toCropLeft = ($im[0] - ($oriW *1))/2;
					$toCropTop = ($im[1] - ($oriH*1))/2;

					$config['source_image'] = $v['new_image'];
					$config['width'] = $oriW;
					$config['height'] = $oriH;
					$config['x_axis'] = $toCropLeft;
					$config['y_axis'] = $toCropTop;
					$config['maintain_ratio'] = false;
					$config['new_image'] = $v['new_image'];

					$CI->image_lib->initialize($config);

					if(!$CI->image_lib->crop()){
						die("Error Crop..");
					}
					$CI->image_lib->clear();

				}else{
					$CI->image_lib->initialize($v);
					$v['width']		= $v['width']==0?$realWidth:$v['width'];
					$v['height'] 	= $v['width']==0?round($realHeight*($v['width']/$realWidth)):$v['width'];
					//resize...
					if(!$CI->image_lib->resize()){
							//debugCode($this->image_lib->display_errors());
							//echo "eror resize ".$new_image_name;
							$return = base_url()."assets/common/img/temp/photos/no_image.jpg";
					}
					$CI->image_lib->clear();
				}

				$return = base_url()."assets/images/".$new_image_name;
			}else{
				$return = base_url()."assets/images/".$new_image_name;
				//$p['url'] = $url_source_no_image;
				//get_new_image($p);
			}
		}

	}
	return $return;
}

function get_image($url="",$noimage=""){
	if(trim($noimage)==""){
		$no_image = base_url()."assets/common/img/temp/photos/no_image.jpg";
	}else{
		$no_image = themeUrl()."images/".$noimage;
	}
	$img = "";
	if(trim($url)!=""){
		$nurl = "./".str_replace(base_url(),"",$url);
		if(file_exists($nurl) && !is_dir($nurl)){
			$img = $url;
		}else
			$img = $no_image;
	}else
		$img = $no_image;

	return $img;
}

function _ac($c='index'){
	if(trim($c) !== ''){
		$CI  = getCI();
		$acc = $CI->session->userdata['jcfg']['access'];
		if(isset($acc[$c])){
			return TRUE;
		}else
			return FALSE;
	} else {
		return FALSE;
	}
}

function _encrypt($key=""){
	$CI =getCI();
	$CI->load->library('encrypt');
	$nid = "meme-#".$key."#bola-".date("Ymdh");
	return urlencode($CI->encrypt->encode($nid));
}

function _decrypt($key=""){
	$CI =getCI();
	$CI->load->library('encrypt');
	$nid = urldecode($CI->encrypt->decode($key));
	$nid_arr = explode("#",$nid);
	return $nid_arr[1];
}

function get_breadcrumb($par=array()){
	if( is_array($par) && count($par) > 1){
		echo '<nav class="cat__core__top-sidebar">';
		echo '<ol class="breadcrumb mb-0 bg-white">';
		if(count($par) > 0){
			foreach ($par as $key => $value) {
				if( isset($value['url']) && trim($value['url'])!="" ){
					echo "<li class='breadcrumb-item'>";
					if(strtolower($value['title'])=="home"){
						echo "<i class='fa fa-home'></i>";
					}else{
						echo "<a href='".$value['url']."'>".$value['title']."</a> <span class='divider'></span>";
					}
					echo "</li>";
				}else{
					echo "<li class='breadcrumb-item active'>".$value['title']."</li>";
				}
			}
		}
		echo '</ol>';
		echo '</nav>';
	}
}

function getTopActionLink($links=array()){
	foreach ($links as $value) {
		if($value['title']=='add') : ?>
			<a href="<?php echo $value['link']; ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
		<?php
		endif;
	}
}

function getFormActionLink($links=array()){
		$CI =getCI();
		$uri =  $CI->uri->segment(3);
		$uriID =  $CI->uri->segment(4);
		if(count($links)>0){
				// rsort($links);
				foreach($links as $v){
						if($v['title'] == 'add'){
								?>
										<a class="btn btn-info" href="<?php echo $v['link']; ?>">
											<i class="fa <?php echo $v['icon']; ?>"></i>
										</a>
								<?php
						} else if ($v['title'] == "edit" && $uri != 'edit' && $uriID != ''){
								?>
										<a class="btn btn-warning" href="<?php echo $v['link'].'/'.$uriID; ?>" id="editItem">
											<i class="fa <?php echo $v['icon']; ?>"></i>
										</a>
								<?php
						} else if ($v['title'] == "delete" && $uriID != ''){
								?>
										<a class="btn btn-danger" href="<?php echo $v['link'].'/'.$uriID; ?>" id="deleteItem">
											<i class="fa <?php echo $v['icon']; ?>"></i>
										</a>
								<?php
						} elseif ($v['title'] == "detail" && $uri != 'detail' && $uriID != '') {
								?>
										<a class="btn btn-success" href="<?php echo $v['link'].'/'.$uriID; ?>" id="detailItem">
											<i class="fa <?php echo $v['icon']; ?>"></i>
										</a>
								<?php
						} else if ($v['title'] == "access"){
								?>
										<a class="btn btn-sm btn-success" href="<?php echo $v['link'].'/'.$uriID; ?>" data-id="0" id="accessItem" onClick="javascript:accessItem(this.id);return false;" disabled="disabled">
											<i class="fa <?php echo $v['icon']; ?>"></i>
										</a>
								<?php
						}
				}
		}
}

function getTopActionLink_bc($links=array()){
	$CI =getCI();
	$uri =  $CI->uri->segment(3);
	if(count($links)>0){
		rsort($links);
		foreach($links as $v){
			if($v['title'] == 'add'){
		?>
				<a class="btn btn-sm btn-info" href="<?php echo $v['link']; ?>">
					<i class="fa <?php echo $v['icon']; ?>"></i>
				</a>
		<?php
			} else if ($v['title'] == "edit"){
		?>
				<a class="btn btn-sm btn-warning" href="#" id="editItem" data-id="0" onClick="javascript:editItem(this.id);return false;" disabled>
					<i class="fa <?php echo $v['icon']; ?>"></i>
				</a>
		<?php
			} else if ($v['title'] == "delete"){
		?>
				<a class="btn btn-sm btn-danger" href="#" id="deleteItem" onClick="javascript:deleteItem(this.id);return false;" disabled="disabled">
					<i class="fa <?php echo $v['icon']; ?>"></i>
				</a>
		<?php
			} else if ($v['title'] == "access"){
		?>
				<a class="btn btn-sm btn-success" href="#" data-id="0" id="accessItem" onClick="javascript:accessItem(this.id);return false;" disabled="disabled">
					<i class="fa <?php echo $v['icon']; ?>"></i>
				</a>
		<?php
			}
		}
	}
}

function getTopAdd($links=array()){
	$CI =getCI();
	$uri =  $CI->uri->segment(3);
	if(count($links)>0){
		rsort($links);
		foreach($links as $v){
			if($v['title'] == 'add'){
		?>
				<a class="btn btn-sm btn-info" href="<?php echo $v['link']; ?>">
					<i class="fa <?php echo $v['icon']; ?>"></i>
				</a>
		<?php
			} else if ($v['title'] == "edit"){
		?>
				<a class="btn btn-sm btn-warning" href="#" id="editItem" data-id="0" onClick="javascript:editItem(this.id);return false;" disabled>
					<i class="fa <?php echo $v['icon']; ?>"></i>
				</a>
		<?php
			}
		}
	}
}

function getFormActionLink_BC($links=array(),$id=''){
	$CI =getCI();
	$uri =  $CI->uri->segment(3);

	if(count($links)>0){
		rsort($links);
		foreach($links as $v){
			if($v['title'] == 'add'){
		?>
				<a class="btn btn-sm btn-primary" type="submit">
					<i class="fa <?php echo $v['icon']; ?>"></i> Simpan Saja
				</a>
		<?php
			} else if ($v['title'] == "edit"){
		?>
				<a class="btn btn-sm btn-warning" href="#" id="editItem" data-id="0" onClick="javascript:editItem(<?php echo $id?>);return false;" disabled>
					<i class="fa <?php echo $v['icon']; ?>"></i>
				</a>
		<?php
			} else if ($v['title'] == "delete"){
		?>
				<a class="btn btn-sm btn-danger" href="#" id="deleteItem" onClick="javascript:deleteItem(<?php echo $id?>);return false;" disabled="disabled">
					<i class="fa <?php echo $v['icon']; ?>"></i>
				</a>
		<?php
			} else if ($v['title'] == "access"){
		?>
				<a class="btn btn-sm btn-success" href="#" data-id="0" id="accessItem" onClick="javascript:accessItem(this.id);return false;" disabled="disabled">
					<i class="fa <?php echo $v['icon']; ?>"></i> Access
				</a>
		<?php
			}
		}
	}
}

function link_actionC($links=array(),$id="",$row=""){

	if(count($links)>0){
		foreach($links as $m){
			// dd($m);
			$property = "";
			if($m['type']=='simple'){
				$property = " class='ttip_t act_modal' rel='500|400'";
			}elseif($m['type']=='confirm'){
				$property = " class='ttip_t act_confirm' rel='300|150' data='Are you sure ??'";
			}else{
				$property = " class='ttip_t' ";
			}

			if($m['title'] == 'edit'){
				echo '<a href="'.$m['link'].'/'.$id.'" class="link-underlined" >'.$row.'</a>';
			}

		}
	}
}

function link_action($links=array(),$id=""){
	//debugCode($links);
	if(count($links)>0){
		foreach($links as $m){
			$property = "";
			if($m['type']=='simple'){
				$property = " class='ttip_t act_modal' rel='500|400'";
			}elseif($m['type']=='confirm'){
				$property = " class='ttip_t act_confirm' rel='300|150' data='Are you sure ??'";
			}else{
				$property = " class='ttip_t' ";
			}
		?>
		<a href="<?php echo $m['link']."/".$id;?>" <?php echo $property;?> title="<?php echo ucwords($m['title']);?> Data "><?php echo image_asset('admin/'.$m['image'], array('alt' => 'test')); ?></a>
		<?php
		}
	}
}

function getLink2($links=array()){
	//debugCode($links);
	$CI =getCI();
	$uri =  $CI->uri->segment(3);
	if(count($links)>0){
		rsort($links);
		foreach($links as $v){
			if($v['action']!="bug"){
				if(trim($uri)==''||trim($uri)=='search'||trim($uri)=='access'){
					$fc = 'index';
				}else{
					$fc = (trim($uri)=='edit'||trim($uri)=='add'||trim($uri)=='upload_excel'||trim($uri)=='print_mail'||trim($uri)=='print_nota')?'add':$uri;
				}
				$class_css = $v['action']=="index"?"list":$v['action'];
				$icon = $v['action']=="add"?'<i class="icon-plus"></i>':'<i class="icon-th-list"></i>';
				if($v['title'] == "add"){
			?>
				<a href="<?php echo $v['link'];?>" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $v['title'];?>"><?php echo $icon." ".$class_css;?></a>
			<?php
				}
			}
		}
	}
}

function _get_menu($menu=array()){
	$CI  = getCI();
	// dd($menu);
	if(count($menu)<0) return array();
	$mnn=[];
	foreach($menu as $mn){
		$mnx 	= preg_split("/>/",$mn['menu']);
		$count	= count($mnx);
		$t		= "\$mnn";
		for($i=0;$i<$count;$i++){
			if(($count-1)==$i)
				$t .= "[]=array('menu'=> '".trim($mnx[$i])."','id'=>'".$mn['id']."','order'=>'".$mn['order']."','group'=>'".$mn['modules']."','name'=>'".$mn['controllers']."','proccess'=>'".$mn['function']."','css_class'=>'".$mn['css_class']."','is_new'=>'".$mn['is_new']."');";
			else
				$t .= "['".trim($mnx[$i])."']";
		}
		// dd($t);
		eval($t);

	}
	return $mnn;
}

//SETING MENU
function sideBarMenu($m,$top=true,$sub=false){
	$CI  = getCI();
	$c 	= count($m);
	$uri1 = $CI->uri->segment(1);
	$uri2 = $CI->uri->segment(2);
	$uri3 = $CI->uri->segment(3);

	$c = 0;

	if(!empty($m)){

		foreach($m as $k=>$v){

			$active = '';
			$style = 'style="padding-left:10px; display:none;"';

			if($uri1 == strtolower($k)){
				$active = 'cat__menu-left__submenu--toggled';
				$style = 'style="padding-left:10px; display:block;"';
			}

			if(is_array($v) && !isset($v['menu']) && !isset($v['id'])){
				if(isset($v[0]['css_class']) && trim($v[0]['css_class'])!=""){
					$css_class = $v[0]['css_class'];
				} else {
					if(isset(current($v)[0]['css_class']) && trim(current($v)[0]['css_class'])!=""){
						$css_class = current($v)[0]['css_class'];
					}
				}

				echo '<li class="cat__menu-left__item cat__menu-left__submenu '.$active.'" >';
				echo 		'<a href="javascript:;" title="'.$k.'" >';
				echo ($top) ? '<i class="cat__menu-left__icon  '.$css_class.'"></i>' : '';
				echo ($top) ? '' :'<span class="cat__core__donut cat__core__donut--primary"></span>';
				echo 						'<span class="title"><strong>'.$k.'</strong></span>';
				echo 						'<span class="arrow"></span>';
				echo 		'</a>';
				echo 		'<ul class="cat__menu-left__list " '.$style.'>';
								sideBarMenu($v,false,true);
				echo 		'</ul>';
				echo "</li>";
				$c++;
			} else {

				$a = '';
				$style = '';
				global $b;
				if($v['group'] == $v['name']){
					$menuLink = $v['group'];
					if(empty($uri2) || $uri2 == 'add' || $uri2 == 'edit'){
						$a = ($v['group']==$uri1) ? 'cat__menu-left__item--toggled':'';
						if ($v['is_new']==1) {
								$b = '<span class="badge badge-primary pull-right">New</span>';
						}else {
								$b = '';
						}
					}
				} else {
					$menuLink = $v['group'].'/'.$v['name'];
					$a = ($v['group']==$uri1 && $v['name']==$uri2)?'cat__menu-left__item--toggled':'';
					if ($v['is_new']==1) {
							$b = '<span class="badge badge-primary pull-right">New</span>';
					}else {
							$b = '';
					}
				}

				echo '<li class=" cat__menu-left__item '.$a.'">';
				echo 		'<a class="left-menu-link text-nowrap" href="'.base_url($menuLink).'">';
				echo     		'<span class="cat__core__donut cat__core__donut--danger"></span>'.$b.''.$v['menu'];
				echo 		'</a>';
				echo '</li>';
			}

		}
	}
}

function buildTree($e){

	// dd($e);
	$cou = 0;

	foreach ($e as $k => $v) {
		// dd($v);
			if(is_array($v)){

					// if(empty($v['children'])){
						// dd($v);

						//SUMBER DATA ORDER
						if(isset($v['pesanan']) && $v['pesanan'] != ''){
								// dd($v);
								$n 	= 0;
								$q 	= 0;
								$kode = isset($v['kode'])?$v['kode']:'';
								$name = isset($v['name'])?$v['name']:'';

								echo '<br><h4>'.$kode.' '.$name.'</h4>';
								echo '<table class="table" id="tableX" cellspacing="0" cellpadding="0" width="100%">';

									echo '<thead class="thead-default">';
										echo '<tr>';
											echo '<th class="text">No Transaksi</th>';
											echo '<th class="text">Data Konsumen</th>';
											echo '<th class="text">Data Sales</th>';
											echo '<th class="text">Tgl Order</th>';
											echo '<th class="qty">Qty Order</th>';
											echo '<th class="total">Total</th>';
										echo '</tr>';
									echo '</thead>';

									echo '<tfoot>';
										echo '<tr>';
											echo '<td colspan="2"></td>';
											echo '<td colspan="2">TOTAL '.$name.'</td>';
											echo '<td>'.$q.'</td>';
											echo '<td>'.myNum($n,'').'</td>';
										echo '</tr>';
									echo '</tfoot>';

									echo '<tbody>';
										foreach ($v['pesanan'] as $key => $val) {

											echo '<tr>';
											echo '<td class="text">'.$val->pemesanan_no_transaksi_map_order.'</td>';
											echo '<td class="text">'.$val->kode_konsumen.'<br>'.$val->pemohon_nama_lengkap.'</td>';
											echo '<td class="text">'.$val->kode_sales.'<br>'.$val->sales_nama_lengkap.'</td>';
											echo '<td class="text">'.$val->pemesanan_tanggal_order.'</td>';
											echo '<td class="text">'.$val->pemesanan_qty_order.'</td>';
											echo '<td class="text">'.$val->pemesanan_total_nilai.'</td>';
											echo '</tr>';

											$n += $val->pemesanan_total_nilai;
											$q += $val->pemesanan_qty_order;
										}
									echo '</tbody>';

								echo '</table>';

						}

					// }
					//  else {
					//
					//
					// 	// echo '<tr><td align="left" colspan="4" >'.$v['kode'].' '.$v['name'].'<td></tr>';
					// 	$kode = isset($v['kode'])?$v['kode']:'';
					// 	$name = isset($v['name'])?$v['name']:'';
					// 	$sum  = isset($v['id'])?sumUnitbisnis($v['id'],$v['level']):'';
					// 	echo '<br><h4>'.$kode.' '.$name.' '.$sum.' a</h4>';
					//
					//
					// }
					buildTree($v);
					// dd($v);
			}
	}

}

function get_menuDraggable($menu=array()){
	$CI  = getCI();
	if(count($menu)<0) return array();
	$mnn=[];
	foreach($menu as $mn){
		$mnx 	= preg_split("/>/",$mn['menu']);
		$count	= count($mnx);
		$t		= "\$mnn";
		for($i=0;$i<$count;$i++){
			if(($count-1)==$i)
				$t .= "[]=['menu'=>'".trim($mnx[$i])."','id'=>'".$mn['id']."','order'=>'".$mn['order']."','group'=>'".$mn['modules']."','group_menu_id'=>'".$mn['group_menu_id']."','name'=>'".$mn['controllers']."','proccess'=>'".$mn['function']."','css_class'=>'".$mn['css_class']."','is_new'=>'".$mn['is_new']."'];";
			else
				$t .= "['".trim($mnx[$i])."/".$mn['group_menu_id']."']";
		}
		eval($t);
	}
	return $mnn;
}

function menuDraggable($a){
	// dd($a);
	foreach ($a as $k => $v) {
      if(is_array($v) && !isset($v['menu']) && !isset($v['id'])){

        echo '<li class="dd-item" data-id="'.explode("/",$k)[1].'">';
        echo '<div class="dd-handle">'.explode("/",$k)[0].'</div>';
        echo '<ol class="dd-list">';
        	menuDraggable($v);
        echo '</ol>';
        echo '</li>';

      } else {
      	echo '<li class="dd-item" data-id="'.$v['id'].'" data-menu="'.$v['menu'].'" data-group="'.$v['group_menu_id'].'" data-order="'.$v['order'].'" data-url="'.base_url().'/menu/edit/'.$v['id'].'">';
        echo '<div class="dd-handle">'.$v['menu'].' <input type="hidden" class="acgid" value="'.$v['group_menu_id'].'" readonly/> <input type="hidden" class="acid" value="'.$v['id'].'" readonly/> <input type="hidden" class="acord" value="'.$v['order'].'" readonly/> ';
       	// echo '<a href="'.base_url('menu/edit').'">Edit Menu</a>';
        echo '</li>';
      }
    }
}

function sumUnitbisnis($id,$l){
	$CI  = getCI();
	$CI->db->select('SUM(total_akhir) as ta');
	if($l == 5){
		$CI->db->where('unitbisnis_id',$id);
	} else {
		$CI->db->where_in('sub_group_marketing_id',unitbisnisRef($id));
	}

	$a = $CI->db->get('pemesanan_sb_hd')->row();

	$y = 0;
	if(isset($a)){
		$y = $a->ta;
	}

	return myNum($y,'');


}

function fixdate($date_art = ''){
	$CI = getCI();

	if(!empty($date_art)){
		$d = explode(' ',$date_art);
		$t = explode('-',$d[0]);
		$w = explode(':',$d[1]);

		$jam  = $w[0].':'.$w[1];
		$tgl  = $t[2];
		$bln  = $t[1];
		$thn  = $t[0];

		$x = mktime(0, 0, 0, $bln, $tgl, $thn);
		$hari = date("w", $x);
	}else{
		$hari = date('w');
		$tgl  = date('d');
		$bln  = date('m');
		$thn  = date('Y');
	}

    switch($hari){
        case 0 : {
                    $hari='Minggu';
                }break;
        case 1 : {
                    $hari='Senin';
                }break;
        case 2 : {
                    $hari='Selasa';
                }break;
        case 3 : {
                    $hari='Rabu';
                }break;
        case 4 : {
                    $hari='Kamis';
                }break;
        case 5 : {
                    $hari="Jum'at";
                }break;
        case 6 : {
                    $hari='Sabtu';
                }break;
        default: {
                    $hari='UnKnown';
                }break;
    }

	switch($bln){
        case 1 : {
                    $bln='Januari';
                }break;
        case 2 : {
                    $bln='Februari';
                }break;
        case 3 : {
                    $bln='Maret';
                }break;
        case 4 : {
                    $bln='April';
                }break;
        case 5 : {
                    $bln='Mei';
                }break;
        case 6 : {
                    $bln="Juni";
                }break;
        case 7 : {
                    $bln='Juli';
                }break;
        case 8 : {
                    $bln='Agustus';
                }break;
        case 9 : {
                    $bln='September';
                }break;
        case 10 : {
                    $bln='Oktober';
                }break;
        case 11 : {
                    $bln='November';
                }break;
        case 12 : {
                    $bln='Desember';
                }break;
        default: {
                    $bln='UnKnown';
                }break;
    }


	if(!empty($date_art)){
		$date = $hari.", ".$tgl." ".$bln." ".$thn." ".$jam." WIB";
	}else{
		$date = $hari.", ".$tgl." ".$bln." ".$thn;
	}

	if(!empty($date_art)){
		return $date;
	}else{
		echo $date;
	}

}

function umur($tgl_lahir,$delimiter='-') {

    list($hari,$bulan,$tahun) = explode($delimiter, $tgl_lahir);

    $selisih_hari = date('d') - $hari;
    $selisih_bulan = date('m') - $bulan;
    $selisih_tahun = date('Y') - $tahun;

    if ($selisih_hari < 0 || $selisih_bulan < 0) {
        $selisih_tahun--;
    }

    return $selisih_tahun;

}

function get_info_message(){
	 if( isset($_GET['msg']) ){
	 		$type= isset($_GET['type_msg'])?$_GET['type_msg']:'info';
	 	?>

		<div id="gritter-notice-wrapper">
			<div id="gritter-item-4" class="gritter-item-wrapper" role="alert">
				<div class="gritter-top"></div>
				<div class="gritter-item">
					<a class="gritter-close" href="#" tabindex="1" style="display: none;">Close Notification</a>
					<div class="gritter-without-image">
					<span class="gritter-title">Message <?php echo $type;?></span>
					<p><?php echo urldecode($_GET['msg']);?></p>
					</div>
					<div style="clear:both"></div>
				</div>
				<div class="gritter-bottom"></div>
			</div>
		</div>
		<script type="text/javascript">
			function hidden_msg(){
				$('#gritter-notice-wrapper').fadeOut();
			}
			setTimeout('hidden_msg()',4000);
		</script>
	<?php }
}

function cclang($langkey = null, $params = [])
{
	if (!is_array($params)) {
		$params = [$params];
	}

		$lang = lang($langkey);

		$idx = 1;
		foreach ($params as $value) {
			$lang = str_replace('$'.$idx++, $value, $lang);
		}

		return preg_replace('/\$([0-9])/', '', $lang);
}

function get_icon_file($file_name = '') {
	$extension_list = [
		'avi' => ['avi'],
		'css' => ['css'],
		'csv' => ['csv'],
		'eps' => ['eps'],
		'html' => ['html', 'htm'],
		'jpg' => ['jpg', 'jpeg'],
		'mov' => ['mov', 'mp4', '3gp'],
		'mp3' => ['mp3'],
		'pdf' => ['pdf'],
		'png' => ['png'],
		'ppt' => ['ppt', 'pptx'],
		'rar' => ['rar'],
		'raw' => ['raw'],
		'ttf' => ['ttf'],
		'txt' => ['txt'],
		'wav' => ['wav'],
		'xls' => ['xls', 'xlsx'],
		'zip' => ['zip'],
		'doc' => ['docx', 'doc']
	];

	$file_name_arr = explode('.', $file_name);
	if (is_array($file_name_arr)) {
		foreach ($extension_list as $ext => $list_ext) {
			if (in_array(end($file_name_arr), $list_ext)) {
				return BASE_ASSET . 'img/icon/' . $ext . '.png';
			}
		}
	}

	return BASE_ASSET . 'img/icon/any.png';
}


function is_allowed($permission, Closure $func) {
	$ci =& get_instance();
	$reflection = new ReflectionFunction($func);
	$arguments  = $reflection->getParameters();


	if ($ci->aauth->is_allowed($permission)) {
		call_user_func($func, $arguments);
	} else {
		ob_start();
		call_user_func($func, $arguments);
		$buffer = ob_get_contents();
		ob_end_clean();

	}
}

function getUsers($id,$field, $type=""){
	$CI = getCI();
	if($type == "by_id_karyawan")
	{
		$CI->db->select("
			usr.*,
			kmo_ub.kd_unitbisnis,
			kmo_ub.nama_unitbisnis,
			kmo_ub.logo as logo_unitbisnis,
			kmo_kw_per.nama_lengkap
		");
		$CI->db->join("karyawan_mutasi_organisasi kmo", "kmo.id = usr.id_karyawan", "LEFT");
		$CI->db->join("unitbisnis_nama kmo_ub", "kmo_ub.id = kmo.unitbisnis_mutasi_id", "LEFT");
		$CI->db->join("karyawan kmo_kw", "kmo_kw.id = kmo.karyawan_id", "LEFT");
		$CI->db->join("personal kmo_kw_per", "kmo_kw_per.id = kmo_kw.personal_id", "LEFT");

		$a = $CI->db->get_where("users usr",array("id_karyawan"=>$id))->row();
	} else {
		$a = $CI->db->get_where("users usr",array("id"=>$id))->row();
	}

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

// Nama Barang
function getPersediaanbarang($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("persediaan_nama",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getNamabarang($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("barang_nama",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getSatuan($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("barang_satuan",array("id"=>$id))->row();

	$y='-';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getIDbarang($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("barang_gambar",array("barang_nama_id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getBarang($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("barang_gambar",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getProduk($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("barang_produk",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getMerek($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("barang_merek",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getKategori($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("barang_kategori",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getKategoriWeb($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("barang_kategori_web",array("id"=>$id))->row();

	$y='-';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getKondisi($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("barang_kondisi",array("id"=>$id))->row();

	$y='-';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
// Nama Barang

// TOP Unit Bisnis
function arrangeCode($id){
	// $kd_unitbisnis,$sort,$cordinate
	// ex : 1-01.01.01-00.00.00-00
	$CI = getCI();
	$r 	= explode('-',$id);
	$ids = $r[0];
	$d 	= $CI->db->get_where('unitbisnis_nama',array('id' => $ids))->row();
	$d1 = $CI->db->get_where('unitbisnis_nama',array('type_organisasi_id' => $r[1],'parent_id' => $ids))->result();
	$c = (count($d1) > 0) ? max($d1):$d;
	$a 	= explode('-',$d->kd_unitbisnis);
	// dd($d1);
	if($r[1] > 4){

		if($r[1] == 5){
			$x = explode('.',explode('-',$c->kd_unitbisnis)[2])[0];
			$v 	= $x+1;
			$e 	= str_repeat("0",2-strlen($v)).$v;
			$b 	= substr_replace($a[2],$e,0,2);
			$code = $a[0].'-'.$a[1].'-'.$b.'-'.$a[3].'-CL';
		}
		if($r[1] == 6){
			$x = explode('.',explode('-',$c->kd_unitbisnis)[2])[1];
			$v 	= $x+1;
			$e 	= str_repeat("0",2-strlen($v)).$v;
			$b 	= substr_replace($a[2],$e,3,2);
			$code = $a[0].'-'.$a[1].'-'.$b.'-'.$a[3].'-OT';
		}
		if($r[1] == 7){
			$x = explode('.',explode('-',$c->kd_unitbisnis)[2])[2];
			$v 	= $x+1;
			$e 	= str_repeat("0",2-strlen($v)).$v;
			$b 	= substr_replace($a[2],$e,6,2);
			$code = $a[0].'-'.$a[1].'-'.$b.'-'.$a[3].'-GM';
		}
		if($r[1] == 8){
			$x = explode('-',$c->kd_unitbisnis)[3];
			$v 	= $x+1;
			// $e 	= str_repeat("0",2-strlen($v)).;
			$e 	= str_pad($v, 2, '0', STR_PAD_LEFT);
			$b 	= substr_replace($a[3],$e,0,2);
			$code = $a[0].'-'.$a[1].'-'.$a[2].'-'.$b;
		}

	} else {
		// $b 	= substr_replace($a[1],$e,6,2);
		$x 	= explode('.',explode('-',$c->kd_unitbisnis)[1])[2];
		$v 	= $x+1;
		$e 	= str_repeat("0",2-strlen($v)).$v;
		$b 	= substr_replace($a[1],$e,6,2);
		$code = $a[0].'-'.$b.'-'.$a[2].'-'.$a[3].'-CG';
	}

	return $code;
}
function getUnitBisnis($id,$field='', $select=''){
	$CI = getCI();
	if(!empty($select))
	{
		$a = $CI->db->select($select)->get_where("unitbisnis_nama",array("id"=>$id))->row();

	} else {
		$a = $CI->db->get_where("unitbisnis_nama",array("id"=>$id));

	}

	$y='';
	if(!empty($field)){
		$y = $a->row()->$field;
	} elseif(empty($field)) {

		$y = $a->row();
	}

	return $y;
}

function getUBParent($id){
	$CI = getCI();

	$x = getUnitBisnis($id,'parent_id');

	$a = $CI->db->get_where("unitbisnis_nama",array("id"=>$x))->row();

	$y='';
	if(isset($a) ){
		$y = $a->nama_unitbisnis;
	}

	return $y;
}

function getPersediaanStatus($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("persediaan_status",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getGroupBrand($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("unitbisnis_group_brand",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getWilayah($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("unitbisnis_wilayah",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getBrand($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("unitbisnis_brand",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getCabangLk($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("unitbisnis_nama",array("id"=>$id, "type_organisasi_id"=>5))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
// TOP Unit Bisnis

// TOP Accesses Menu
function getGroupMenu($id,$field){
	$CI = getCI();
	$a = json_decode(json_encode($CI->db->get_where("group_menu",array("id"=>$id))->row()),true);

	$y='';
	if(count($a) > 0){
		$y = $a[$field];
	}
	return $y;
}
function getSektorAcl($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("groups_sektor_acl",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
// TOP Accesses Menu

// Regional Indonesia
function getProvinsi($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("regional_provinsi",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getKota($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("regional_kota",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getKecamatan($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("regional_kecamatan",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getKelurahan($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("regional_kelurahan",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
// Regional Indonesia

// Informasi Adminsitratif
function getInfoAdm($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("informasi_administratif",array("id"=>$id));

	$y='';
	if($a->num_rows() > 0){
		$y = $a->row()->$field;
	}
	return $y;
}
function getInfoTypeAdm($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("informasi_type",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getInfoPendidikan($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("informasi_administratif",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getInfoSuku($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("informasi_suku",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getProfesi($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("informasi_tree_status_perkerjaan",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
// Informasi Adminsitratif

// Supplier
function getSupplierNama($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("supplier_nama",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getSupplierType($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("supplier_type",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function GetSupplierdata($apa,$id){
		if ($apa == 'suppliertype'){
		return getSupplierType(getSupplierNama($id,'supplier_type_id'),'nama_type_supplier');
	}else if($apa == 'kota'){
		return getKota(getSupplierNama($id,'kota_id'),'nama_kota');
	}else if($apa == 'prov'){
		return getProvinsi(getSupplierNama($id,'provinsi_id'),'nama_provinsi');
	}
}
// Supplier

// Konsumen
function getIDkonsumenGambar($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("konsumen_gambar",array("konsumen_nama_id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getkonsumenGambar($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("konsumen_gambar",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getIDKonsumen($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("konsumen",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

// Personal Konsumen
function getKonsumen($id,$field,$type=''){

	$CI = getCI();
	$a = $CI->db->get_where("konsumen",array("id"=>$id))->row();
	$b = $CI->db->get_where("personal",array("id"=>$a->personal_id))->row();
	$c = $CI->db->get_where("personal_alamat",array("id"=>$a->personal_id))->row();


	$y='';
	if(isset($a) > 0){
		if ($type == 'konsumen') {
				$y = $a->$field;
		}elseif ($type == 'alamat') {
				$y = $c->$field;
		}else {
				$y = $b->$field;
		}
	}
	return $y;
}

//Personal Pendamping
function getPendamping($id,$field){
	// dd($id);
	$CI = getCI();
	$a = $CI->db->get_where("konsumen",array("id"=>$id))->row();
	$b = $CI->db->get_where("personal",array("id"=>$a->pdmpg_id))->row();

	$y='-';
	if(count($b) > 0){
		$y = $b->$field;
	}
	return $y;
}

//AMBIL PERSONAL DARI KARYAWAN DARI KARYAWAN MUTASI ORGANISASI
function getPerKwKmo($id,$field,$type=''){
	$CI = getCI();
	$a = $CI->db->get_where("karyawan_mutasi_organisasi",array("id"=>$id))->row();
	$b = $CI->db->get_where("karyawan",array("id"=>$a->karyawan_id))->row();
	$c = $CI->db->get_where("personal",array("id"=>$b->personal_id))->row();

	$y='-';
	if(isset($a)){
		if ($type == 'karyawan_mutasi') {
				$y = $a->$field;
		}else {
				$y = $c->$field;
		}
	}
	return $y;
}

function getPersonalKaryawan($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("karyawan",array("id"=>$id))->row();
	$b = $CI->db->get_where("personal",array("id"=>$a->personal_id))->row();

	$y='-';
	if($a->personal_id != 0){

		if(isset($a)){
			$y = $b->$field;
		}
	}

	return $y;
}

function getUserstbl($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("users",array("id"=>$id))->row();

	$y='-';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getMobil($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("aset_kendaraan",array("id"=>$id))->row();

	$y='-';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

//MODUL KEPEGAWAIAN-------------------------------------------------------------
function getIDkaryawanGambar($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("karyawan_gambar",array("karyawan_nama_id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getkaryawanGambar($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("karyawan_gambar",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function organizeCode($id=array(),$kode=""){

	$CI = getCI();
	$a = $CI->db->get_where('karyawan_struktur_organisasi',array('tipe_organisasi_id' => $id[0],'tipe_parent' => $id[1]))->result();
	if($id[1] == 3){
		$a = $CI->db->get_where('karyawan_struktur_organisasi',array('parent_id' => $id[0],'tipe_parent' => $id[1]))->result();
	}
	$b = count($a);
	$c = $b+1;
	$d = str_repeat("0",2-strlen($c)).$c;
	$code = substr_replace($kode, $d, 2,2);
	if($id[1] > 2){
		$code = substr_replace($kode, $d, 5,2);
	}



	return $code;
}

function parentOrganisasi($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("karyawan_struktur_organisasi",array("id"=>$id))->row();
	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getTypeOrganisasi($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("karyawan_type_organisasi",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getOrganisasiJabatan($id,$field){
    $CI = getCI();
    $a = $CI->db->get_where("karyawan_struktur_organisasi",array("id"=>$id))->row();
    // $array = json_decode(json_encode($this->jCfg['access']),true);
    $a = json_decode(json_encode($CI->db->get_where("karyawan_struktur_organisasi",array("id"=>$id))->row()),true);

    $y='';
    if(count($a) > 0){
        // $y = $a->$field;
        $y = $a[$field];
    }
    return $y;
}

function getDetailOrganisasi($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("karyawan_type_organisasi_jabatan",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getJabatanGrade($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("karyawan_grade",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getBaganR($id){
	$CI = getCI();
	$t = array();
	$tmp = '';
	$a = $CI->db->get_where('karyawan_struktur_organisasi',array('tipe_organisasi_id' => $id, 'status' =>1))->result();
	$title_organisasi = $CI->db->get_where('karyawan_type_organisasi',array('id' => $id))->row()->nama_tipe_organisasi;
	foreach ($a as $key => $v) {
		$CI->db->select("nama as title")->where('parent_id',$v->id)->where('status',1);
		$b = $CI->db->get('karyawan_struktur_organisasi')->result();
		$children = array();
		foreach ($b as $kso => $k) {
			$children[] = array(
				'name' 		=> 'Jabatan',
				'title' 	=> $k->title,
				'className' => 'bottom-level'
			);
		}

		$t[$key] = array(
			'name'	=> 'Departemen',
			'title' => $v->nama,
			'children' => $children,
			'className' => 'middle-level'
		);

	}

	$test = array(
		'name' 		=> 'Tipe Organisasi',
		'title' 	=> $title_organisasi,
		'children'	=> $t,
		'className'	=> 'top-level'
	);


	return $test;
}
//MODUL KEPEGAWAIAN/////////////////////////////////////////////////////////////

function getPersonal($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("personal",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

//MODUL PERSEDIAAN--------------------------------------------------------------
function getPersediaan($table,$id,$field){
	$CI = getCI();
	$a = $CI->db->get_where($table,array("id"=>$id))->row();

	$y='-';
	if(isset($a) > 0){
		$y = $a->$field;
	}
	return $y;
}

function GetProdukPersediaan($id){
	return getProduk(getNamabarang($id,"produk_id"),"nama_produk");
}

function getSatuanId($id){
	return getSatuan(getNamabarang($id,"produk_id"),"nama_produk");
}

function GetStatus($id,$idInfo){
		if ($id == '1'){
		return '<button class="btn btn-sm btn-success swal-btn-custom-img" onclick="info_status('.$idInfo.')">Aktif</button>';
	}else{
		return '<button class="btn btn-sm btn-success swal-btn-custom-img" onclick="info_status('.$idInfo.')">Tidak Aktif</button>';
	}
}
function GetStatusAkses($id){
	 if ($id == '1'){
	 return '<span class="label label-success">Aktif</span>';
 }else{
	 return '<span class="label label-success">Tidak Aktif</span>';
 }
}

function GetStatusWawancara($id){
	 if ($id != '' || $id != null){
	 return 'Sudah wawancara';
	 }else{
	 	return 'Belum wawancara';
	 }
	}

function GetStatusLamaran($id){
	 if ($id == '1'){
	 return 'Dicalonkan';
	 }else if($id == '2'){
		 return 'Tidak Dicalonkan';
	 }else if($id == '3'){
	 	return 'Pertimbangan';
	 }else{
	 	return '-';
	 }
	}

// MODULES PEMESANAN SB

function getSB($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("pemesanan_sb_hd",array("id"=>$id))->row();

	$y='-';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getAN($id,$field){
    $CI = getCI();
    $a = $CI->db->get_where("pemesanan_an_hd",array("id"=>$id))->row();

    $y='-';
    if(isset($a)){
        $y = $a->$field;
    }
    return $y;
}

function Get_gambarSB($konsumenId){
	return get_image(base_url()."uploads/konsumen/large/".getkonsumenGambar(getIDkonsumen($konsumenId,'gambar_id'),'gambar_1'));
}

function GetLinkKonsumen($lti,$id,$konsumenId){
	return link_actionC($lti,$id,getIDKonsumen($konsumenId,"nama_lengkap"));
}
// END PEMESANAN SB

//module pemesanan_analisa_kredit
function getPemesananAnalisaKreditBarang($id,$field){
    $CI = getCI();
    $a = $CI->db->get_where("pemesanan_analisa_kredit_gambar",array("pemesanan_analisa_kredit_id"=>$id))->row();

    $y='';
    if(isset($a)){
        $y = $a->$field;
    }
    return $y;
}

// MODULES KARYAWAN
function getKaryawanMutasi($id, $field){
	$CI 		= getCI();
	$get 		= $CI->db->get_where("karyawan_mutasi_organisasi",array("id"=>$id))->row();
	$print 	= '';

	if(isset($get) > 0){
		$print = $get->$field;
	}

	return $print;
}

function getKaryawan($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("karyawan",array("id"=>$id))->row();
	$b = $CI->db->get_where("personal",array("id"=>$a->personal_id))->row();

	$y='-';
	if(isset($a)){
		$y = $b->$field;
	}
	return $y;
}

//BC ADI
// function getKaryawanMutasi($id,$field){
// 	$CI = getCI();
//     $a = $CI->db->get_where("karyawan_mutasi_organisasi",array("karyawan_id"=>$id))->row();
//
//     $y='';
//     if(isset($a)){
//         $y = $a->$field;
//     }
//     return $y;
// }

function getAnalisaKreditBarang($id,$field){
    $CI = getCI();
    $a = $CI->db->get_where("pemesanan_analisa_kredit_gambar",array("id"=>$id))->row();

    $y='';
    if(isset($a)){
        $y = $a->$field;
    }
    return $y;
}

function getAnalisOts($id){
	$CI = getCI();
	$a = $CI->db->get_where("analist_komite",array("pemesanan_analisa_kredit_id"=>$id))->result();
	$return = [];

	foreach ($a as $k => $v) {

		$cek = $CI->db->get_where("pemesanan_sb_hd",array("id"=>$v->pemesanan_analisa_kredit_id))->row();

		if(isset($cek)){
			$return = [
				'id' 	=> $v->id,
				'tipe'	=> 'ots',
			];
		}

	}

	if(empty($return)){
		$id_analist_komite = $CI->db->get_where("analist_komite",array("pemesanan_analisa_kredit_id"=>$id))->row();
		$return = [
			'id' 	=> isset($id_analist_komite)?$id_analist_komite->id:'',
			'tipe'	=> 'internal'
		];
	}

	return $return;

}

// SELECT no_transaksi_map_order AS lkode FROM pemesanan_sb_hd WHERE no_transaksi_map_order LIKE '%1-01.01.01-01.02%' ORDER BY id DESC LIMIT 1 ------------- ALTERNATIVE CODE , getUnitBisnisByLevel(id_unitbisnis,field(kode_unitbisnis),naik_2(Outlet)) => 1-01.01.01-01.02.00-00-OT EXPLODE TO 02

//KODE MAP ORDER
function mapOrderCode($date,$code){
	$CI = getCI();

	// get the last row year
	$getLast = $CI->db->query("SELECT no_transaksi_map_order AS lkode FROM pemesanan_sb_hd WHERE no_transaksi_map_order LIKE '%".$code."%' ORDER BY id DESC LIMIT 1")->row();

	$sCode = date("y/m/d",strtotime($date))."/000001";

	if(count($getLast) > 0){
		$gl = $getLast->lkode;
		if(strpos($gl,'/')){
			$lastYearRow = explode("/",$gl)[2];
			$nowYear = date("y");
			if($lastYearRow == $nowYear){
				$n = $CI->db->query("
							SELECT MAX(SUBSTR(no_transaksi_map_order,-6)) AS kode FROM pemesanan_sb_hd WHERE no_transaksi_map_order LIKE '%".$code."%'
						")->row();
				$v = $n->kode+1;
				$sCode = date("y/m/d",strtotime($date))."/".str_repeat("0",6-strlen($v)).$v;
			}
		}
	}

	return $sCode;
}

function mapRekapCode($date,$code){
	$CI = getCI();
	// get the last row year
	$getLast = $CI->db->query("SELECT no_rekap_map_analist AS lkode FROM pemesanan_an_hd WHERE no_rekap_map_analist LIKE '%".$code."%' ORDER BY id DESC LIMIT 1")->row();
	$sCode = date("y/m/d",strtotime($date))."/000001";

	if(count($getLast) > 0){
		$gl = $getLast->lkode;
		if(strpos($gl,'/')){
			$lastYearRow = explode("/",$gl)[2];
			$nowYear = date("y");

			if($lastYearRow == $nowYear){
				$n = $CI->db->query("
							SELECT MAX(SUBSTR(no_rekap_map_analist,-6)) AS kode FROM pemesanan_an_hd WHERE no_rekap_map_analist LIKE '%".$code."%'
						")->row();
				$v = $n->kode+1;
				$sCode = date("y/m/d",strtotime($date))."/".str_repeat("0",6-strlen($v)).$v;
			}
		}
	}

	// else{
	// 	$sCode = date("y/d/m")."/000001";
	// }

	return $sCode;
}

function CodePO(){
	$CI = getCI();

	$getLast = $CI->db->query("SELECT no_transaksi_pesanan AS lkode FROM pemesanan_bl_hd ORDER BY id DESC LIMIT 1")->row();
	$sCode = date("y/d/m")."/000001";

	if(count($getLast) > 0){
		$gl = $getLast->lkode;
		if(strpos($gl,'/')){
			$lastYearRow = explode("/",$gl)[2];
			$nowYear = date("y");

			if($lastYearRow == $nowYear){
				$n = $CI->db->query("
							select max(substr(no_transaksi_pesanan,-6)) as k from pemesanan_bl_hd
						")->row();
				$v = $n->k+1;
				$sCode = date("y/d/m")."/".str_repeat("0",6-strlen($v)).$v;
			}
		}
	}


	return $sCode;
}

function CodeDO(){
	$CI = getCI();

	$getLast = $CI->db->query("SELECT no_transaksi_masuk_brg AS lkode FROM pembelian_hd ORDER BY id DESC LIMIT 1")->row();
	$sCode = date("y/d/m")."/000001";

	if(count($getLast) > 0){
		$gl = $getLast->lkode;
		if(strpos($gl,'/')){
			$lastYearRow = explode("/",$gl)[2];
			$nowYear = date("y");

			if($lastYearRow == $nowYear){
				$n = $CI->db->query("
							select max(substr(no_transaksi_masuk_brg,-6)) as k from pembelian_hd
						")->row();
				$v = $n->k+1;
				$sCode = date("y/d/m")."/".str_repeat("0",6-strlen($v)).$v;
			}
		}
	}


	return $sCode;
}

function codeFaktur($loop,$c,$date=null){
    $CI = getCI();

    $getLast = $CI->db->query("SELECT no_transaksi_fsb_mask AS lkode FROM penjualan_sb_hd WHERE no_transaksi_fsb_mask LIKE '%".$c."%' ORDER BY id DESC LIMIT 1")->row();
	$sCode = date("y/m/d",strtotime($date))."/000001";
	// dd($sCode);
	if(count($getLast) > 0){

		$gl = $getLast->lkode;
		if(strpos($gl,'/')){
			$lastYearRow = explode("/",$gl)[2];
			$nowYear = date("y");
			if($lastYearRow == $nowYear){
				$n = $CI->db->query("
			                SELECT MAX(SUBSTR(no_transaksi_fsb,-6)) AS k FROM penjualan_sb_hd WHERE no_transaksi_fsb_mask LIKE '%".$c."%'
			            ")->row();
			    $v = $n->k+1;
			    $sCode = date("y/m/d",strtotime($date))."/".str_repeat("0",6-strlen($v)).$v;
			}
		}
	}

	for ($i=0; $i < $loop; $i++) {
		$a = substr($sCode, -6);
		$b = $a + $i;
		$fCode[] = [
			'code' => 'FSB/'.explode('-', $c)[2].'-'.explode('-', $c)[3].'/'.date("y/m/d",strtotime($date))."/".str_repeat("0",6-strlen($b)).$b,
			'codeM' => 'FSB/'.$c.'/'.date("y/m/d",strtotime($date))."/".str_repeat("0",6-strlen($b)).$b,
		];
	}

    return $fCode;
}

function getFaktur($id,$field){
	$C = getCI();

	$a = $C->db->get_where('penjualan_sb_hd',array('id' => $id))->row();

	$y = '';
	if(isset($a)){
		$y = $a->$field;
	}

	return $y;
}

function getFakturDetailByIdHeader($id,$field){
	$C = getCI();

	$a = $C->db->get_where('penjualan_sb_dt',array('header_id' => $id))->row();

	$y = '';
	if(isset($a)){
		$y = $a->$field;
	}

	return $y;
}

function getFakturPembayaranByIdFaktur($id,$field){
	$C = getCI();

	$a = $C->db->get_where('penjualan_sb_byr_piutang_hd',array('penjualan_sb_hd_id' => $id))->row();

	$y = '';
	if(isset($a)){
		$y = $a->$field;
	}

	return $y;
}

function codePengiriman($id,$date){
    $CI = getCI();

    $c = getUnitBisnis($id,'kd_unitbisnis');
    $getLast = $CI->db->query("SELECT no_pengiriman AS lkode FROM pengiriman_hd WHERE no_pengiriman_mask LIKE '%".$c."%' ORDER BY id DESC LIMIT 1")->row();
	$sCode = [
    	'code' => 'BPBK/'.explode('-', $c)[2].'-'.explode('-', $c)[3].'-'.explode('-', $c)[4].'/'.date("y/d/m",strtotime($date)).'/'."/000001",
    	'codeM' => 'BPBK/'.$c.'/'.date("y/d/m",strtotime($date))."/000001",
    ];

	if(count($getLast) > 0){
		$gl = $getLast->lkode;
		if(strpos($gl,'/')){
			$lastYearRow = explode("/",$gl)[2];
			$nowYear = date("y");

			if($lastYearRow == $nowYear){
				$n = $CI->db->query("
			                SELECT MAX(SUBSTR(no_pengiriman,-6)) AS k FROM pengiriman_hd WHERE no_pengiriman_mask LIKE '%".$c."%'
			            ")->row();
			    $v = $n->k+1;

			    $sCode = [
			    	'code' => 'BPBK/'.explode('-', $c)[2].'-'.explode('-', $c)[3].'-'.explode('-', $c)[4].'/'.date("y/d/m",strtotime($date))."/".str_repeat("0",6-strlen($v)).$v,
			    	'codeM' => 'BPBK/'.$c.'/'.date("y/d/m",strtotime($date))."/".str_repeat("0",6-strlen($v)).$v,
			    ];
			}
		}
	}

    return $sCode;
}

// function generate code for persediaan masuk keluar
function getMaxCodeTransInventory($tipe,$date,$idUnitnisnis,$alasanMasuk){

		$CI = getCI();

		$table = 'persediaan_masuk';
		if($tipe == 'keluar'){
			$table = 'persediaan_keluar';
		}

		//1 = SALDO AWAL
		if ($alasanMasuk == 1) {
				$idGroupAlasanMasuk =  ('alasan_masuk=1');

		//5 = PEMBELIAN UMUM, 6 = PEMBELIAN ANTAR CABANG, 10 = RETUR FSB BATAL
		}elseif ($alasanMasuk == 5 || $alasanMasuk == 6 || $alasanMasuk == 10) {
				$idGroupAlasanMasuk =  ('alasan_masuk=5 OR alasan_masuk=6 OR alasan_masuk=10');

		//11 = RETUR TARIK, 16 = RETUR SITA
		}elseif ($alasanMasuk == 11 || $alasanMasuk == 16) {
			  $idGroupAlasanMasuk =  ('alasan_masuk=11 OR alasan_masuk=16');

		//14 = MUTASI INTERNAL
		}elseif ($alasanMasuk == 14) {
				$idGroupAlasanMasuk =  ('alasan_masuk=14');

		}

		//CEK TAHUN INPUT SEKARANG
		$newDate = explode('-',$date);
		$newYY = $newDate[0];

		//GET KODE MAX BY KODE UNITBISNIS + SQUENCE
		$sql = $CI->db->query("SELECT tgl_input, RIGHT(no_transaksi_mask,6) AS maxval FROM $table WHERE lokasi_id=$idUnitnisnis AND $idGroupAlasanMasuk AND no_transaksi_mask = (SELECT MAX(no_transaksi_mask) FROM persediaan_masuk WHERE unitbisnis_id=19 AND alasan_masuk=1)")->row_array();
		//CEK TAHUN TRANSAKSI
		$transDate = explode('-',$sql['tgl_input']);
		$transYY = $transDate[0];

		//JIKA UNITBISNIS BY ID TERSEBUT BELUM MEMILIKI TRANSAKSI = ULANG DARI NOL
		$maxCode = $sql['maxval']+1;
		if ($maxCode == '') {
				$okeCode = '000001';
		}else {
				if ($transYY==$newYY) {//DALAM TAHUN YANG SAMA
						$okeCode = str_repeat("0",6-strlen($maxCode)).$maxCode;
				}else {
					$okeCode = '000001';
				}
		}
		return $okeCode;
}

function getMaxCodeTransInvOut($tipe,$date,$idUnitnisnis,$alasanKeluar){

		$CI = getCI();

		$table = 'persediaan_masuk';
		if($tipe == 'keluar'){
			$table = 'persediaan_keluar';
		}

		//8 = PENJUALAN UMUM
		if ($alasanKeluar == 8) {
				$idGroupAlasanKeluar =  ('alasan_keluar=8');

		// 9 = PENJUALAN ANTAR CABANG
		}elseif ($alasanKeluar == 9) {
				$idGroupAlasanKeluar =  ('alasan_keluar=9');

			//12 = RETUR PEMBELIAN UMUM
		}elseif ($alasanKeluar == 12) {
				$idGroupAlasanKeluar =  ('alasan_keluar=12');

		//15 = MUTASI NPBI
		}elseif ($alasanKeluar == 15) {
			  $idGroupAlasanKeluar =  ('alasan_keluar=15');

		}

		//CEK TAHUN INPUT SEKARANG
		$newDate = explode('-',date("Y-m-d",strtotime($date)));
		$newYY = $newDate[0];

		//GET KODE MAX BY KODE UNITBISNIS + SQUENCE
		$sql = $CI->db->query("SELECT tgl_input, LPAD(MAX(RIGHT(REPLACE(no_transaksi_mask, SUBSTR(no_transaksi_mask , -16, 9), ''),6))+1,6,'000000') AS maxval FROM $table WHERE lokasi_id=$idUnitnisnis AND $idGroupAlasanKeluar")->row_array();
		//CEK TAHUN TRANSAKSI
		$transDate = explode('-',$sql['tgl_input']);
		$transYY = $transDate[0];

		//JIKA UNITBISNIS BY ID TERSEBUT BELUM MEMILIKI TRANSAKSI = ULANG DARI NOL
		$maxCode = $sql['maxval'];
		if ($maxCode == '') {
				$okeCode = '000001';
		}else {
				if ($transYY==$newYY) {//DALAM TAHUN YANG SAMA
						$okeCode = $maxCode;
				}else {
					$okeCode = '000001';
				}
		}
		return $okeCode;
}

function getCodePersediaanPaketHelper($id_unitbisnis,$tgl_berlaku){
		$CI = getCI();

		$status_persediaan = 2;//2 = persediaan paket
		//CEK TAHUN INPUT
		$newDate = explode('-',$tgl_berlaku);
		$newYY = $newDate[0];

		//GET KODE MAX BY KODE UNITBISNIS + SQUENCE
		$sql = $CI->db->query("SELECT tgl_berlaku,RIGHT(sku_internal,6) AS maxval FROM persediaan_nama WHERE lokasi_id=$id_unitbisnis AND status_persediaan=2 AND sku_internal = (SELECT MAX(sku_internal) FROM persediaan_nama WHERE lokasi_id=$id_unitbisnis AND status_persediaan=2)")->row_array();
		// dd($id_unitbisnis.'+'.$tgl_berlaku);
		//CEK TAHUN TRANSAKSI DB
		$transDate = explode('-',$sql['tgl_berlaku']);
		$transYY = $transDate[0];

		$m = $sql['maxval'] + 1;
		$maxCode = str_repeat("0",6-strlen($m)).$m;
		if ($maxCode == '') {
			$okeCode = '000001';
		}else {
			if ($transYY==$newYY) {//DALAM TAHUN YANG SAMA
					$okeCode = $maxCode;
			}else {
				$okeCode = '000001';
			}
		}

		return $okeCode;
}

function qtyCode($tipe,$date){
	$CI = getCI();

	$table = 'persediaan_masuk';

	if($tipe == 'keluar'){
		$table = 'persediaan_keluar';
	}

	$getLast = $CI->db->query("SELECT no_transaksi_mask AS lkode FROM ".$table." ORDER BY id DESC LIMIT 1")->row();
	$sCode = date("y/m/d",strtotime($date))."/000001";

	if(count($getLast) > 0){
		$gl = $getLast->lkode;
		if(strpos($gl,'/')){
			$lastYearRow = explode("/",$gl)[2];
			$nowYear = date("y");

			if($lastYearRow == $nowYear){

				$n = $CI->db->query("
							select max(substr(no_transaksi,-6)) as k from ".$table."
						")->row();
				$v = $n->k+1;
				$sCode = date("y/m/d",strtotime($date))."/".str_repeat("0",6-strlen($v)).$v;
			}
		}
	}


	return $sCode;
}

function saldoAkhir($qty,$id,$s){
	$T = getCI();
	$saldo = $qty;

	$a = $T->db->query('SELECT * FROM persediaan_kartu_stok WHERE barang_nama_id = '.$id.' AND is_trash = 0 ORDER BY id DESC LIMIT 1')->row();

	if(isset($a)){
		if($s == 'masuk'){
			$saldo = $a->qty + $qty;
		}else{
			$saldo = $a->qty - $qty;
		}
	}

	return $saldo;

}

function pointPaketHelper($persediaan_id){
	$tis = getCI();
	$a = $tis->db->get_where('persediaan_nama',['id'=>$persediaan_id])->row();
	$b = 0;

	if($a->status_persediaan == 1){

		$getBarangKategori = getNamabarang($a->barang_nama_id,'kategori_id');
		$getKategoriPoint = getKategori($getBarangKategori,'point');

	} else {

		$getPersediaanPaket = $tis->db->get_where('persediaan_nama_item_paket',['header_id' => $persediaan_id])->result();

		foreach ($getPersediaanPaket as $k => $v) {

			$b += pointPaketHelper($v->persediaan_nama_id);

		}

		$getKategoriPoint = $b;

	}

	return $getKategoriPoint;

}

function cekStokItemPaketHelper($id_persediaan){
	$CI = getCI();

	$sql = ('
					SELECT
					header_id,
					persediaan_nama_id,
				  (
				    (SELECT
				      COALESCE(SUM(pmd.qty), 0)
				    FROM
				      persediaan_masuk_dt pmd
				    WHERE pmd.persediaan_nama_id = pkt.persediaan_nama_id) -
				    (SELECT
				      COALESCE(SUM(pkd.qty), 0)
				    FROM
				      persediaan_keluar_dt pkd
				    WHERE pkd.persediaan_nama_id = pkt.persediaan_nama_id)
				  ) AS saldo_qty
				FROM
				  persediaan_nama_item_paket pkt
				WHERE pkt.header_id = '.$id_persediaan.'
				ORDER BY saldo_qty ASC

	');
	$query = $CI->db->query($sql)->row_array();

	return $query['saldo_qty'];

}

function cekStokDiPesanHelper($id_header_sb){
	$CI = getCI();

	$sql = ('
					SELECT
					id,
					header_id,
					persediaan_nama_id,
					(
						(SELECT
						COALESCE(SUM(pmd.qty), 0)
						FROM
						persediaan_masuk_dt pmd
						WHERE pmd.persediaan_nama_id =
							(SELECT
							persediaan_nama_id
							FROM
							persediaan_hjt
							WHERE persediaan_nama_id = psd.persediaan_nama_id
							LIMIT 1)) -

						(SELECT
						COALESCE(SUM(pkd.qty), 0)
						FROM
						persediaan_keluar_dt pkd
						WHERE pkd.persediaan_nama_id =
							(SELECT
							persediaan_nama_id
							FROM
							persediaan_hjt
							WHERE persediaan_nama_id = psd.persediaan_nama_id
							LIMIT 1))
					) AS saldo_qty
					FROM
					pemesanan_sb_dt psd
					WHERE psd.header_id = '.$id_header_sb.'
					ORDER BY saldo_qty ASC

	');
	$query = $CI->db->query($sql)->result();

	return $query['saldo_qty'];
	// return $query;

}

function cekStokByIdPersediaanNama($id_persediaan_nama){
	$CI = getCI();

	$sql = ('
					SELECT
					id,
					(
						(SELECT
						COALESCE(SUM(pmd.qty), 0)
						FROM
						persediaan_masuk_dt pmd
						WHERE pmd.persediaan_nama_id = nama.id AND pmd.status_persediaan=1) -
						(SELECT
						COALESCE(SUM(pkd.qty), 0)
						FROM
						persediaan_keluar_dt pkd
						WHERE pkd.persediaan_nama_id = nama.id AND pkd.status_persediaan=1)
					) AS saldo_qty
					FROM
					persediaan_nama nama
					WHERE nama.id = '.$id_persediaan_nama.'

	');
	$query = $CI->db->query($sql)->row_array();
	// dd($query);
	return $query['saldo_qty'];
	// return $query;
}

function listItemPaketHelper($id_persediaan){
	$CI = getCI();

	$sql = ('
						SELECT
					  header_id,
					  persediaan_nama_id,
					  (
					    (SELECT
					      COALESCE(SUM(pmd.qty), 0)
					    FROM
					      persediaan_masuk_dt pmd
					    WHERE pmd.persediaan_nama_id = pkt.persediaan_nama_id) -
					    (SELECT
					      COALESCE(SUM(pkd.qty), 0)
					    FROM
					      persediaan_keluar_dt pkd
					    WHERE pkd.persediaan_nama_id = pkt.persediaan_nama_id)
					  ) AS saldo_qty
					FROM
					  persediaan_nama_item_paket pkt
					WHERE pkt.header_id =
					  (SELECT
					    persediaan_nama_id
					  FROM
					    persediaan_hjt
					  WHERE id = '.$id_persediaan.')
					ORDER BY saldo_qty ASC
	');
	$query = $CI->db->query($sql)->result();
	// dd($query);
	return $query;

}

//Kendaraan
function getJenisKendaraan($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("aset_jenis_kendaraan",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getJenisKendaraanOpr($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("aset_jenis_kendaraan_opr",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function kendaraan_check($data=[]){

	$CI = getCI();
	$db = $CI->db;

	$sql = ('
		SELECT * FROM aset_kendaraan ak
		WHERE ak.status = 1
		AND ak.is_trash = 0
		AND (SELECT status FROM unitbisnis_nama WHERE id = ak.unitbisnis_id) = 1
		AND REPLACE(ak.plat_nomor, \' \', \'\') = REPLACE(\''.$data[0].'\', \' \', \'\')
		AND REPLACE(ak.no_rangka, \' \', \'\') = REPLACE(\''.$data[1].'\', \' \', \'\')
		AND REPLACE(ak.no_mesin, \' \', \'\') = REPLACE(\''.$data[2].'\', \' \', \'\')
	');
	$check = $db->query($sql)->result();

	$out = false;
	if (count($check) > 0) {
		$out = true;
	}

	return $out;

}

/** ACCOUNTING ===============================================================*/
function getPerkiraanGroup($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("acc_perkiraan_group",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getPerkiraanSetting($id){

	// $CI = getCI();

	// $sql = $CI->db->query("SELECT * FROM acc_perkiraan_setting WHERE id='$id'")->row_array();

	$sql = (array) _db('acc_perkiraan_setting')->where('id', $id)->first();

	return $sql;
}

function getAccPerkiraan($id) {

	$sql = get_data('acc_perkiraan_nama', ['id' => $id]);

	return $sql;
}


function getJurnalTmp($nama_jurnal){

	$CI = getCI();

	$sql = $CI->db->query("SELECT * FROM acc_jurnal_tmp WHERE nama_jurnal='$nama_jurnal'")->result_array();

	return $sql;
}

function SaveJurnal($data, $update_condition=[]) {
	// $data = [
	// 	"tanggal",
	// 	"jenis",
	// 	"unitbisnis_id",
	// 	"unitbisnis_id_level",
	// 	"transaksi_id",
	// 	"no_transaksi_kas",
	// 	"no_urut",
	// 	"posting",
	// 	"keterangan",
	// 	"acc_coa_id",
	// 	"acc_coa_kode",
	// 	"nilai_debet",
	// 	"nilai_kredit",
	// 	"nilai_total",
	// ];

	return _insert_or_update('acc_jurnal', $data, $update_condition);

	// $count = get_data('acc_jurnal', $update_condition, 'COUNT(id) as count')->count;

	// $c = getCI();
	// $db = $c->db;

	// $db->set($data);

	// if($count > 0) {
	// 	$db->where($update_condition);
	// 	$db->update('acc_jurnal');
	// 	return true;
	// } else {
	// 	$db->insert('acc_jurnal');

	// 	return $db->insert_id();
	// }
}

function DeleteJurnal($condition=[]) {
	$c = getCI();
	$db = $c->db;

	$db->where($condition)->delete('acc_jurnal');
}

function getNameFromNumber($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2) . $letter;
    } else {
        return $letter;
    }
}
/*============================================================================*/
// MODULES PENOMERAN
function getNamaModul($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("penomeran_nama_modul",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}
function getTipeModul($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("penomeran_tipe_modul",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function alasan($id){
    $re = '';
	switch($id){
        case 1 : {
                $re='Pembelian Umum';
            }break;
        case 2 : {
                $re='Pembelian Antar Cabang';
            }break;
        case 3 : {
                $re='Retur Jual';
            }break;
    }

    return $re;
}

function mmtipe($id){
    $re = '';
	switch($id){
        case 1 : {
                $re='Saldo Awal';
            }break;
        case 5 : {
                $re='Pembelian Umum';
            }break;
        case 6 : {
                $re='Pembelian Antar Cabang';
            }break;
        case 7 : {
                $re='Fakturisasi';
            }break;
        case 8 : {
                $re='Penjualan Umum';
            }break;
        case 9 : {
                $re='Penjualan Antar Cabang';
            }break;
        case 10 : {
                $re='Retur FSB Batal (Masih dalam bulan periode akutansi berjalan)';
            }break;
        case 11 : {
                $re='Retur FSB Tarik (Diluar bulan periode akuntansi berjalan, barang yang sama)';
            }break;
        case 12 : {
                $re='Retur Pembelian Umum';
            }break;
        case 15 : {
                $re='Mutasi NPBI';
            }break;
        case 16 : {
                $re='Retur FSB Sita (Diluar bulan periode akuntansi berjalan, barang pengganti)';
            }break;
        case 14 : {
                $re='Mutasi SPBI';
            }break;
    }

    return $re;
}

// MODULES PENOMERAN
// GROUPING UNITBISNIS
function unitbisnisRef($id){

	$ci  = getCI();
	$a   = array();
	$a[] = $id;

	$sql = '
		WITH ParentChildCTE
		AS (
		    SELECT id, parent_id, nama_unitbisnis
		    FROM unitbisnis_nama
		    WHERE id = '.$id.'

		    UNION ALL

		    SELECT T1.id, T1.parent_id, T1.nama_unitbisnis
		    FROM unitbisnis_nama T1
		    INNER JOIN ParentChildCTE T ON T.id = T1.parent_id
		    WHERE T1.parent_id IS NOT NULL
		    )
		SELECT id FROM ParentChildCTE ORDER BY id
	';

	// $query = (new Cache())->remember('web:unitref:'.$id, 60*60, function() use($ci, $sql) {
	// 	return $ci->db->query($sql)->result();
	// });

	$query = $ci->db->query($sql)->result();

	foreach ($query as $k => $v) {
		$a[] = $v->id;
	}
	// dd($a);
	return $a;

	// $out 		= unitbisnisRecursive($id);
	// $sort 	= sort($out);
	// return $out;
}

function unitbisnisRefAsc($id,$level){
	$ci = getCI();
	$a  = array();

	$sql = '
		WITH CTE AS (
			SELECT id, parent_id, nama_unitbisnis, type_organisasi_id
			FROM unitbisnis_nama
			WHERE id = '.$id.'

			UNION ALL

			SELECT T1.id, T1.parent_id, T1.nama_unitbisnis, T1.type_organisasi_id
			FROM unitbisnis_nama T1
			INNER JOIN CTE T ON T.parent_id = T1.id
			WHERE T1.parent_id IS NOT NULL
		)

		SELECT id,type_organisasi_id FROM CTE WHERE type_organisasi_id = '.$level.' order by id
	';

	$query = $ci->db->query($sql)->result();

	foreach ($query as $k => $v) {
		$a[] = $v->id;
	}

	return $a[0];

}

function unitbisnisRecursive($id_unit, $where=false, $is_parent=true) {
	$ci = getCI();
	$ci->load->database();
	$DB = $ci->db;

	$id = [$id_unit];
	$DB->trans_start();

	$DB->select('nama.id, nama.type_organisasi_id as level');
	$DB->from('unitbisnis_nama nama');
	$DB->where('nama.parent_id', $id_unit);
	$DB->where('nama.status', 1);

	$GET = $DB->get()->result_array();

	$DB->trans_complete();

	foreach ($GET as $key => $value) {
		if($value['level'] < 8) {
			$getRec[$key] 	= unitbisnisRecursive($value['id'], false, false);
			$id           = array_merge($getRec[$key], $id);
		} else {
			$id[]         = $value['id'];
		}
	}

	return $id;
}

function unitbisnisAsc__($id){
	$ci = getCI();
	$a = array();
	$a[] = $id;

	$sql = '
		SELECT id
		FROM (SELECT * FROM unitbisnis_nama ORDER BY id DESC) parent_sorted,
			 (select @pv := "'.$id.'") initialisation
		WHERE FIND_IN_SET(id, @pv)
        AND LENGTH(@pv := CONCAT(@pv, ",", parent_id))
        AND type_organisasi_id < 6 AND type_organisasi_id > 4';
	$q = $ci->db->query($sql)->row();
	return $q->id;
}

//OUTLET S/D SUB GROUP MARKETING
function unitbisnisAsc($id='', $level='', $target_level=5, $params=false){
	error_reporting(0);
	$CI = getCI();
	$lev[8] = $CI->db->select($params ? $params:'id'.', parent_id')->get_where("unitbisnis_nama",array("id"=>$id))->row();
	$lev[7] = $CI->db->select($params ? $params:'id'.', parent_id')->get_where("unitbisnis_nama",array("id"=>$lev['8']->parent_id))->row();
	$lev[6] = $CI->db->select($params ? $params:'id'.', parent_id')->get_where("unitbisnis_nama",array("id"=>$lev['7']->parent_id))->row();
	$lev[5] = $CI->db->select($params ? $params:'id'.', parent_id')->get_where("unitbisnis_nama",array("id"=>$lev['6']->parent_id))->row();
	if($target_level == 5 && $level > $target_level) {
		$array = [8 => 3, 7 => 2, 6 => 1];

		foreach($array as $key=> $val) {
			if($level == $key) {
				$getLevel = 8-$val;
			}
		}

	} elseif($target_level == 6 && $level > $target_level) {
		$array = [8 => 2, 7 => 1, 6 => 0];

		foreach($array as $key=> $val) {
			if($level == $key) {
				$getLevel = 8-$val;
			}
		}

	} elseif($target_level == 7 && $level > $target_level) {
		$array = [8 => 1, 7 => 0];

		foreach($array as $key=> $val) {
			if($level == $key) {
				$getLevel = 8-$val;
			}
		}

	}

	if(!$params) {
		return $lev[$getLevel]->id;
	} else {
		return $lev[$getLevel]->$params;
	}
}

//OUTLET S/D SUB GROUP MARKETING
function getLevel6sd8($id){
	$CI = getCI();
	$lev8 = $CI->db->get_where("unitbisnis_nama",array("id"=>$id))->row();
	$lev7 = $CI->db->get_where("unitbisnis_nama",array("id"=>$lev8->parent_id))->row();
	$lev6 = $CI->db->get_where("unitbisnis_nama",array("id"=>$lev7->parent_id))->row();
	$lev5 = $CI->db->get_where("unitbisnis_nama",array("id"=>$lev6->parent_id))->row();

	$y='-';
	if(count($lev8) > 0){
		$y = $lev5->id;
	}
	return $y;
}

function getUnitBisnisByLevel($id,$field,$type=''){//params : id, column, naik_x
	$CI = getCI();
	$type_str = substr($type,5,1);
	$naik_0 = $CI->db->get_where("unitbisnis_nama",array("id"=>$id))->row();

	if ($type_str > 0) {
		$parent_id_handle = $naik_0->id;
		for($i = 1; $i <= $type_str; $i++) {
			// $parent = "naik_{$i}";
			// $var = $i-1;
			// $child = "naik_{$var}";

			$ub_loop 							= $CI->db->get_where("unitbisnis_nama",array("id"=>$parent_id_handle))->row();
			$parent_id_handle 		= $ub_loop->parent_id;

			// $parent = $CI->db->get_where("unitbisnis_nama",array("id"=>$child->parent_id))->row();
		}
	}else {
		$naik_0 = $CI->db->get_where("unitbisnis_nama",array("id"=>$id))->row();
	}

	$y='-';
	if(isset($naik_0)){
		if ($type == 'naik_0') {
			$y = $naik_0->$field;
		}else {
			$y = $parent_id_handle;
		}
	}
	return $y;
}

function getMasterBrandByKode($kode='',$field=""){

	$CI = getCI();
	$kode_exp = explode('/',$kode);

	if (strlen($kode_exp[0]) > 3) {//INISIAL TRANSAKSI CTH BPBK
			$kode_str = substr($kode_exp[1],5,2);
	}else {
			$kode_str = substr($kode_exp[1],5,2);
	}
	$a = $CI->db->get_where("master_brand",array("kd_brand"=>$kode_str))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getBrandFromCode($kode) {
	$get_code_brand = substr($kode, 5,2);
	$data = _db('master_brand')->where('kd_brand', $get_code_brand)->first();

	return $data;
}

function getPengiriman($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("pengiriman_hd",array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getPengirimanDetailByFakturId($id,$field){
	$CI = getCI();
	$a = $CI->db->get_where("pengiriman_dt",array("penjualan_sb_hd_id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function akumulasiOrder($type="", $id_unitbisnis="" )
{
	$ci = getCI();

	if($type == "MO")
	{
		$ci->db->where('sub_group_marketing_id', $id_unitbisnis);
		return $ci->db->get("pemesanan_sb_hd")->num_rows();
	} elseif($type == "nilai") {
		$query = $ci->db->select("SUM(total_akhir) as nilai_akumulasi")->where("sub_group_marketing_id", $id_unitbisnis)->get("pemesanan_sb_hd")->result();
		return $query[0]->nilai_akumulasi;
	}
}

function sendMailRef($to, $subject, $message, $attach="", $email_no=0) {

	$CI = getCI();

	// $email = "predator.dev@prioritas-group.com";

	$emails = [
		[
			'mail' => 'predator.dev@prioritas-group.com',
			'pass' => 'predator030317'
		]
		// [
		// 	'mail'=> 'mydan3.msc@gmail.com',
		// 	'pass'=>'@mydan396'
		// ],
		// [
		// 	'mail'=> 'dhanie.storeage@gmail.com',
		// 	'pass'=>'@mydan396'
		// ],
		// [
		// 	'mail'=> 'dani.aliciatj@gmail.com',
		// 	'pass'=>'@bogor123'
		// ]
	];


	$email = $emails[$email_no];
	if($email_no > count($emails) - 1) {

		$o["status"] = false;
		$o["message"] = "Ada kesalahan pada saat kirim email, Periksa kembali di SMTP server";
		return $o;
	}
	$CI->load->library('email');

	$config = Array(
	'protocol' 	=> 'smtp',
	'smtp_host'	=> 'ssl://smtp.googlemail.com',
	'smtp_port'	=> 465,
	'smtp_user'	=> $email['mail'], // change it to yours
	'smtp_pass'	=> $email['pass'], // change it to yours
	'mailtype' 	=> 'html',
	'charset'  	=> 'iso-8859-1',
	'wordwrap' 	=> TRUE,
	'crlf'			=> "\r\n"
	);

	$CI->email->initialize($config);
	$CI->email->clear(TRUE);
	$CI->email->set_newline("\r\n");
	$CI->email->from($email['mail'], "PREDATOR SYSTEM"); // change it to yours
	$CI->email->to($to);// change it to yours
	$CI->email->subject($subject);
	if(!empty($attach)) {

		$CI->email->attach($attach);

	}

	$CI->email->message($message);
	if($CI->email->send()) {

		$o["status"] = true;
		$o["message"] 	= 'Email terkirim.';


	} else {

		// return sendMailRef($to, $subject, $message, $attach="", $email_no=$email_no+1);
		$o["status"] 	= true;
		$o["message"] 	= 'Email tidak dikirim.';
		// $o["error"] = $CI->email->print_debugger();

	}

	return $o;
}

function sendMailRef_old($to, $subject, $message, $attach="") {
	$CI = getCI();
		$email = "predator.dev@prioritas-group.com";
		// $email = "prio.ho.erp@gmail.com";
        $CI->load->library('email');
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => $email, // change it to yours
        'smtp_pass' => 'predator030317', // change it to yours
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE,
        'crlf'	=> "\r\n"
        );
          $CI->email->initialize($config);
          $CI->email->clear(TRUE);
          $CI->email->set_newline("\r\n");
          $CI->email->from($email, "PREDATOR SYSTEM"); // change it to yours
          $CI->email->to($to);// change it to yours
          $CI->email->subject($subject);
          if(!empty($attach))
          {
	          $CI->email->attach($attach);
          }
          $CI->email->message($message);
        if($CI->email->send())
         {
          $o["status"] 		= true;
					$o["message"]   = 'Berhasil dikirim';
         }
         else
        {
        	$o["status"] 		= false;
        	$o["message"] 	= $CI->email->print_debugger();
		}
		dd($o);
        return $o;
}

function getBarangMO($id='')
{
	$CI = getCI();
	$CI->db->select("c.nama_barang, a.total, a.cicilan_bln, a.cicilan_nilai")->from("pemesanan_sb_dt a")
	->join("persediaan_nama b", "b.id = a.persediaan_nama_id", "LEFT")
	->join("barang_nama c", "c.id = b.barang_nama_id", "LEFT");
	$CI->db->where("a.header_id", $id);

	return $CI->db->get()->result();

}

function getOptGroup($id){

	$CI = getCI();

	$a = $CI->db->get_where('penomeran_tipe_modul',['id'=>$id])->row();
	$y = '';

	if(isset($a)){
		$y = $a->nama_tipe_modul;
	}

	return $y;

}

function getQty($id,$tipe,$ds='',$de=''){

	$CI = getCI();

	if($tipe == "keluar"){
		$table = "persediaan_keluar_dt";
	} else {
		$table = "persediaan_masuk_dt";
	}

	if(empty($ds)){
		$CI->db->select('SUM(qty) as qty');
		$CI->db->where('persediaan_nama_id',$id);
		$a = $CI->db->get($table)->row();
	}else{
		$CI->db->select('SUM(qty) as qty');
		$CI->db->where('persediaan_nama_id',$id);
		$CI->db->where('tgl_input >=',$ds);
		$CI->db->where('tgl_input <=',$de);
		$a = $CI->db->get($table)->row();
	}

	$y=0;
	if(isset($a) > 0 && $a->qty != ''){
		$y = $a->qty;
	}
	return $y;
}

function clStrU($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function clStr($string) {
   $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '_', $string); // Removes special chars.
}

function JmlPelamar($id) {
	$CI = getCI();

	$a = $CI->db->get_where('rekrut_lamaran',array('rekrut_posisi_jabatan_id' => $id))->num_rows();
	return $a;
}

function getRektrutA($id,$field) {
	$CI = getCI();

	$a = $CI->db->get_where('rekrut_action',array('rekrut_lamaran_id' => $id))->row();
	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getJmlProduk($id) {
	$CI = getCI();

	$CI->db->select('count(nama.id) as count')->from("persediaan_nama nama")
	->join("barang_nama bn", "bn.id = nama.barang_nama_id", "LEFT")
	->join("barang_produk bp", "bp.id = bn.produk_id", "LEFT");
	$CI->db->where("bn.produk_id", $id);
	// $a = $CI->db->get_where('persediaan_nama',array('barang_nama_id' => $id))->num_rows();
	// return $a;
	return $CI->db->get()->row()->count;
	// return $CI->db->get()->result();
}


function getJmlKategoriWeb($id) {
	$CI = getCI();

	$CI->db->select('*')->from("barang_nama bn")
	->join("barang_kategori_web bkw", "bkw.id = bn.kategori_web_id", "LEFT");
	$CI->db->where("bkw.id", $id);
	return $CI->db->get()->num_rows();
}

/////////// Module karyawan

function CheckImage($var='',$type='') {
	if($type == 'personal'){
		$location = APPPATH.'../uploads/personal/small/'.$var;
	}else if($type == 'barang'){
		$location = APPPATH.'../uploads/barang_nama/large/'.$var;
	}else if($type == 'supplier'){
		$location = APPPATH.'../uploads/supplier/large/'.$var;
	}else if($type == 'merek'){
		$location = APPPATH.'../uploads/barang_merek/large/'.$var;
	}else if($type == 'icon_merek'){
	$location = APPPATH.'../uploads/barang_merek/icons/'.$var;
	}else if($type == 'kategoriweb'){
		$location = APPPATH.'../uploads/barang_kategori/large/'.$var;
	}else if($type == 'icon_kategoriweb'){
		$location = APPPATH.'../uploads/barang_kategori/icons/'.$var;
	}else if($type == 'kendaraan'){
		$location = APPPATH.'../uploads/kendaraan/large/'.$var;
	}else if($type == 'personal_users'){
		$var = getImage($var) ? getImage($var):'no';
		$location = APPPATH.'../uploads/personal/large/'.$var;
	}else if($type == 'berita'){
		$location = APPPATH.'../uploads/berita/banner/large/'.$var;
	}else if($type == 'paket'){
		$location = APPPATH.'../uploads/persediaan_paket/large/'.$var;
	}
	if(file_exists($location)) {
		return $var;
	} else {
		return '../../no_image.jpg';
	}
}

function getImage($idKr="") {
	getCI()->load->database();
	$query = 'SELECT
					gambar_profil
					FROM
					personal_file_dokumen
					WHERE personal_id =	(SELECT
										id
										FROM
										personal
										WHERE id =	(SELECT
													personal_id
													FROM
													karyawan
													WHERE id = (SELECT
																karyawan_id
																FROM
																karyawan_mutasi_organisasi
																WHERE id = '.$idKr.')))';
$get = getCI()->db->query($query)->row();
return isset($get->gambar_profil) ? $get->gambar_profil:'';
}


function CheckAkses($controller, $id_action) {
	$CI = getCI();
	$CI->load->library('session');
	$jCfg = $CI->session->userdata('jcfg');
// dd($jCfg);
	$IDG = $jCfg['user']['id_group_level'];
	$CI->load->database();
	$DB = $CI->db;
	if ($jCfg['user']['id_relasi_cabang'] !='9'){

		$DB->select('controllers')->from('groups ug')
		->join('groups_accesses ga', 'ga.groups_id = ug.id', 'left')
		->join('accesses acc', 'acc.id = ga.accesses_id', 'left')
		->where('ug.id', $IDG)
		->where('acc.controllers', 'pemesanananalist')
		->where('ga.actions_id', $id_action);
		// dd($DB->get()->result());
		return $DB->get()->num_rows();
	}
}

//Notification Rekap
function countRekap() {
	$CI = getCI();

	$jCfg = $CI->session->userdata('jcfg');
	$ID = $jCfg['user']['id_relasi_cabang'];

	$CI->load->database();
	$DB = $CI->db;

	$fungsi = unitbisnisRef($ID);
	$DB->select('hd.id')
	->from('pemesanan_sb_hd hd')->
	where_in('hd.sub_group_marketing_id', $fungsi)->
	where('(select count(order_sb_id) from pemesanan_an_dt where order_sb_id = hd.id) = 0');
	return $DB->get()->num_rows();
}

function getRekap() {
	$CI = getCI();

	$jCfg = $CI->session->userdata('jcfg');
	$ID = $jCfg['user']['id_relasi_cabang'];

	$CI->load->database();
	$DB = $CI->db;

	$fungsi = unitbisnisRef($ID);
	$DB->select('hd.id')
	->from('pemesanan_sb_hd hd')
	->where_in('hd.sub_group_marketing_id', $fungsi)
	->where('(select count(order_sb_id) from pemesanan_an_dt where order_sb_id = hd.id) = 0');

	return $DB->get()->result();

}

function getMasterStatusPenjualan($param=false) {

	$status['analisa'] = array(
		'dibawa' => 'Pembawaan',
		'rekomendasi' => 'Rekomendasi',
		'tidakrekomendasi' => 'Tidak Rekomendasi',
		'pertimbangan' => 'Pertimbangan'
	);

	$status['komite'] = array(
		'acc' 	=> 'ACC',
		'tolak' => 'TOLAK',
		'batal' => 'BATAL'
	);

	$status['pengiriman'] = array(
		'dikirim' => 'Dikirim',
		'terkirim' => 'Terkirim',
		'tao' => 'Tidak Ada Orang (TAO)',
		'ubs' => 'Uang Belum Siap (UBS)',
		'atj' => 'Alamat Tidak Jelas (ATJ)',
		'batal' => 'Batal'
	);

	$status['collector'] = array(
		''			=> '- Pilih -',
		'bayar'		=> 'Bayar',
		'jb'		=> 'Janji Bayar',
		'tk'		=> 'Tunggu Kabar',
		'tao'		=> 'Tidak Ada Orang',
		'tarik'		=> 'Tarik Barang'
	);

	if ($param) {
			return $status[$param];
	}else {
			return $status;
	}

}

function segment($get=false) {
	if($get) {
		return getCI()->uri->segment($get);
	} else {
		return getCI()->uri->segment();
	}
}

function get_data($table, $where=[], $select='*', $row=true, $order=false, $array=false) {

	$db = getCI()->db;

	$db->select($select);

	if(count($where)) {
		foreach($where as $key => $value) {
			if($key == 'subquery') {
				$db->where($value);
			} else {
				$db->where($key, $value);
			}
		}
	}

	if($order != false) {
		$db->order_by('id', $order);
	}

	if($row) {
		if($array) {
			return $db->get($table)->row_array();
		}else {
			return $db->get($table)->row();
		}
	} else {
		return $db->get($table)->result();
	}

}

function update_data($table, $where, $set) {
	$db = getCI()->db;
	$db->where($where);
	$db->set($set);
	$db->update($table);
}

// Point Config By Faktur

function point_config($tgl){

	$db = getCI()->db;

	$tgl = date("Y-m-d",strtotime($tgl));

	$a = $db->query("SELECT id FROM point_config_by_faktur WHERE '".$tgl."' BETWEEN periode_point_start AND periode_point_end")->row();

	$y=0;
	if(isset($a)){
		$y = $a->id;
	}

	return $y;

}

function no_image() {
	$no_image = base_url('assets/common/img/temp/photos/no_image.jpg');
	return $no_image;
}

function getInt($string) {
	return preg_replace("/\D/", "", $string);
}

function getDecimal($string) {
	return str_replace(',', '', $string);
}

function getDecimalMaks($string) {
	try {
		if ($string == '') $string = '0,00';
		$string_x 		= explode(',',$string);
	
		$string_a 		= str_replace('.', '', $string_x[0]);
		$string 			= $string_a . '.' . $string_x[1];
	
	} catch (\Throwable $th) {
		if ($string == '') $string = '0,00';
	}
	return $string;
}

function setDecimalMaks($num=0,$curr="ID",$minimumFractionDigits='2'){

	if ($curr == "ID") {//ID = mata uang indonesia
		if ($minimumFractionDigits) {//dgn decimal
			return number_format( (float) $num, $minimumFractionDigits, ",", "." );
		}else {//tanpa decimal
			return number_format($num, 0, ",", ".");
		}
	}

}

function validasiPeriodeAccounting($tgl, $ub_id){//params : tgl:30-12-2020

	$db = getCI()->db;

	$tgl_a = date("Y-m",strtotime($tgl));

	$query = $db->query("SELECT tgl_berjalan FROM acc_periode_setting WHERE id_unitbisnis = $ub_id")->row_array();

	if($query == null) {
		return false;
	}

	$tgl_b = date("Y-m", strtotime($query['tgl_berjalan']));

	$out=false;
	if ( isset($query) && $tgl_a >= $tgl_b ) {
		$out = true;
	}
	return $out;
}

function get_bayar_full($faktur_id) {
    $ci = getCI();
    $ci->load->database();

    $db = $ci->db;

    $db->select('header.penjualan_sb_hd_id, detail.tenor_bayar');
    $db->from('penjualan_sb_byr_piutang_dt detail');
	$db->join('penjualan_sb_byr_piutang_hd header', 'header.id = detail.header_id');
	$db->where('header.penjualan_sb_hd_id', $faktur_id);

    $results = $db->get()->result();

    $tenor_bayar = [];

    foreach($results as $key => $value) {
        if(!in_array($value->tenor_bayar, $tenor_bayar)) {
            $tenor_bayar[] = $value->tenor_bayar;
        }
    }

    return $tenor_bayar;
}

function checkIsUnitbisnisKantor(){
	$tipe_organisasi_id 	= jCfg('user')['level'];
	$user_ub_id 					= jCfg('user')['id_relasi_cabang'];

	$out = true;
	if ($tipe_organisasi_id >= 5) {
		$out = false;
	}

	return $out;
}

function getDataById($table,$id,$field){
	$CI = getCI();
	$a = $CI->db->get_where($table,array("id"=>$id))->row();

	$y='';
	if(isset($a)){
		$y = $a->$field;
	}
	return $y;
}

function getDocumentSpb($tgl, $unitbisnis_id, $inisial_dokumen='SPB', $type=''){
	$CI = getCI();

	$tgl_ 										= date("y",strtotime($tgl));//19-12-31
	$array_unitbisnis_id 			= unitbisnisRef($unitbisnis_id);
	$array_unitbisnis_id 			= implode(',', $array_unitbisnis_id);

	if ($inisial_dokumen == 'SPB') {
		$array_squence = $CI->db->query(" SELECT no_transaksi_do as no_transaksi,id, 'pembelian_beli_hd' as sumber_tabel, SUBSTRING(no_transaksi_do,34,6) as maxseq FROM pembelian_beli_hd WHERE lokasi_barang_id IN ($array_unitbisnis_id)  AND inisial_document = '$inisial_dokumen'
		UNION SELECT no_transaksi_rt as no_transaksi, id, 'penjualan_sb_retur_hd' as sumber_tabel, SUBSTRING(no_transaksi_rt,34,6) as maxseq  FROM penjualan_sb_retur_hd WHERE unitbisnis_id IN ($array_unitbisnis_id) AND tipe_transaksi = 'RETUR'
		UNION SELECT no_transaksi_rt as no_transaksi, id, 'penjualan_retur_hd' as sumber_tabel, SUBSTRING(no_transaksi_rt,34,6) as maxseq FROM penjualan_retur_hd WHERE sales_kmo_ub_id IN ($array_unitbisnis_id) ORDER BY maxseq")->result();
	}else {
		$inisial_dokumen = 'SPBD';

		$array_squence = $CI->db->query(" SELECT no_transaksi_do as no_transaksi,id, 'pembelian_beli_hd' as sumber_tabel, SUBSTRING(no_transaksi_do,35,6) as maxseq, inisial_document FROM pembelian_beli_hd WHERE lokasi_barang_id IN ($array_unitbisnis_id) AND inisial_document = '$inisial_dokumen' ORDER BY maxseq")->result();
	}

	if($type == 'GET'){
		$maxsequence = end($array_squence);

		//generate squence
		$sequence = '000001';
		if($array_squence){
			$sequence = str_pad(( $maxsequence->maxseq + 1),6,'000000',STR_PAD_LEFT);
		}

		$out = [
			'no_transaksi_tmp' 					=> $inisial_dokumen . '/'.Unitbisnis::getUnitbisnis($unitbisnis_id,'kd_unitbisnis').'/'.$tgl_.'/',
			'no_transaksi_squence' 			=> $sequence,
		];

	} else if($type == 'CHECK'){

		$out = $array_squence;

	}

	return $out;

}

function checkFile($path, $return_bool=false) {
	$url = 'https://storageupload.prioritasgroup.com/'.$path;
	// dd($url);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_NOBODY, true); // this is what sets it as HEAD request
	curl_exec($ch);

	$output = true;
	if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '404') { // 404 = not found
			$output = false;
	}

	curl_close($ch);
	if(!$return_bool) {
		return $url;
	} else {
		return $output;
	}
}

function write_log($log_message='', $user='') {
	$datetime 		= _now('d-m-Y H:i:s');
	$name     		= strtolower(explode('@', $user)[0]);
	$log 		  	= "$datetime | ".strtolower($name)." \t\t$log_message\t\t| ".current_url()."\n";

	file_put_contents(APPPATH.'logs/log_'.date("").'.log', $log, FILE_APPEND);
}