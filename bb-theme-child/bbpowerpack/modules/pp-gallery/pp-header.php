<?php
	/******************************************************************
	*  Copyright 2011 Ktools.net LLC - All Rights Reserved
	*  http://www.ktools.net
	*  Created: 4-21-2011
	*  Modified: 4-21-2011
	******************************************************************/
	
	//$config['settings']['lightbox'] = ($config['settings']['lightbox']) ? 1 : 0;
	
	try
	{
		/*
		* Get the site stats
		*/
		if($config['settings']['site_stats'])
		{	
			if(!$_SESSION['siteStatsSess'])
			{
				$_SESSION['siteStatsSess']['members'] = mysqli_result_patch(mysqli_query($db,"SELECT COUNT(mem_id) FROM {$dbinfo[pre]}members WHERE status = 1")); // Number of active members
				$_SESSION['siteStatsSess']['media'] = mysqli_result_patch(mysqli_query($db,"SELECT COUNT(media_id) FROM {$dbinfo[pre]}media")); // Number of media files
				$_SESSION['siteStatsSess']['contributors'] = 'xxxx'; //mysqli_result_patch(mysqli_query($db,"SELECT COUNT(media_id) FROM {$dbinfo[pre]}media")); // Number of active contributors
				$_SESSION['siteStatsSess']['visits'] = $config['settings']['site_visits']; //mysqli_result_patch(mysqli_query($db,"SELECT COUNT(media_id) FROM {$dbinfo[pre]}media")); // Number of active contributors
			}
			$smarty->assign('siteStats',$_SESSION['siteStatsSess']);
		}
		
		/*
		* Get the members that have been logged in within the last 30 minutes
		* Tweak $config['CheckMembersOnline'] for minutes between new check
		*/
		if($config['settings']['members_online'])
		{
			$pastCheckTime = (int)date("U")-(60*$config['CheckMembersOnline']); //gmdate("Y-m-d H:i:s",strtotime("{$nowGMT} -{$config[CheckMembersOnline]} minutes")); // Added this so it only checks every X minutes		
			if(!$_SESSION['memberOnlineCheck'] or $_SESSION['memberOnlineCheck'] < $pastCheckTime)
			{
				unset($_SESSION['membersOnline']); // Clear previous first
				$_SESSION['memberOnlineCheck'] = (int)date("U");
				$pastActivityTime = gmdate("Y-m-d H:i:s",strtotime("{$nowGMT} -30 minutes"));
				$membersOnlineResult = mysqli_query($db,"SELECT f_name,l_name,email,display_name,mem_id,last_activity FROM {$dbinfo[pre]}members WHERE last_activity > '{$pastActivityTime}' AND status = 1");
				while($membersOnlineDB = mysqli_fetch_array($membersOnlineResult))
				{
					if(!$membersOnlineDB['display_name']) // Set display name if none exists
						$membersOnlineDB['display_name'] = $membersOnlineDB['f_name'].' '.$membersOnlineDB['l_name']; 
					
					$_SESSION['membersOnline'][$membersOnlineDB['mem_id']] = $membersOnlineDB;
				}
			}
			if(@$_SESSION['membersOnline'])
			{
				foreach($_SESSION['membersOnline'] as $key => $member)
				{
					$minutesDifference = secondsDiff($_SESSION['membersOnline'][$key]['last_activity'],$nowGMT)/60; // Difference in minutes
					$_SESSION['membersOnline'][$key]['lastSeen'] = ($minutesDifference < 1 or $key == $_SESSION['member']['mem_id']) ? '<1' : round($minutesDifference); // If member is logged in then it will always show <1 minute
				}
				//echo $_SESSION['memberOnlineCheck'] . " < " . $pastCheckTime; exit; // For testing
				$smarty->assign('membersOnline',$_SESSION['membersOnline']);
			}
		}
		
		/*
		* Assign site Logo
		*/
		if($config['settings']['mainlogo'] and file_exists('assets/logos/'.$config['settings']['mainlogo']))
			$smarty->assign('mainLogo',$siteURL.'/assets/logos/'.$config['settings']['mainlogo']); // Assign logo
		else
			$smarty->assign('mainLogo',$siteURL.'/assets/logos/generic.logo.png'); // Generic logo	
		
		/*
		* Get the correct meta title, keywords, description for the selected language
		*/
		$config['settings']['site_title'] = ($config['settings']['site_title_'.$_SESSION['member']['language']]) ? $config['settings']['site_title_'.$_SESSION['member']['language']] : $config['settings']['site_title']; // Get the correct meta title for the language
		$config['settings']['site_description'] = ($config['settings']['site_description_'.$_SESSION['member']['language']]) ? $config['settings']['site_description_'.$_SESSION['member']['language']] : $config['settings']['site_description']; // Get the correct meta description for the language
		$config['settings']['site_keywords'] = ($config['settings']['site_keywords_'.$_SESSION['member']['language']]) ? $config['settings']['site_keywords_'.$_SESSION['member']['language']] : $config['settings']['site_keywords']; // Get the correct meta keywords for the language
		
		/*
		* Assign meta title, keywords, description and page encoding
		*/
		//echo $_SESSION['selectedLanguageSession']; 
		$defaultSiteTitle = ($config['settings']['site_title_'.$_SESSION['selectedLanguageSession']]) ? $config['settings']['site_title_'.$_SESSION['selectedLanguageSession']] : $config['settings']['site_title']; // Get the correct languages
		$defaultMetaKeywords = ($config['settings']['meta_keywords_'.$_SESSION['selectedLanguageSession']]) ? $config['settings']['meta_keywords_'.$_SESSION['selectedLanguageSession']] : $config['settings']['meta_keywords'];
		$defaultMetaDescription = ($config['settings']['meta_desc_'.$_SESSION['selectedLanguageSession']]) ? $config['settings']['meta_desc_'.$_SESSION['selectedLanguageSession']] : $config['settings']['meta_desc'];
		
		$smarty->assign('metaTitle',(defined('META_TITLE') and META_TITLE != '') ? strip_tags(META_TITLE) : $defaultSiteTitle); // Assign meta title
		$smarty->assign('metaKeywords',(defined('META_KEYWORDS') and META_KEYWORDS != '') ? strip_tags(META_KEYWORDS) : $defaultMetaKeywords); // Assign meta keywords
		$smarty->assign('metaDescription',(defined('META_DESCRIPTION') and META_DESCRIPTION != '') ? strip_tags(META_DESCRIPTION) : $defaultMetaDescription); // Assign meta description		
		$smarty->assign('pageEncoding',(defined('PAGE_ENCODING') and PAGE_ENCODING != '') ? PAGE_ENCODING : $langset['lang_charset']); // Assign page encoding from language file settings
		$smarty->assign('metaRobots',(defined('ACCESS') and ACCESS == 'public') ? 'index, follow' : 'noindex, nofollow'); // Assign robots setting
		$smarty->assign('contribLink', $config['settings']['contrib_link']);
		
		if
		(
		   $config['settings']['featuredpage'] or 
		   $config['settings']['printpage'] or 
		   $config['settings']['prodpage'] or 
		   $config['settings']['packpage'] or 
		   $config['settings']['collpage'] or 
		   $config['settings']['subpage'] or 
		   $config['settings']['creditpage']
		)
		$smarty->assign('featuredTab',1); // Assign that a featured tab, button or link should be visible	
		
		//$smarty->register_function('linkto','linkto'); // Register the linkto function		
		//$smarty->registerPlugin("function","linkto", "linkto");
		
		/*
		* Featured Contributors
		*/
		if($config['settings']['contr_num'] > 0 and $config['settings']['contr_showcase'] and addon('contr'))
		{	
			if(!$_SESSION['featuredContributors']) // Only do this on visitors first view of the homepage
			{
				$contributorFields = 'mem_id,f_name,l_name,display_name,email,avatar_status,bio_content';
				//$_SESSION['featuredContributors'] = ''; // Clear the contributors list first
				/*
				switch($config['settings']['contr_fm'])
				{
					default:
					case "1": // Randomly any contributor
						$contributorsResult = mysqli_query($db,
							"
							SELECT {$contributorFields} FROM {$dbinfo[pre]}members 
							LEFT JOIN {$dbinfo[pre]}memberships 
							ON {$dbinfo[pre]}members.membership = {$dbinfo[pre]}memberships.ms_id 
							WHERE {$dbinfo[pre]}memberships.msfeatured = 1
							AND {$dbinfo[pre]}members.status = 1
							ORDER BY RAND()
							LIMIT {$config[settings][contr_num]}
							"
						);
					break;
					case "2": // Randomly only those with media for sale
						$contributorsResult = mysqli_query($db,
							"
							SELECT {$contributorFields} FROM {$dbinfo[pre]}members 
							LEFT JOIN {$dbinfo[pre]}memberships 
							ON {$dbinfo[pre]}members.membership = {$dbinfo[pre]}memberships.ms_id
							LEFT JOIN {$dbinfo[pre]}media 
							ON {$dbinfo[pre]}members.mem_id = {$dbinfo[pre]}media.owner  
							WHERE {$dbinfo[pre]}memberships.msfeatured = 1
							AND {$dbinfo[pre]}media.media_id != 0
							AND {$dbinfo[pre]}members.status = 1
							ORDER BY RAND()
							LIMIT {$config[settings][contr_num]}
							"
						);
					break;
					case "3": // Randomly only those with a bio
						$contributorsResult = mysqli_query($db,
							"
							SELECT {$contributorFields} FROM {$dbinfo[pre]}members 
							LEFT JOIN {$dbinfo[pre]}memberships 
							ON {$dbinfo[pre]}members.membership = {$dbinfo[pre]}memberships.ms_id 
							WHERE {$dbinfo[pre]}memberships.msfeatured = 1
							AND {$dbinfo[pre]}members.status = 1
							AND {$dbinfo[pre]}members.bio_status = 1
							AND {$dbinfo[pre]}members.bio_content != ''
							ORDER BY RAND()
							LIMIT {$config[settings][contr_num]}
							"
						);
					break;
					case "4": // Randomly only those with with a bio and media for sale
						$contributorsResult = mysqli_query($db,
							"
							SELECT {$contributorFields} FROM {$dbinfo[pre]}members 
							LEFT JOIN {$dbinfo[pre]}memberships 
							ON {$dbinfo[pre]}members.membership = {$dbinfo[pre]}memberships.ms_id 
							LEFT JOIN {$dbinfo[pre]}media 
							ON {$dbinfo[pre]}members.mem_id = {$dbinfo[pre]}media.owner  
							WHERE {$dbinfo[pre]}memberships.msfeatured = 1
							AND {$dbinfo[pre]}members.status = 1
							AND {$dbinfo[pre]}members.bio_status = 1
							AND {$dbinfo[pre]}members.bio_content != ''
							AND {$dbinfo[pre]}media.media_id != 0
							ORDER BY RAND()
							LIMIT {$config[settings][contr_num]}
							"
						);
					break;
					case "5": // Manually selected
						$contributorsResult = mysqli_query($db,
							"
							SELECT {$contributorFields} FROM {$dbinfo[pre]}members 
							WHERE {$dbinfo[pre]}members.featured = 1
							AND {$dbinfo[pre]}members.status = 1
							ORDER BY RAND()
							LIMIT {$config[settings][contr_num]}
							"
						);
					break;
				}
				*/
				
				$contributorsResult = mysqli_query($db,
					"
					SELECT {$contributorFields} FROM {$dbinfo[pre]}members 
					WHERE showcase = 1 
					AND status = 1 
					ORDER BY RAND()
					LIMIT {$config[settings][contr_num]}
					"
				);
				/*
				$contributorsResult = mysqli_query($db,
					"
					SELECT {$contributorFields} FROM {$dbinfo[pre]}members 
					LEFT JOIN {$dbinfo[pre]}memberships 
					ON {$dbinfo[pre]}members.membership = {$dbinfo[pre]}memberships.ms_id 
					WHERE {$dbinfo[pre]}memberships.msfeatured = 1
					AND {$dbinfo[pre]}memberships.deleted = 0 
					AND {$dbinfo[pre]}memberships.active = 1 
					AND {$dbinfo[pre]}members.status = 1 
					ORDER BY RAND()
					LIMIT {$config[settings][contr_num]}
					"
				);
				*/
				if($returnRows = mysqli_num_rows($contributorsResult))
				{
					while($contributor = mysqli_fetch_array($contributorsResult))
					{
						$_SESSION['featuredContributors'][$contributor['mem_id']] = contrList($contributor);
					}
				}
			}			
			@shuffle($_SESSION['featuredContributors']); // Randomize the order of the array so different contributors are always shown			
			$smarty->assign('featuredContributors',$_SESSION['featuredContributors']);
		}

		$customDate = new kdate;
		$customDate->setMemberSpecificDateInfo();
		
		if($_SESSION['member']['customized_date'])
		{
			//$customDate->date_display = $_SESSION['member']['date_display'];
			/*
			var $distime = 0;
			var $time_zone;
			var $date_sep;
			var $date_format;
			var $date_display;
			var $clock_format;
			var $daylight_savings;
			var $adjust_date = 1;
			*/
		}

		$setCurrency = new currencySetup;
		
		/*
		* Get active currencies
		*/
		if(in_array('multicur',$installed_addons))
		{
			$displayCurrencies = $setCurrency->getDisplayCurrencies(); // Get the active currencies in display mode getDisplayCurrencies(1) to add codes
			$activeCurrencies = $setCurrency->getActiveCurrencies(); // Get an array of details containing all active currencies
		}
		else
			$displayCurrencies = false;
		
		//print_r($activeCurrencies); // Testing
		//echo "<br><br>";
		
		/*
		* Setup the primary currency
		*/
		$priCurrency = $setCurrency->getPrimaryCurrency(); // Return the details about the primary currency
		
		/* // testing
		echo "Pri: ";
		print_r($priCurrency);
		echo "<br><br>";
		*/
		
		if(!$_SESSION['selectedCurrencySession']) $_SESSION['selectedCurrencySession'] = $priCurrency['currency_id']; // If no currency is set use the default
		
		if(@!array_key_exists($_SESSION['selectedCurrencySession'],$activeCurrencies)) // If selected currency is not active then update with new primary currency
			$_SESSION['selectedCurrencySession'] =  $priCurrency['currency_id'];
		
		$setCurrency->setSelectedCurrency($_SESSION['selectedCurrencySession']); // Add config variables for the selected currency // setupSelectedCurrency($selectedCurrency);		
		$exchangeRate = $config['settings']['cur_exchange_rate']; // Shortcut
		
		if(!$config['settings']['cur_currency_id'])
			die('header.inc.php : No currency setting exists'); // Make sure the script can't continue if all currency detection fails
	
		$cleanCurrency = new number_formatting;
		$cleanCurrency->set_cur_defaults();
		
		$cleanNumber = new number_formatting;
		$cleanNumber->set_num_defaults();
		
		$smarty->assign('priCurrency',$priCurrency);
		$smarty->assign('displayCurrencies',$displayCurrencies);
		$smarty->assign('activeCurrencies',$activeCurrencies);
		$smarty->assign('exchangeRate',$exchangeRate);
			
		/*
		* Set if lightboxes should be available
		*/
		$config['settings']['lightbox'] = (addon('lightbox') and ($config['settings']['lightbox'] and ($_SESSION['loggedIn'] or $config['settings']['glightbox']))) ? 1 : 0;
		if($_SESSION['member']['membershipDetails']['lightboxes'] and $config['settings']['lightbox']) // Make sure lightboxes are on and see if members on this membership can create them
			$lightboxSystem = true;
		
		$smarty->assign('lightboxSystem',$lightboxSystem); // Lightbox status
		
		$mediaDate = new kdate; // Setup a new kdate object to use specifically on media details
		$mediaDate->setMemberSpecificDateInfo();
		$mediaDate->distime = 0;

		$smarty->assign('config',$config); // Assign config to smarty so all settings can be used in the template
		
		if(!$_SESSION['viewedMedia'])
			$_SESSION['viewedMedia'] = array(); // Create a session of viewed media files - used to track views
			
		if(!$_SESSION['cartTotalsSession']['itemsInCart']) // A counter for how many items are in the cart
			$_SESSION['cartTotalsSession']['itemsInCart'] = 0;
			
		//if($_SESSION['cartTotalsSession']['itemsInCart'] > 0)
		//{
			$previewParms['noDefault'] = true;
			if($_SESSION['cartTotalsSession']['creditsSubTotalPreview'] <= 0) $_SESSION['cartTotalsSession']['creditsSubTotalPreview'] = 0; // Do extra check for no credits - default to 0
			$_SESSION['cartTotalsSession']['priceSubTotalPreview'] = getCorrectedPrice($_SESSION['cartTotalsSession']['priceSubTotal'],$previewParms); // Assign a new local value to be used for local currency display
		//}
		$smarty->assign('cartTotals',$_SESSION['cartTotalsSession']);
		
		/*
		* Grab Content Titles
		*/
		//echo "selected lang: {$config[settings][default_lang]}"; exit; // Testing
		//echo "SELECT content_id,ca_id,name,name_{$_SESSION[selectedLanguageSession]} FROM {$dbinfo[pre]}content WHERE ca_id = '3'"; exit; // Testing
		if($_SESSION['selectedLanguageSession'])
			$addContentSQL = ",name_{$_SESSION[selectedLanguageSession]}"; // Removed this just in case there is no selectedLanguageSession so that it doesn't cause an error
		$contentResult = mysqli_query($db,"SELECT content_code,content_id,ca_id,linked,name{$addContentSQL} FROM {$dbinfo[pre]}content WHERE ca_id = '3' AND active = 1 ORDER BY content_id"); // Switched to session to avoid having to load init.member.php in all files
		while($contentDB = mysqli_fetch_array($contentResult))
		{
			$contentPages[$contentDB['content_id']] = $contentDB;
			$contentPages[$contentDB['content_id']]['name'] = ($contentDB['name_'.$selectedLanguage]) ? $contentDB['name_'.$selectedLanguage] : $contentDB['name'];			
			$contentPages[$contentDB['content_id']]['name'] = $smarty->fetch('eval:'.$contentPages[$contentDB['content_id']]['name']);
			$contentPages[$contentDB['content_id']]['linked'] = $contentDB['linked'];
		}
		$smarty->assign('contentPages',$contentPages);
		
		/*
		* Grab Content Blocks
		*/
		if($_SESSION['selectedLanguageSession'])
			$addContentSQL = ",name_{$_SESSION[selectedLanguageSession]},content_{$_SESSION[selectedLanguageSession]}"; // Removed this just in case there is no selectedLanguageSession so that it doesn't cause an error
		$contentResult = mysqli_query($db,"SELECT content_code,content_id,ca_id,name,content{$addContentSQL} FROM {$dbinfo[pre]}content WHERE content_code LIKE 'customBlock%' AND active = 1");
		while($contentDB = mysqli_fetch_array($contentResult))
		{
			$contentBlocks[$contentDB['content_code']] = $contentDB;
			
			if($contentDB['content_code'] == 'customBlock1' or $contentDB['content_code'] == 'customBlock2' or $contentDB['content_code'] == 'customBlock3')
				$contentBlocks[$contentDB['content_code']]['specType'] = 'sncb'; // Subnav content block
			
			$contentBlocks[$contentDB['content_code']]['name'] = ($contentDB['name_'.$selectedLanguage]) ? $contentDB['name_'.$selectedLanguage] : $contentDB['name'];
			$contentBlocks[$contentDB['content_code']]['content'] = ($contentDB['content_'.$selectedLanguage]) ? $contentDB['content_'.$selectedLanguage] : $contentDB['content'];
			
			$contentBlocks[$contentDB['content_code']]['name'] = $smarty->fetch('eval:'.$contentBlocks[$contentDB['content_code']]['name']);
			$contentBlocks[$contentDB['content_code']]['content'] = $smarty->fetch('eval:'.$contentBlocks[$contentDB['content_code']]['content']);
		}
		$smarty->assign('contentBlocks',$contentBlocks);
		
		//if($_SESSION['cartTotalLocalCur']) // Show the cart total
		//	$smarty->assign('cartTotalLocalCur',$_SESSION['cartTotalLocalCur']);
		
		
		/*
		* Main level galleries
		*/
		if($_SESSION['galleriesData'])
		{
			foreach($_SESSION['galleriesData'] as $key => $value) // Loop through galleries
			{
				if($value['gallery_id'] != 0 and $value['parent_gal'] == 0) // Make sure it is a legitimate record with an ID - Fixes blank gallery problem / Only show top level galleries
				{
					if($value['album'] == 0) // Only show those that aren't albums
						$mainLevelGalleries[$key] = $value['gallery_id'];
				}
			}
		}
		//print_r($mainLevelGalleries);
		$smarty->assign('mainLevelGalleries',$mainLevelGalleries);
		
	}
	catch(Exception $e)
	{
		die(exceptionError($e));	
	}
	
	//echo "cookie: ".$_COOKIE['member']['umem_id']."<br>";
	//echo "mem session: ".$_SESSION['member']['umem_id'].'<br>';	
?>