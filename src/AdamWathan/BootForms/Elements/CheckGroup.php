<?php namespace AdamWathan\BootForms\Elements;

use AdamWathan\Form\Elements\Element;
use AdamWathan\Form\Elements\Label;

class CheckGroup extends FormGroup
{
	protected $label;
	protected $inline = false;

	public function __construct(Label $label)
	{
		$this->label = $label;
	}

	public function render()
	{
		if ($this->inline === true) {
			return $this->label->render();
		}

		$html  = '<div';
		$html .= $this->renderAttributes();
		$html .= '>';
		$html .=  $this->label;
		$html .= $this->renderHelpBlock();

		$html .= '</div>';

		return $html;
	}

	public function inline()
	{
		$this->inline = true;

		$class = $this->control()->type() . '-inline'; // Requires base form PR #49 merge.
		$this->label->removeClass('control-label')->addClass($class); // Requires base form PR #49 merge.

		return $this;
	}

	public function control()
	{
		return $this->label->getControl();
	}

	public function __call($method, $parameters)
	{
		call_user_func_array(array($this->label->getControl(), $method), $parameters);
		return $this;
	}
}