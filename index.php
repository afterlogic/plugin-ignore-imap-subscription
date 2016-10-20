<?php

class_exists('CApi') or die();

class CIgnoreImapSubscriptionPlugin extends AApiPlugin
{
	/**
	 * @param CApiPluginManager $oPluginManager
	 */
	public function __construct(CApiPluginManager $oPluginManager)
	{
		parent::__construct('1.0', $oPluginManager);

		$this->AddHook('api-change-account-by-id', 'PluginChangeAccountById');
	}
	
	/**
	 * @param CAccount $oAccount
	 */
	public function PluginChangeAccountById(&$oAccount)
	{
		$sEmail = CApi::GetConf('plugins.ignore-imap-subscription.options.email', '');
		if ($oAccount && $oAccount instanceof CAccount &&
			(empty($sEmail) || $sEmail === $oAccount->Email))
		{
			$oAccount->enableExtension(CAccount::IgnoreSubscribeStatus);
			$oAccount->enableExtension(CAccount::DisableManageSubscribe);
		}
	}
}

return new CIgnoreImapSubscriptionPlugin($this);
