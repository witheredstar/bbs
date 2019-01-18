<?php

/*
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2015 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\TextFormatter\Configurator\Bundles;
use s9e\TextFormatter\Configurator;
use s9e\TextFormatter\Configurator\Bundle;
class Forum extends Bundle
{
	public function configure(Configurator $configurator)
	{
		$configurator->rootRules->enableAutoLineBreaks();
		$configurator->BBCodes->addFromRepository('B');
		$configurator->BBCodes->addFromRepository('CENTER');
		$configurator->BBCodes->addFromRepository('CODE');
		$configurator->BBCodes->addFromRepository('COLOR');
		$configurator->BBCodes->addFromRepository('EMAIL');
		$configurator->BBCodes->addFromRepository('FONT');
		$configurator->BBCodes->addFromRepository('I');
		$configurator->BBCodes->addFromRepository('IMG');
		$configurator->BBCodes->addFromRepository('LIST');
		$configurator->BBCodes->addFromRepository('*');
		$configurator->BBCodes->add('LI');
		$configurator->BBCodes->addFromRepository('QUOTE', 'default', array(
			'authorStr' => '<xsl:value-of select="@author"/> <xsl:value-of select="$L_WROTE"/>'
		));
		$configurator->BBCodes->addFromRepository('S');
		$configurator->BBCodes->addFromRepository('SIZE');
		$configurator->BBCodes->addFromRepository('SPOILER', 'default', array(
			'hideStr'    => '{L_HIDE}',
			'showStr'    => '{L_SHOW}',
			'spoilerStr' => '{L_SPOILER}',
		));
		$configurator->BBCodes->addFromRepository('U');
		$configurator->BBCodes->addFromRepository('URL');
		$configurator->rendering->parameters = array(
			'L_WROTE'   => 'wrote:',
			'L_HIDE'    => 'Hide',
			'L_SHOW'    => 'Show',
			'L_SPOILER' => 'Spoiler'
		);
		$emoticons = array(
			':)'  => 'smile',
			':-)' => 'smile',
			';)'  => 'wink',
			';-)' => 'wink',
			':D'  => 'grin',
			':-D' => 'grin',
			':('  => 'frown',
			':-(' => 'frown',
			':-*' => 'kiss',
			':P'  => 'razz',
			':-P' => 'razz',
			':p'  => 'razz',
			':-p' => 'razz',
			':?'  => 'confused',
			':-?' => 'confused',
			':|'  => 'neutral',
			':-|' => 'neutral',
			':o'  => 'shock',
			':lol:' => 'laugh'
		);
		foreach ($emoticons as $code => $filename)
			$configurator->Emoticons->add(
				$code,
				'<img src="{$EMOTICONS_PATH}/' . $filename . '.png" alt="' . $code . '"/>'
			);
		$configurator->MediaEmbed->createIndividualBBCodes = \true;
		$configurator->MediaEmbed->add('bandcamp');
		$configurator->MediaEmbed->add('dailymotion');
		$configurator->MediaEmbed->add('facebook');
		$configurator->MediaEmbed->add('indiegogo');
		$configurator->MediaEmbed->add('instagram');
		$configurator->MediaEmbed->add('kickstarter');
		$configurator->MediaEmbed->add('liveleak');
		$configurator->MediaEmbed->add('soundcloud');
		$configurator->MediaEmbed->add('twitch');
		$configurator->MediaEmbed->add('twitter');
		$configurator->MediaEmbed->add('vimeo');
		$configurator->MediaEmbed->add('vine');
		$configurator->MediaEmbed->add('wshh');
		$configurator->MediaEmbed->add('youtube');
		$configurator->Autoemail;
		$configurator->Autolink;
	}
}