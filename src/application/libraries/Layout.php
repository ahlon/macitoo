<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Layout Library Class
 *
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Lyndon Wang
 * @link http://blog.lyphp.com
 */

class Layout
{
  private $slots=array();
  private $files=array();
  private $ci,$tplpath,$vars,$return,$layout,$slotvars;
  public $parse=TRUE;
  public $merge=FALSE;
  
  function __construct($layout='layout.php')
  {
    $this->ci=&get_instance();
    $this->tplpath=APPPATH .'views/';
    $this->layout=$this->getFile($layout);
    if($this->parse)$this->ci->load->library('parser');
  }
  
  function setSlot($path,$vars=array(),$file='')
  {
    $this->slots[]=$path;
    $_path = explode( '/', $path );
    $var=$_path[count($_path)-1];
    $this->files[$path]=$this->getFile($file,$var);
    $this->slotvars[$path]=empty($vars)?array():(array)$vars;
  }
  
  function getFile($file='',$var='')
  {
    //默认使用于模块变量相同名称的文件
    if($file=='' && $var)$file=$var.'.php';
    //默认使用views下该controller目录下的文件
    $_file=$this->tplpath.$this->ci->router->fetch_class().'/'.$file;
    if(is_file($_file))
    {
      return str_replace($this->tplpath,'',$_file);
    }else if (is_file($this->tplpath.'default/'.$file)){
      return 'default/'.$file;
    }else {
      return 'default/blank.php';
      //throw new Exception('File not found '.$file);
    }
  }
  
  //按包含层级，由多到少排序
  function sort(&$array)
  {
    usort( $array, array('self','cmp') );
  }
  

  //处理各级模块
  function slot()
  {
    $slots=$this->slots;
    $this->sort($slots);
    // 将相同层级模块整合到同一数组中
    $tmp=array();
    foreach ( $slots as $v )
    {
      $count = substr_count( $v, '/' );
      $tmp[$count][] = $v;
    }
    unset( $v );
    foreach ( $tmp as $k => &$v )
    {
//      if ($k == 0)
//        break;
      //处理最后一级模块
      foreach ( $v as &$_v )
      {
        $path = explode( '/', $_v );
        $var=$path[count($path)-1];
        $$var=$this->ci->load->view($this->files[$_v],!$this->merge?$this->slotvars[$_v]:array_merge($this->vars,$this->slotvars[$_v]),TRUE);
        if($this->parse)
        {
          $this->vars[$var]=$this->ci->parser->_parse($$var, empty($this->vars)?array():(array)$this->vars,TRUE);
        }else{
          $this->vars[$var]=$$var;
        }
        //去掉最后一级模块
        array_pop( $path );
        $_path = implode( '/', $path );
        //并将剩余层级移至上一层级中
        if (! isset( $tmp[$k - 1] ) || ! in_array( $_path, $tmp[$k - 1] ))
          $tmp[$k - 1][] = $_path;
      }
      unset( $tmp[$k] );
    }
  }
  
  static function cmp($a, $b)
  {
    $x = substr_count( $a, '/' );
    $y = substr_count( $b, '/' );
    if ($x == $y)
      return 0;
    return ($x > $y) ? - 1 : 1;
  }
  
  function view($vars=array(),$views='',$return=FALSE)
  {

    //默认layout文件名
    $views==''?$views='layout.php':1;
    $this->vars=empty($vars)?array():(array)$vars;
    $this->return=$return;
    //处理各级模块
    $this->slot();

    if($this->parse)
    {
      $layout=$this->ci->load->view($this->layout,$this->vars,TRUE);
      return $this->ci->parser->_parse($layout, empty($this->vars)?array():(array)$this->vars,$return);
    }else{
      return $this->ci->load->view($this->layout,$this->vars,$return);
    }
  }
  
  function reset()
  {
    $this->vars=array();
    $this->return='';
    $this->slots='';
    $this->files='';
  }
  

}