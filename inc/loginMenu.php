<?php

class Menu
{

	private $styleId;
	private $items = [];

	private $page;

	public function __toString()
	{
		$out = "<ol id=\"{$this->styleId}\">";
		foreach ($this->items as $item) {
			$out .= $item;
		}
		$out .= "</ol>";

		return $out;
	}

	public function __construct($styleId, $activePage)
	{
		$this->styleId = $styleId;
		$this->page = $activePage;
	}

	public function addItem($item)
	{
		if ($item->page == $this->page) {
			$item->active = true;
		} else {
			$item->active = false;
		}
		$this->items[] = $item;

		usort($this->items, function ($a, $b) {
			if ($a->order === $b->order) {
				return 0;
			}
			return ($a->order < $b->order) ? -1 : 1;
		});
	}
}

class MenuItem
{
	private $label;
	public $page;
	public $type;
	public $order;
	public $active;

	public function __construct($label, $page, $order, $type = "page")
	{

		$this->label = $label;
		$this->page = $page;
		$this->order = $order;
		$this->type = $type;
	}

	public function __toString()
	{
		$cl = "inactive";
		if ($this->active) {
			$cl = "active";
		}

		$href = "?p={$this->page}";

		switch ($this->type) {
			case "page":
				break;
			case "url":
				$href = $this->page;
				break;
		}
		return "<li class=\"$cl\"><a href=\"$href\">{$this->label}</a></li>";
	}
}
