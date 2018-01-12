<?php

/* (c) Zhu Jing <zhujing@shinetechchina.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Drupalpay;


Class Fattpay {

	private $engine = null;

	public function __construct ()
	{
		$this->engine = new Curlengine();
	}


	public function authentication ()
	{
		$route = Config::AUTHENTICATE_ROUTE;

		return $this->engine->usePost($route)->setEmail()->setPassword()->sendPost()->getResult();
	}

	public function getBillInformation ($billID)
	{
		$route = Config::GETBILLINFORMATION_ROUTE.'/'.$billID;

		return $this->engine->useGet($route, true)->getResult();
	}

    public function say($toSay = "Nothing given")
    {
        return $toSay;
    }
}


?>