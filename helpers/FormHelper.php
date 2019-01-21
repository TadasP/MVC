<?php

class FormHelper
{
    private $form = '';

    public function __construct($method, $action)
    {
        $this->form .='<form method="'.$method.'" action="'.$action.'">';
    }

    public function input($attributes)
    {
        $this->form .= '<div class="form-group">';
        $this->form .= '<input ';
            foreach($attributes as $key => $attr){
                $this->form .= $key.'="'.$attr.'" ';
            }
        $this->form .= '></br>';
        $this->form .= '</div>';
        return $this;
    }

    public function select($attributes, $options)
    {
        $this->form .= '<div class="form-group">';
        $this->form .= '<select ';
            foreach($attributes as $key => $attr){
                $this->form .= $key.'="'.$attr.'" ';
            }

            foreach($options as $opt){
                $this->form .= '><option value="'.$opt.'">'.ucfirst($opt).'</option>';
            }
        $this->form .= '</select></br>';
        $this->form .= '</div>';
        return $this;
    }

    public function textarea($attributes)
    {
        $this->form .= '<div class="form-group">';
        $this->form .= '<textarea ';
            foreach($attributes as $key => $attr){
                $this->form .= $key.'="'.$attr.'"';
            }
        $this->form .= '></textarea></br>';
        $this->form .= '</div>';
        return $this;    
    }

    public function get()
    {
        $this->form .= '</form>';
        return $this->form;
    }

}