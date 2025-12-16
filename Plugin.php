<?php
/**
 * 客户端 IP 地址归属地信息查询插件
 *
 * @package ip2region
 * @author 多仔
 * @version 1.0
 * @link https://www.duox.dev
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require 'vendor/autoload.php';

class ip2region_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate() {}
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate() {}
    
    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form) {}
    
    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form) {}
    
    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function render($ip) {}
    
    /**
     * 获取客户端 IP 地址归属地信息
     *
     * @access public
     * @param string $ip 客户端 IP 地址
     * @return string 客户端 IP 地址归属地信息
     */
    public static function get($ip) {
        try {
            $ip2region = new \Ip2Region('content');
            $result = $ip2region->simple($ip);
            $pattern = '/【.*?】/u';
            $result = preg_replace($pattern, '', $result);
            return $result;
        } catch (Exception $e) {
            return "未知地区";
        }
    }
}
