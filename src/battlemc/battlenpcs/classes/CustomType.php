<?php

namespace battlemc\battlenpcs\classes;
class CustomType
{

	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $geometry;

	/**
	 * @var string
	 */
	private $imageData;

	/**
	 * @return mixed
	 */
	public function getGeometry()
	{
		return $this->geometry;
	}

	/**
	 * @return mixed
	 */
	public function getImageData()
	{
		return $this->imageData;
	}

	/**
	 * @param string $geometry
	 */
	public function setGeometry(string $geometry): void
	{
		$this->geometry = $geometry;
	}

	/**
	 * @param string $imageData
	 */
	public function setImageData(string $imageData): void
	{
		$this->imageData = $imageData;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
}