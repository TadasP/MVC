<?php

class FormHelper
{
    private $form = '';

    public function __construct($method, $action)
    {
        $this->form .='<form method="'.$method.'" action="'.$action.'">';
    }

    public function input($attributes, $label = '')
    {
        $this->form .= '<div class="form-group">';
        $this->form .= '<label>'.$label.'</label>';
        $this->form .= '<input ';
            foreach($attributes as $key => $attr){
                $this->form .= $key.'="'.$attr.'" ';
            }
        $this->form .= '>';
        $this->form .= '</div>';
        return $this;
    }

    public function select($attributes, $options, $label = '')
    {
        $this->form .= '<div class="form-group">';
        $this->form .= '<label>'.$label.'</label>';
        $this->form .= '<select ';
            foreach($attributes as $key => $attr){
                $this->form .= $key.'="'.$attr.'" ';
            }
            $this->form .= '>';
            foreach($options as $opt){
                $this->form .= '<option value="'.$opt.'">'.ucfirst($opt).'</option>';
            }
        $this->form .= '</select>';
        $this->form .= '</div>';
        return $this;
    }

    public function textarea($attributes, $label = '')
    {
        $this->form .= '<div class="form-group">';
        $this->form .= '<label>'.$label.'</label>';
        $this->form .= '<textarea ';
            foreach($attributes as $key => $attr){
                $this->form .= $key.'="'.$attr.'"';
            }
        $this->form .= '></textarea>';
        $this->form .= '</div>';
        return $this;    
    }

    public function get()
    {
        $this->form .= '</form>';
        return $this->form;
    }

}