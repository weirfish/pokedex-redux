<?php

namespace PtuDex\Routing;

class Template extends \Engine\Page\Template\Template
{
	protected function outputHeaderOpen() : void
	{
?><html>
	<head>
		<link rel="stylesheet" href="/css/default-template.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script><?php
	}

	protected function outputHeaderClose() : void
	{
?></head><?php
	}

	protected function outputBodyOpen(): void
	{
?><body><?php
	}


	protected function outputBodyClose(): void
	{
?></body><?php
	}

	protected function outputFooter(): void
	{
?></html><?php
	}
}