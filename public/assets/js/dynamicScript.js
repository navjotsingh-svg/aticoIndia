/*!@license Copyright 2013, Heinrich Goebl, License: MIT, see https://github.com/hgoebl/mobile-detect.js*/


var eboundMD = new MobileDetect(window.navigator.userAgent); //Mobile Detect
function eboundReady(fn){var d=document;(d.readyState=='loading')?d.addEventListener('DOMContentLoaded',fn):fn();}
eboundReady(function(){

	while(true && numberOfEboundDynamicAdds <= allowedNumberOfEboundDynamicAdds){
		var x = Math.floor(Math.random() * eboundAdsFunc.length);
		console.log(x);
		if ( eboundTraversed[x] === false){
			eboundAdsFunc[x](eboundDynamicAdsPosition[x]);
			console.log(eboundAdsFunc.length);
			eboundTraversed[x] = true;
			numberOfEboundDynamicAdds = numberOfEboundDynamicAdds+1;
			break;
		}
	}

});

if(typeof eboundDynamicAdsPosition == 'undefined'){
	var eboundDynamicAdsPosition = [];
}

var scriptTag = document.getElementsByTagName('script');

scriptTag = scriptTag[scriptTag.length - 1];

//eboundDynamicAdsPosition.push(scriptTag);


if(typeof eboundTraversed == 'undefined'){
	var eboundTraversed = [];
}
eboundTraversed.push(false);

if(typeof eboundAdsFunc == 'undefined'){
	var eboundAdsFunc = [];
}

eboundAdsFunc.push(function (el){
  loadXMLDocDynamic(el);
  //alert(4);
});


if (typeof numberOfEboundDynamicAdds != 'undefined' && numberOfEboundDynamicAdds ){

}else{
	var numberOfEboundDynamicAdds = 1;
}

if (typeof numberOfEboundDynamicAddsCountPerPage != 'undefined' && numberOfEboundDynamicAddsCountPerPage ){

}else{
	var numberOfEboundDynamicAddsCountPerPage = 0;
}


var script = document.createElement('script'); 
script.async = true; 
script.src = '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'; 
document.head.appendChild(script); 

var script = document.createElement('script'); 
script.async = true; 
script.src = '//eboundservices.com/ads/country.php'; 
document.head.appendChild(script); 


var style_rules = [];
style_rules.push(".eboundDynamicAdsbygoogle {display: none !important;} ");
document.querySelector('head').innerHTML += '<style type="text/css">' + style_rules.join("\n ") + '</style>';

function display_ebound_ads()
{
	(adsbygoogle=window.adsbygoogle || []).push({});
}

function loadXMLDocDynamic(el) {
    var xmlhttp;
	var params = "domain="+encodeURIComponent(document.domain)+"&pathname="+encodeURIComponent(window.location.pathname)+"&currentPage="+encodeURIComponent(window.location.href);
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
           if(xmlhttp.status == 200){
               console.log(xmlhttp.responseText);
			   var jsonResponse = JSON.parse(xmlhttp.responseText);
			   if(jsonResponse.allow===true)
				{
					console.log('test1: '+el);
					if(jsonResponse.compare===true){
						
						var eboundEL = 'ebound_'+jsonResponse.position+'_tag';
						console.log('test2: '+eboundEL);
						try{
							var userCPM = parseFloat(user_tag_config[eboundEL][reporting['type']]['cpm']) || 0.00;
							var eboundCPM = parseFloat(jsonResponse.eboundCPM) || 0.00;
							console.log( userCPM);
							if( eboundCPM > userCPM){
								
								document.getElementById(eboundEL).style.width = jsonResponse.width+'px';
								document.getElementById(eboundEL).style.height = jsonResponse.height+'px';
								console.log(jsonResponse.slot);
								document.getElementById(eboundEL).dataset.adSlot = jsonResponse.slot;
								document.getElementById(eboundEL).className = "adsbygoogle";
							}else{
								replaceTargetWith(eboundEL,user_tag_config[eboundEL][reporting['type']]['adsCode']);  
								document.getElementById(eboundEL).className = "adsbygoogle";
								console.log('test3: '+eboundEL);
							}
							
							console.log('test4: '+eboundEL);
							
						}catch(e){
						   console.log("YO",e);
						   console.log('property:'+jsonResponse.position);
						   document.getElementById(el).className = "adsbygoogle";
						}

					}else{
						document.getElementById(el).className = "adsbygoogle";
					}
					
					//el.nextSibling.className = "adsbygoogle";
					display_ebound_ads();
				}
           }
           else if(xmlhttp.status == 400) {
              //alert('There was an error 400');
			  //console.log('400');
           }
           else {
			   //console.log('other');
               //alert('something else other than 200 was returned');
           }
        }
    };

    xmlhttp.open("POST", "//publisher.eboundservices.com/dynamicAds/ajax-dynamicAds.php?"+params, true);
	//xmlhttp.setRequestHeader("Content-type", "application/json");
	xmlhttp.timeout = 1000;
	xmlhttp.ontimeout = function () { 
						console.log('timeout');
						//el.nextSibling.className = "adsbygoogle";
						document.getElementById(el).className = "adsbygoogle";
						//el.nextSibling.className = "adsbygoogle";
						display_ebound_ads();
					}
	var reporting = prepareAnalytics(); 
	reporting['duplicate'] = numberOfEboundDynamicAdds; 
	reporting['tag'] = el; 
		
	console.log(el);
	
	if (eboundMD.tablet()) {
		reporting['type'] = 'tablet'; 
		reporting['cpm'] = user_tag_config[el]['tablet']['cpm'];
	}else if (eboundMD.mobile()) { 
		reporting['type'] = 'mobile'; 
		reporting['cpm'] = user_tag_config[el]['mobile']['cpm'];
	}else{
		reporting['type'] = 'desktop'; 
		reporting['cpm'] = user_tag_config[el]['desktop']['cpm'];
	}
	
	reporting['width'] = document.getElementById(el).style.width;
	reporting['height'] = document.getElementById(el).style.height;
	
    xmlhttp.send(JSON.stringify({reporting:reporting}));
}

function block_keywords(){
			var block = ["porn ","pistol ","nude ","kidnap ","underwear ","sexual ","nangi ","breast ","boobs ","penis ","mujra ","horny ","sucking ","beheading ","behead ","geslag ","seksuele ","naked ","Ню ","Порно ","секс ","сексуальные ","голые ","nud ","porno ","sexuale ","booty ","aistillinen ","akt ","alasti ","alaston ","alusvaatteet ","barangrampasan ","behead ","beheading ","beute ","biancheriaintima ","bielizna ","blod ","bloed ","blood ","Blut ","boobs ","booty ","borst ","bottino ","breast ","Brust ","bryst ","buit ","butin ","caldoerotico ","chaudérotique ","Chiếnlợiphẩm ","cinsel ","corné ","corneo ","çplak ","cycki ","damitnapanloob ","darah ","decapita ","decapitaç ","decapitar ","decapitare ","decapitare ","décapitation ","decapitazione ","décapiter ","dibdib ","dik ","doden ","donjerublje ","dusang ","dugo ","dươngvật ","elrabol ","emme ","entführen ","enthaupten ","enthauptung ","erotiksıcak ","érzéki ","excitat ","fehérnemû ","fierbinteerotic ","forróerotikus ","ganimet ","geil ","giếtchết ","gợicảm ","gorącyerotyczny ","grudi ","halshugge ","halshugning ","heteerotische ","horkéerotické ","horny ","horúceerotické ","hoteroottinen ","hoterotic ","hoterotisk ","hubad ","imeminen ","kaçırmak ","kafakesme ","kafasınıkesmek ","kan ","kapalan ","kemény ","khiêudâm ","kidnap ","kidnappe ","kidnapper ","kiimainen ","kojisisa ","koris ","krev ","krew ","krv ","ldürmek ","lefejez ","lefejezés ","lenjerie ","liderlig ","makidnap ","mama ","matar ","mell ","mellek ","membunuh ","meme ","memenggalkepala ","menculik ","menetek ","mestata ","mestaus ","meztelen ","naakt ","nackt ","nadambong ","nagi ","nah ","naked ","ngsanggol ","ngực ","nhũhoa ","Nộiy ","nóngkhiêudâm ","nud ","nude ","nudo ","odsijecanjeglave ","odsjeوiglavu ","œciêcie ","ondergoed ","onthoofden ","onthoofding ","ontvoeren ","oteti ","pagpugotngulo ","pakaiandalam ","panaserotis ","payudara ","peitos ","pemenggalan ","pene ","penis ","pénis ","pierœ ","pistol ","pistola ","pistole ","pistolet ","pistool ","pistooli ","pisztoly ","pitole ","pitolj ","plijen ","poprava ","porn ","pornَ ","porno ","pornô ","pornografija ","porwaوkogoœ ","prsa ","prsia ","prsيèka ","przypiersi ","pumatay ","pumugotngulo ","quenteerótico ","rapire ","rinta ","sân ","sânge ","sangue ","sania ","sanselig ","saque ","saugen ","sein ","seins ","seksuaalinen ","seksual ","seksualan ","seksualniepodniecony ","seksualny ","seksueel ","seksuel ","sekswal ","seno ","sensual ","sensuale ","sensueel ","sensuel ","senzual ","senzualan ","seqüestrar ","sessuale ","sexuell ","siepata ","sinnlich ","smysln ","sous-vêtements ","succion ","sucking ","sugende ","sừng ","sungayan ","supt ","suzione ","szexuلlis ","szopلs ","tabanca ","tappaa ","telanjang ","telanjang ","tette ","tieten ","tissit ","titi ","trầntruồng ","tuer ","ubiti ","uccidere ","ucide ","underwear ","unést ","unies ","Unterwنsche ","vér ","veri ","vrućeerotske ","zabiو ","zmyseln ","zuig ","горещаеротична ","горячаяэротика ","अंडरवियर ","अनुभवहीन ","अपहरणकरना ","कामुक ","गर्मकामुक ","नंगा ","पिस्तौल ","पॉर्न ","यौन ","रक्त ","लिंग ","लूटकामाल ","सिरकाटना ","सींगकाबनाहुआ ","स्तन ","हत्या ","에로틱뜨거운 ","熱色情 ","torrent ","download ","dolls ","doll ","dolls ","toy ", "обезглавяване ","Beheading ","halshugning ","Enthauptung ","Αποκεφαλισμός ","Beheading ","Decapitación ","Décapitation ","सिरकाटना ","Odsijecanjeglave ","Lefejezés ","Pemenggalan ","Decapitazione ","עֲרִיפַתרֹאשׁ ","頭がおかしい ","Būkgalva ","onthoofding ","Obcinanie ","Decapitação ","Decapitare ","обезглавливание ","Sťatie ","Obglavitev ","Убиство ","Halshuggning ","การตัดหัว ","Kesmediler ","Cắtđầu ","斩首 ","斬首 ","الثدي ","бозки ","Prsa ","boobs ","Βυζιά ","tetas ","Seins ","स्तन ","sise ","mellek ","Payudara ","tette ","おっぱい ","tieten ","Cycki ","Mamas ","ţâţe ","буфера ","prsia ","Sise ","Бообс ","tuttar ","สาว ","göğüsler ","Ngực ","胸部 ","Половакт ","pohlavnístyk ","Samleje ","Geschlechtsverkehr ","Σεξουαλικήεπαφή ","sexualintercourse ","Relacionessexuales ","Rapportssexuels ","संभोग ","Spolniodnos ","nemiközösülés ","Hubunganseksual ","Rapportisessuali ","יַחֲסֵימִין ","性交 ","Seksualinisbendravimas ","Geslachtsgemeenschap ","Współżycieseksualne ","Relaçãosexual ","Raportsexual ","Половойакт ","Pohlavnýstyk ","Spolniodnos ","Сексуалниоднос ","samlag ","การมีเพศสัมพันธ์ ","Cinselilişki ","Quanhệtìnhdục ","性交 ","سرعةالقذف ","Преждевременнаеякулация ","Předčasnáejakulace ","Fortidligsædafgang ","vorzeitigerSamenerguss ","Πρόωρηεκσπερμάτιση ","prematureejaculation ","Eyaculaciónprecoz ","Éjaculationprécoce ","समयसेपहलेस्खलन ","Preranaejakulacija ","Koraimagömlés ","ejakulasidini ","Eiaculazioneprecoce ","שפיכהמוקדמת ","早漏 ","Ankstyvaejakuliacija ","Prematureejaculatie ","Przedwczesnywytrysk ","Ejaculaçãoprecoce ","Ejaculareaprecoce ","Преждевременнаяэякуляция ","Predčasnáejakulácia ","Prezgodnjaejakulacija ","Преурањенаејакулација ","Förtidigutlösning ","การหลั่งเร็ว ","Erkenboşalma ","Xuấttinhsớm ","早泄 ","早洩 ","ISIS ","ISIL ","Daesh ","Beheading ","Terrorism ","терроризм ","goof ","MiaKhalifa ","Brazzers ","18+ ","Porno ","cekc ","bikini ","christy ","christymack ","terrorisme ","prisoners ","caliphate ","booty ","добыча ","dhoti ","sexual ","половой ","adult ","babes ","hot ","gratifying ","captured ","fetish ","premature ","ejaculation ","prematureejaculation ","pennis ","vagina ","pussy ","comic ","orgasm ","kiss ","dies ","dead ","death ","brutal ","fatal ","sebevražda ","Selbstmord ","itsemurha ","suicidio ","самоубийство ","Samomor ","intihar ","Tự tử ","vreemd ","عجيب ","podivný ","seltsam ","outo ","strano ","странный ","Čudno ","tuhaf ","kỳ dị ","bombardovat ","Bombe ","βόμβα ","bombe ","bomba ","פְּצָצָה ","bom ","bombear ","бомбить ","bomba ","bomba ","bom ","مصاب ","Zraněno ","verletzt ","τραυματίας ","blessé ","ferito ","נִפגָע ","gewond ","Lesionado ","пострадавший ","poranený ","yaralı ","Bị thương ","دم ","krev ","Blut ","αίμα ","du sang ","sangue ","דָם ","bloed ","sangue ","кровь ","krvný ","kan ","Máu "];
			return block;
	}//end of block_keywords();

function prepareAnalytics() {
		var text = document.body.innerText;
		var reportItems = {}; 
		//1- HTML Language TAG 
		var theLanguage = document.documentElement.lang;
		reportItems['lang'] = theLanguage;
		//alert(theLanguage);

		//2- Page Total words count
		var numbersArray = text.split(' ');
		reportItems['wordsCount'] = numbersArray.length;
		//alert(numbersArray.length);

		//3- Search for Non-English words
		reportItems['nonEnglishCount'] = 0;
		
				//4- Search for Blocked keywords
				var block_words = block_keywords();
				reportItems['blockKeywords'] = [];
		numbersArray.forEach(function(value, index) {			
			if(!/^[a-zA-Z0-9.,:;]+$/i.test(value.trim())&&value.length>0){
				reportItems['nonEnglishCount']++; 				
			}
		}, this);
		
		
		//4- Search for Blocked keywords
		var block_words = block_keywords();
		reportItems['blockKeywords'] = [];
		block_words.forEach(function(value, index) {
			if(text.toLowerCase().indexOf(value.toLowerCase())!=-1||text.toLowerCase().indexOf(value.toLowerCase()+",")!=-1){ 
				reportItems['blockKeywords'].push(value);
			}
		}, this);
		
		//5- Get Operating System Platform
		var os = navigator.platform;
		reportItems['platform'] = os;
		
		//6- Get Referrer url
		var referrer =  document.referrer;
		reportItems['referrer'] = referrer;
		
		//7- Get Iframe
		reportItems['iframe'] = 0;
		if(window.self !== window.top){
			reportItems['iframe'] = 1;
		}
		
		//7- Get Domain name		
		reportItems['domain'] = document.domain;
		
		//8- Path Name
		reportItems['pathname'] = window.location.pathname;
		
		//8- Get Current Page
		reportItems['currentPage'] = window.location.href;
		
		//9- Get Device
		var isMobile = false; //initiate as false
		
		if (eboundMD.tablet()) {
			isMobile = true;
		}else if (eboundMD.mobile()) { 
			isMobile = true; 
		}
	
		reportItems['device'] = "Desktop";
		reportItems['atf'] = "";
		if(isMobile){
			reportItems['device'] = "Mobile";
			//When site is loaded on MOBILE ONLY and on the Above the fold/first screen viewport there is Google ads and the size of that ad is above or equal to 300x250
			var els = document.getElementsByClassName("adsbygoogle");

			Array.prototype.forEach.call(els, function(el) {
				var elTop = el.offsetTop;
				if( elTop < window.innerHeight && (el.offsetWidth >= 300 || el.offsetHeight >= 250)){
					reportItems['atf'] = el.offsetWidth+"x"+el.offsetHeight;
				}
			});
		}
		
		//Duplicate requests
		reportItems['duplicate'] = 0;
		
		if(numberOfEboundDynamicAddsCountPerPage === 0){
			console.log('length:'+document.getElementsByClassName("eboundDynamicAdsbygoogle").length);
			numberOfEboundDynamicAddsCountPerPage = document.getElementsByClassName("eboundDynamicAdsbygoogle").length;
			reportItems['dynamicAddsCountPerPage'] = numberOfEboundDynamicAddsCountPerPage;
		}
		
		return reportItems;
}

function eboundAdsTagByDevice(sizesEboundDynamicAdsDesktop,sizesEboundDynamicAdsTablet,sizesEboundDynamicAdsMobile,tag){
	var data_slot = [];
	
	if(tag == 'ebound_article1_tag'){
		data_slot[0] = '9675095403'; //High
		data_slot[1] = '1174049883'; //Low
		data_slot[2] = '7265493954'; //Mid
	}
	
	if(tag == 'ebound_article2_tag'){
		data_slot[0] = '2151803283'; //High
		data_slot[1] = '2650757763'; //Low
		data_slot[2] = '5952411651'; //Mid
	}
	
	if(tag == 'ebound_article3_tag'){
		data_slot[0] = '3628511163'; //High
		data_slot[1] = '4127465643'; //Low
		data_slot[2] = '4639329348'; //Mid
	}
	
	if(tag == 'ebound_article4_tag'){
		data_slot[0] = '5105219043'; //High
		data_slot[1] = '5604173523'; //Low
		data_slot[2] = '6252826316'; //Mid
	}
	
	if(tag == 'ebound_footer_tag'){
		data_slot[0] = '6581926923'; //High
		data_slot[1] = '7220634123'; //Low
		data_slot[2] = '3326247045'; //Mid
	}
	
	if(tag == 'ebound_header_tag'){
		data_slot[0] = '8058634803'; //High
		data_slot[1] = '5743926243'; //Low
		data_slot[2] = '2013164742'; //Mid
	}
	
	if(tag == 'ebound_sidebar1_tag'){
		data_slot[0] = '9535342683'; //High
		data_slot[1] = '7080881403'; //Low
		data_slot[2] = '5056810406'; //Mid
	}
	
	if(tag == 'ebound_sidebar2_tag'){
		data_slot[0] = '2012050563'; //High
		data_slot[1] = '8557589283'; //Low
		data_slot[2] = '9700082439'; //Mid
	}
	
	if(tag == 'ebound_sidebar3_tag'){
		data_slot[0] = '3488758443'; //High
		data_slot[1] = '1034297163'; //Low
		data_slot[2] = '8387000136'; //Mid
	}
	
	if(tag == 'ebound_sidebar4_tag'){
		data_slot[0] = '4965466323'; //High
		data_slot[1] = '2511005043'; //Low
		data_slot[2] = '3743728103'; //Mid
	}
	
	// console.log(data_slot.length);
	// console.log(data_slot[[Math.floor(Math.random() * data_slot.length)]]);
	
	var sizesEboundDynamicAdsDesktop = sizesEboundDynamicAdsDesktop[Math.floor(Math.random() * sizesEboundDynamicAdsDesktop.length)].split('x'); 
	var sizesEboundDynamicAdsTablet = sizesEboundDynamicAdsTablet[Math.floor(Math.random() * sizesEboundDynamicAdsTablet.length)].split('x'); 
	var sizesEboundDynamicAdsMobile = sizesEboundDynamicAdsMobile[Math.floor(Math.random() * sizesEboundDynamicAdsMobile.length)].split('x'); 

	if (eboundMD.tablet()) {
		document.write('<ins id="'+tag+'" class="eboundDynamicAdsbygoogle" style="display:inline-block;width:'+sizesEboundDynamicAdsTablet[0]+'px;height:'+sizesEboundDynamicAdsTablet[1]+'px" data-ad-client="ca-pub-7733626117287363" data-ad-slot="'+data_slot[[Math.floor(Math.random() * data_slot.length)]]+'"></ins>'); 
	}else if (eboundMD.mobile()) {
		document.write('<ins id="'+tag+'" class="eboundDynamicAdsbygoogle" style="display:inline-block;width:'+sizesEboundDynamicAdsMobile[0]+'px;height:'+sizesEboundDynamicAdsMobile[1]+'px" data-ad-client="ca-pub-7733626117287363" data-ad-slot="'+data_slot[[Math.floor(Math.random() * data_slot.length)]]+'"></ins>'); 
	}else{
		document.write('<ins id="'+tag+'" class="eboundDynamicAdsbygoogle" style="display:inline-block;width:'+sizesEboundDynamicAdsDesktop[0]+'px;height:'+sizesEboundDynamicAdsDesktop[1]+'px" data-ad-client="ca-pub-7733626117287363" data-ad-slot="'+data_slot[[Math.floor(Math.random() * data_slot.length)]]+'"></ins>'); 
	}
	eboundDynamicAdsPosition.push(tag);
	
}

function replaceTargetWith( targetID, html ){
  /// find our target
  var i, div, elm, last, target = document.getElementById(targetID);
  /// create a temporary div
  div = document.createElement('div');
  /// fill that div with our html, this generates our children
  div.innerHTML = html;
  /// step through the temporary div's children and insertBefore our target
  i = div.childNodes.length;
  var divS = div.cloneNode(true);
  /// the insertBefore method was more complicated than I first thought so I 
  /// have improved it. Have to be careful when dealing with child lists as they 
  /// are counted as live lists and so will update as and when you make changes.
  /// This is why it is best to work backwards when moving children around, 
  /// and why I'm assigning the elements I'm working with to `elm` and `last`
  last = target;
  
  while(i--){
    target.parentNode.insertBefore((elm = div.childNodes[i]), last);
    last = elm;
  }
  scripts = divS.getElementsByTagName('script');
    for (var i = 0; i < scripts.length; ++i) {
      var script = scripts[i];
      eval(script.innerHTML);
    }
  /// remove the target.
  target.parentNode.removeChild(target);
}

function deviceType(eboundDeviceState){
	
	if (eboundMD.tablet()) {
		return 'tablet'; 
	}else if (eboundMD.mobile()) { 
		return 'mobile'; 
	}else{
		return 'desktop'; 
	}
	
	return 'desktop'; 
	
}