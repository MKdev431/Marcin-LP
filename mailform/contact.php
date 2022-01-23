<?php

$alert_name = '';
$alert_email = '';
$alert_message = '';
$alert_spam = '';

$message = '';

$name =(isset($_POST['contact_name']) && $_POST['contact_name']!="")? $_POST['contact_name'] : '';
$email =(isset($_POST['contact_email']) && $_POST['contact_email']!="")? $_POST['contact_email'] : '';
$phone =(isset($_POST['contact_phone']) && $_POST['contact_phone']!="")? $_POST['contact_phone'] : '';
$query =(isset($_POST['contact_query']) && $_POST['contact_query']!="")? $_POST['contact_query'] : '';

$spam =(isset($_POST['spam']) && $_POST['spam']!="")? $_POST['spam'] : '';


//if(isset($_SESSION['item_ok']) && $spam!==$_SESSION['item_ok']['nr'])
//	$_SESSION['item_ok'] = $antyspan_array[$random_array[$random_item]];

if (isset($_POST['ok'])){	
	$ok = true;
	
	if($_SESSION['item_ok']['nr']!==intval($spam)){		
		$ok = false;		
		$alert_spam = "Kliknij w odpowiedną figurę.<br />";		
	}

	if ($name == ""){
		$ok = false;
		$alert_name = "Imię i nazwisko jest wymagane i nie może pozostać puste.<br />";
	}

	$check = "/([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})/";
	if ($email == ""){
		$ok = false;
		$alert_email = "E-mail jest wymagany i nie może pozostać pusty.<br />";
	}
	else if(!preg_match($check, $email)){
		$ok = false;
		$alert_email = "Musisz podać prawidłowy adres e-mail.<br />";
	}


	if ($query == ""){
		$ok = false;
		$alert_message = "Treść jest wymagana i nie może pozostać pusta.";
	}

	if ($ok == true){
		$headers  = "From: <noreply@kurek.pl>\r\n";
		$headers .= 'Content-type: text/plain; charset=utf-8';

		$text_mail = "Od: ".$name."\n";
		$text_mail .= "E-mail: ".$email."\n";
		if($phone!='')
			$text_mail .= "Telefon: ".$phone."\n";
		$text_mail .= "\nTreść:\n".$query;

		mail("ogrodzenia@kurek.pl", "Formularz kontaktowy ze strony www.ogrodzenia.kurek.pl", $text_mail, $headers);
//		$message = "Formularz został wysłany. Dziękujemy.";
		$message = "<div style='padding-bottom: 10px; color: #E9672D;'>Formularz został wysłany. Dziękujemy.</div>";

		$name = "";
		$email = "";
		$query ="";
		$phone = "";
		$spam = "";		
	}
	else{
//		$message = "<div class='red' style='font-size: 11px; padding-bottom: 10px;'>Wystąpiły błędy w formularzu. Popraw treść i spróbuj ponownie.</div>";
		$message = "<div style='padding-bottom: 10px; color: red'>Wystąpiły błędy w formularzu. Popraw treść i spróbuj ponownie.</div>";
	}
}


//antispam

$antyspan_array = array(
	array('nr'=>0, 'text'=>'kwadrat', 'id' => 'square'),
	array('nr'=>1, 'text'=>'trójkąt', 'id' => 'triangle'),
	array('nr'=>2, 'text'=>'księżyc', 'id' => 'moon'),
	array('nr'=>3, 'text'=>'kolo', 'id' => 'circle'),
	array('nr'=>4, 'text'=>'korone', 'id' => 'crown'),
	array('nr'=>5, 'text'=>'serce', 'id' => 'heart')
 );

//$test = array(0=>'aaa', 1=>'bbb');

//$_SESSION['random_array'] = array_rand($antyspan_array, 3);
//print_r($random_array);echo '<br />';
//$random_item = array_rand($_SESSION['random_array']);
//print_r($random_item);exit;
//echo($random_array[$random_item]);

//print_r($_SESSION['item_ok']);

//endantispam

//if(isset($_SESSION['item_ok']) && intval($spam)!==$_SESSION['item_ok']['nr'] || !isset($_SESSION['item_ok'])){
	$_SESSION['random_array'] = array_rand($antyspan_array, 3);
	$random_item = array_rand($_SESSION['random_array']);
	$_SESSION['item_ok'] = $antyspan_array[$_SESSION['random_array'][$random_item]];
	
//}

//echo $_SESSION['item_ok']['nr'].'<br />';
//echo $spam;

?>
<script type="text/javascript">
	//<![CDATA[
	$(document).ready(function(){
		$('#img_antispam a').click(function(e){
			e.preventDefault();
			$('#img_antispam a').removeClass('active');
			$(this).addClass('active');
			$('#spam_id').val($(this).attr('rel'));
		});
	});	
	//]]>
</script>



<div class="content" style="margin-top: 20px;">	
		<div class="box_wrap">
			<div class="box_border_bottom">
				<div class="title2" style="padding-bottom: 15px;">Kontakt</div>
				<div class="contact_left">
					<div class="title2" style="padding-bottom: 15px;">Adres:</div>
					<p>
                    "KUREK" Szymon Kurek<br />
						ul. Bulowska 3<br />
						32-652 Bulowice<br />
						woj. małopolskie, Polska
					</p>
                    <p>
                    GPS:<br /> 
                    49.866396, 19.250886‎<br /> 
					49°51'59.0"N 19°15'03.2"E
                    </p> 
					<p>
						tel. +48 33 843 57 06<br />
						fax +48 33 843 56 23<br />
						kom. +48 502 370 361
					</p>
					<p>
						e-mail: <a href="mailto:ogrodzenia@kurek.pl">ogrodzenia@kurek.pl</a><br />
						<a href="http://www.kurek.pl">www.kurek.pl</a>
					</p>
					<p>
						<span class="title2">Biuro czynne:</span><br />
						poniedziałek - piątek: od 7.00 do 17.00<br />
						sobota: od 8.00 do 13.00
					</p>
					<p>
						<span class="title2">Numer konta bankowego:</span><br />
                        ABS Bank<br />
						konto: 77 8110 0000 2001 0046 2039 0001
					</p>
				</div>
				<div class="contact_right">
					<div class="title2" style="padding-bottom: 15px;">Formularz kontaktowy:</div>	
					<?= $message ?>
					<form method="post" action="">
						<table class="table" id="table_contact">
							<tr>
								<td>Imię i nazwisko*</td>
								<td>
									<input type="text" value="<?=$name?>" name="contact_name" />
									<div class="errors"><?= $alert_name ?></div>
								</td>
							</tr>
							<tr>
								<td>e-mail*</td>
								<td>
									<input type="text" value="<?=$email?>" name="contact_email" />
									<div class="errors"><?= $alert_email ?></div>
								</td>
							</tr>
							<tr>
								<td>Telefon</td>
								<td><input type="text" value="<?=$phone?>" name="contact_phone" /></td>
							</tr>
							<tr>
								<td>Treść*</td>
								<td>
									<textarea name="contact_query"><?=$query?></textarea>
									<div class="errors"><?= $alert_message ?></div>
								</td>
							</tr>
							<tr>
								<td style="line-height: normal">
									Zabezpieczenie przed SPAM-em<br />
									Kliknij w <?= $_SESSION['item_ok']['text'] ?>
								</td>
								<td>
									<div id="img_antispam">
									<?php  for($i=0; $i<count($_SESSION['random_array']); $i++): ?>
<?php /*										<a href="" id="<?= $antyspan_array[$_SESSION['random_array'][$i]]['id'] ?>" rel="<?= $antyspan_array[$_SESSION['random_array'][$i]]['nr'] ?>"<?php if($antyspan_array[$_SESSION['random_array'][$i]]['nr']==intval($spam)): ?> class="active"<?php endif; ?>></a> */ ?>
										<a href="" id="<?= $antyspan_array[$_SESSION['random_array'][$i]]['id'] ?>" rel="<?= $antyspan_array[$_SESSION['random_array'][$i]]['nr'] ?>"></a>
									<?php endfor;?>
										<input type="hidden" name="spam" value="<?= $spam ?>" id="spam_id" />
									</div>								
									<div class="errors"><?= $alert_spam ?></div>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="padding: 0px;">*pola obowiązkowe</td>								
							</tr>
							<tr>
								<td colspan="2" style="padding: 0px;">
									<input type="submit" name="ok" value="" class="send" />
								</td>
							</tr>
						</table>
					</form>	
				</div>
				<div class="clear"></div>
			</div>
			<div class="box_border_bottom" style="border: 0px;">
				<script type="text/javascript"
					src="http://maps.googleapis.com/maps/api/js?sensor=true">
				</script>
				<script type="text/javascript">
					//<![CDATA[
					function google_map(){
						var myLatlng = new google.maps.LatLng(49.86639,19.25088);
						var myOptions = {
							zoom: 13,
							center: myLatlng,
							scrollwheel: false,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						}
						var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
						var image = "images/google_icon.png";
						var marker = new google.maps.Marker({
							position: myLatlng,
							map: map,
							icon: image
						});
					}				
					$(document).ready(function(){
						google_map();					
					});
					//]]>
				</script>
				<div id="map_canvas" style="width: 929px; height: 357px; border: 1px solid #dcdcdc;"></div>
				<a href="http://maps.google.com/maps?saddr=&amp;daddr=49.86639,19.25088" target="_blank">Wskazówki&nbsp;dojazdu</a>
		</div>	
	</div>
</div>