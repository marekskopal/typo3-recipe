<?php

defined('TYPO3_MODE') or die();

call_user_func(function() {

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('ms_recipe', 'Configuration/TypoScript', 'Recipe');

});
