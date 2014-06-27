<?php

/*
  Plugin Name: WordCampMcr_ExternalApi
  Plugin URI:
  Description: Example Application Plugin for WordCamp Manchester talk
  Version: 1.0.0
  Author: Kathryn Reeve <Kathyrn@BinaryKitten.com>
  Author URI: BinaryKitten.com
 */

class WordCampMcr_ExternalApi
{
    protected $pagename = "bitcoin";
    protected static $bitcoinAmount = 0;
    protected static $gbpValue = 0;

    function __construct()
    {
        add_filter("template_include", array($this, "process_template_include"));
        add_filter('wp_title', array($this, 'process_title'), 10, 2);
        add_action('wp', array($this, 'process_wp'));
    }

    public function process_wp($wp)
    {
        if (isset($wp->query_vars["name"]) && $wp->query_vars["name"] === $this->pagename) {
            $amount = filter_input(INPUT_POST, 'btc_amount', FILTER_DEFAULT, FILTER_SANITIZE_NUMBER_FLOAT);
            self::$bitcoinAmount = $amount;
            $url = sprintf('http://bitcointy.herokuapp.com/convert/%d/GBP', $amount);
            $response = wp_remote_get($url);
            if (!is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                $data = json_decode($body);
                self::$gbpValue = $data->value;
            }
        }
    }

    public function process_template_include($original_template)
    {
        global $wp;
       
        if (isset($wp->query_vars["name"]) && $wp->query_vars["name"] === $this->pagename) {
            return plugin_dir_path(__FILE__) . "/templates/page.phtml";
        }
        return $original_template;
    }

    public function process_title($title, $sep)
    {
        global $wp;

        if (isset($wp->query_vars["name"]) && $wp->query_vars["name"] === $this->pagename) {
            $title = 'BitCointy ' . $sep . ' External API Example ' . $sep . ' ';
        }
        return $title;
    }

    public static function getResults() {

        return array(
            'btc_amount' => self::$bitcoinAmount,
            'currency_amount' => self::$gbpValue
        );
    }

    public static function isSubmitted() {
        return  (filter_input(INPUT_POST, 'btc_amount', FILTER_DEFAULT, FILTER_SANITIZE_NUMBER_FLOAT) !== false);
    }
}

new WordCampMcr_ExternalApi();